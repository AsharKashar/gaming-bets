<template>
  <modal-wrap>
    <component :is="activeModal" />
  </modal-wrap>
</template>
<script>
import { createNamespacedHelpers } from 'vuex';
import ModalWrap from './ModalWrap';
import LoginForm from 'components/global-modal/forms/LoginForm';
import SignUp from 'components/global-modal/forms/sign-up/SignUp';
import NotEnoughCoins from 'components/global-modal/NotEnoughCoins';
import JoinedSuccessfully from 'components/global-modal/JoinedSuccessfully';
import ByBombs from 'components/global-modal/ByBombs';
import Payment from 'components/global-modal/forms/payment/Payment';
import CreateTeam from 'components/global-modal/forms/team/CreateTeam';
import SelectedTeam from 'components/global-modal/forms/team/SelectedTeam';
import TournamentTeamModal from 'components/global-modal/forms/team/TournamentTeamModal';
import MatchSummary from 'components/global-modal/match-summary/';
import OAuthCreateUserEmailForm from 'components/forms/OAuthCreateUserEmailForm';
import EvidenceUpload from 'components/global-modal/forms/evidence/EvidenceUpload';

import BoxFightResult from './BoxFightResult';
import JoinBoxFight from 'components/tournamentWizard/joinBoxFight/JoinBoxFight';
import UploadBoxFightProof from 'components/tournamentWizard/boxFightResult/BoxFightResultModal';
import CreateBoxFightModal from 'components/tournamentWizard/CreateBoxFight/CreateBoxFightModal';

const { mapState } = createNamespacedHelpers('modal');

export default {
  name: 'GlobalModal',
  components: {
    ModalWrap,
    LoginForm,
    SignUp,
    NotEnoughCoins,
    ByBombs,
    CreateTeam,
    SelectedTeam,
    Payment,
    JoinedSuccessfully,
    JoinBoxFight,
    TournamentTeamModal,
    BoxFightResult,
    UploadBoxFightProof,
    CreateBoxFightModal,
    MatchSummary,
    OAuthCreateUserEmailForm,
    EvidenceUpload,
  },
  computed: mapState(['activeModal']),
};
</script>
