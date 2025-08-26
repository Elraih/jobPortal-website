<template>
  <div class="space-y-2">
    <!-- <h3 class="font-semibold text-gray-700 mb-1">{{ label }}</h3> -->
    <div class="flex items-center gap-2">
      <label :for="name" class="flex items-center gap-2 cursor-pointer"> 
        <input @change="update($event)"  type="checkbox" :filterKey="filterKey" class="form-checkbox text-blue-600" :value="value"  id="name"/>
        {{ label }}
      </label>
    </div>
  </div>
</template>


<script>
export default {
  name: 'CheckBox',
  props: {
    label: String,
    value: Number,
    filterKey: String,
    name: String,
  },
  data(){
    return{
      checked:false,
    }
  },
 methods:{
  update(event){
    this.$emit('filter-change', {
      event,
      key: this.filterKey,
      value: this.value,
      checked: event.target.checked,
      
    })
  }
 }

};
</script>
