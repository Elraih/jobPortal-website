<template>

    <span class="inline-block mt-1 text-xs px-2 py-1 rounded font-medium" :class="{
            'bg-green-100 text-green-800': status === 'open',
            'bg-yellow-100 text-yellow-800': status === 'draft',
            'bg-red-100 text-red-800': status === 'closed'
          }">
            {{ status }}
    </span>

</template>

<script>
export default {
    props:{
        status: {
            type: String,
        },
    }
    
}
</script>