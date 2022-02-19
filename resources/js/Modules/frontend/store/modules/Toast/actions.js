import { request } from "../../../mixins/request";
export default 
{
    createToast(context, payload)
    {
        var toastId = Math.floor(Math.random() * 999999);
        context.commit("setToast", {...payload, id: toastId});
        setTimeout( () => {
            context.commit("removeToast", toastId);
        }, 2000);
    }
};