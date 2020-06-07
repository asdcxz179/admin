import * as types from './mutations_type.js'
import Vue from 'vue'

// state
export const state = {
	language:'en',
}

// mutations
export const mutations = {
	[types.LANGUAGE] (state,lang){
		state.language 	 = lang;
  	}
}

