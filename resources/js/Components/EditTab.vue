<template>


<div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px">
        
        <li class="me-2">
            <Link  :href="route('user.profile.editInfo')" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">Edit Information</Link>
        </li>
        <li class="me-2">
            <Link  :href="route('user.profile.editSkills')" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Edit Skills</Link>
        </li>
        <li class="me-2">
            <Link  :href="route('user.profile.editExperience')" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Edit Experience</Link>
        </li>
        
    </ul>
</div>


</template>

<script>

export default{

data(){
    return{
       
    }
},


}

</script>