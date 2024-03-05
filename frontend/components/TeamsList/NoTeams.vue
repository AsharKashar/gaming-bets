<template>
  <div class="no-team-container">
    <div
      class="background-block"
      :style="{ backgroundImage: 'linear-gradient(0deg, #010432 1.15%, rgba(1, 4, 50, 0) 24.71%), linear-gradient(271.03deg, #010432 0.09%, rgba(1, 4, 50, 0) 24.05%), linear-gradient(90.92deg, #010432 0.77%, rgba(1, 4, 50, 0) 41.18%), linear-gradient(180deg, #010432 0%, rgba(1, 4, 50, 0) 100%), url(' + game.image + ')'}"
    />
    <div class="message-block">
      <div class="message-title">
        {{ $t('You have no teams against') }} {{ game.name }}
      </div>
      <default-button
        class="create-team-btn"
        :on-click="()=>{showCreateModal=true}"
      >
        {{ $t('Create New Team') }}
      </default-button>
      <default-modal
        persistent
        invisible-scrollbar
        secondery-modal
        :show="showCreateModal"
        :close-modal="closeModal"
      >
        <create-company-form :on-submit="closeModal" />
      </default-modal>
    </div>
  </div>
</template>

<script>
import DefaultButton from 'components/DefaultButton';
import DefaultModal from 'components/modals/DefaultModal';
import CreateCompanyForm from 'components/forms/CreateCompanyForm';

export default {
  name: 'NoTeams',
  components: {
    DefaultButton,
    DefaultModal,
    CreateCompanyForm
  },
  props: {
    game: {
      type: Object,
      default: () => ({})
    }
  },
  data() {
    return {
      showCreateModal: false
    };
  },
  methods: {
    closeModal() {
      this.showCreateModal = false;
    }
  }
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";

.no-team-container {
  position: relative;
  min-height: 600px;

  .background-block {
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    background-blend-mode: normal, normal, normal, normal, luminosity;
    position: absolute;
    min-height: 600px;
    opacity: 0.5;
    width: 100%;
    z-index: 1;
  }

  .message-block {
    position: inherit;
    z-index: 10;
    display: flex;
    align-items: center;
    flex-direction: column;

    .message-title {
      padding: 11% 15% 3% 15%;
      font-family: Telegraf-UltraBold, serif;
      font-style: normal;
      font-weight: 800;
      font-size: 43px;
      line-height: 48px;
      display: flex;
      align-items: center;
      text-align: center;
      color: $text-primary-color;
    }

    .create-team-btn {
      font-size: 15px;
      letter-spacing: 0.05em;
      padding: 12px 26px;
      text-transform: uppercase;
    }
  }
}
</style>
