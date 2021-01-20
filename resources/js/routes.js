import Vue from 'vue';
import VueRouter from 'vue-router';

//Component
import DashboardLayout from './components/dashboard-layout.vue';
import UserLayout from './components/pages/user-page.vue';
import AddUserLayout from './components/pages/add-user-page.vue';
import ProductLayout from './components/pages/product-page.vue';
import AddProductLayout from './components/pages/add-product.vue';
import OrderLayout from './components/pages/order-page.vue';
import AddOrderLayout from './components/pages/add-order.vue';
import OrderSummary from './components/pages/order-summary.vue';
Vue.use(VueRouter);

const routes = [
	
	{
		path : '/dashboard',
		component : DashboardLayout
	},
	{
		path : '/customer',
		component : UserLayout
	},
	{
		path : '/add-customer/:id?',
		component : AddUserLayout,
		name : 'add-customer'
	},
	{
		path : '/product',
		component : ProductLayout
	},
	{
		path : '/add-product/:id?',
		component : AddProductLayout,
		name : 'add-product'
	},
	{
		path : '/order',
		component : OrderLayout
	},
	{
		path : '/add-order',
		component : AddOrderLayout
	},
	{
		path : '/order-summary/:id?',
		component : OrderSummary,
		name : 'order-summary'
	}



];


export default new VueRouter({routes,mode:'history',base : __dirname});