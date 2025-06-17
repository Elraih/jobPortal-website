<template>

    <Table>

        <template v-slot:tableHead>
            <th scope="col" class="px-6 py-3">
                    Product name
            </th>
            <th scope="col" class="px-6 py-3">
                    Product name
            </th>
        </template>

        <template v-slot:tableBody>
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                    Apple MacBook Pro 17"
                </th>
                <td class="px-6 py-4">
                    Silver
                </td>
                <td class="px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
                </td>
        </template>
    </Table>
</template>


<script>
import Table from '@/Components/UI/Table.vue';

import AdminLayout from '@/Layouts/AdminLayout.vue';

export default{

    layout: AdminLayout,

    components: { Table},
    data(){
        return {

        }
    },
    
}
</script>