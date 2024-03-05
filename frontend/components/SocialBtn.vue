<template>
  <v-btn
    fab
    dark
    :color="color"
    class="btn--social"
  >
    <slot />
  </v-btn>
</template>

<script>
export default {
  name: 'SocialBtn',
  props: {
    color: {
      type: String,
      default: '#fff',
    }
  }
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes";
.btn--social {
    width: 48px;
    height: 48px;
    margin: 0 15px;
    @media all and (max-width: $tablet-small-width) {
      width: 40px;
      height: 40px;
      margin: 0 5px;
    }
  &::v-deep {
    .v-btn__content {
      max-width: 100%;
    }
    img {
      max-width: 25px;
    }
    .social-icon {
      &--discord {
        max-width: 30px;
      }
      &--google {
        max-width: 20px;
      }
    }
  }
}
</style>
