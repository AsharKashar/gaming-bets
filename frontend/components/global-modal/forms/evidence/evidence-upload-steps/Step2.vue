<template>
  <div class="form-steps form-steps--2">
    <button-back-from @click.native="$emit('setStep', 1)" />
    <evidence-form-header
      title="Please add screenshots or video to confirm the game"
      :description="false"
    />
    <multi-upload-files
      :init-val="propsFormData.files"
    />
    <div class="actions">
      <default-button
        type="submit"
        :loading="load"
        class="btn"
        @click.native="$emit('setData')"
      >
        {{ $t('CONFIRM') }}
      </default-button>
    </div>
  </div>
</template>

<script>
import EvidenceFormHeader from 'components/global-modal/forms/evidence/parts/EvidenceFormHeader';
import ButtonBackFrom from 'components/global-modal/forms/parts/ButtonBack';
import MultiUploadFiles from 'components/global-modal/forms/parts/MultiUploadFiles';
import props from 'components/global-modal/forms/DefaultPropsValidation';
import DefaultButton from 'components/DefaultButton';

export default {
  name: 'Step2',
  components: {DefaultButton, MultiUploadFiles, ButtonBackFrom, EvidenceFormHeader},
  props,
};
</script>

<style lang="scss" scoped>
.actions {
  .btn {
    width: 100%;
  }
}
</style>
