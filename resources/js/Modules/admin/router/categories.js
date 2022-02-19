// middleware
import AuthMiddleware from '../middleware/AuthMiddleware';
// Components
import category from '../views/pages/categories/List.vue';
import categoryAdd from '../views/pages/categories/Add.vue';
import categoryEdit from '../views/pages/categories/Edit.vue';

export default [
	{
		name: 'category-list',
		path: '/admin/category',
		component: category,
		meta: {
			middleware:AuthMiddleware
		}
	},
    {
        name:'category-add',
        path:'/admin/category/add',
        component:categoryAdd,
        meta:{
            middleware:AuthMiddleware
        }
    },
    {
        name:'category-edit',
        path:'/admin/category/edit/:id',
        component:categoryEdit,
        meta:{
            middleware:AuthMiddleware
        }
    }
];
