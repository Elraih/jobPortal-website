<template>

<section class="bg-cover h-screen bg-center bg-fixed overflow-y-auto py-10" 
    :style="{
      backgroundImage: `linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.6)), url('${backgroundImage}')`
    }">
    <div class="max-w-6xl mx-auto px-4 ">
        <toast v-if="flash.success" type="success" :message="flash.success" />
        <toast v-if="flash.error" type="error" :message="flash.error" />
        
        <slot />
    </div>
</section>


</template>


<script>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import Toast from '../Components/UI/Toast.vue';

export default{
    components:{Toast},
        props:{
            backgroundImage: {
                type: String,
                default: '/img/hero.jpg'
        },
    },
    setup(){
        const flash = computed(() => usePage().props.flash);
        return { flash };
    },
    
    
}
</script>