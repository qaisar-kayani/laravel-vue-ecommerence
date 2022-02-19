import store from "../store";
import moment from "moment";
import { useToast } from 'vue-toastification'

export const globalHelpers = 
{
    data() {
        let toast = useToast()
        return { toast};
    },
    
    mounted() {},

    methods: 
    {
        // axios loading
        setIsLoading(value) 
        {
            store.commit("setIsLoading", value);
        },
        setToast(status,data)
        {   
            const toast = useToast()
            // store.dispatch("createToast", toast);
            if(status==401)
            {
                toast.error(data)
            }
            if(status==403)
            { 
                $.each(data, function(key, value) {
                    
                     toast.error(data[key][0])

                  });
            }
        },
        setUpToast(data)
        {
            var type = null;
            if(data.code == 200)
                type = "success";
            else if(data.code == 401)
                type = "error";
            else if(data.code == 400)
                type = "error";
            else
                type = "error";
            
            return {
                type: type,
                message: data.message,
                position: "right_btm"
            };
        },
        
        

        // Date-time formatter
        vpDate(date, format = "DD-MM-YYYY")
        {
            return moment(date).format(format);
        },
        vpNum(number, fix = 2)
        {
            return new Intl.NumberFormat().format(Number(number).toFixed(fix));
        },
        _setObject(object, key, value =  null)
        {
            object[key] = value;
            return new Proxy(object, {});
        },
       
         // Validation helpers
         _vClass(validator, field)
         {      
            
             if(validator?.[field]?.$errors?.length > 0)
             {    
                
                return "is-invalid";
             }
             return "";
         },
         _vError(validator, field)
         {
             if(validator?.[field]?.$errors?.length > 0)
             {
                 return true;
             }
             return false;
         },
         _vErrorMessage(validator, field)
         {    
             if(validator?.[field]?.$errors?.length > 0)
             {  
                 return validator[field].$errors[0].$message;
             }
             return "";
         },
         //string limit show
         _vstr_limit(value, size) {
            if (!value) return '';
            value = value.toString();
        
            if (value.length <= size) {
              return value;
            }
            return value.substr(0, size) + '...';
          },
          _vImageShow(image)
          {
            if (image) {
                return process.env.MIX_APPURL+image
            }  
          }
    },
};