import PropTypes from 'prop-types'

import prefix from '../../helpers/prefix'

const ListItem = ({ post }) => (
  <div className={`${prefix}-cart-item`} key={post.key}>
    <a href={post.link} title={post.title} className={`${prefix}-link`}>
      <img src={post.thumb} alt={post.title} />
      <span>
        {post.title}
      </span>
    </a>
  </div>
)

ListItem.propTypes = {
  post: PropTypes.shape({
    slug: PropTypes.string.isRequired,
    link: PropTypes.string.isRequired,
    title: PropTypes.string.isRequired,
    thumb: PropTypes.string.isRequired,
  }).isRequired,
}

export default ListItem
