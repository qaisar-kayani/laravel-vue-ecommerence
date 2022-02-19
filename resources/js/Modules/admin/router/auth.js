// middleware
import NotAuthMiddleware from '../middleware/NotAuthMiddleware';
// Components
import Login from '../views/auth/Login.vue';

export default [
	{
		name: 'Login',
		path: '/admin/',
		component: Login,
		meta: {
			middleware:NotAuthMiddleware
		}
	},
	
	{
		name: 'Login',
		path: '/admin/Login',
		component: Login,
		meta: {
			middleware:NotAuthMiddleware
		}
	}
];
