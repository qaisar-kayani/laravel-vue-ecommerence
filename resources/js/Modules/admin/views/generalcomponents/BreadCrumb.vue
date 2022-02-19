<template lang="">
    <div class="py-5">
                <div class="row g-4 align-items-center">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-sa-simple mb-5">
                                <li class="breadcrumb-item " ><router-link :to="{name:'dashboard'}">Dashboard </router-link></li>
                                <li class="" aria-current="page">/</li>
                                <li class="breadcrumb-item active" aria-current="page" ><router-link :to="{name:currentRoute}"> {{pageHeading}}</router-link></li>
                            </ol>
                        </nav>
                    <h1 class="h3 m-0">{{pageHeading}} </h1>
                    </div>
                    <div class="col-auto d-flex" v-if="nextRouteName && nextRouteHeading">
                        <router-link  :to="{name:nextRouteName}" class="btn btn-primary">{{nextRouteHeading}}</router-link>
                    </div>
                </div>
            </div>
</template>
<script>
export default {
     props: {
                pageHeader: { type: Object },
            },
    mounted() {
        console.log(this.pageHeading)    
    },  
    data() {
                return {
                    pageHeading:this.pageHeader.pageHeading,
                    currentRoute:this.pageHeader.currentRoute,
                    nextRouteName:this.pageHeader.nextRouteName,
                    nextRouteHeading:this.pageHeader.nextRouteHeading
                }
            },
            
}
</script>
<style lang="">
    
</style>