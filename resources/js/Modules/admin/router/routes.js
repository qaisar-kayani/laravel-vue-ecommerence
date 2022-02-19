
import auth from './auth.js';
import dashboard from './dashboard.js';
import product  from './product.js';
import profile  from './profile';
import categories from "./categories"
import vendorRoutes from './vendor'
import sliderRoutes from './slider'
import attributes  from "./attribute"
import attributevalue from "./attributevalue"
import order from './order.js';
import customer from './customer.js';
import group from './group.js';
const routes = [
    ...auth,
    ...dashboard,
    ...product,
    ...profile,
    ...categories,
    ...vendorRoutes,
    ...sliderRoutes,
    ...attributes,
    ...attributevalue,
    ...order,
    ...group,
    ...customer
    
];
export default routes;