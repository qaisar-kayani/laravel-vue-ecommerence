export default 
{
    setAuth(state, payload)
    {
        state.isLogin = true
        state.auth=payload
    },
    logout(state)
    {
        state.isLogin=false;
        localStorage.removeItem('admin_auth')
        localStorage.removeItem('admin_token')
        
    },
    setVendor(state,payload)
    {
        state.auth.vendor=payload
    }
};