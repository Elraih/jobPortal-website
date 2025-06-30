<template>

    <dashboard-nav>

        <template v-slot:navbarAvatarList>
            <li>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 "
                    role="menuitem">Dashboard</a>
            </li>
            <li>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 "
                    role="menuitem">Dashboard</a>
            </li>
        </template>
    </dashboard-nav>


    <dashboard-sidebar>
        <template v-slot:sidebarList>
            <li>
                <Link :href="route('admin.jobs.index')">jobs</Link>
            </li>
        </template>
    </dashboard-sidebar>


    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg  mt-14">

            <slot />
        </div>
    </div>


</template>


<script>


import DashboardNav from '@/Components/Nav/DashboardNav.vue';
import DashboardSidebar from '@/Components/Nav/DashboardSidebar.vue';
export default {

    components: { DashboardNav, DashboardSidebar },
    data() {
        return {

        }
    },

    methods: {

    }
}
</script>