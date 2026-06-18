export function useMeta(title, description) {
  document.title = title ? `${title} — Buyly` : 'Buyly — Fresh groceries delivered'
  let meta = document.querySelector('meta[name="description"]')
  if (!meta) {
    meta = document.createElement('meta')
    meta.name = 'description'
    document.head.appendChild(meta)
  }
  meta.content = description || 'Fresh groceries and everyday essentials delivered to your door.'
}
