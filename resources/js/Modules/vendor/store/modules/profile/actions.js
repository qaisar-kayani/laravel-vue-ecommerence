import { request } from "../../../mixins/request";

export default 
{
    uploadProfile(context, payload)
    {
        // context.commit("setAuth", payload);
        return  request.methods.makeRequest("FilePOST","vendor/profile/edit/"+payload.id,payload,false)
            .then((data) => {
                // if(data.status==200){
                    
                //     context.commit("setAuth", data?.data?.data);
                //     localStorage.setItem('vendor_auth',JSON.stringify(data?.data.data))
                // }
                console.log(data)
                return data
                
            })
    }
};