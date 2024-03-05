<template>
  <div>
    <div class="page-container">
      <breadcrumbs
        :breadcrumbs-list="breadcrumbs"
        active-crumb="categoryName"
        :additional-bread-crumbs="additionalBreadCrumbs"
      />
      <div class="page-tite-section">
        <v-row>
          <v-col
            md="8"
            class="page-title"
          >
            {{ categoryName }}
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
      </div>
      <div class="page-detail-section">
        <v-row>
          <v-col
            md="6"
            class="my-3"
          >
            <div
              v-for="(item, i) in categoryDetails"
              :key="i"
            >
              <div :class="{'active-question' :currentQuestionId === item.id }">
                <div
                  class="questions-text mb-2"
                  @click="currentQuestionId = item.id"
                >
                  {{ item.question }}
                </div>
                <v-divider class="custom-divider" />
              </div>
            </div>
          </v-col>
          <v-col
            md="6"
            class="my-3"
          >
            <div class="title-text mb-4">
              {{ currentCategory.question }}
            </div>
            <div>
              <div class="questions-text mb-3">
                {{ currentCategory.answer }}
              </div>
              <!-- <p class="questions-text mb-3">{{ category.answer2 }}</p> -->
            </div>
          </v-col>
        </v-row>
      </div>
    </div>
    <v-dialog
      v-model="dialog"
      width="600px"
    >
      <ContactForm
        form-color-class="secondery-card"
        page-tite="Ask question"
        @closeDailouge="closeDailouge"
      />
    </v-dialog>
  </div>
</template>

<script>
import DefaultButton from 'components/DefaultButton.vue';
import ContactForm from 'components/StaticPages/ContactForm.vue';

import { createNamespacedHelpers } from 'vuex';
const faqModule = createNamespacedHelpers('faq');
import { STATE_STATUSES } from 'helpers/constants';
import Breadcrumbs from 'components/Breadcrumbs.vue';
import { APP_URL } from 'configs/config';

export default {
  name: 'FAQCategoryDetails',
  components: {
    ContactForm,
    DefaultButton,
    Breadcrumbs,
  },
  data: () => ({
    dialog: false,
    category: {},
    currentQuestionId: null,
    breadcrumbs: ['faq', 'categoryName'],
  }),
  computed: {
    ...faqModule.mapState(['allCategories', 'categoryDetails', 'faqStatus']),
    loading() {
      return this.gamesStatus === STATE_STATUSES.PENDING;
    },
    currentCategory() {
      return this.categoryDetails.length && this.currentQuestionId
        ? this.categoryDetails.find((x) => x.id === this.currentQuestionId)
        : {};
    },
    categoryName() {
      const category =
          this.categoryDetails.length && this.currentCategory
            ? this.allCategories.find(
              (x) => x.id === this.currentCategory.faq_catagory_id
            )
            : {};
      return category ? category.catagory_name : '';
    },
    additionalBreadCrumbs() {
      return {
        categoryName: {
          text: this.categoryName,
          href: '',
        },
      };
    },
  },
  async created() {
    await this.getCategoryDetails(this.$route.params.categoryId);
    this.getAllCategories();
    this.currentQuestionId = parseInt(
      this.$route.params.questionId || this.categoryDetails[0].id
    );
  },

  methods: {
    ...faqModule.mapActions(['getAllCategories', 'getCategoryDetails']),
    openDialog() {
      this.dialog = true;
    },
    closeDailouge()
    {

      this.dialog = false;
    }
  },
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Faq question',
      link: [
        {
          rel: 'canonical',
          href: route
        }
      ]
    };
  },
};
</script>
<style lang="scss" scoped>
  @import "~/assets/styles/colors";
  .page-container {
    color: $text-primary-color;
  }
  .page-container p {
    margin: 0;
  }
  .page-tite-section {
    margin-top: 56px;
  }

  .page-detail-section {
    margin: 20px 0;

    .contact-us-from-wrapper {
      margin: 32px 0;
    }
  }
  .default-banger-btn {
    background: $text-primary-color;
    box-shadow: none !important;
    color: $app-background;
  }
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
  .questions-text {
    font-size: 20px;
    line-height: 120%;
    cursor: pointer;
  }
  .active-question {
    .questions-text {
      font-weight: 800;
      font-family: Telegraf-UltraBold, serif;
    }

    .custom-divider {
      border-bottom: 2px solid $text-primary-color;
    }
  }
</style>
