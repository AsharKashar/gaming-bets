<template>
  <div class="page-container">
    <breadcrumbs
      :breadcrumbs-list="breadcrumbs"
      active-crumb="faq"
    />
    <faq-header page-title="Questions" />
    <div class="page-detail-section">
      <loader
        :loading="loading"
        :overlay="false"
        :center="true"
        height="300px"
      >
        <v-row>
          <v-col
            v-for="(item, i) in faqs"
            :key="i"
            md="6"
            sm="12"
            xs="12"
            class="my-3"
          >
            <FaqCategoryQuestions :question="item" />
          </v-col>
        </v-row>
      </loader>
    </div>
  </div>
</template>

<script>
import FaqHeader from 'components/StaticPages/FaqHeader.vue';
import { STATE_STATUSES } from 'helpers/constants';
import Breadcrumbs from 'components/Breadcrumbs.vue';

import FaqCategoryQuestions from '@/components/StaticPages/FaqCategoryQuestions';

import { createNamespacedHelpers } from 'vuex';
const faqModule = createNamespacedHelpers('faq');
import Loader from 'components/Loader.vue';
import { APP_URL } from 'configs/config';

export default {
  name: 'FAQ',
  components: {
    FaqCategoryQuestions,
    Loader,
    Breadcrumbs,
    FaqHeader,
  },
  data: () => ({
    dialog: false,
    breadcrumbs: ['main', 'faq'],
  }),
  computed: {
    ...faqModule.mapState(['faqs', 'faqStatus']),
    loading() {
      return this.gamesStatus === STATE_STATUSES.PENDING;
    },
  },
  async mounted() {
    await this.getFaqs();
  },
  methods: {
    ...faqModule.mapActions(['getFaqs']),
    openDialog() {
      this.dialog = true;
    },
  },
  head() {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Faq',
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

    &::v-deep .default-banger-btn {
      background: $text-primary-color;

      &:hover {
        box-shadow: 3px 20px 30px rgba(160, 175, 211, 0.28);
      }
    }
  }
  .page-container p {
    margin: 0;
  }

  .page-detail-section {
    margin: 20px 0;

    .contact-us-from-wrapper {
      margin: 32px 0;
    }
  }
</style>
