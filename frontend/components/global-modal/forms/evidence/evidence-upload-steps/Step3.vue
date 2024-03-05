<template>
  <div class="form-steps form-steps--3">
    <img
      src="~/static/images/bomber.png"
      alt="bomber"
    >
    <evidence-form-header
      title="Thanks for sharing results we are working on this blah blah"
      :description="false"
    />
  </div>
</template>

<script>
import EvidenceFormHeader from 'components/global-modal/forms/evidence/parts/EvidenceFormHeader';
export default {
  name: 'Step3',
  components: {EvidenceFormHeader}
};
</script>

<style lang="scss" scoped>
.form-steps {
  text-align: center;
  & > img {
    margin-bottom: 25px;
  }
  &::v-deep {
    .heading {
      margin-bottom: 20px;
    }
  }
}
</style>
