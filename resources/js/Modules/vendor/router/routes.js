
import auth from './auth.js';
import dashboard from './dashboard.js';
import product  from './product.js';
import profile  from './profile';
import order from './order.js';
import bidding from './bidding.js';
const routes = [
    ...auth,
    ...dashboard,
    ...product,
    ...profile,
    ...order,
    ...bidding
    
];
export default routes;