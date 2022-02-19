// middleware
import NotAuthMiddleware from '../middleware/NotAuthMiddleware';
// Components
import Login from '../views/auth/Login.vue';

export default [
	{
		name: 'Login',
		path: '/vendor/',
		component: Login,
		meta: {
			middleware:NotAuthMiddleware
		}
	},
	
	{
		name: 'Login',
		path: '/vendor/Login',
		component: Login,
		meta: {
			middleware:NotAuthMiddleware
		}
	}
];
