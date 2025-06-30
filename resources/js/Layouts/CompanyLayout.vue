<template>

    <dashboard-nav />

    <dashboard-sidebar>
        <template v-slot:sidebarList>

            <li>
                <Link :href="route('company.jobs.index')">All Job</Link>
            </li>
            <li>
                <Link :href="route('company.jobs.create')">Create Job</Link>
            </li>
            <li>
                <Link :href="route('company.jobs.edit')">Edit Job</Link>
            </li>
            <li>
                <Link :href="route('company.job-applications.index')">All Job Applications</Link>
            </li>
            <li>
                <Link :href="route('company.job-applications.show')">Show Job Application</Link>
            </li>

            <li>
                <Link :href="route('company.profile.show')">Show Profile</Link>
            </li>
            <li>
                <Link :href="route('company.user.show')">Show User Profile</Link>
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