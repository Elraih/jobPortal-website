<template>
  

</template>

<script>
export default{
   props:{
      sidebar: {
         type: Boolean,
      }
   },
   watch:{
      sidebar(newval){
         console.log(newval);
         
      }
   }

   
}

</script>