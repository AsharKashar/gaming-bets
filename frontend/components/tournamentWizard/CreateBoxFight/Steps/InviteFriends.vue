<template>
  <div class="invite-box">
    <p>{{ $t('Step') }} 2 of 2</p>
    <h3 class="subtitles-primary mb-3">
      {{ $t('Invite friends') }}
    </h3>
    <p>{{ $t('Copy Invite Link and share that with your opponents as well as team mate as well the wager amount you paid will be distributed equally among the team') }}</p>

    <div v-if="links.friends">
      <p class="bold">
        {{ $t('Friendly Invite') }}
      </p>
      <div class="copy-text-box">
        <p>{{ links.friends }}</p>
        <a
          class="copy"
          @click="copyLink(links.friends)"
        >copy</a>
      </div>
    </div>

    <div>
      <p class="bold">
        {{ $t('Opponents') }}
      </p>
      <div class="copy-text-box">
        <p>{{ links.opponent }}</p>
        <a
          class="copy"
          @click="copyLink(links.opponent)"
        >{{ $t('copy') }}</a>
      </div>
    </div>

    <div class="btn-container">
      <default-button
        type="button"
        btn-class="default-banger-btn button-block"
        :on-click="next"
      >
        {{ $t('Skip for Now') }}
      </default-button>
      <default-button
        type="button"
        btn-class="default-banger-btn button-block"
        :on-click="next"
      >
        {{ $t('Next') }}
      </default-button>
    </div>
  </div>
</template>

<script>
import DefaultButton from 'components/DefaultButton.vue';
export default {
  components: {
    DefaultButton,
  },
  props: {
    links: {
      type: Object,
      default: () => ({
        friends: '',
        opponent: '',
      }),
    },
  },
  methods: {
    next() {
      this.$emit('nextTab');
    },
    copyLink(link) {

      const el = document.createElement('textarea');
      el.value = link;
      el.setAttribute('readonly', '');
      el.style.position = 'absolute';
      el.style.left = '-9999px';
      document.body.appendChild(el);
      el.select();
      console.log(el.value);
      document.execCommand('copy');
      document.body.removeChild(el);
      this.$notify({
        group: 'error',
        title: 'Link copied',
        text: 'Invitation link was successfully copied to clipboard',
        type: 'app',
      });

      // navigator.clipboard.writeText(link).then(() => {
      //   this.$notify({
      //     group: 'error',
      //     title: 'Link copied',
      //     text: 'Invitation link was successfully copied to clipboard',
      //     type: 'app',
      //   });
      // });
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";
.invite-box {
  padding: 1rem;
  & > p,
  & > h3 {
    color: $text-secondary-color;
  }

  & > p.bold {
    color: $text-primary-color;
  }

  .copy-text-box {
    border: 1px solid $border-secondary-color;
    padding: 1rem;
    display: flex;
    align-items: center;
    margin-bottom: 1.5rem;

    & > p {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      margin: 0;
    }

    .copy {
      margin-left: 1rem;
      text-decoration: underline;
      color: $text-secondary-color;
      font-weight: bold;
    }
  }
  .btn-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    column-gap: 15px;
    & button {
      font-size: 1rem;
    }
    & button:first-child {
      background: transparent;
      color: $text-secondary-color;
    }
  }
}
</style>
