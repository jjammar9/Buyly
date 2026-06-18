<script setup>
import { ref } from 'vue'

const openIndex = ref(null)

function toggle(i) {
  openIndex.value = openIndex.value === i ? null : i
}

const faqs = [
  {
    q: 'How does Buyly work?',
    a: 'Buyly makes it easy to order from your favorite stores. Shop for items from stores near you, with a selection of top retailers and trusted local grocers across your area. Then, Buyly will connect you with a personal shopper in your area to shop and deliver your order. Contactless delivery is available with our "Leave at my door" option.\n\nYou can track your order\'s progress and communicate with your shopper every step of the way using the Buyly app or website.\n\nBuyly also offers curbside pickup at select retail locations. Simply place your order and choose a pickup time, and a shopper will prepare your order at the store.\n\nWhen you get to the store, use the Buyly app to notify us. Depending on the store, a shopper or store employee will bring the groceries to your car, or you can pick them up at the designated area.',
  },
  {
    q: 'Do I need a membership to order?',
    a: 'You don\'t need a membership to order with Buyly. You can shop from a wide range of stores without any membership fees.\n\nTo get started, create an account, select the store you want to shop, and place your order.',
  },
  {
    q: 'How much does delivery cost?',
    a: 'Delivery: Fees start at $3.99 for same-day orders over $35. Fees vary for one-hour deliveries and deliveries under $35.\n\nService fees: Service fees vary and are subject to change based on factors like location and the number and types of items in your cart. Orders containing alcohol have a separate service fee.\n\nWith an optional Buyly+ membership, you can get $0 delivery fees on eligible orders over $35. Service fees still apply.',
  },
  {
    q: 'Where do the prices come from?',
    a: 'Retail partners set the prices of items on the Buyly marketplace. While many retailers offer everyday store prices on Buyly, some retailers may set prices on the Buyly platform that are different from in-store prices.\n\nYou can view pricing policies for each retailer on the Buyly app and website.',
  },
  {
    q: 'What happens if an item is out of stock?',
    a: 'Buyly makes it easy to communicate with your shopper. When an item you want is out-of-stock at the store, your shopper will follow your replacement preferences.\n\nYou can set item and delivery instructions in advance, as well as chat directly with your shopper while they shop and deliver your items. You can tell the shopper to:\n\nFind Best Match: By default, your shopper will use their best judgement to pick a replacement for your item.\nPick Specific Replacement: You can pick a specific alternative for the shopper to purchase if your first choice is out-of-stock.\nDon\'t Replace: For items you\'d rather not replace, choose "Don\'t replace" to get a refund if the item is out of stock.',
  },
  {
    q: 'Can I change or cancel my order?',
    a: 'You can update or cancel your order as long as your shopper hasn\'t started shopping. If you need to make changes after shopping has started, you can use the app or website to approve replacements or chat with your shopper.',
  },
  {
    q: 'What if something is wrong with my order?',
    a: 'If something isn\'t right, you\'ve got options. In the Buyly app or website, you can report:\n\nMissing items\nIncorrect items\nDamaged items\nPoor replacements\nEarly/late orders\n\nIf an order never came, or you get someone else\'s order, you can reach out to Buyly Customer Experience.',
  },
  {
    q: 'Is contactless delivery available?',
    a: 'The health and safety of our community is our number one priority. We offer contactless delivery through our Leave at My Door delivery feature.\n\nLeave at My Door delivery gives you the flexibility to have your groceries delivered without having to come to the door or be at home. You can leave delivery instructions for your shopper at checkout, and we\'ll notify you when your order arrives.\n\nLeave at My Door is the default setting for all Buyly deliveries. If you\'d prefer to not use this feature, simply uncheck the box that says "Leave at my door if I\'m not around" at checkout.\n\nCustomers who order alcohol, prescriptions, or certain high-value items may need to show ID upon delivery.',
  },
]
</script>

<template>
  <section class="w-[71%] max-w-[1200px] mx-auto mt-[60px] mb-16">
    <h2 class="text-center text-[30px] font-bold text-[#222] mb-10">Common questions</h2>
    <div class="flex flex-col gap-0">
      <div
        v-for="(faq, i) in faqs"
        :key="i"
        class="border-b border-[#e0e0e0]"
      >
        <button
          class="w-full flex justify-between items-center py-5 text-left bg-transparent border-0 cursor-pointer"
          @click="toggle(i)"
        >
          <span class="text-[28px] font-bold text-[#222]">{{ faq.q }}</span>
          <svg
            class="shrink-0 ml-4 transition-transform duration-200"
            :class="openIndex === i ? 'rotate-180' : ''"
            width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#222" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
          >
            <polyline points="6 9 12 15 18 9"/>
          </svg>
        </button>
        <div v-if="openIndex === i" class="pb-5 pr-4">
          <p class="text-[17px] text-[#222] leading-[1.7] whitespace-pre-line">{{ faq.a }}</p>
        </div>
      </div>
    </div>
  </section>
</template>
