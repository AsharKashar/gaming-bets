<template>
  <form class="create-company-form">
    <div class="from-title">
      {{ $t('Create Your Team ({sizeName})', {sizeName: activeType.name}) }}
    </div>

    <avatar-upload-square
      name="avatar"
      :set-field="setField"
    />

    <div class="team-members">
      <div class="team-members-title">
        {{ $t('Team Members') }}
      </div>
      <div
        class="copy-link"
        @click="() => {}"
      >
        {{ $t('Copy invite link') }}
      </div>
    </div>
    <input-group
      :value="name"
      name="name"
      text-capitalize
      :on-change="setField"
      :label="$t('Team Name')"
    />
    <div
      v-if="members.length || limitMember"
      class="members-container"
    >
      <input-group
        v-for="(member,i) in members"
        :key="i"
        :value="member"
        placeholder="example@gmail.com"
        name="members"
        custom-input-style
        :on-change="(name, value) => setField(name,value,i)"
        :label="(i+1)+'.E-mail'"
        type="email"
      />
      <div
        v-if="limitMember"
        class="add-member"
        @click="() => members.push('')"
      >
        {{ $t('Add Member') }}
        <plus color="#A1AFD3" />
      </div>
    </div>
    <div class="bottom-block">
      <default-button
        type="button"
        btn-class="default-banger-btn button-block"
        :on-click="handleSubmit"
        class="create-company-submit"
        :loading="formSubmitting"
      >
        {{ $t('CONTINUE') }}
      </default-button>
    </div>
  </form>
</template>

<script>
import InputGroup from 'components/forms/parts/InputGroup.vue';
import AvatarUploadSquare from 'components/forms/parts/AvatarUploadSquare.vue';
import Plus from 'components/svgIcons/Plus';
import DefaultButton from 'components/DefaultButton';
import { createNamespacedHelpers } from 'vuex';
const { mapActions, mapState } = createNamespacedHelpers('team');

export default {
  name: 'CreateCompanyForm',
  components: {
    InputGroup,
    AvatarUploadSquare,
    Plus,
    DefaultButton,
  },
  props: {
    onSubmit: {
      type: Function,
      default: () => {},
    },
  },
  data: () => ({
    name: '',
    avatar: '',
    avatarPreview: null,
    formSubmitting: false,
    membersList: [],
  }),
  computed: {
    ...mapState({
      teamTypes: ({teamTypes}) => teamTypes,
      teamSizeId: ({filters}) => filters.teamSizeId,
    }),
    activeType() {
      const activeType = this.teamTypes.find(({id}) => id === this.teamSizeId);
      return activeType || {};
    },
    form() {
      return {
        name: this.name,
        avatar: this.avatar,
        members: this.membersList,
      };
    },
    members() {
      return this.membersList;
    },
    limitMember() {
      return (this.members.length + 1) < this.activeType.size;
    }
  },
  methods: {
    ...mapActions(['createTeam', 'getFilteredTeams']),
    async handleSubmit() {
      this.formSubmitting = true;
      await this.createTeam(this.form).then(() => {
        this.onSubmit();
        this.getFilteredTeams();
      });
      this.formSubmitting = false;
    },
    setField(name, value, index) {
      if (index >= 0) {
        this[name][index] = value;
      } else {
        this[name] = value;
      }
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";

.create-company-form {
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

  .avatar-upload-container {
    margin-bottom: 32px;
  }

  .members-container {
    .add-member {
      font-family: Telegraf-UltraBold, serif;
      color: $text-primary-color;
      font-style: normal;
      font-weight: 900;
      font-size: 16px;
      line-height: 94%;
      letter-spacing: 0.05em;
      margin-top: 16px;

      svg {
        height: 9px;
        width: 9px;
        margin-left: 7px;
      }
    }

    &::v-deep .input-group {
      .label {
        text-transform: capitalize;
      }
      input {
        margin-left: 90px;
      }
    }
  }

  .bottom-block {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;

    &::v-deep .create-company-submit {
      font-size: 19px;
      letter-spacing: 0.05em;
      padding: 15px 20px;
    }
  }
}
</style>
