export default {
    props: ["date"],
    data()
    {
        return {
            message: "Not found!",
        }
    },
    mounted () {
        // console.log('hi')
    }
    ,
    methods: {  
        test()
        {
            console.log('yesy')
        },
        // for images path concat
        showImage(path)
        {
            return process.env.MIX_APPURL+path
        },
        toUpperCase(str,type='first')
        {
            if(type=='full')
            {
                return  str.toUpperCase();
            }else if(type=='first')
            {
                return  str.charAt(0).toUpperCase()+str.slice(1);

            }else
            {
                return str
            }
        },
      currency(price,symbal='AED',language='en-US')
        {
            return symbal+' '+ (new Intl.NumberFormat(language, ).format(price));
        },
        orderstatusClass(type)
        {   
            let result='badge badge-sa-secondary'
            if (type=='placed') {
                result= 'badge badge-sa-primary'
            }
            else if(type=='processing')
            {
                result='badge badge-sa-success'
            }
            else if(type=='shipping')
            {
                result= 'badge badge-sa-success'
            }
            else if(type=='Canceled')
            {
                result= 'badge badge-sa-danger'
            }
            return result
        },
        productStatus(type)
        {   
            let result='badge badge-sa-secondary'
            if (type=='pending') {
                result= 'badge badge-sa-primary'
            }
            else if(type=='active')
            {
                result='badge badge-sa-success'
            }
            else if(type=='inactive')
            {
                result= 'badge badge-sa-danger'
            }
            return result
        },
        generatefilter(filterData)//generall filter
        {   
            let filter='';
           
             filterData.forEach(element => {
                 filter+='&filter['+element.type+']'+'['+element.name+']='+element.value
            });
            return filter
        },
        //all order status
        orderStatusDropdown()
        {
            let statusList=['placed','processing','on-hold','cancelled','refund','failed','shipped','completed']
            let result='';
            statusList.forEach(element => {
                result+=`<option value='`+element+`'>`+this.toUpperCase(element)+`</option>`
            });
            return result
        }
        
        
        
    },
}