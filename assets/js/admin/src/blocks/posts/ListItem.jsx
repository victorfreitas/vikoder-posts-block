import PropTypes from 'prop-types'

import prefix from '../../helpers/prefix'

const ListItem = ({ post }) => (
  <div className={`${prefix}-card-item`}>
    <a href={post.link} title={post.title} className={`${prefix}-link`}>
      <div className={`${prefix}-card-thumb`}>
        <img src={post.thumb} alt={post.title} />
      </div>
      <h4 className={`${prefix}-card-title`}>
        {post.title}
      </h4>
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
