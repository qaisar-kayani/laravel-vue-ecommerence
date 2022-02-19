import store from "../store"

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
        isLogin()
        {
            if(store.getters.auth)
            return true
            else
            return false
        },
        auth()
        {
            if(!store.getters.auth){this.redirect('login')}
        },
        // for images path concat
        showImage(path)
        {
            return process.env.MIX_APPURL+path
        },
        toUpperCase(str,type='first')
        {  
            if(str==undefined){return ''}
            if(type=='full')
            {
                return  str.toUpperCase();
            }else if(type=='first')
            {
                // return  str.charAt(0).toUpperCase()+str.slice(1);
                return  str;

            }else
            {
                return str
            }
        },
        //base url
        baseUrl(url='')
        {
            return process.env.MIX_APPURL+url
        },
        currency(price,symbal='AED',language='en-US')
        {
            return symbal+' '+ (new Intl.NumberFormat(language, ).format(price));
        },
        //text limit
        textLimit(str,length=0)
        {
            if(str.length>length)
            {
                return str.substring(0,length)+'...'
            }else
            {
                return str
            }
        },
        //notification 
         notification(title, thumb, text, type) {
            $.jGrowl.defaults.closer = false;
            //Stop jGrowl
            //$.jGrowl.defaults.sticky = true;
            var tpl = thumb + '<h3>'+text+'</h3>';
            $.jGrowl(tpl, {		
                life: 4000,
                header: title,
                speed: 'slow',
                theme: type
            });
        },
        redirect(path)
        {
            window.location.href=process.env.MIX_APPURL+path
        },
        //rating 
		ratingClass(index,rating)
		{
			if(rating>index || rating==index ) return 'fa-star'
			else return 'fa-star-o'
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
     isProductPercentage(numA, numB) {

        let discount=numB-numA

        return (discount / numB) * 100;
      }
        
        
        
    },
}