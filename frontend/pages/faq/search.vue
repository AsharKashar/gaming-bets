<template>
  <div class="page-container">
    <breadcrumbs
      :breadcrumbs-list="breadcrumbs"
      active-crumb="categoryName"
      :additional-bread-crumbs="additionalBreadCrumbs"
    />
    <div
      class="search-bar-wraper"
      :class="{'search-bar-active' : !!search}"
    >
      <div
        height="auto"
        class="search-bar-inner"
      >
        <v-row no-gutters>
          <v-col
            md="11"
            sm="11"
            xs="11"
            class="d-flex flex-row align-center justify-space-around"
          >
            <input
              v-model="searchText"
              class="search-input-bar"
              type="text"
              :placeholder="$t('Type here your search')"
              autofocus
            >
          </v-col>
          <v-col
            md="1"
            sm="1"
            xs="1"
            class="d-flex flex-row align-center justify-space-around"
          >
            <div
              v-ripple="{ center: true }"
              class="single-button-link"
            >
              <v-avatar
                tile
                size="36"
              >
                <img
                  src="~/static/icons/cross_24px.svg"
                  alt="search"
                  @click="closeSearch"
                >
              </v-avatar>
            </div>
          </v-col>
        </v-row>
      </div>
    </div>

    <div class="page-detail-section">
      <div
        v-if="!search"
        class="title-text mb-4"
      >
        {{ $t('Similarities to your search') }}
      </div>
      <v-row v-if="search">
        <v-col
          md="6"
          class="my-3"
        >
          <div
            v-for="(item, i) in faqSearched"
            :key="i"
          >
            <div
              class="questions-text mb-2"
              @click="$router.push(`/faq/category/${item.faq_catagory_id}/questions/${item.id}`)"
            >
              {{ item.question }}
            </div>
            <v-divider class="custom-divider" />
          </div>
        </v-col>
      </v-row>
      <v-row v-else>
        <v-col
          md="6"
          class="my-3"
        >
          <div
            v-for="(item, i) in similarQuesions.slice(0, sliceQuestion)"
            :key="i"
          >
            <div
              class="questions-text mb-2"
              @click="$router.push(`/faq/category/${item.faq_catagory_id}/questions/${item.id}`)"
            >
              {{ item.question }}
            </div>
            <v-divider class="custom-divider" />
          </div>
        </v-col>
        <v-col
          md="6"
          class="my-3"
        >
          <div
            v-for="(item, i) in similarQuesions.slice(sliceQuestion)"
            :key="i"
          >
            <div
              class="questions-text mb-2"
              @click="$router.push(`/faq/category/${item.faq_catagory_id}/questions/${item.id}`)"
            >
              {{ item.question }}
            </div>
            <v-divider class="custom-divider" />
          </div>
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script>
import Breadcrumbs from 'components/Breadcrumbs.vue';

import { createNamespacedHelpers } from 'vuex';
import { APP_URL } from 'configs/config';
const faqModule = createNamespacedHelpers('faq');

export default {
  name: 'FAQ',
  components: {
    Breadcrumbs,
  },
  data: () => ({
    category: {},
    displaySearch: false,
    search: null,
    breadcrumbs: ['faq', 'categoryName'],
    categoryName: 'search',
  }),
  computed: {
    additionalBreadCrumbs() {
      return {
        categoryName: {
          text: this.categoryName,
          href: '',
        },
      };
    },
    ...faqModule.mapState(['faqs', 'faqStatus', 'faqSearched']),
    sliceQuestion() {
      return Math.round(this.similarQuesions.length / 2);
    },
    similarQuesions() {
      let questions = [];
      this.faqs.map((item) => {
        item.questions.map((q) => {
          q.faq_catagory_id = item.id;
          questions.push(q);
        });
      });
      return questions;
    },
    questions() {
      if (this.search) return this.faqSearched;
      else return this.similarQuesions;
    },
    searchText: {
      get() {
        return this.search;
      },
      set(val) {
        this.search = val;
        this.searchFaqs(val);
      },
    },
  },
  async created() {
    await this.getFaqs();
  },
  methods: {
    ...faqModule.mapActions(['getFaqs', 'searchFaqs']),

    closeSearch() {
      if (this.search) return (this.search = '');
      else this.$router.push('/faq/');
    },
  },
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Faq search',
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
  @import "~/assets/styles/sizes";

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
    box-shadow: $text-primary-color;
    color: $app-background;
  }
  .custom-divider {
    margin: 20px 0;
    border-bottom: 2px solid $text-primary-color;
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
  //
  section-main-title {
    font-weight: 900;
    font-size: 32px;
    line-height: 120%;
  }
  .single-button-link {
    display: flex;
    flex-direction: column;
    align-content: center;
    justify-content: center;
    flex: 1 1 50px;
    align-items: center;
    cursor: pointer;

    .single-button-link-title {
      text-align: center;
      line-height: 15px;
      margin-top: 4px;
    }
  }
  .search-bar-wraper {
    margin-top: 56px;
    height: 200px;
    border-color: $text-primary-color;
    background: $text-primary-color;
    display: flex;
    align-items: center;

    .search-bar-inner {
      position: relative;
      padding: 0 20%;
      width: 100%;

      .search-input-bar {
        flex-basis: 95%;
        font-size: 32px;
        line-height: 92%;
        letter-spacing: 0.02em;
        font-feature-settings: "ss03";
        font-family: Telegraf-UltraBold, serif;
        outline: none;
        font-weight: 800;
        color: $app-background;

        &::placeholder {
          color: $app-background !important;
        }
      }
    }
  }

  .search-bar-active {
    background: white;
  }

  @media only screen and (max-width: $tablet-small-width) {
    .section-main-title {
      font-size: 23px;
      line-height: 49px;
    }
    .single-button-link-icon {
      width: 24px !important;
    }
  }
  @media only screen and (min-width: $tablet-small-width) {
    .section-main-title {
      font-size: 56px;
      line-height: 59px;
    }
    .single-button-link-icon {
      width: 48px;
    }
  }
  //
</style>
