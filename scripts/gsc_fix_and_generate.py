import os, re, csv, json, pathlib
import pandas as pd

DOMAIN = "https://www.hoosiercladding.com"

# Use the attached CSV files
in_pages = "/Users/malware/Downloads/hoosiercladding.com-Performance-on-Search-2025-10-20/Pages.csv"
in_queries = "/Users/malware/Downloads/hoosiercladding.com-Performance-on-Search-2025-10-20/Queries.csv"

out_dir = pathlib.Path("outputs")
snip_dir = out_dir / "snippets"
out_dir.mkdir(parents=True, exist_ok=True)
snip_dir.mkdir(parents=True, exist_ok=True)

def norm_num(s):
    if pd.isna(s): return None
    s = str(s).strip().replace("%","").replace(",","")
    try:
        return float(s)
    except:
        return None

# Load
pages = pd.read_csv(in_pages)
queries = pd.read_csv(in_queries)

# Standardize columns
pages = pages.rename(columns={"Top pages":"url"})
queries = queries.rename(columns={"Top queries":"query"})

for col in ["Clicks","Impressions","CTR","Position"]:
    if col in pages.columns:
        pages[col] = pages[col].apply(norm_num)

for col in ["Clicks","Impressions","CTR","Position"]:
    if col in queries.columns:
        queries[col] = queries[col].apply(norm_num)

# Basic cleanup: drop rows without URL
pages = pages.dropna(subset=["url"]).copy()

# Helper: strip protocol + trailing slash normalization key
def strip_domain(u:str):
    u = u.strip()
    u = re.sub(r"^https?://(www\.)?hoosiercladding\.com","",u,flags=re.I)
    u = u or "/"
    return u

def canonical_key(u:str):
    # group key that ignores ending slash only
    path = strip_domain(u)
    if path != "/" and path.endswith("/"):
        path = path[:-1]
    return path or "/"

def slug_from_url(u:str):
    path = canonical_key(u).strip("/")
    return path if path else "home"

pages["path"] = pages["url"].apply(strip_domain)
pages["canon_key"] = pages["url"].apply(canonical_key)
pages["slug"] = pages["url"].apply(slug_from_url)

# Decide canonical per canon_key by highest Impressions
canon_choice = (
    pages.sort_values(["canon_key","Impressions"], ascending=[True,False])
         .groupby("canon_key", as_index=False)
         .first()[["canon_key","url","Impressions"]]
         .rename(columns={"url":"canonical_url","Impressions":"canonical_impr"})
)

pages = pages.merge(canon_choice, on="canon_key", how="left")
pages["is_canonical"] = pages["url"].eq(pages["canonical_url"])

# Identify underperformers
pages["ctr_num"] = pages["CTR"]
low_ctr = pages[(pages["Impressions"]>50) & ((pages["ctr_num"].fillna(0)<1.0))]
too_low_pos = pages[(pages["Position"].fillna(100)>15) & (pages["Impressions"]>50)]

targets = pd.concat([low_ctr, too_low_pos], ignore_index=True).drop_duplicates(subset=["url"])

# Heuristic token extraction from slug
CITY_TOKENS = ["bluffton","mishawaka","south-bend","fort-wayne","goshen","elkahrt","elkhart","granger","muncie","valparaiso","kokomo","warsaw","anderson","noblesville","carmel","avon","plainfield"]
SERVICE_TOKENS = ["vinyl","fiber-cement","fiber","aluminum","steel","wood","soffit","fascia","gutters","repair","installation","replace","siding","home-siding","house-siding","vinyl-siding"]

def guess_city(slug:str):
    parts = re.split(r"[-/]+", slug.lower())
    for t in CITY_TOKENS:
        if t in parts or "-"+t in slug.lower() or slug.lower().endswith(t):
            return t.replace("-"," ").title()
    return None

def guess_service(slug:str):
    s = slug.lower()
    if "vinyl" in s: return "Vinyl Siding"
    if "fiber" in s: return "Fiber Cement Siding"
    if "repair" in s: return "Siding Repair"
    if "installation" in s or "install" in s: return "Siding Installation"
    if "soffit" in s or "fascia" in s: return "Soffit & Fascia"
    if "gutter" in s: return "Gutters"
    if "siding" in s: return "Home Siding"
    return "Home Siding"

def nice_city(c):
    if not c: return None
    # Fix common misspelling
    if c.lower()=="elkahrt": return "Elkhart"
    return c

# Tokenize queries for mapping
def tokenize(q):
    return re.findall(r"[a-zA-Z]+", str(q).lower())

queries["tokens"] = queries["query"].apply(tokenize)

# Build quick city/service token lists for mapping
CITY_WORDS = set([w for t in CITY_TOKENS for w in t.split("-")])
SERVICE_WORDS = {"siding","vinyl","fiber","cement","repair","install","installation","contractor","contractors","company","companies"}

def score_query_for_slug(q_tokens, slug):
    s = slug.lower()
    score=0
    for t in q_tokens:
        if t in s: score+=2
        if t in CITY_WORDS: score+=1
        if t in SERVICE_WORDS: score+=1
    return score

# For each target page, pick top 3 matching queries by heuristic score & impressions
def top_queries_for_slug(slug):
    if queries.empty:
        return []
    q = queries.copy()
    q["score"] = q["tokens"].apply(lambda toks: score_query_for_slug(toks, slug))
    q = q.sort_values(["score","Impressions"], ascending=[False,False])
    return [r["query"] for _,r in q.head(3).iterrows() if r["score"]>0]

def build_title(service, city, brand="Hoosier Cladding"):
    parts=[]
    if city and service:
        parts.append(f"{service} in {city}")
    elif service:
        parts.append(service)
    else:
        parts.append("Home Siding")
    parts.append("Durable • Fast Quotes")
    parts.append(brand)
    title = " | ".join(parts)
    # Keep ~ 55–60 chars if possible
    return title[:70]

def build_meta(service, city):
    if city:
        return (f"{service} for homes in {city}, IN — install, replacement, and repair. "
                f"Licensed, insured, and built to Indiana weather. Get a same-day quote.")
    return (f"{service} done right — install, replacement, and repair. "
            f"Licensed, insured. Get a same-day quote.")

def build_faq(service, city):
    city_txt = f" in {city}, IN" if city else ""
    faqs = [
        {
          "@type":"Question",
          "name": f"How much does {service.lower()}{city_txt} cost?",
          "acceptedAnswer": {"@type":"Answer","text": f"Costs vary by material and square footage. We provide firm quotes after a quick site check and can match most written estimates."}
        },
        {
          "@type":"Question",
          "name": f"Do you offer {service.lower()} repair{city_txt}?",
          "acceptedAnswer": {"@type":"Answer","text": "Yes. We handle storm damage, warped panels, and color-matched replacements. Most repairs are completed in a single visit."}
        },
        {
          "@type":"Question",
          "name": f"How fast can you start {service.lower()}?",
          "acceptedAnswer": {"@type":"Answer","text": "Typical lead time is 3–7 days depending on material availability. Emergency service is available for urgent issues."}
        }
    ]
    return {
      "@context":"https://schema.org",
      "@type":"FAQPage",
      "mainEntity": faqs
    }

# Generate outputs
rec_rows=[]
redirect_rules=[]

for _,r in targets.sort_values("Impressions", ascending=False).iterrows():
    url = r["url"]
    slug = r["slug"]
    city = nice_city(guess_city(slug))
    service = guess_service(slug)
    queries_3 = top_queries_for_slug(slug)
    title = build_title(service, city)
    meta = build_meta(service, city)
    faq = build_faq(service, city)

    # Snippet files
    target_dir = snip_dir / slug
    target_dir.mkdir(parents=True, exist_ok=True)
    (target_dir/"title.txt").write_text(title, encoding="utf-8")
    (target_dir/"meta.txt").write_text(meta, encoding="utf-8")
    (target_dir/"faq.jsonld").write_text(json.dumps(faq, ensure_ascii=False, indent=2), encoding="utf-8")

    # Collect rec row
    rec_rows.append({
        "url": url,
        "slug": slug,
        "canonical_for_group": "YES" if r.get("is_canonical") else "NO",
        "impressions": r.get("Impressions"),
        "position": r.get("Position"),
        "ctr_pct": r.get("ctr_num"),
        "guessed_service": service,
        "guessed_city": city or "",
        "top_queries": "; ".join(queries_3),
        "recommend_title": title,
        "recommend_meta": meta,
        "snippet_dir": str(target_dir)
    })

# Canonical map & redirects between variants
canon_map_rows=[]
for key, grp in pages.groupby("canon_key"):
    # canonical
    can_url = grp.iloc[grp["Impressions"].fillna(0).argmax()]["url"]
    for _, rr in grp.iterrows():
        canon_map_rows.append({"group_key": key, "url": rr["url"], "canonical_url": can_url})
        if rr["url"] != can_url:
            # create 301 rule
            from_path = strip_domain(rr["url"])
            to_url = can_url
            redirect_rules.append((from_path, to_url))

# Write outputs
pd.DataFrame(rec_rows).to_csv(out_dir/"recommendations.csv", index=False)
pd.DataFrame(canon_map_rows).to_csv(out_dir/"canonical_map.csv", index=False)

with open(out_dir/"htaccess_redirects.txt","w",encoding="utf-8") as f:
    f.write("# --- 301 Canonical Redirects (place in vhost or .htaccess) ---\n")
    f.write("RewriteEngine On\n")
    for from_path, to_url in redirect_rules:
        # ensure leading slash
        if not from_path.startswith("/"): from_path="/"+from_path
        f.write(f'RewriteRule ^{re.sub(r"^/","",from_path)}$ {to_url} [R=301,L]\n')

print("DONE: recommendations, snippets, canonical map, and redirects generated under /outputs")
