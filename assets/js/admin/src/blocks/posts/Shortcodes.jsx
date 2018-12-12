import PropTypes from 'prop-types'

import getShortcode from '../../helpers/get-shortcode'

const { RawHTML } = wp.element

const Shortcode = ({ attributes }) => (
  <RawHTML>
    {getShortcode(attributes)}
  </RawHTML>
)

Shortcode.propTypes = {
  attributes: PropTypes.shape().isRequired,
}

export default Shortcode
