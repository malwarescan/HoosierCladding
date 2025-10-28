PHP ?= php

build:
	@$(PHP) scripts/build_sitemaps.php

matrix:
	@$(PHP) scripts/generate_matrix.php

careers:
	@$(PHP) scripts/generate_career_matrix.php

news:
	@$(PHP) scripts/build_news_only.php

validate:
	@$(PHP) scripts/validate_sitemaps.php

audit:
	@$(PHP) scripts/crawl_audit.php

ping:
	@$(PHP) scripts/ping_sitemaps.php https://www.hoosiercladding.com/sitemaps/sitemap-index.xml.gz

# NDJSON Feed Testing
FEED=https://www.hoosiercladding.com/feeds/products.ndjson

feed-head:
	@curl -I $(FEED)

feed-test:
	@curl -s $(FEED) | head -n 3

feed-validate:
	@curl -s $(FEED) | $(PHP) tools/validate_ndjson.php

