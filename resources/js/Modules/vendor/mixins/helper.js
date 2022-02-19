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
        timeAgo(date) {
            var ms = (new Date()).getTime() - date.getTime();
            var seconds = Math.floor(ms / 1000);
            var minutes = Math.floor(seconds / 60);
        var hours = Math.floor(minutes / 60);
        var days = Math.floor(hours / 24);
        var months = Math.floor(days / 30);
        var years = Math.floor(months / 12);
    
        if (ms === 0) {
            return 'Just now';
        } if (seconds < 60) {
            return seconds + ' seconds Ago';
        } if (minutes < 60) {
            return minutes + ' minutes Ago';
        } if (hours < 24) {
            return hours + ' hours Ago';
        } if (days < 30) {
            return days + ' days Ago';
        } if (months < 12) {
            return months + ' months Ago';
        } else {
            return years + ' years Ago';
        }
    
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
        }
        
        
    },
}