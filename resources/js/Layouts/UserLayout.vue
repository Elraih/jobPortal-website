<template>


    <main-nav />
    <div class="bg-gray-100 min-h-screen">
        <toast v-if="flash.success" type="success" :message="flash.success" />
        <toast v-if="flash.error" type="error" :message="flash.error" />
        <slot />

    </div>
     <Footer :FooterLink="route('home')"/>

</template>


<script>

import MainNav from '@/Components/MainNav.vue';
import Toast from '../Components/UI/Toast.vue';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
export default {

    components: { MainNav, Toast},
    data() {
        return {

        }
    },
    setup(){
        const flash = computed(() => usePage().props.flash);
        return { flash };
    },
    methods: {

    }
}
</script>