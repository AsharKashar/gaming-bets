<template>
  <form class="invite-member-form">
    <div class="from-title">
      {{ $t('Add Member in team') }}
    </div>
    <div class="team-members">
      <div class="team-members-title">
        {{ $t('Team Members') }}
      </div>
      <div
        class="copy-link"
        @click="copyInvitationLink"
      >
        {{ $t('Copy invite link') }}
      </div>
    </div>
    <input-group
      :value="member"
      name="member"
      placeholder="example@gmail.com"
      custom-input-style
      :on-change="setField"
      label="E-mail"
    />
    <div class="bottom-block">
      {{ $t('Create Your Team (Squad)') }}
      <default-button
        type="button"
        btn-class="default-banger-btn button-block"
        :on-click="handleSubmit"
        class="add-member-submit"
        :loading="formSubmitting"
      >
        {{ $t('CONTINUE') }}
      </default-button>
    </div>
  </form>
</template>

<script>
import InputGroup from 'components/forms/parts/InputGroup.vue';
import DefaultButton from 'components/DefaultButton';
import minxInviteLink from '@/mixins/inviteLink';

import { createNamespacedHelpers } from 'vuex';
const { mapActions } = createNamespacedHelpers('team');

export default {
  name: 'AddMemberInTeamForm',
  components: {
    InputGroup,
    DefaultButton
  },
  mixins: [minxInviteLink],
  props: {
    team: {
      type: Object,
      default: () => ({})
    }
  },
  data: () => ({
    member: '',
    formSubmitting: false
  }),
  methods: {
    async handleSubmit() {
      this.formSubmitting = true;
      await this.inviteMember({
        email: this.member,
        teamId: this.team.team_id
      });
      this.formSubmitting = false;
      this.$emit('formSend');
    },
    setField(name, value) {
      this[name] = value;
    },
    ...mapActions(['inviteMember'])
  }
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";

.invite-member-form {
  padding: 28px 37px;

  .from-title {
    font-family: Telegraf-UltraBold, serif;
    font-style: normal;
    color: $border-primary-color;
    margin-bottom: 35px;
    font-weight: 900;
    font-size: 32px;
    line-height: 100%;
  }

  &::v-deep .input-group {
    .label {
      // text-transform: capitalize;
    }
    input {
      // margin-left: 135px;
    }
  }

  .team-members {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 8px;

    .team-members-title {
      font-family: Telegraf-UltraBold, serif;
      font-style: normal;
      color: $text-primary-color;
      font-weight: 800;
      font-size: 20px;
      line-height: 110%;
    }
    .copy-link {
      font-family: Telegraf-UltraBold, serif;
      font-style: normal;
      font-weight: 900;
      font-size: 16px;
      line-height: 100%;
      color: $text-secondary-color;
      letter-spacing: 0.05em;
      text-decoration-line: underline;
      cursor: pointer;
    }
  }

  .bottom-block {
    display: flex;
    justify-content: space-between;
    margin-top: 57px;

    &::v-deep .add-member-submit {
      font-size: 20px;
      letter-spacing: 0.05em;
      padding: 15px 32px;
    }
  }
}
</style>
