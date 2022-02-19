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
        localStorage.removeItem('vendor_auth')
        localStorage.removeItem('token')
        return false
    },
    setVendor(state,payload)
    {
        state.auth.vendor=payload
    }
};