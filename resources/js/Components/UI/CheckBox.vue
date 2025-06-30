<template>
  <div class="space-y-2">
    <h3 class="font-semibold text-gray-700 mb-1">{{ label }}</h3>
    <div v-for="option in options" :key="option[valueKey]" class="flex items-center gap-2">
      <label class="flex items-center gap-2 cursor-pointer">
        <input type="checkbox" class="form-checkbox text-blue-600" :value="option[valueKey]" v-model="modelProxy" />
        {{ option[labelKey] }}
      </label>
    </div>
  </div>
</template>

<script>
export default {
  name: 'CheckBox',
  props: {
    label: String,
    options: Array,
    valueKey: {
      type: String,
      default: 'id',
    },
    labelKey: {
      type: String,
      default: 'name',
    },
    modelValue: Array,
  },
  emits: ['update:modelValue'],
  computed: {
    modelProxy: {
      get() {
        return this.modelValue;
      },
      set(val) {
        this.$emit('update:modelValue', val);
      },
    },
  },
};
</script>
