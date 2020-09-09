<template>
  <div class="DefaultPage">
    <h1>{{ cms.title }}</h1>
    <div v-html="cms.content"></div>
  </div>
</template>

<script>
export default {
  name: 'DefaultPage',

  props: {
    cms: {
      type: Object,
      default() {
        const Statamic = window.Statamic || {};
        return Statamic.cms || {};
      },
    },
  },
};
</script>

<!-- <style lang="scss" src="./DefaultPage.scss" scoped></style> -->
