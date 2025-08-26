<template>

<div class="mt-2">
          <span
            class="inline-block text-xs px-2 py-1 rounded font-medium"
            :class="{
              'bg-green-100 text-green-800': jobStatus === 'open',
              'bg-red-100 text-red-800': jobStatus === 'closed',
              'bg-yellow-100 text-yellow-800': jobStatus === 'draft',
            }"
          >
            {{ jobStatus }}
          </span>
</div> 
</template>


<script>
export default{
props:{
    jobStatus: String,
}

}

</script>