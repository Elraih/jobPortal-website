<template>

    <span  class="inline-block mt-1 text-xs px-2 py-1 rounded font-medium" :class="{
            'bg-orange-100 text-orange-800': status == 'pending',
            'bg-blue-100 text-blue-800': status == 'reviewed',
            'bg-green-100 text-green-800': status == 'in consideration',
            'bg-red-100 text-red-800': status == 'rejected'
          }">
            {{ status }}
    </span>

</template>

<script>
export default {
    mounted(){
        console.log(this.status);
        
    },  
    props:{
        status: String,
    }
    
}
</script>