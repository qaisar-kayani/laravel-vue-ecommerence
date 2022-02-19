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
 head_script(src_url) {
    let src=process.env.MIX_API_ASSET+src_url
    if(document.querySelector("script[src='" + src + "']")){ return; }
    let script = document.createElement('script');
    script.setAttribute('src',src);
    script.async = true;

    script.setAttribute('type', 'text/javascript');
    document.head.appendChild(script)
},

 body_script(src_url) {
    let src=process.env.MIX_API_ASSET+src_url
    if(document.querySelector("script[src='" +src + "']")){ return; }
    let script = document.createElement('script');
    script.setAttribute('src', src);
    // script.async = true;
    script.setAttribute('type', 'text/javascript');
    document.body.appendChild(script)
},

 del_script(src_url) {
    let src=process.env.MIX_API_ASSET+src_url
    
    let el = document.querySelector("script[src='" + src + "']");
    if(el){ el.remove(); }
    
},


 head_link(href_url) {
    let href=process.env.MIX_API_ASSET+href_url
    if(document.querySelector("link[href='" + href + "']")){ return; }
    let link = document.createElement('link');
    link.setAttribute('href', href);
    link.setAttribute('rel', "stylesheet");
    link.setAttribute('type', "text/css");
    document.head.appendChild(link)
},

 body_link(href) {
    if(document.querySelector("link[href='" + href + "']")){ return; }
    let link = document.createElement('link');
    link.setAttribute('href', href);
    link.setAttribute('rel', "stylesheet");
    link.setAttribute('type', "text/css");
    document.body.appendChild(link)
},

 del_link(href) {
    let el = document.querySelector("link[href='" + href + "']");
    if(el){ el.remove(); }
},
 hello()
{
    $('.sa-select2').select2({
        width: '100%',
    });
},

//image Base64
 imageBase64(file)
        {   
                 
            let rawImg=[]
            file.forEach( (element,index) => {
                const reader = new FileReader()

                reader.onloadend =(fileLoadedEvent) => {
                 rawImg[index]=fileLoadedEvent.target.result
                console.log('hi')
                // console.log(fileLoadedEvent.target)
                // console.log(fileLoadedEvent.target.result)
                
                }
                reader.readAsDataURL(element);
            });
            return rawImg

        }

},
}