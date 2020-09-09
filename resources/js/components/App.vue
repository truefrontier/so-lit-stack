<template>
  <div class="App">
    <div class="text-3xl font-bold">App</div>
    <inertia-link :href="$route('home')">Home</inertia-link> |
    <inertia-link :href="$route('about')">About</inertia-link>
    <div v-html="cms.content"></div>
  </div>
</template>

<script>
export default {
  name: 'App',

  props: {
    cms: {
      type: Object,
      default() {
        return {};
      },
    },
  },
};
</script>

<!-- <style lang="scss" src="./App.scss" scoped></style> -->
