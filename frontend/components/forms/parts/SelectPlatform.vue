<template>
  <div class="platform">
    <div class="label">
      {{ $t('Select Plaform') }}
    </div>
    <div class="select-platform">
      <div
        v-ripple="{ center: true }"
        class="single-button-link"
        :class="platform === 'pc' && 'single-button-link-active'"
        link
        @click="selectPlatform('pc')"
      >
        <v-avatar
          tile
          class="single-button-link-icon"
        >
          <svg
            width="41"
            height="40"
            viewBox="0 0 41 40"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M40.3021 0.839961C40.119 0.219259 39.4686 -0.135394 38.849 0.0481444L33.1628 1.73195C30.8067 2.40945 29.4272 4.80537 30.0219 7.18902C30.207 7.93083 29.9867 8.72757 29.4471 9.26826C29.1415 9.57455 28.7034 10.0136 28.3743 10.3434C24.0119 6.79257 17.5676 7.02861 13.4758 11.129L3.6941 20.9311C-0.653242 25.2876 -0.653242 32.376 3.6941 36.7324C8.04128 41.0887 15.1151 41.089 19.4626 36.7324L29.2443 26.9304C33.3487 22.8174 33.5601 16.3586 30.0283 12.0009L31.1037 10.9233C32.2191 9.8038 32.6741 8.15539 32.2912 6.62052C32.0138 5.50866 32.6217 4.33234 33.8208 3.98136L39.512 2.29616C40.1314 2.1127 40.4852 1.46074 40.3021 0.839961ZM27.5902 25.273L17.8086 35.075C14.3732 38.5175 8.78342 38.5175 5.34805 35.075C1.91275 31.6325 1.91275 26.0311 5.34805 22.5886L15.1298 12.7865C18.3032 9.60651 23.2689 9.36835 26.7088 12.0124L24.5125 14.2132C23.1421 13.5335 21.4327 13.7635 20.293 14.9056L18.5287 16.6736C17.389 17.8156 17.1594 19.5286 17.8378 20.9019L16.7643 21.9776C16.3076 22.4353 16.3076 23.1773 16.7643 23.635C17.221 24.0927 17.9616 24.0928 18.4184 23.635L19.4918 22.5594C20.8823 23.2491 22.5855 22.9952 23.7114 21.867L25.4756 20.0991C26.6154 18.957 26.845 17.244 26.1665 15.8707L28.3627 13.67C30.9883 17.1009 30.7788 22.0777 27.5902 25.273ZM23.8216 18.4415L22.0573 20.2095C21.5405 20.7273 20.6996 20.7273 20.1827 20.2095C19.6676 19.6932 19.6619 18.853 20.1827 18.3309L21.947 16.563C22.4639 16.0451 23.3047 16.0451 23.8216 16.563C24.3384 17.0809 24.3384 17.9236 23.8216 18.4415Z"
              :fill="platform === 'pc' ? '#be1338' : '#A1AFD3'"
            />
          </svg>
        </v-avatar>
        <span class="single-button-link-title">PC</span>
      </div>
      <div
        v-ripple="{ center: true }"
        class="single-button-link"
        :class="platform === 'x-box' && 'single-button-link-active'"
        link
        @click="selectPlatform('x-box')"
      >
        <v-avatar
          tile
          class="single-button-link-icon"
        >
          <svg
            width="33"
            height="32"
            viewBox="0 0 33 32"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <g clip-path="url(#clip0)">
              <path
                d="M16.1959 4.61661C14.6044 3.50643 12.9064 2.59158 11.1504 1.90037C11.1502 1.90016 11.1499 1.89984 11.1496 1.89935C11.1492 1.8987 11.1489 1.89809 11.1487 1.89763C11.1487 1.89761 11.1487 1.89758 11.1487 1.89756C14.2815 0.703766 18.1081 0.703693 21.2432 1.89764C19.4886 2.58889 17.79 3.50397 16.1959 4.61661Z"
                :stroke="platform === 'x-box' ? '#be1338' : '#A1AFD3'"
                stroke-width="2"
              />
              <path
                d="M18.8078 6.45579L19.4291 7.23494L19.4311 7.23747C19.4311 7.23757 19.431 7.23768 19.431 7.23777C19.4307 7.23844 19.4306 7.23819 19.4316 7.23737L19.4313 7.23701L19.4297 7.23497L18.8078 6.45579ZM18.8078 6.45579C20.5083 5.09979 22.3165 3.86779 24.1786 2.79179M18.8078 6.45579L25.2424 2.83379M24.1786 2.79179L24.6752 3.65519L24.6742 3.65667C24.6744 3.6568 24.6746 3.65694 24.6748 3.65707C24.6747 3.65705 24.6746 3.65702 24.6745 3.657C24.6739 3.65678 24.6744 3.65682 24.6762 3.65804L24.6765 3.6575L24.6772 3.65864C24.678 3.65819 24.6786 3.65787 24.6791 3.65765C24.6801 3.65714 24.6804 3.65713 24.68 3.65724C24.6797 3.65731 24.6793 3.65738 24.6788 3.65743L24.6778 3.65567L25.2424 2.83379M24.1786 2.79179L24.6765 3.65337L25.2424 2.83379M24.1786 2.79179C24.5159 2.59779 24.9251 2.61579 25.2424 2.83379M31.162 15.9978C31.162 18.9487 30.2948 21.8092 28.6933 24.2275C27.93 21.9014 26.7001 18.9953 25.3082 16.2204C23.5006 12.6166 21.3312 9.05421 19.4316 7.23951L19.4316 7.23735C21.0925 5.91296 22.8588 4.70949 24.6771 3.65869C28.7389 6.46482 31.162 11.0767 31.162 15.9978ZM26.3696 25.1244C26.6118 25.5401 26.8399 25.9318 27.052 26.2941C24.25 29.2944 20.3381 30.9978 16.1953 30.9978C12.0514 30.9978 8.13935 29.2936 5.34784 26.3034C5.57233 25.9193 5.81478 25.5024 6.07265 25.0589C7.22896 23.0702 8.69524 20.5484 10.2426 18.0737C12.3507 14.702 14.5264 11.5562 16.1933 9.99847C17.8587 11.5558 20.0375 14.6997 22.149 18.0686C23.7183 20.5725 25.2055 23.1257 26.3696 25.1244ZM3.70574 24.2362C2.09618 21.8093 1.22852 18.9478 1.22852 15.9978C1.22852 11.0782 3.65009 6.46774 7.70756 3.66134C7.71055 3.65955 7.71274 3.6591 7.71392 3.65899C9.5308 4.70901 11.2943 5.91174 12.9568 7.2357C12.9568 7.23682 12.9566 7.23753 12.9564 7.23793L12.9562 7.23837L12.9559 7.23862C11.0545 9.05453 8.88764 12.6217 7.08304 16.2289C5.69439 19.0046 4.46788 21.9108 3.70574 24.2362Z"
                :stroke="platform === 'x-box' ? '#be1338' : '#A1AFD3'"
                stroke-width="2"
              />
            </g>
            <defs>
              <clipPath id="clip0">
                <rect
                  width="31.9335"
                  height="32"
                  fill="white"
                  transform="translate(0.228516)"
                />
              </clipPath>
            </defs>
          </svg>
        </v-avatar>
        <span class="single-button-link-title">X-Box</span>
      </div>
      <div
        v-ripple="{ center: true }"
        class="single-button-link"
        :class="platform === 'ps-4' && 'single-button-link-active'"
        link
        @click="selectPlatform('ps-4')"
      >
        <v-avatar
          tile
          class="single-button-link-icon"
        >
          <svg
            width="40"
            height="12"
            viewBox="0 0 40 12"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M2.34375 11.7188H0V8.20312C0 6.26461 1.57711 4.6875 3.51562 4.6875H8.25523C8.90141 4.6875 9.42711 4.1618 9.42711 3.51562C9.42711 2.86945 8.90141 2.34375 8.25523 2.34375H0V0H8.25523C10.1938 0 11.7709 1.57711 11.7709 3.51562C11.7709 5.45414 10.1938 7.03125 8.25523 7.03125H3.51562C2.86945 7.03125 2.34375 7.55695 2.34375 8.20312V11.7188ZM17.0709 8.20312V3.51562C17.0709 1.57764 18.6472 0.000867844 20.585 0H20.5866H25.8844V2.34375H20.5866C19.9404 2.34375 19.4147 2.86945 19.4147 3.51562V8.20312C19.4147 10.1416 17.8376 11.7188 15.8991 11.7188H10.5996V9.375H15.8991C16.5452 9.375 17.0709 8.8493 17.0709 8.20312ZM35.3125 11.7188H37.6562V9.375H40V7.03125L37.6562 7.03109V2.34375C37.6562 1.05141 36.6048 0 35.3125 0C34.8686 0 34.4362 0.125001 34.0618 0.361406L26.64 5.04891C25.9555 5.48117 25.5469 6.22219 25.5469 7.03125C25.5469 8.32359 26.5983 9.375 27.8906 9.375H35.3125V11.7188ZM27.8915 7.03055L35.3125 2.34375V7.03102L27.8915 7.03055Z"
              :fill="platform === 'ps-4'? '#be1338' : '#A1AFD3' "
            />
          </svg>
        </v-avatar>

        <span class="single-button-link-title">PS 4</span>
      </div>
      <div
        v-ripple="{ center: true }"
        class="single-button-link"
        :class="platform === 'cross platform' && 'single-button-link-active'"
        @click="selectPlatform('cross platform')"
      >
        <v-avatar
          tile
          class="single-button-link-icon"
        >
          <svg
            width="41"
            height="40"
            viewBox="0 0 41 40"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M6.84375 22.1919V14.4555C6.84375 13.7341 7.23227 13.0686 7.86049 12.7139L13.8438 9.33589L14.4387 9M34.8438 22.1919V14.4555C34.8438 13.7341 34.4552 13.0686 33.827 12.7139L27.8438 9.33589L27.2488 9M14.8438 33.6126L19.8605 36.4449C20.4707 36.7894 21.2168 36.7894 21.827 36.4449L27.2488 33.3839"
              :stroke="platform === 'cross platform' ? '#be1338' : '#A1AFD3'"
              stroke-width="2"
            />
            <path
              d="M20.3438 3.44338C20.6532 3.26474 21.0343 3.26474 21.3438 3.44338L27.138 6.78867C27.4474 6.96731 27.638 7.29743 27.638 7.6547V14.3453C27.638 14.7026 27.4474 15.0327 27.138 15.2113L21.3438 18.5566C21.0343 18.7353 20.6532 18.7353 20.3438 18.5566L14.5495 15.2113C14.2401 15.0327 14.0495 14.7026 14.0495 14.3453V7.6547C14.0495 7.29743 14.2401 6.96731 14.5495 6.78868L20.3438 3.44338Z"
              :stroke="platform === 'cross platform' ? '#be1338' : '#A1AFD3'"
              stroke-width="2"
            />
            <path
              d="M20.8438 19V11L14.3438 7.75"
              :stroke="platform === 'cross platform' ? '#be1338' : '#A1AFD3'"
              stroke-width="2"
            />
            <path
              d="M20.3438 11L26.8438 7.75"
              :stroke="platform === 'cross platform' ? '#be1338' : '#A1AFD3'"
              stroke-width="2"
            />
            <path
              d="M11.3438 19.4434C11.6532 19.2647 12.0343 19.2647 12.3438 19.4434L18.138 22.7887C18.4474 22.9673 18.638 23.2974 18.638 23.6547V30.3453C18.638 30.7026 18.4474 31.0327 18.138 31.2113L12.3438 34.5566C12.0343 34.7353 11.6532 34.7353 11.3438 34.5566L5.54952 31.2113C5.24012 31.0327 5.04952 30.7026 5.04952 30.3453V23.6547C5.04952 23.2974 5.24012 22.9673 5.54952 22.7887L11.3438 19.4434Z"
              :stroke="platform === 'cross platform' ? '#be1338' : '#A1AFD3'"
              stroke-width="2"
            />
            <path
              d="M11.8438 35V27L5.34375 23.75"
              :stroke="platform === 'cross platform' ? '#be1338' : '#A1AFD3'"
              stroke-width="2"
            />
            <path
              d="M11.3438 27L17.8438 23.75"
              :stroke="platform === 'cross platform' ? '#be1338' : '#A1AFD3'"
              stroke-width="2"
            />
            <path
              d="M29.3438 19.4434C29.6532 19.2647 30.0343 19.2647 30.3438 19.4434L36.138 22.7887C36.4474 22.9673 36.638 23.2974 36.638 23.6547V30.3453C36.638 30.7026 36.4474 31.0327 36.138 31.2113L30.3438 34.5566C30.0343 34.7353 29.6532 34.7353 29.3438 34.5566L23.5495 31.2113C23.2401 31.0327 23.0495 30.7026 23.0495 30.3453V23.6547C23.0495 23.2974 23.2401 22.9673 23.5495 22.7887L29.3438 19.4434Z"
              :stroke="platform === 'cross platform' ? '#be1338' : '#A1AFD3'"
              stroke-width="2"
            />
            <path
              d="M29.8438 35V27L23.3438 23.75"
              :stroke="platform === 'cross platform' ? '#be1338' : '#A1AFD3'"
              stroke-width="2"
            />
            <path
              d="M29.3438 27L35.8438 23.75"
              :stroke="platform === 'cross platform' ? '#be1338' : '#A1AFD3'"
              stroke-width="2"
            />
          </svg>
        </v-avatar>
        <span class="single-button-link-title">{{ $t('Cross Platform') }}</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    active: {
      type: String,
      default: 'cross platform'
    }
  },
  data() {
    return {
      platform: ''
    };
  },
  mounted() {
    this.platform = this.active;
  },
  methods: {
    selectPlatform(platform) {
      this.platform = platform;
      this.$emit('onSelect', platform);
    }
  }
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes";
.platform {
  // display: flex;
  // align-items: center;
  min-height: 43px;
  font-size: 24px;
  font-weight: 900;
  line-height: 94%;
  margin-top: 10px;
  text-transform: uppercase;

  .label {
    font-size: 16px;
    font-family: Telegraf-UltraBold, serif;
    // display: flex;
    // flex-direction: column;
    // flex-basis: 30%;
    text-align: left;
    padding: 8px;
    color: $text-primary-color;
  }

  .select-platform {
    color: $text-primary-color;
    display: flex;
    flex: 1 1 auto;
    align-items: center;
    justify-content: space-between;

    .single-button-link {
      display: flex;
      flex-direction: column;
      align-content: center;
      justify-content: center;
      // flex: 1 1 55px;
      border: 1px solid rgba(161, 175, 211, 0.2);
      box-sizing: border-box;
      width: 100px;
      height: 104px;
      align-items: center;
      cursor: pointer;

      .single-button-link-title {
        font-family: Telegraf-UltraBold, serif;
        font-style: normal;
        text-align: center;
        font-style: normal;
        font-weight: 900;
        font-size: 14px;
        line-height: 94%;
        text-transform: initial;
        line-height: 15px;
        margin-top: 11px;
      }
    }
  }
  .single-button-link-active {
    background: #be133847;
    border: none !important;

    .single-button-link-title {
      color: $text-secondary-color !important;
    }
  }
}

@media all and (max-width: $tablet-small-width) {
  .platform {
    flex-direction: column;
    align-items: flex-start;

    .label {
      margin: 10px 0;
    }
    .select-platform {
      margin: 10px 0;
      width: 100%;
    }
  }
}
</style>
