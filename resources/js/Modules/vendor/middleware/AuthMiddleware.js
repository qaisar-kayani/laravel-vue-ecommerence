import store from '../store';
import router from '../router';
export default (to, from, next) => {
	let auth = store.getters.auth;
	if (!auth) {
		router.push({ name: 'Login' });
		// store.commit('logout');
		return false;
	}

   
 
	
};
