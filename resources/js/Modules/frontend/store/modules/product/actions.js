import { request } from "../../../mixins/request";

export default 
{
    fetchProduct(context, payload)
    {
        // context.commit("setAuth", payload);
        let url=payload.url;
        Reflect.deleteProperty(payload,'url')
        let type =(payload.requesttype)?payload.requesttype:'GET'
        Reflect.deleteProperty(payload,'requesttype')
        return  request.methods.makeRequest(type,url,payload,false)
            .then((data) => {
                if(data.status==200){
                    
                    context.commit("setProduct", data.data);
                }
                return data
                
            })
    }
};