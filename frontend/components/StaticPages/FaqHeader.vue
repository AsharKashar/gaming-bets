<template>
  <div class="page-tite-section">
    <v-row>
      <v-col
        md="8"
        class="page-title link"
        @click="$router.push('/faq/search')"
      >
        {{ pageTitle }}
      </v-col>
      <v-col
        md="4"
        class="page-title"
      >
        <default-button
          type="button"
          :on-click="openDialog"
        >
          {{ $t('ask question') }}
        </default-button>
      </v-col>
    </v-row>
    <!-- <v-dialog v-model="dialog" width="600px" /> -->

    <v-dialog
      v-model="dialog"
      invisible-scrollbar
      minwidth="730px"
      max-width="730px"
    >
      <ContactForm
        :is-faq="false"
        page-title="Ask Question"
        :close-modal="() => {dialog= false}"
        @closeDailouge="closeDailouge"
      />
    </v-dialog>
    <!-- <default-modal
      persistent
      invisible-scrollbar
      minwidth="730px"
      max-width="730px"
      :show="dialog"
      :close-modal="() => {dialog= false}"
    >
      <ContactForm
        :is-faq="false"
        page-title="Ask Question"
        :close-modal="() => {dialog= false}"
      />
    </default-modal> -->
  </div>
</template>

<script>
import ContactForm from 'components/StaticPages/ContactForm.vue';
// import DefaultModal from 'components/modals/DefaultModal.vue';
import DefaultButton from 'components/DefaultButton.vue';

export default {
  name: 'FaqHeader',
  components: {
    ContactForm,
    // DefaultModal,
    DefaultButton,
  },
  props: {
    pageTitle: {
      type: String,
      default: '',
    },
  },
  data: () => ({
    dialog: false,
  }),
  methods: {
    gotoCategory(questionId = '') {
      this.$router
        .push(`/faq/category/${this.question.id}/questions/${questionId}`)
      ;
    },
    openDialog() {
      this.dialog = true;
    },
    closeDailouge()
    {

      this.dialog = false;
    }
  },
};
</script>


<style scoped lang="scss">
@import "~/assets/styles/colors";
.modal-body
{
  border: none;
}
.page-tite-section {
  margin-top: 56px;
}
</style>

