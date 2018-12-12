import PropTypes from 'prop-types'

import prefix from '../../helpers/prefix'
import Types from './Types'

const { __ } = wp.i18n
const { TextControl } = wp.components

const Filters = ({
  type,
  onChangeType,
  limit,
  onChangeLimit,
  children,
}) => (
  <div className={`${prefix}-filter`}>
    <Types
      value={type}
      onChange={onChangeType}
    />
    <TextControl
      type="number"
      label={__('Limit', 'vikoder-posts-block')}
      value={limit}
      onChange={onChangeLimit}
    />
    {children}
  </div>
)

Filters.propTypes = {
  type: PropTypes.string.isRequired,
  onChangeType: PropTypes.func.isRequired,
  limit: PropTypes.number.isRequired,
  onChangeLimit: PropTypes.func.isRequired,
  children: PropTypes.node.isRequired,
}

export default Filters
