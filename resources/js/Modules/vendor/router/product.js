// middleware
import AuthMiddleware from '../middleware/AuthMiddleware';
// Components
import Product from '../views/pages/product/List.vue';
import ProductAdd from '../views/pages/product/Add.vue';
import ProductEdit from '../views/pages/product/Edit.vue';
import Attribute from '../views/pages/product/Attribute.vue';

export default [
	{
		name: 'product-list',
		path: '/vendor/product',
		component: Product,
		meta: {
			middleware:AuthMiddleware
		}
	},
    {
        name:'product-add',
        path:'/vendor/product/add',
        component:ProductAdd,
        meta:{
            middleware:AuthMiddleware
        }
    },
    {
        name:'product-edit',
        path:'/vendor/product/edit/:id',
        component:ProductEdit,
        meta:{
            middleware:AuthMiddleware
        }
    },
    {
        name:'product-attribute',
        path:'/vendor/product/attribute/:product_id',
        component:Attribute,
        meta:{
            middleware:AuthMiddleware
        }
    }
];
