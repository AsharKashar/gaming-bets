<template>
  <v-form
    ref="form"
    class="custom-forms"
    @submit.prevent="sendForm"
  >
    <div class="form-heading modal-heading">
      <div class="modal-title">
        {{ $t('Create Your Team') }}
      </div>
    </div>
    <upload-image
      name="avatar"
      :rules="rules.uploadImage"
      @setData="setDataForm"
      @isError="setErrors"
    />

    <v-text-field
      class="team-name"
      name="name"
      :label="$t('Team Name')"
      placeholder="Team Name"
      :rules="rules.teamName"
    />

    <add-member
      name="members"
      :max-size="commonData.tournament.team_size.size"
      :rules="[rules.email[1]]"
      @setData="setDataForm"
    />
    <default-button
      type="submit"
      btn-class="default-banger-btn button-block"
      class="add-member-submit"
      :loading="load"
    >
      {{ $t('CONTINUE') }}
    </default-button>
  </v-form>
</template>

<script>
import mixinForm from '@/mixins/mixinForm';
import UploadImage from '../parts/UploadImage';
import AddMember from '../parts/AddMember';
import DefaultButton from 'components/DefaultButton';
import { createNamespacedHelpers } from 'vuex';
import { get } from 'lodash';

const teamModule = createNamespacedHelpers('team');
const modalModule = createNamespacedHelpers('modal');

export default {
  name: 'CreateTeam',
  components: {AddMember, UploadImage, DefaultButton},
  mixins: [mixinForm],
  computed: {
    ...modalModule.mapState(['commonData']),
  },
  methods: {
    ...teamModule.mapActions(['createTeam']),
    ...modalModule.mapMutations(['setActiveModal', 'setCommonData']),
    async sendForm() {
      if(this.isError() || this.load) {
        return;
      }
      this.load = true;
      try{
        this.setDataForm();

        const gameId = get(this, 'commonData.tournament.game_id', '');
        const teamSizeId = get(this, 'commonData.tournament.team_size.id', '');

        const team = await this.createTeam({
          ...this.formData,
          team_size_id: teamSizeId,
          game_id: gameId,
        });

        if(!team) {
          console.error('Not Team');
          return;
        }

        this.setActiveModal({type: 'MatchSummary', options: {fullscreen: true}});
        this.setCommonData({team});
      } finally {
        this.load = false;
      }
    },
  },
};
</script>
<style scoped lang="scss">
  @import '~/components/global-modal/forms/forms.scss';
  @import '~/components/global-modal/modal.scss';
.team-name {
    margin-bottom: 31px;
    .v-label {
      font-size: 18px;
    }
  }
</style>
