import { blockName, postId } from '../../environments'
import Posts from './Posts'
import Shortcode from './Shortcodes'

const { registerBlockType } = wp.blocks
const { __ } = wp.i18n

registerBlockType(blockName, {
  title: __('Latest Posts by Vikoder', 'vikoder-posts-block'),
  icon: 'grid-view',
  category: 'widgets',
  keywords: [__('Vikoder', 'vikoder-posts-block')],
  description: __('Display a grid of latest posts with featured image', 'vikoder-posts-block'),
  attributes: {
    type: {
      type: 'string',
      default: 'post',
    },
    limit: {
      type: 'number',
      default: 3,
    },
    exclude: {
      type: 'number',
      default: postId,
    },
  },
  edit: Posts,
  save: Shortcode,
})
