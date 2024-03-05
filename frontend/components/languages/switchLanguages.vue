<template>
  <div>
    <div
      v-if="!isProd"
      class="language-switcher"
    >
      <div class="switcher-box">
        <img
          src="~/static/images/language.svg"
          alt=""
          class="language-icon"
        >
        <v-select
          v-model="selectLanguage"
          auto
          :items="anotherLocales"
          class="filter-select"
          @change="setLang(selectLanguage)"
        />
      </div>
    </div>
  </div>
</template>

<script>
import { VUE_MODE } from 'config';
import setLangMixin from '../../mixins/setLang';
import get from 'lodash/get';
export default {
  mixins: [setLangMixin],
  data: () => ({
    isProd: VUE_MODE === 'production',
    locales: ['en', 'es'],
    selectLanguage: 'en',
  }),

  computed: {
    anotherLocales() {
      return this.locales.filter(function (locale) {
        return locale !== get(this, '$i18n.locale', '');
      });
    },
  },
};
</script>

<style lang='scss' scoped>
.language-switcher {
  .switcher-box {
    width: 60px;
    display: flex;
    .language-icon {
      margin-right: 5px;
    }
  }
}
</style>components