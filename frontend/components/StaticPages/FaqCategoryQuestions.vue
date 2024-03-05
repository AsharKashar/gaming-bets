<template>
  <div>
    <!-- @click="$router.push(`/faq/${question.id}`).catch(()=>{})" -->
    <div class="title-text mb-4">
      {{ question.catagory_name }}
    </div>
    <div
      v-for="(item, i) in question.questions"
      :key="i"
    >
      <div
        class="questions-text mb-2"
        @click="gotoCategory(item.id)"
      >
        {{ item.question }}
      </div>
      <v-divider class="custom-divider" />
    </div>
    <div
      class="see-all-questions"
      @click="gotoCategory()"
    >
      {{ $t('See all questions') }}
    </div>
  </div>
</template>

<script>
export default {
  name: 'FaqCategoryQuestions',
  components: {},
  props: {
    question: {
      type: Object,
      default: () => ({}),
    },
  },
  methods: {
    gotoCategory(questionId = '') {
      this.$router
        .push(`/faq/category/${this.question.id}/questions/${questionId}`)
      ;
    },
  },
};
</script>


<style scoped lang="scss">
@import "~/assets/styles/colors";

.custom-divider {
  margin: 20px 0;
  height: 1px;
  border-bottom: 1px solid $text-primary-color;
}

.title-text {
  font-weight: 800;
  font-size: 32px;
  line-height: 120%;
}
.questions-text,
.see-all-questions {
  font-size: 20px;
  line-height: 94%;
  cursor: pointer;
}
.see-all-questions {
  text-decoration: underline;
  color: $text-secondary-color;
}
</style>

