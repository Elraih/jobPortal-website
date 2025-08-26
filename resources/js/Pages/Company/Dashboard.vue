<template>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div class="bg-green-300 text-white py-5 px-3 text-center">
            <h2>Number Of Companies</h2>
            <p>{{ companyCount }}</p>
        </div>


        <div class="bg-blue-300 text-white py-5 px-3 text-center">
            <h2>Number Of JobSeekers</h2>
            <p>{{ userCount }}</p>
        </div>

        <div class="bg-blue-300 text-white py-5 px-3 text-center">
            <h2>Number Of Jobs</h2>
            <p>{{ jobPostCount }}</p>
        </div>
    </div>

</template>


<script>
export default{
    props:{
        jobPostCount: Number,
        companyCount: Number,
        userCount: Number, 
    },
    mounted(){
        // console.log(this.jobPostCount);
        
    }
}

</script>