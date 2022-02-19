<template lang="">
              <div class="so-categories module custom-slidercates">
                <h3 class="modtitle"><span>Shop by Categories</span></h3>
                <div class="modcontent">
                    <div class="cat-wrap theme3 font-title">
                        <div class="yt-content-slider" data-rtl="yes" data-autoplay="no" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="30" data-items_column0="7" data-items_column1="4" data-items_column2="4"  data-items_column3="2" data-items_column4="1" data-arrows="yes" data-pagination="no" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
                            <div class="content-box" v-for="(cat ,index) in categories" :key="index" >
                                <div class="image-cat">
                                    <a :href="baseUrl('category/'+cat.slug)"  target="_self">
                                        <img  :src="showImage(cat.image)" :title="cat.name" :alt="cat.name"  >
                                    </a>
                                </div>
                                <div class="cat-title"> 
                                  <a :href="baseUrl('category/'+cat.slug)" title="Smart Phones" target="_self">{{cat.name}}</a>
                                </div>
                            </div>
                           
                          
                            
                        </div>
                    </div>
                </div>
            </div>

</template>
<script>
export default {
    props:['shop_category'],
    data() {
        return {
            categories:[]
        }
    },
    mounted() {
       this.categories=JSON.parse(this.shop_category)
        
    },
    methods: {
        
    },

}
</script>
<style lang="">
    
</style>