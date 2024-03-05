<template>
  <div
    class="input-group"
    :class="{ 'custom-input-group': isAuth || customInputStyle, 'text-capitalize' : textCapitalize , 'color-primary' : colorPrimary }"
    :style="noBorder ? 'border:none;' : ''"
  >
    <div class="label">
      <div class="label-title">
        {{ label }}
      </div>
      <div
        v-if="subtitle"
        class="label-subtitle"
      >
        {{ subtitle }}
      </div>
    </div>
    <v-select
      v-if="isMenu"
      :name="name"
      :value="value"
      :placeholder="placeholder ? placeholder : label"
      :items="menuItems"
      :loading="isMenuLoading"
      :item-text="menuText"
      :item-value="menuValue"
      hide-details
      class="input-select"
      :menu-props="{bottom: true, offsetY: true }"
      :append-icon="'mdi-chevron-down'"
      @change="onChangeInput({ value: $event, name })"
    />
    <v-icon v-if="appendicon">
      {{ appendicon }}
    </v-icon>
    <input
      v-if="!isMenu && type !== 'dob'"
      :type="type"
      :name="name"
      :value="value"
      :readonly="readonly"
      :placeholder="placeholder ? placeholder : label"
      :required="required"
      :disabled="disabled"
      class="custom-input"
      @input="onChangeInput"
      @click="onClick"
      @focusout="focusOut"
    >
  </div>
</template>

<script>

export default {
  name: 'InputGroup',
  props: {
    value: {
      type: [String, Number],
      default: '',
    },
    label: {
      type: String,
      default: '',
    },
    placeholder: {
      type: String,
      default: '',
    },
    subtitle: {
      type: String,
      default: '',
    },
    name: {
      type: String,
      default: '',
    },
    type: {
      type: String,
      default: 'text',
    },
    readonly: {
      type: Boolean,
      default: false,
    },
    vOn: {
      type: Object,
      default: () => ({}),
    },
    vBind: {
      type: Object,
      default: () => ({}),
    },
    isMenu: {
      type: Boolean,
      default: false,
    },
    isMenuLoading: {
      type: Boolean,
      default: false,
    },
    menuText: {
      type: String,
      default: 'text',
    },
    menuValue: {
      type: String,
      default: 'value',
    },
    isAuth: {
      type: Boolean,
      default: false,
    },
    customInputStyle: {
      type: Boolean,
      default: false,
    },
    textCapitalize: {
      type: Boolean,
      default: false,
    },
    menuItems: {
      type: Array,
      default: () => {
        [];
      },
    },
    onChange: {
      type: Function,
      default: () => {},
    },
    onClick: {
      type: Function,
      default: () => {},
    },
    required: {
      type: Boolean,
      default: true,
    },
    mask: {
      type: String,
      default: '11/11/1111',
    },
    appendicon: {
      type: String,
      default: '',
    },
    disabled: {
      type: Boolean,
      default: false,
    },
    noBorder:{
      type:Boolean,
      default:false
    },
    colorPrimary:{
      type:Boolean,
      default:false
    }
  },
  mounted() {
    if (this.$refs.masking) {
      this.$refs.masking.$el.addEventListener(
        'focusout',
        () => {
          this.$emit('focusout');
        },
        false
      );
    }
  },
  methods: {
    onChangeInput(evt) {
      if (this.type === 'dob') {
        this.onChange(this.name, evt);
      } else {
        const { value, name } = evt.target ? event.target : evt;
        this.onChange(name, value);
      }
    },
    focusOut() {
      this.$emit('focusout');
    },
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes";
.v-icon {
  color: #a1afd3;
  font-size: 16px;
}

.custom-input-group {
  font-size: 16px !important;
  line-height: 94% !important;

  .label {
    text-align: right !important;
    padding-top: 0 !important;
    padding-right: 15px;
    color: $text-primary-color;
    font-family: inherit !important;
  }
  input {
    color: #be1338 !important;
    width: 100%;
    // opacity: 0.5;

    &::placeholder {
      opacity: 0.5;
      text-transform: initial !important;
    }
  }
    input[type="text"]:disabled {
      color: $text-primary-color !important;
    }
}

.input-group {
  display: flex;
  align-items: center;
  min-height: 43px;
  border-bottom: 1px solid rgba(161, 175, 211, 0.2);
  font-style: normal;
  font-size: 18px;
  line-height: 100%;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  color: $text-primary-color;

  .label {
    display: flex;
    font-size: 15px;
    flex-direction: column;
    font-family: Telegraf-Regular, serif;
    font-weight: normal;
    flex-basis: 37%;
  }
  input {
    font-family: Telegraf-Regular, serif;
    font-size: 16px;
    outline: none;
    color: $text-primary-color;
    flex-basis: 63%;

    &::placeholder {
      font-family: Telegraf-Regular, serif;
      text-transform: uppercase;
      color: $text-primary-color;
    }
  }

  .label-subtitle {
    font-family: Telegraf-Regular, serif;
    font-style: normal;
    font-weight: normal;
    font-size: 13px;
    line-height: 94%;
    color: #be1338;
    text-transform: lowercase;
    padding: 15px 0;
  }

  .input-select {
    display: flex;
    color: #be1338;
    align-items: center;
    flex-basis: 63%;
    padding: 0;
    margin: 0;
  }

  .input-select::v-deep .v-input__control {
    i {
      color: #be1338 !important;
      font-size: 36px;
    }
    .v-select__selections {
      // font-size: 24px;
      font-size: 16px;
      line-height: 94%;
      color: #be1338;
      display: flex;
      align-items: center;
      // padding-bottom: 8px;
    }

    .v-select__selection {
      color: #be1338;
    }

    .v-input__control > .v-input__slot:before {
      border: none;
    }
  }

}
    .color-primary{
      .input-select::v-deep .v-input__control {
      .v-select__selections {
        color: $text-primary-color;
      }
      .v-select__selection {
        color: $text-primary-color;
      }
    }
    }

.profile-input {
  input {
    &::placeholder {
      text-transform: capitalize;
      opacity: 0.7;
    }
  }

  .input-select::v-deep .v-input__control {
    i {
      color: #be1338 !important;
      font-size: 36px;
    }

    .v-select__selection {
      color: #95a2c7;
    }
  }
}
/* Change the white to any color ;) */
input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus,
input:-webkit-autofill:active {
  box-shadow: 0 0 0 30px $app-background inset !important;
  -webkit-box-shadow: 0 0 0 30px $app-background inset !important;
  border: none !important;
  background-color: #be1338;
  -webkit-text-fill-color: #be1338 !important;
}

@media all and (max-width: $tablet-small-width) {
  .input-group {
    flex-direction: column;
    align-items: flex-start;

    .label {
      margin: 10px 0;
      text-align: left !important;
    }
    input,
    .input-select {
      margin: 10px 0;
    }

    .v-text-field {
      padding-top: 0;
    }

    .input-select::v-deep .v-input__control {
      .v-select__selections {
        font-size: 16px;
        line-height: 94%;
        padding: 0;
      }
    }
  }
}

@media all and (max-width: $mobile-width) {
  .custom-input-group {
    font-size: 16px !important;
    line-height: 94% !important;
  }
  .input-group {
    input {
      margin: 8px 0;
    }
    .label {
      margin-top: 1rem;
    }
  }
}

.text-capitalize {
  .label {
    text-transform: capitalize;
  }
  input {
    &::placeholder {
      text-transform: capitalize;
      opacity: 0.5;
    }
  }
}

.color-primary{
  .input-select,
    input{
      color: $text-primary-color !important;
    }
}
</style>
<style lang="scss">
.input-select > .v-input__control > .v-input__slot:before,
.input-select > .v-input__control > .v-input__slot:after {
  border: none;
}
</style>
