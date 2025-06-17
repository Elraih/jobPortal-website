<template v-once>
    <p class=" mb-2 text-sm font-medium text-gray-900">{{ label }}</p>
    <textarea v-if="mode === 'textarea'" v-bind="value"/>
    <input class="border bg-gray-50 border-gray-600 rounded px-3 py-2" placeholder="Enter Skills.." v-else :value="value" v-on:change="onChange">
</template>
  
  <script>
import Tagify from "@yaireo/tagify";
import '@yaireo/tagify/dist/tagify.css';
// import "./tagify.css"
  
  export default {
    name: "Tags",
    props: {
      mode: String,
      label: String,
      settings: Object,
      value: [String, Array],
      onChange: Function
    },
    watch: {
      value(newVal, oldVal) {
        this.tagify.loadOriginalValues(newVal)
      },
    },
    mounted() {
      this.tagify = new Tagify(this.$el, this.settings)
    }
  };
  </script>