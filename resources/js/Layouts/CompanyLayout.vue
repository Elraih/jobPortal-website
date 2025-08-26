<template>

    <dashboard-nav>
        <template v-slot:sidebarList>

            <li :class="$page.url.startsWith('/company/dashboard') ? 'bg-white text-blue-900 p-2 rounded-lg transition' : 'hover:bg-blue-700 p-2 transition rounded-lg'">
                <Link :href="route('company.dashboard')">Dashboard</Link>
            </li>
            <li :class="$page.url.startsWith('/company/profile/') ? 'bg-white text-blue-900 p-2 rounded-lg transition' : 'hover:bg-blue-700 p-2 transition rounded-lg'">
                <Link :href="route('company.profile.show', {user: $page.props.auth.company.id})">Profile</Link>
            </li>
            <!-- <li :class="$page.url.startsWith('/company/account') && $page.url.endsWith('edit') ? 'bg-white text-blue-900 p-2 rounded-lg transition' : 'hover:bg-blue-700 p-2 transition rounded-lg'">
                <Link :href="route('company.profile.edit', {user: $page.props.auth.company.id})">Edit Profile</Link>
            </li> -->
            <li :class="$page.url.endsWith('/company/jobs') ? 'bg-white text-blue-900 p-2 rounded-lg transition' : 'hover:bg-blue-700 p-2 transition rounded-lg'">
                <Link :href="route('company.jobs.index')">All Jobs</Link>
            </li>
            <li :class="$page.url.endsWith('/trashed') ? 'bg-white text-blue-900 p-2 rounded-lg transition' : 'hover:bg-blue-700 p-2 transition rounded-lg'">
                <Link :href="route('company.jobs.trashed')">Archived Jobs</Link>
            </li>
            <li :class="$page.url.startsWith('/company/jobs/create') ? 'bg-white text-blue-900 p-2 rounded-lg transition' : 'hover:bg-blue-700 p-2 transition rounded-lg'">
                <Link :href="route('company.jobs.create')">Create Job</Link>
            </li>
            <li :class="$page.url.startsWith('/company/account/') ? 'bg-white text-blue-900 p-2 rounded-lg transition' : 'hover:bg-blue-700 p-2 transition rounded-lg'">
                <Link :href="route('company.account.edit', {user: $page.props.auth.company.id})" >Edit Account</Link>
            </li>


            <li class="hover:bg-blue-700 p-2 transition rounded-lg">
                <form @submit.prevent="logout">
                    <button class="cursor-pointer">Logout</button>
                </form>
            </li>
           
        </template>
    </dashboard-nav>


    <div class="p-5 sm:ml-64 bg-gray-300 ">
        <div class="rounded-lg  mt-14">

            <toast v-if="flash.success" type="success" :message="flash.success" />
            <toast v-if="flash.error" type="error" :message="flash.error" />
            <slot />
        </div>
    </div>


</template>


<script>


import DashboardNav from '@/Components/Nav/DashboardNav.vue';
import DashboardSidebar from '@/Components/Nav/DashboardSidebar.vue';
import Toast from '../Components/UI/Toast.vue';

export default {

    components: { DashboardNav, DashboardSidebar, Toast },
    data() {
        return {

        }
    },

    methods: {
        logout(){
            this.$inertia.post(route('logout'), {}, {
            replace:true,
        });
        }
        
    },
    computed:{
        flash(){
            return this.$page.props.flash;
        }
    },
    mounted(){
        console.log(this.$page.url);
        
    }

    
}
</script>