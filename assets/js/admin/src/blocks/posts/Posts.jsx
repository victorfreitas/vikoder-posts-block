import PropTypes from 'prop-types'

import { restPath } from '../../environments'
import Placeholder from './Placeholder'
import Filters from './Filters'
import ErrorNotice from './ErrorNotice'
import List from './List'

import 'scss/admin-posts'

const { apiFetch } = wp
const { addQueryArgs } = wp.url
const { Component } = wp.element
const { Spinner } = wp.components

class Posts extends Component {
  state = {
    posts: [],
    isLoading: true,
  }

  componentDidMount() {
    const { attributes: { type, limit } } = this.props

    this.fetchPosts(type, limit)
  }

  onSuccess = (posts) => {
    this.setState({
      posts,
      isLoading: false,
      error: null,
    })
  }

  onError = (error) => {
    this.setState({
      error,
      isLoading: false,
    })
  }

  getPath(type, limit) {
    const { attributes: { exclude } } = this.props

    return addQueryArgs(restPath, { limit, type, exclude })
  }

  handleChangeType = (type) => {
    const { attributes: { limit } } = this.props

    this.handleChange(type, limit)
  }

  handleChangeLimit = (limit) => {
    const { attributes: { type } } = this.props

    this.handleChange(type, limit)
  }

  handleChange(type, limit) {
    const { setAttributes } = this.props

    setAttributes({
      type,
      limit: parseInt(limit, 10),
    })

    this.setState({ isLoading: true })
    this.fetchPosts(type, limit)
  }

  fetchPosts(type, limit) {
    apiFetch({ path: this.getPath(type, limit) })
      .then(this.onSuccess)
      .catch(this.onError)
  }

  render() {
    const { posts, isLoading, error } = this.state
    const { attributes: { type, limit } } = this.props

    return (
      <Placeholder>
        <Filters
          type={type}
          onChangeType={this.handleChangeType}
          limit={limit}
          onChangeLimit={this.handleChangeLimit}
          isLoading={isLoading}
        >
          {isLoading ? <Spinner /> : null}
        </Filters>
        {error
          ? <ErrorNotice error={error} />
          : <List posts={posts} />}
      </Placeholder>
    )
  }
}

Posts.propTypes = {
  attributes: PropTypes.shape().isRequired,
  setAttributes: PropTypes.func.isRequired,
}

export default Posts
