import { request } from "../../../mixins/request";

export default 
{
    fetchCategoiesList(context, payload)
    {
        // context.commit("setAuth", payload);
        
        return  request.methods.makeRequest("GET","catalog/product/list/",payload,false)
            .then((data) => {
                // if(data.status==200){
                    
                    context.commit("setCategoriesList", data?.data?.data);
                //     localStorage.setItem('vendor_auth',JSON.stringify(data?.data.data))
                // }
                console.log(data)
                return data
                
            })
    }
};