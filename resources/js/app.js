
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/* Basic */

import VueRouter from 'vue-router';
import store from './store';
import VueSweetalert2 from 'vue-sweetalert2';
import VueCookies from 'vue-cookies'
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(VueSweetalert2);
Vue.use(VueCookies);

/* Language*/

import VueI18n from 'vue-i18n'

const i18n = new VueI18n();

/* Compent */
const Login = () => import('./components/AdminLTE/Login.vue');
const Register = () => import('./components/AdminLTE/Register.vue');
const Layout = () => import('./components/AdminLTE/Layout.vue');
const Dashboard = () => import('./components/AdminLTE/Dashboard.vue');

axios.interceptors.response.use(function (response) {
	AxiosHanlde(response);
	return response;
}, function (error) {
	AxiosHanlde(error.response);
});

function AxiosHanlde(data){

	var swal_settings 	=	{
		heightAuto:false,
	};
	switch(data.status){
		case 200:
			swal_settings.title 	=	i18n.t('common').success;
			swal_settings.icon 		=	'success';
			swal_settings.html 		=	data.data.message;
		break;
		case 422:
			swal_settings.title 	=	i18n.t('common').warning;
			swal_settings.icon 		=	'warning';
			swal_settings.html 		=	data.data.message;
		break;
		case 500:
			swal_settings.title 	=	i18n.t('common').error;
			swal_settings.icon 		=	'error';
			swal_settings.html 		=	i18n.t('common.system-error');
		break;
		default:
			swal_settings.title 	=	i18n.t('common').error;
			swal_settings.icon 		=	'error';
			swal_settings.html 		=	i18n.t('common.undefind-error')+':'+data.status;
		break;
	}
	Vue.swal(swal_settings);
}

Vue.use(VueRouter);

const routes = [
  // { path: '/', component: Dashboard },
  { path: '/Register', component: Register },
  { path: '/Login', component: Login },
];

const router = new VueRouter({
  routes 
});

var vm = new Vue({
	el: '#app',
	store,
	router,
	i18n,
	data:{
		language_type:{
			'en':'English',
			'zh-TW':'繁體中文',
		},
		loadedLanguages:[],
	},
	methods:{
		loadLanguageAsync:function(){
			// if (this.$i18n.locale !== this.$store.getters.getLang) {
			// 	if (!this.loadedLanguages.includes(this.$store.getters.getLang)) {
					return import(/* webpackChunkName: "lang-[request]" */ `../lang/${this.$store.getters.getLang}/${this.$store.getters.getLang}.json`).then(msgs => {
					    this.$i18n.setLocaleMessage(this.$store.getters.getLang, msgs.default);
					    this.loadedLanguages.push(this.$store.getters.getLang);
						return this.setI18nLanguage();
					});
			// 	}
			// 	return Promise.resolve(this.setI18nLanguage());
			// }
			// return Promise.resolve(this.$store.getters.getLang);
		},
		setI18nLanguage:function(){
			this.$i18n.locale = this.$store.getters.getLang;
			this.$cookies.set('lang',this.$i18n.locale);
		  	document.querySelector('html').setAttribute('lang', this.$i18n.locale);
		  	return this.$i18n.locale;
		}
	},
	mounted:function(){
		var lang = this.$cookies.get('lang');
		if(lang){
			this.$store.commit('LANGUAGE', lang);
		}
		this.loadLanguageAsync(this.$store.getters.getLang);
	},
	computed:{
		getLang:{
    		get(){
    			return this.$store.getters.getLang;
    		},
    		set(newLang){
    			this.$store.commit('LANGUAGE', newLang);
    			this.loadLanguageAsync();
    		}
    	}
	}
});
