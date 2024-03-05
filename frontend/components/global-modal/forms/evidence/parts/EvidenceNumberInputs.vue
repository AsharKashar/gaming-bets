<template>
  <div :id="'number-inputs'+ _uid">
    <v-text-field
      v-model="text"
      v-mask="'#####'"
      masked="true"
      :name="name"
      :label="label"
      placeholder="X"
      type="tel"
      :rules="formRules.required"
      validate-on-blur
      hide-details
    />
  </div>
</template>

<script>
import formRules from 'helpers/formRules';

export default {
  name: 'EvidenceNumberInputs',
  props: {
    label: {
      type: String,
      required: true,
    },
    name: {
      type: String,
      required: true,
    },
    initVal: {
      type: String,
      default: '',
    }
  },
  data: () => ({
    formRules,
    text: '',
  }),
  mounted() {
    this.text = this.initVal;
  }
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";

[id*="number-inputs"] {
  margin-top: 0;
  max-width: 103px;
  padding: 25px 20px 10px;
  .v-input {
    ::v-deep {
      .v-input__slot {
        &::before,
        &::after {
          display: none;
        }
      }

      label {
        top: -22px;
        right: 0!important;
        text-align: center;
        font-size: 16px;
        overflow: unset;
        transform: none;
        font-weight: 900;
      }

      input {
        border: 1px solid rgba(161, 175, 211, .2);
        padding: 15px 5px;
        text-align: center;
        max-height: 48px;
        font-weight: 800;
        color: $text-secondary-color;
      }
    }
    &.error--text {
     &::v-deep {
       input {
         border-color:  $text-secondary-color;
       }
       label {
         color:  $text-secondary-color!important;
       }
     }
    }
  }
}


</style>
