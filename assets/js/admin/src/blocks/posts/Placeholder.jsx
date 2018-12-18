import PropTypes from 'prop-types'

import prefix from '../../helpers/prefix'

const { components } = wp
const { __ } = wp.i18n

const Placeholder = ({ children, isLoading }) => (
  <components.Placeholder
    icon="grid-view"
    label={__('Latest Posts by Vikoder', 'vikoder-posts-block')}
    className={`${prefix}-placeholder${isLoading ? ' loading' : ''}`}
    instructions={__('Display a grid of latest posts with featured image', 'vikoder-posts-block')}
  >
    {children}
  </components.Placeholder>
)

Placeholder.propTypes = {
  children: PropTypes.node.isRequired,
  isLoading: PropTypes.bool.isRequired,
}

export default Placeholder
