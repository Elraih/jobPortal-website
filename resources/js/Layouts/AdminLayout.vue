<template>

    <dashboard-nav>
        <template  v-slot:sidebarList>

            <li :class="$page.url.startsWith('/admin/dashboard') ? 'bg-white text-blue-900 p-2 rounded-lg transition' : 'hover:bg-blue-700 p-2 transition rounded-lg'">
                <Link :href="route('admin.dashboard')">Dashboard</Link>
            </li>
            <li :class="$page.url.endsWith('/admin/user') ? 'bg-white text-blue-900 p-2 rounded-lg transition' : 'hover:bg-blue-700 p-2 transition rounded-lg'">
                <Link :href="route('admin.user.index')">All Jobseekrs</Link>
            </li>
            <li :class="$page.url.endsWith('user/trashed') ? 'bg-white text-blue-900 p-2 rounded-lg transition' : 'hover:bg-blue-700 p-2 transition rounded-lg'">
                <Link :href="route('admin.user.trashed')">Deleted Jobseekrs</Link>
            </li>
            <li :class="$page.url.endsWith('/admin/company') ? 'bg-white text-blue-900 p-2 rounded-lg transition' : 'hover:bg-blue-700 p-2 transition rounded-lg'">
                <Link :href="route('admin.company.index')">All Companies</Link>
            </li>
            <li :class="$page.url.endsWith('/company/trashed') ? 'bg-white text-blue-900 p-2 rounded-lg transition' : 'hover:bg-blue-700 p-2 transition rounded-lg'"> 
                <Link :href="route('admin.company.trashed')">Deleted Companies</Link>
            </li>
            <li :class="$page.url.endsWith('/admin/jobs') ? 'bg-white text-blue-900 p-2 rounded-lg transition' : 'hover:bg-blue-700 p-2 transition rounded-lg'">
                <Link :href="route('admin.jobs.index')">All Job</Link>
            </li>
            <li :class="$page.url.endsWith('/admin/jobs/trashed') ? 'bg-white text-blue-900 p-2 rounded-lg transition' : 'hover:bg-blue-700 p-2 transition rounded-lg'">
                <Link :href="route('admin.jobs.trashed')">Deleted Job</Link>
            </li>
            <li :class="$page.url.startsWith('/admin/profile/') ? 'bg-white text-blue-900 p-2 rounded-lg transition' : 'hover:bg-blue-700 p-2 transition rounded-lg'">
                <Link :href="route('admin.profile.edit', {user: $page.props.auth.admin.id})">Edit Account</Link>
            </li>
            

            <li class="hover:bg-blue-700 p-2 transition rounded-lg">
                <form @submit.prevent="logout">
                    <button>Logout</button>
                </form>
            </li>
           
        </template>
    </dashboard-nav>


    <div class="p-5 sm:ml-64 min-h-screen bg-gray-300 ">
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
            this.$inertia.post(route('logout'))
            
        }
        
    },
    computed:{
        flash(){
            return this.$page.props.flash;
        }
    },

    
}
</script>