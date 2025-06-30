<template>


    <main-nav />
    <div class="bg-gray-100 min-h-screen">

        <slot />

    </div>

</template>


<script>

import mainNav from '../Components/mainNav.vue';
export default {

    components: { mainNav },
    data() {
        return {

        }
    },

    methods: {

    }
}
</script>