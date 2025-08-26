<!-- components/UI/Toast.vue -->
<template>
    <transition name="fade">
        <div v-if="visible && message" :class="classType" class="fixed top-10 right-6 text-white px-4 py-2 rounded shadow-lg z-50">
            {{ message }}
        </div>
        
    </transition>
</template>

<script>
export default {
    name: "Toast",
    props: {
        message: {
            type: String,
            required: true,
        },
        type:{
            type: String
        },
        duration: {
            type: Number,
            default: 5000, // 3 seconds
        },
    },
    data() {
        return {
            visible: false,
        };
    },
    computed:{
        classType(){
            return this.type == 'success' ? 'bg-green-500' : 'bg-red-500';
        }
    },
    watch: {
        message: {
            immediate: true,
            handler(val) {
                if (val) {
                    this.visible = true;
                    setTimeout(() => {
                        this.visible = false;
                    }, this.duration);
                }
            },
        },
    },
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>