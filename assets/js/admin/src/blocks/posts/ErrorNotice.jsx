import PropTypes from 'prop-types'

const { Notice } = wp.components

const ErrorNotice = ({ error }) => (
  <Notice status="error" isDismissible={false}>
    <p>{error.message}</p>
  </Notice>
)

ErrorNotice.propTypes = {
  error: PropTypes.shape().isRequired,
}

export default ErrorNotice
