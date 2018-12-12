import prefix from '../helpers/prefix'

export const globalVars = window[`${prefix}GlobalVars`] || {}
export const { blockName } = globalVars
export const { restPath } = globalVars
export const { postTypes } = globalVars
export const postId = parseInt(globalVars.postId, 10)
