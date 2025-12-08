import { sendFactlet } from '../croutons-sdk/index.js';

async function main() {
  console.log('🧪 Testing Croutons satellite integration...\n');

  const fact = {
    '@type': 'Factlet',
    page_id: 'https://www.hoosiercladding.com/about',
    passage_id: 'https://www.hoosiercladding.com/about#p1',
    fact_id: 'https://www.hoosiercladding.com/about#f1',
    claim: 'Our solar panels reduce emissions by 40%.'
  };

  try {
    console.log('Sending factlet:', JSON.stringify(fact, null, 2));
    const result = await sendFactlet(fact);
    console.log('\n✅ Success!');
    console.log('Response:', JSON.stringify(result, null, 2));
  } catch (error) {
    console.error('\n❌ Error:', error.message);
    process.exit(1);
  }
}

main();

