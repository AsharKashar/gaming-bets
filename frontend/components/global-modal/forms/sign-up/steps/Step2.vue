<template>
  <div>
    <v-autocomplete
      :items="countries"
      :menu-props="{bottom: true, offsetY: true }"
      :label="$t('Country')"
      item-text="name"
      item-value="id"
      name="country_id"
      :value="propsFormData.country_id"
      :loading="loadCountry"
      :rules="rules.countries"
    />
    <v-select
      :items="gender"
      :menu-props="{bottom: true, offsetY: true }"
      :label="$t('Gender')"
      name="gender"
      :value="propsFormData.gender"
      :rules="rules.gender"
    />
    <platform-list @setActivePlatform="stepData.platform = $event" />
    <div class="actions">
      <default-button
        :loading="load"
        type="submit"
        @click.native="$emit('setData', stepData)"
      >
        Sign up
      </default-button>
    </div>
    <div>
      {{ $t('By signing up i have read and agree to') }}
      <a
        class="secondery--text"
        href="#"
      >{{ $t('terms and conditions') }}</a>
      {{ $t('and') }}
      <a
        class="secondery--text"
        href="#"
      >{{ $t('privacy policy') }}</a>
      {{ $t('and i am') }}
      <span class="secondery--text">18+</span>
    </div>
  </div>
</template>

<script>
import props from 'components/global-modal/forms/DefaultPropsValidation';
import DefaultButton from 'components/DefaultButton';
import PlatformList from 'components/global-modal/forms/sign-up/parts/PlatformList';
import {createNamespacedHelpers} from 'vuex';

const { mapState, mapActions } = createNamespacedHelpers('country');

export default {
  name: 'SignUpStep2',
  components: {
    PlatformList,
    DefaultButton
  },
  props,
  data: () => ({
    activePlatform: null,
    gender: [
      'Male', 'Female'
    ],
    stepData: {
      platform: undefined,
    }
  }),
  computed: mapState(['countries', 'loadCountry']),
  mounted() {
    if(!this.countries.length) {
      this.getCountries();
    }
  },
  methods: mapActions(['getCountries']),
};
</script>

<style scoped lang="scss">
@import '~/components/global-modal/forms/forms.scss';
@import '~/components/global-modal/modal.scss';
</style>
