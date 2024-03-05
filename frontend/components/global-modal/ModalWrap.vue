<template>
  <v-dialog
    v-model="dialog"
    :fullscreen="fullscreen"
    max-width="540"
    overlay-color="#A1AFD3"
    persistent
    overlay-opacity=".82"
    :retain-focus="false"
    scrollable
  >
    <div class="modal-content">
      <div class="modal-action">
        <button
          type="button"
          class="close-modal"
          @click="closeModal"
        >
          <cross />
        </button>
      </div>
      <div
        class="modal-content__inner"
      >
        <div
          class="hide-mobile modal-content__slot-wrap"
        >
          <slot />
        </div>
      </div>
    </div>
  </v-dialog>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
import Cross from 'components/svgIcons/Cross';

const { mapState, mapMutations } = createNamespacedHelpers('modal');

export default {
  name: 'ModalWrap',
  components: { Cross },
  computed: {
    ...mapState(['activeModal', 'modalOptions']),
    dialog: {
      get() {
        return !!this.activeModal;
      },
      set(val) {
        this.setActiveModal({type: val });
      }
    },
    fullscreen() {
      if (this.modalOptions.fullscreen) {
        return this.modalOptions.fullscreen;
      }
      return this.$vuetify.breakpoint.width <= 768;
    }
  },
  methods: {
    ...mapMutations(['setActiveModal','clearModal']),
    closeModal() {
      this.clearModal();
    },
  },
};
</script>

<style lang="scss" scoped>
  @import "~/assets/styles/colors.scss";
  @import "~/assets/styles/sizes.scss";

  .modal-content {
    position: relative;

    &__inner {
      height: 100%;
      background: $app-background;
      border: 4px solid $border-secondary-color;
      border-radius: 32px;
      overflow: hidden;
    }
    &__slot-wrap {
      height: 100%;
      padding: 36px;
    }
    .close-modal {
      padding: 0;
      margin: 0;
      height: auto;
      border: none;
      position: absolute;
      right: -80px;
      top: 20px;
      z-index: 1;
      line-height: .5;
      &:focus {
        outline: none;
      }
    }
  }

  .v-dialog--fullscreen {
    .modal-content {
      &__inner {
        border: 0;
        border-radius: 0;
        padding: 0;
      }
      .close-modal {
        right: 16px;
        top: 16px;
        background: rgba(190, 19, 56, 0.2);
        border-radius: 8px;
        svg {
          transform: scale(.5);
        }
      }
    }
  }
</style>

<style lang="scss">
  @import "~/assets/styles/sizes.scss";
  @media all and (max-width: $tablet-small-width) {
    .close-modal svg path {
      stroke-width: 2px;
    }
  }

  .hide-mobile.modal-content__slot-wrap{
    overflow-x: hidden;

    &::-webkit-scrollbar {
      width: 8px;
      border-radius: 22px;
    }

    &::-webkit-scrollbar-track {
      background: #111542;
    }

    &::-webkit-scrollbar-thumb {
      background-color: #be1338;
      border-radius: 20px;
    }
  }
</style>
