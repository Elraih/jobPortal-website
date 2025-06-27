<template>
  <section :style="{
    backgroundImage: `linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.6)), url('/img/hero.jpg')`
  }" class="min-h-96 max:h-screen bg-cover bg-center bg-no-repeat pb-12  px-4 text-center">


    <div class="max-w-4xl mx-auto">

      <hero-header />

      <hero-search />

    </div>
  </section>
</template>

<script>
import mainNav from '../mainNav.vue';
import heroHeader from './HeroHeader.vue';
import HeroSearch from './HeroSearch.vue';
export default {

  components: { mainNav, heroHeader, HeroSearch },
  data() {
    return {

    }
  },
  methods: {


  }
}
</script>