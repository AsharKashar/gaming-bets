<template>
  <div class="selected-team custom-forms">
    <div class="form-heading modal-heading">
      <div class="modal-title">
        {{ $t('Select your Team') }}
      </div>
    </div>
    <loader
      height="100px"
      :center="true"
      :loading="loading"
      :overlay="false"
    >
      <tournament-team-grid
        v-if="!loading"
        :teams="currentUserTeamsTournament.data"
        @setActiveTeam="setActiveTeam($event)"
      />
    </loader>

    <div class="selected-team__action">
      <a
        href="#"
        @click.prevent="$emit('setStep', 'CreateTeam')"
      >
        +{{ $t('CREATE TEAM') }}
      </a>
    </div>
    <pagination
      class="selected-team__pagination"
      :page="page"
      :total="currentUserTeamsTournament.last_page"
      :set-page="newPage => setPage(newPage)"
    />
    <v-slide-y-transition>
      <div
        v-if="errorMessage"
        class="selected-team__error"
        v-text="errorMessage"
      />
    </v-slide-y-transition>
    <div class="actions">
      <default-button
        btn-class="default-banger-btn button-block"
        class="add-member-submit"
        @click.native="setModal"
      >
        {{ $t('CONTINUE') }}
      </default-button>
    </div>
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
import TournamentTeamGrid from 'components/CardsGrid/grids/TournamentTeamGrid';
import Pagination from 'components/Pagination';
import DefaultButton from 'components/DefaultButton';
import Loader from 'components/Loader';
import formRules from 'helpers/formRules';

const moduleModal = createNamespacedHelpers('modal');
const moduleTournament = createNamespacedHelpers('tournament');

export default {
  name: 'SelectedTeam',
  components: {Loader, DefaultButton, Pagination, TournamentTeamGrid},
  data: () => ({
    page: 1,
    loading: false,
    activeTeam: {},
    errorMessage: null,
  }),
  computed: {
    ...moduleTournament.mapState(['currentUserTeamsTournament']),
  },
  methods: {
    ...moduleModal.mapMutations(['setActiveModal', 'setCommonData']),
    ...moduleTournament.mapActions(['getCurrentUserTeamsTournament']),
    async setPage(page) {
      this.page = page;
      this.loading = true;
      try {
        await this.getCurrentUserTeamsTournament({page});
      } finally {
        this.loading = false;
      }
    },
    setActiveTeam(team) {
      this.activeTeam = team;
    },
    setModal() {
      this.errorMessage = null;

      if (!this.activeTeam.team_id) {
        this.errorMessage = formRules.joinTeam[0];
        return;
      }
      this.setActiveModal({type: 'MatchSummary', options: {fullscreen: true}});
      this.setCommonData({team: this.activeTeam});
    },
  },
};
</script>

<style scoped lang="scss">
  @import "~/assets/styles/colors.scss";
  @import '~/components/global-modal/forms/forms.scss';
  @import '~/components/global-modal/modal.scss';

  .selected-team {
    &__action {
      margin-bottom: 24px;
      text-decoration: underline;
      a {
        letter-spacing: 0.05em;
        text-transform: uppercase;
      }
    }
    &__pagination {
      margin-bottom: 33px;
    }
    &__error {
      margin-bottom: 15px;
      color: $accent-error-color;
    }
  }
</style>
