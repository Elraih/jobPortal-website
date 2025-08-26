<template>
    
<nav class="fixed top-0 z-50 w-full shadow-lg inset-shadow-blue-950 text-white bg-blue-900">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <button @click="sidebarToggle"  class="cursor-pointer inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
               <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
         </button>
        
      </div>
      <div class="flex items-center ">
          <div class="flex items-center ms-3">
            <div>
              <button @click="toggleNav" type="button"  class="cursor-pointer flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                <span class="sr-only">Open user menu</span>
               
                <img class="w-8 h-8 rounded-full" :src="$page.props.auth.logo ? `/storage/${$page.props.auth.logo}` : '/img/company_default.png'" alt="user photo">
              </button>
            </div>
            <div :class="dashNavAvatar ? '' : 'hidden'" class="relative list-none rounded-sm shadow-sm " >
              <div class="absolute top-5 right-3.5 px-4 py-3 bg-white shadow-xl rounded-2xl border border-gray-200 " role="none">
                <p class="text-sm text-gray-900 " role="none">
                  Hello
                </p>
                <p v-if="$page.props?.auth?.user" class="text-sm font-medium text-gray-900 truncate " role="none">
                  {{ $page.props.auth.user.email }}
                </p>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</nav>
  <aside :class="isOpenSidebar ? '' : '-translate-x-full'" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform bg-blue-900 border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" >
   <div class="h-full px-3 pb-4 overflow-y-auto bg-blue-900 dark:bg-gray-800">
      <ul class="space-y-4 font-medium text-white">
         
         <slot name="sidebarList" />
      </ul>
      
   </div>
</aside>
      
                

</template>

<script>

export default{
    components: {},

    props:{

    },

    data(){
      return{
        dashNavAvatar: false,
        isOpenSidebar: false,
      }
    },

    methods:{
      toggleNav(){
        this.dashNavAvatar = !this.dashNavAvatar
      },
      sidebarToggle(){
        this.isOpenSidebar = !this.isOpenSidebar;
        
      }
    }
}
</script>