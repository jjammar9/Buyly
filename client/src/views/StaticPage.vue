<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import NavBar from '../components/NavBar.vue'
import FooterSection from '../components/FooterSection.vue'

const route = useRoute()

const pages = {
  about: {
    title: 'About Buyly',
    subtitle: 'We\'re on a mission to make grocery delivery fast, reliable, and accessible for everyone.',
    hero: 'https://images.unsplash.com/photo-1488459716781-31db52582fe9?w=1200&h=500&fit=crop',
    sections: [
      { heading: 'Our story', text: 'Founded with a simple idea — that getting fresh groceries shouldn\'t be a hassle. Buyly connects you with local stores and personal shoppers to bring quality food straight to your door. Today we serve millions of customers across North America with thousands of retail partners.' },
      { heading: 'Our mission', text: 'We believe everyone deserves access to fresh food without the wait. From farm-fresh produce to pantry staples, we make shopping for groceries as easy as tapping a button.' },
      { heading: 'Why Buyly', text: 'With real-time order tracking, flexible delivery options, and a 100% quality guarantee, we put you in control. Your time is valuable — let us handle the shopping.' },
    ]
  },
  careers: {
    title: 'Careers',
    subtitle: 'Join a team that\'s redefining the future of grocery delivery.',
    hero: 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&h=500&fit=crop',
    sections: [
      { heading: 'Work with us', text: 'At Buyly, we\'re building the future of online grocery. We\'re looking for passionate people who want to make a real impact. From engineering to operations, every role helps us serve millions of customers better.' },
      { heading: 'Why join?', text: 'Competitive compensation, flexible remote options, comprehensive benefits, and a culture that values growth and innovation. We invest in our people because they\'re our greatest asset.' },
      { heading: 'Open positions', text: 'We\'re hiring across engineering, product, design, marketing, and operations. Check back regularly for new opportunities or send your resume to careers@buyly.com.' },
    ]
  },
  blog: {
    title: 'Blog',
    subtitle: 'Tips, stories, and updates from the Buyly team.',
    hero: 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=1200&h=500&fit=crop',
    sections: [
      { heading: 'Latest from Buyly', text: 'Stay up to date with the latest in grocery delivery, meal planning tips, and behind-the-scenes stories from our team. From seasonal recipes to product launches, we\'ve got you covered.' },
      { heading: 'Coming soon', text: 'We\'re working on something exciting! Our blog will feature in-depth guides, customer stories, and insights into how we\'re making grocery delivery better every day.' },
    ]
  },
  press: {
    title: '',
    subtitle: 'News, announcements, and media resources.',
    hero: 'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=1200&h=500&fit=crop',
    sections: [
      { heading: 'Press releases', text: 'Get the latest news and announcements from Buyly. For press inquiries, please contact press@buyly.com.' },
      { heading: 'Media kit', text: 'Download our media kit including logos, brand guidelines, and photography. Contact our press team for high-resolution assets and executive interviews.' },
      { heading: 'In the news', text: 'Buyly has been featured in leading publications for our innovative approach to grocery delivery. From startup spotlights to industry analysis, see what the press is saying about us.' },
    ]
  },
  help: {
    title: 'Help center',
    subtitle: 'Find answers to common questions and get support.',
    hero: 'https://images.unsplash.com/photo-1553877522-43269d4ea984?w=1200&h=500&fit=crop',
    sections: [
      { heading: 'Getting started', text: 'New to Buyly? Creating an account is free and easy. Browse stores near you, add items to your cart, and choose a delivery window that works for your schedule.' },
      { heading: 'Managing your order', text: 'Track your order in real-time, communicate with your shopper, and make changes before they start shopping. You\'ll get notified at every step — from store to doorstep.' },
      { heading: 'Payment & billing', text: 'We accept all major credit cards, debit cards, and Buyly gift cards. Your payment is processed securely when your order is delivered. View your order history and download receipts anytime.' },
      { heading: 'Still need help?', text: 'Reach out to our support team at help@buyly.com or call us at 1-800-BUYLY. We\'re available 7 days a week from 6 AM to 11 PM EST.' },
    ]
  },
  returns: {
    title: 'Returns & refunds',
    subtitle: 'We stand behind every order with our satisfaction guarantee.',
    hero: 'https://images.unsplash.com/photo-1580651315530-69c8e0026377?w=1200&h=500&fit=crop',
    sections: [
      { heading: 'Our guarantee', text: 'If something isn\'t right, we\'ll make it right. Report issues within 48 hours of delivery and we\'ll issue a refund or credit for missing, damaged, or incorrect items.' },
      { heading: 'How to request a refund', text: 'Go to your order history in the app or website, select the order, and report the issue. Choose from missing items, damaged items, incorrect items, or poor replacements. Most refunds are processed within 5-7 business days.' },
      { heading: 'Contact us', text: 'Need help with a refund? Email refunds@buyly.com with your order number and details. Our team typically responds within 24 hours.' },
    ]
  },
  delivery: {
    title: 'Delivery & pickup',
    subtitle: 'Flexible options to get your groceries when and how you want them.',
    hero: 'https://images.unsplash.com/photo-1586880244406-556ebe35f282?w=1200&h=500&fit=crop',
    sections: [
      { heading: 'Same-day delivery', text: 'Choose a delivery window that works for you — as fast as one hour. Fees start at $3.99 for orders over $35. Your personal shopper picks fresh items and delivers them to your door.' },
      { heading: 'Curbside pickup', text: 'Order online and pick up at your convenience. Simply select curbside pickup at checkout, park at the designated spot, and let us know you\'ve arrived through the app. We\'ll bring your order right to your car.' },
      { heading: 'Contactless delivery', text: 'Leave at My Door is the default for all deliveries. Your shopper will drop off your order at your doorstep, send a notification, and you\'re all set — no contact needed.' },
    ]
  },
  contact: {
    title: 'Contact us',
    subtitle: 'We\'d love to hear from you. Get in touch with our team.',
    hero: 'https://images.unsplash.com/photo-1423666639041-f56000c27a9a?w=1200&h=500&fit=crop',
    sections: [
      { heading: 'Customer support', text: 'Email: help@buyly.com\nPhone: 1-800-BUYLY\nHours: Monday — Sunday, 6 AM — 11 PM EST' },
      { heading: 'Press inquiries', text: 'Email: press@buyly.com\nFor media kits, interview requests, and press releases.' },
      { heading: 'Partnerships', text: 'Email: partners@buyly.com\nInterested in listing your store on Buyly? We\'d love to talk.' },
    ]
  },
  gifts: {
    title: 'Gift cards',
    subtitle: 'The perfect gift for every occasion. Give the gift of groceries.',
    hero: 'https://images.unsplash.com/photo-1549465220-1a8b9238cd48?w=1200&h=500&fit=crop',
    sections: [
      { heading: 'Buy gift cards', text: 'Send a Buyly gift card to friends and family. Choose from fixed amounts or customize your own. Digital gift cards are delivered instantly via email — perfect for last-minute gifting.' },
      { heading: 'How to use', text: 'Redeem gift cards at checkout by entering the code. The balance will be applied to your order automatically. You can also check your gift card balance anytime in your account settings.' },
    ]
  },
  membership: {
    title: 'Buyly+ membership',
    subtitle: 'Save on every order with unlimited free delivery.',
    hero: 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=1200&h=500&fit=crop',
    sections: [
      { heading: 'What is Buyly+?', text: 'Buyly+ is our membership program that gives you $0 delivery fees on eligible orders. Members also get reduced service fees and exclusive member-only deals. It\'s the best way to save if you order regularly.' },
      { heading: 'How it works', text: 'Pay an annual or monthly membership fee and start saving immediately. $0 delivery fees on orders over $10 (grocery and retail), $35+ at Costco, and $25+ for restaurant delivery. Service fees still apply.' },
      { heading: 'Start your free trial', text: 'New members get a 14-day free trial. No commitment — cancel anytime. Try Buyly+ and see how much you can save on your weekly grocery runs.' },
    ]
  },
  coupons: {
    title: 'Coupons & deals',
    subtitle: 'Save big with exclusive offers from your favorite stores.',
    hero: 'https://images.unsplash.com/photo-1556742031-c6961e8560b0?w=1200&h=500&fit=crop',
    sections: [
      { heading: 'Current deals', text: 'Check back regularly for new coupons and promotions. Save on fresh produce, pantry staples, household essentials, and more. Deals are updated weekly.' },
      { heading: 'How coupons work', text: 'Clip coupons in the app or on the website before adding items to your cart. Savings are automatically applied at checkout. Some coupons have minimum purchase requirements — check the details on each offer.' },
    ]
  },
  accessibility: {
    title: 'Accessibility',
    subtitle: 'We\'re committed to making Buyly accessible for everyone.',
    hero: 'https://images.unsplash.com/photo-1573164713714-d95e436ab8d6?w=1200&h=500&fit=crop',
    sections: [
      { heading: 'Our commitment', text: 'Buyly is dedicated to providing an inclusive experience for all users. We continuously work to improve the accessibility of our website and app in accordance with WCAG 2.1 AA guidelines.' },
      { heading: 'Accessibility features', text: 'Screen reader support, keyboard navigation, high contrast mode, and scalable text. Our app and website are designed to work with assistive technologies.' },
      { heading: 'Feedback', text: 'If you encounter any accessibility barriers or have suggestions for improvement, please contact us at accessibility@buyly.com. Your feedback helps us build a better experience for everyone.' },
    ]
  },
  'more-ways-to-shop': {
    title: 'More ways to shop',
    subtitle: 'From same-day delivery to curbside pickup — get your groceries the way you want.',
    hero: 'https://images.unsplash.com/photo-1526367790999-0150786686a2?w=1200&h=500&fit=crop',
    sections: [
      { heading: 'Grocery delivery', text: 'Get fresh produce, pantry staples, and household essentials delivered to your door in as fast as one hour. Our personal shoppers hand-pick each item to ensure quality.' },
      { heading: 'Same-day delivery', text: 'Order by noon and receive your groceries the same day. Choose a delivery window that fits your schedule — morning, afternoon, or evening.' },
      { heading: 'Curbside pickup', text: 'Order online and pick up without leaving your car. Park in a designated spot, check in through the app, and we\'ll load your order into your vehicle.' },
      { heading: 'Alcohol delivery', text: 'Beer, wine, and spirits delivered straight to your door. Browse our selection from local retailers and enjoy responsibly. Available in select areas.' },
      { heading: 'Restaurant delivery', text: 'Craving takeout? Order from your favorite local restaurants and have it delivered hot and fresh. From pizza to sushi, we\'ve got you covered.' },
    ]
  },
  categories: {
    title: 'Browse categories',
    subtitle: 'Shop by department — from fresh produce to household essentials.',
    hero: 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=1200&h=500&fit=crop',
    sections: [
      { heading: 'Fruits & vegetables', text: 'Fresh, seasonal produce hand-picked by our shoppers. From organic greens to exotic fruits, find the freshest options for your table.' },
      { heading: 'Meat & seafood', text: 'Premium cuts of beef, chicken, pork, and fresh-caught seafood. Sourced from trusted providers and handled with care.' },
      { heading: 'Dairy & eggs', text: 'Milk, cheese, yogurt, butter, and farm-fresh eggs. Choose from organic, grass-fed, and plant-based alternatives.' },
      { heading: 'Pantry staples', text: 'Rice, pasta, oils, spices, and everything you need to stock your kitchen. From bulk buys to everyday essentials.' },
      { heading: 'Beverages', text: 'Juices, sodas, sparkling water, coffee, tea, and more. Stay refreshed with our wide selection of drinks.' },
      { heading: 'Snacks & treats', text: 'Chips, crackers, candy, chocolate, and healthier alternatives. Perfect for movie night or an afternoon pick-me-up.' },
    ]
  },
}

const slug = computed(() => route.name || 'about')
const page = computed(() => pages[slug.value] || pages.about)
</script>

<template>
  <div>
    <NavBar />
    <div class="relative h-[350px] overflow-hidden">
      <img :src="page.hero" :alt="page.title" class="w-full h-full object-cover" />
      <div :class="page.textLight !== false ? 'bg-black/40' : 'bg-white/80'" class="absolute inset-0 flex items-center justify-center">
        <div class="text-center px-6">
          <h1 v-if="page.title" :class="page.textLight !== false ? 'text-white' : 'text-[#222]'" class="text-[42px] font-bold mb-3">{{ page.title }}</h1>
          <p :class="page.textLight !== false ? 'text-white/80' : 'text-[#444]'" class="text-[17px] max-w-[600px] mx-auto leading-relaxed">{{ page.subtitle }}</p>
        </div>
      </div>
    </div>
    <div class="w-[71%] max-w-[900px] mx-auto py-14">
      <div v-for="(section, i) in page.sections" :key="i" class="mb-10 last:mb-0">
        <h2 class="text-[24px] font-bold text-[#222] mb-3">{{ section.heading }}</h2>
        <p class="text-[16px] text-[#444] leading-relaxed whitespace-pre-line">{{ section.text }}</p>
      </div>
    </div>
    <FooterSection />
  </div>
</template>
