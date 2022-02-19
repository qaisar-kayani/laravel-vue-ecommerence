import { request } from "../../../mixins/request";

export default 
{
    fetchProductList(context, payload)
    {
        let query=(payload?.query)?payload.query:''
        
        return  request.methods.makeRequest("POST","catalog/product/list"+query,payload,true)
            .then((data) => {
                if(data.status==200){
                    
                    context.commit("setProductList", data);
                }
                return data
                
            })
    },
    saveProduct(context, payload)
    {
        return  request.methods.makeRequest("FilePOST","catalog/product/add",payload,false)
            .then((data) => {
                return data
                
            })
    },
    updateProduct(context, payload)
    {
        return  request.methods.makeRequest("FilePOST",'catalog/product/edit/'+payload._id,payload,false)
            .then((data) => {
                return data
                
            })
    }
};