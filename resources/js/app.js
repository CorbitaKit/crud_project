import router from './routes.js';
import GlobalImport from './plugins/global-import.js';
require('./bootstrap');

window.Vue = require('vue');

Vue.use(GlobalImport)



const app = new Vue({
    el: '.app',
    router,
    computed:{
		currentPage(){
			return this.$route.path
		}
	},
});
