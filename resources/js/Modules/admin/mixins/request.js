import axios from "../config/apiRequest.js";
import store from "../store";
import router from "../router";
import { globalHelpers } from "./globalHelpers";


export const request = 
{
    data() {
        return {};
    },
    
    mounted() {
        // console.log(axios)
    },

    methods: 
    {
        async makeRequest(requestType = "POST", url, data = {}, showToast = false) 
        {
            
            let request = null;
            let response = {};
            if(showToast)
            {
                store.commit('setToast',true)
            }
            switch (requestType) 
            {
                case "GET":
                    request = axios.get(url, data);
                    break;
                case "POST":
                    request = axios.post(url, data);
                    break;
                case "FilePOST":
                   
                    var form_data = new FormData();
                    for ( var key in data ) {
                        
                        if(data[key] && Array.isArray(data[key]))
                        {   
                            data[key].forEach(file=>{
                               
                                form_data.append(key+'[]',file);
                            });
                        }else
                        {

                            form_data.append(key, data[key]);
                        }
                        
                    } 
                    request = axios.post(url, form_data,{
                        headers: {
                            "Content-Type": "multipart/form-data"
                          },
                    });
                    break;
                case "DELETE":
                        request = axios.delete(url, data);
                        break;
                default:
                    request = axios.post(url, data);
            }

            await request
            .then((resp) =>
            {   
                if(showToast)
                {
                    globalHelpers.methods.setToast(resp);
                }
                if( resp.data.code == 401 )
                {   
                    store.dispatch("logout", {});
                    router.push("/verify-email");
                    response = { data:{ data: null, paginationData: null }, status: 0 };
                   
                }
                else if( resp.data.code == 400 )
                {
                    response =resp
                }
                else if( resp.data.code == 404 )
                {
                    response = resp
                }
                else
                {
                    response = resp
                    
                }
               
            })
            .catch((error) => 
            {   
                if(error.response.status==401)
                {   
                    globalHelpers.methods.setToast(401,error.response.data.message);
                    
                    store.commit("logout", {})
                    router.push({name:'Login'})
                }else if(error.response.status==403)
                {   
                   
                    globalHelpers.methods.setToast(403,error.response.data.data);
                    // store.commit("logout", {})
                    // router.push({name:'Login'})

                }else if(error.response.status==500)
                {
                    globalHelpers.methods.setToast(401,error.response.data.message);

                }
                response =error.response
            })
            .finally(() => 
            {
                // globalHelpers.methods.setIsLoading(false);
                store.commit('setToast',false)
            });

            return response;
            
        },
    },
};