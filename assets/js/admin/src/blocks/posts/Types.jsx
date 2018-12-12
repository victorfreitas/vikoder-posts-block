import PropTypes from 'prop-types'

import { postTypes } from '../../environments'

const { __ } = wp.i18n
const { SelectControl } = wp.components

const Types = ({ value, onChange }) => (
  <SelectControl
    label={__('Post Type', 'vikoder-posts-block')}
    value={value}
    options={postTypes}
    onChange={onChange}
  />
)

Types.propTypes = {
  value: PropTypes.string.isRequired,
  onChange: PropTypes.func.isRequired,
}

export default Types
