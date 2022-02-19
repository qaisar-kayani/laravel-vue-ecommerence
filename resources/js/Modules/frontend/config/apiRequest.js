import axios from "axios";

const defaultOptions = {
    baseURL: process.env.MIX_API_URL,
    headers: {
        // "Access-Control-Allow-Origin": "*",
        // "Content-Type": "application/json",
    },
};

const MAX_REQUESTS_COUNT = 1;
const INTERVAL_MS = 10;
let PENDING_REQUESTS = 0;

const instance = axios.create(defaultOptions);

// Request interceptor
instance.interceptors.request.use(
    function(config) 
    {
        return new Promise((resolve, reject) => {
            
            let interval = setInterval(() => 
            {
                if(PENDING_REQUESTS < MAX_REQUESTS_COUNT ) 
                {
                    PENDING_REQUESTS++
                    clearInterval(interval);

                    // Before request sent
                    // Inject in body
                    // config.data.application = "webMerchant";
                    // config.data.applicationVersion = "1.33";
                    // config.data.deviceId = "web";
                    // config.data.deviceDetail = "XYXYXYXYXYXYXYX";
                    // Inject in headers
                    // config.headers.apiId = 1;
                    // config.headers.apiSecret = "XYXYXYXYXYX";

                    // Update token in localStorage
                    if (localStorage.getItem("user_token")) {
                        config.headers.Authorization ='Bearer '+localStorage.getItem("user_token");
                    }

                    resolve(config)
                }
            }, INTERVAL_MS)
        });
        
    },
    function(error) {
        // Do something with request error
      
        return Promise.reject(error);
    }
);

// Response interceptor
instance.interceptors.response.use(
    function(response) 
    {      
        // Update token in localStorage
        if (response.data?.data?.token) {
            localStorage.setItem("user_token", response.data.data.token);
        }
        PENDING_REQUESTS = Math.max(0, PENDING_REQUESTS - 1);
        return response;
    },
    function(error) 
    {   
        console.log(error)
        PENDING_REQUESTS = Math.max(0, PENDING_REQUESTS - 1);
        return Promise.reject(error);
    }
);

export default instance;