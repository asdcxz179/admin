import Vue from 'vue'
import mutations from './mutations'
// 引入 mutations_type （引用同一個 key）
import * as types from './mutations_type.js'

export const actionSetLanguage = ({commit,lnag}) => {
	commit(types.LANGUAGE)
};