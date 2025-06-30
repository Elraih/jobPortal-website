<!-- components/UI/Toast.vue -->
<template>
    <transition name="fade">
        <div v-if="visible" class="fixed bottom-6 right-6 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50">
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
        duration: {
            type: Number,
            default: 3000, // 3 seconds
        },
    },
    data() {
        return {
            visible: false,
        };
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