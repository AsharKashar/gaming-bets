<template>
  <div>
    <div class="teams-header">
      <div class="header-title">
        {{ teamsCount }} {{ $t('teams') }}
      </div>
      <default-button
        class="create-team-btn"
        :on-click="()=>{showCreateModal=true}"
      >
        {{ $t('Create new team') }}
      </default-button>
    </div>
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
</template>

<script>
import DefaultButton from 'components/DefaultButton';
import DefaultModal from 'components/modals/DefaultModal';
import CreateCompanyForm from 'components/forms/CreateCompanyForm';

export default {
  name: 'TeamListHeader',
  components: {
    DefaultButton,
    DefaultModal,
    CreateCompanyForm
  },
  props: {
    teamsCount: {
      type: Number,
      default: 0
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

.teams-header {
  display: flex;
  justify-content: space-between;
  margin-top: 20px;
  align-items: center;

  .header-title {
    font-family: Telegraf-UltraBold, serif;
    font-style: normal;
    font-weight: 800;
    font-size: 43px;
    line-height: 59px;
    display: flex;
    align-items: center;
    color: $text-primary-color;
    white-space: nowrap;
    margin-right: 15px;
  }

  .create-team-btn {
    font-size: 15px;
    letter-spacing: 0.05em;
    padding: 12px 24px;
    text-transform: uppercase;
  }
}

@media only screen and (max-width: $tablet-small-width) {
  .teams-header {
    flex-direction: column;
    align-items: center;
  }
}
</style>
