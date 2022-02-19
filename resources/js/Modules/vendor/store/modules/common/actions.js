import { values } from "lodash";
import { request } from "../../../mixins/request";

export default 
{
   async saveData(context, payload)
    {
        let url=payload.url;
        Reflect.deleteProperty(payload,'url')
        let type =(payload.requesttype)?payload.requesttype:'FilePOST'
       return  await  request.methods.makeRequest(type,url,payload,false)
            .then((data) => {
                return data
                
            })
    },
   async updateData(context, payload)
    {
        let url=payload.url;
        Reflect.deleteProperty(payload,'url')
        let type =(payload.requesttype)?payload.requesttype:'FilePOST'
        return await request.methods.makeRequest(type,url,payload,false)
            .then((data) => {
                return data
                
            })
    },
   async getRow(context, payload)
    {
        let url=payload.url;
        Reflect.deleteProperty(payload,'url')
        let type =(payload.requesttype)?payload.requesttype:'GET'
        return await request.methods.makeRequest(type,url,payload,false)
            .then((data) => {
                return data
                
            })
    },
  
async getData(context, payload)
    {
        let url=payload.url;
        Reflect.deleteProperty(payload,'url')
        let type =(payload.requesttype)?payload.requesttype:'GET'
        url+=(payload?.query)?payload.query:''
        return await request.methods.makeRequest(type,url,payload,false)
            .then((data) => {
                return data
                
            })
    },
  async  delRow(context, payload)
    {
        let url=payload.url;
        
        console.log(payload)
        let type =(payload.requesttype)?payload.requesttype:'POST'
            Reflect.deleteProperty(payload,'url')
        return await request.methods.makeRequest(type,url,payload,false)
            .then((data) => {
                return data
                
            })
    },
    
};