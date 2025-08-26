<template>

<div class="relative overflow-x-auto">
    <table :class="['w-full table-auto shadow text-sm bg-white rounded', tableSpacing]">
        <thead class="bg-gray-100 text-left">
            <tr class="">
                <slot name="tableHead" />
            </tr>
        </thead>
        <tbody>
            <slot name="tableBody" />
            
        </tbody>
    </table>
</div>


</template>

<script>
export default{

    props:{
        tableSpacing: {
                type:String,
                default: 'border-separate border-spacing-y-2'
            }
    },
    data(){
        return{
            
        }
    },
}
</script>