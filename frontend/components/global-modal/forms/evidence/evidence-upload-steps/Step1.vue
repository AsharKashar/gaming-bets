<template>
  <div class="form-steps form-steps--1">
    <div class="evidence-heading">
      <button-back-from @click.native="clearModal" />
    </div>
    <evidence-form-header />
    <div class="evidence-teams">
      <evidence-team-card
        :avatar-url="data.firstTeam.avatar_url"
        :name="data.firstTeam.name"
      />
      <span v-text="$t('VS')" />
      <evidence-team-card
        :avatar-url="data.secondTeam.avatar_url"
        :name="data.secondTeam.name"
      />
    </div>
    <div class="evidence__body">
      <div
        class="evidence__description"
        v-text="$t('You should enter the number of the kills and assists in the match')"
      />
      <div class="fields-wrap">
        <evidence-number-inputs
          label="Kills"
          name="kills"
          :init-val="propsFormData.kills"
        />
        <evidence-number-inputs
          label="Assists"
          name="assists"
          :init-val="propsFormData.assists"
        />
      </div>
    </div>
    <div class="evidence__action">
      <default-button
        type="button"
        class="mx-4 mb-2"
        @click.native="setStep(1)"
      >
        {{ $t('i\'ve won') }}
      </default-button>
      <default-button
        type="button"
        class="mx-4 mb-2"
        @click.native="setStep(0)"
      >
        {{ $t('i\'ve lost') }}
      </default-button>
    </div>
  </div>
</template>

<script>
import EvidenceFormHeader from 'components/global-modal/forms/evidence/parts/EvidenceFormHeader';
import props from 'components/global-modal/forms/DefaultPropsValidation';
import {createNamespacedHelpers} from 'vuex';
import ButtonBackFrom from 'components/global-modal/forms/parts/ButtonBack';
import EvidenceTeamCard from 'components/global-modal/forms/evidence/parts/EvidenceTeamCard';
import EvidenceNumberInputs from 'components/global-modal/forms/evidence/parts/EvidenceNumberInputs';
import DefaultButton from 'components/DefaultButton';
const { mapState, mapMutations } = createNamespacedHelpers('modal');
const initData = {firstTeam: {}, secondTeam: {}};

export default {
  name: 'Step1',
  components: {DefaultButton, EvidenceNumberInputs, EvidenceTeamCard, ButtonBackFrom, EvidenceFormHeader},
  props,
  computed: mapState({
    data: ({commonData}) => commonData.evidence || initData,
  }),
  methods: {
    ...mapMutations(['clearModal']),
    setStep(place) {
      this.$emit('nextStep', {place});
    }
  }
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";

.evidence {
  &-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-bottom: 8px;
  }
  &-teams {
    margin: 0 -5px 40px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    & > span {
      font-weight: 900;
      font-size: 24px;
      color: $text-secondary-color;
      display: block;
      width: max-content;
      padding: 5px;
    }
  }
  &__description {
    text-align: center;
    font-size: 14px;
    color: $text-primary-color;
    line-height: 1.2;
    margin-bottom: 15px;
  }
  &__action {
    display: flex;
    justify-content: center;
  }
}

.fields-wrap {
  display: flex;
  align-items: center;
  justify-content: center;
  padding-bottom: 30px;
}
</style>
