<template>
  <div class="footer-container">
    <div
      v-if="!isProd"
      class="owners"
    >
      <img
        v-lazy-load
        src="~/static/images/sponsor-origins-fruit.png"
        class="origins-fruit"
      >
      <img
        v-lazy-load
        src="~/static/icons/rent4wear.svg"
        class="rent"
      >
      <img
        v-lazy-load
        src="~/static/images/sponsor-tydlo-blanco.png"
        class="tydlos"
      >
      <img
        v-lazy-load
        src="~/static/images/sponsor-bee-logo.png"
        class="bee-logo"
      >
    </div>
    <div class="links-row">
      <div class="copy">
        © Copy Rights Banger Games, {{ new Date().getFullYear() }}
      </div>
      <links-columns
        :links="links"
        colors-class="font-gray"
      />

      <div
        v-if="!isProd"
        class="language-switcher"
      >
        <switch-language />
      </div>
    </div>
  </div>
</template>

<script>
import LinksColumns from 'components/LinksColumns.vue';
import { footerLinks } from 'helpers/links';
import { VUE_MODE } from 'configs/config';
import setLang from 'mixins/setLang';
import get from 'lodash/get';
import SwitchLanguage from 'components/languages/switchLanguages';
export default {
  name: 'DefaultFooter',
  components: {
    LinksColumns,
    SwitchLanguage,
  },
  mixins: [setLang],
  data: () => ({
    isProd: VUE_MODE === 'production',
    locales: ['en', 'es'],
  }),
  computed: {
    links() {
      if (!this.isProd) {
        return footerLinks.map((item) => {
          item.disabled = false;
          return { ...item };
        });
      }

      return footerLinks.filter(({ disabled }) => !disabled);
    },
    currentLocale: {
      get() {
        return get(this, '$i18n.locale', 'en');
      },
      set() {},
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/sizes";
.footer-container {
  position: relative;
  .language-switcher {
    position: absolute;
    right: 10%;
    top: 60%;
    .switcher-box {
      width: 60px;
      display: flex;
      .language-icon {
        margin-right: 5px;
      }
    }
  }
}
.owners {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  justify-content: space-between;
  align-items: center;

  border-bottom: 4px solid;
  border-top: 4px solid;
  border-color: #be1338;

  img {
    margin: 15px 0;
    max-height: 100px;
    height: auto;
    max-width: 100%;
    margin: auto;
  }
}

.language-switcher {
  li {
    p {
      text-decoration: underline;
      color: #459ce7;
      cursor: pointer;
    }
  }
}

.links-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap-reverse;
  margin-bottom: 116px;

  .copy {
    font-style: normal;
    font-weight: normal;
    line-height: 150%;
    color: #a1afd3;
  }
}
@media only screen and (min-width: $tablet-small-width) {
  .owners {
    padding: 0 9.5% 0 15.5%;
    min-height: 97px;
  }

  .links-row::v-deep .links-container {
    max-width: 60.4%;
    padding-left: 48px;
  }

  .links-row::v-deep .link-item {
    font-size: 14px !important;
    line-height: 13px !important;
  }

  .links-row {
    padding: 30px 6% 30px 16%;

    .copy {
      font-size: 12px;
    }
  }
}

@media only screen and (min-width: $tablet-large-width) {
  .owners {
    padding: 0.8rem 18.5%;
    min-height: 100px;
  }

  .links-row::v-deep .links-container {
    max-width: 56.4%;
    padding-right: 86px;
  }

  .links-row {
    padding: 30px 10% 30px 13%;

    .copy {
      font-size: 12px;
    }
  }
}

@media only screen and (min-width: $desktop-width) {
  .owners {
    min-height: 132px;
    padding: 0 16.5%;
  }
  .links-row::v-deep .link-item {
    font-size: 17px;
    line-height: 17px;
  }

  .links-row::v-deep .links-container {
    max-width: 40.5%;
    padding-right: 90px;
  }

  .links-row {
    padding: 30px 10%;

    .copy {
      font-size: 16px;
    }
  }
}
@media only screen and (max-width: $tablet-small-width) {
  .owners {
    min-height: 132px;
    padding: 0 16.5%;
  }
  .links-row::v-deep .link-item {
    font-weight: 800;
    font-size: 12px;
    line-height: 94%;
    letter-spacing: 0.04em;
    text-transform: uppercase;
  }

  .links-row::v-deep .links-container {
    max-width: 100%;
    margin: 12px 0 48px 0;
  }

  .links-row {
    padding: 30px 10%;

    .copy {
      font-weight: 800;
      font-size: 11px;
      line-height: 115%;
    }
  }
}

@media screen and (max-width: $tablet) {
  .footer-container {
    position: relative;
    .language-switcher {
      top: 82%;
    }
  }
}
</style>
