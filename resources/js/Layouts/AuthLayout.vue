
<template>

<section class="bg-cover h-screen bg-center bg-fixed overflow-y-auto py-10" 
    :style="{
      backgroundImage: `linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.6)), url('${backgroundImage}')`
    }">
    <div class="max-w-6xl mx-auto px-4 ">

        <slot />
    </div>
</section>


</template>


<script>

// import mainNav from '../Components/mainNav.vue';
export default{

    props:{
        backgroundImage: {
            type: String,
            default: '/img/hero.jpg'
        }

    },
    data(){
        return{
            
        }
    },

    methods:{
        
    }
}
</script>