
<template>


<main-nav />
    
    <slot />


</template>


<script>

import mainNav from '../Components/mainNav.vue';
export default{

    components: {mainNav},
    data(){
        return{
            
        }
    },

    methods:{
        
    }
}
</script>