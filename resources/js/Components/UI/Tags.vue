<!-- resources/js/Components/Form/TagInput.vue -->
<template>
  <label :for="name" class="block mb-2 text-sm font-medium text-gray-900 ">{{ label }}</label>
  <input ref="tagInputRef"  :id="name" :autocomplete="autocomplete"/>
  <small v-if="error" class="mt-2 text-sm  text-red-600 ">{{ error }}</small>

</template>

<script>
import Tagify from '@yaireo/tagify';
import '@yaireo/tagify/dist/tagify.css';

export default {
  name: 'TagInput',
  props: {
    error: String,
    name:{type: String, default: ''},
    autocomplete: {type:String, default: 'off'},
    modelValue: {
      type: [Array],
      default: () => [],
    },
    whitelist: {
      type: Array,
      default: () => [],
    },
    label: String,
    placeholder: {
      type: String,
      default: 'Add tags...',
    },
  },
  emits: ['update:modelValue'],
  data() {
    return {
      tagify: null,
    };
  },
  mounted() {
    const inputEl = this.$refs.tagInputRef;

    this.tagify = new Tagify(inputEl, {
      whitelist: this.whitelist,
      originalInputValueFormat: valuesArr => valuesArr.map(item => item.value),
      dropdown: {
        maxItems: 20,
        enabled: 0,
        closeOnSelect: false,
      },
      enforceWhitelist: false,
      placeholder: this.placeholder,
    });

    // Set initial value
    if (Array.isArray(this.modelValue)) {
      this.tagify.addTags(this.modelValue);
    }

    // Emit on change
    this.tagify.on('change', () => {
      const values = this.tagify.value.map(tag => tag.value);
      this.$emit('update:modelValue', values);
    });
  },
  beforeUnmount() {
    this.tagify.destroy();
  },
};
</script>
