import prefix from './prefix'

export default atts => (
  `[${prefix} ${Object
    .entries(atts)
    .map(([name, value]) => `${name}="${value}"`)
    .join(' ')}]`
)
