import PropTypes from 'prop-types'

import prefix from '../../helpers/prefix'
import ListItem from './ListItem'

const List = ({ posts }) => (
  <div className={`${prefix}-cards`}>
    {posts.map(post => <ListItem key={post.key} post={post} />)}
  </div>
)

List.propTypes = {
  posts: PropTypes.arrayOf(PropTypes.shape()).isRequired,
}

export default List
