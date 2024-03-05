<template>
  <div class="host-wrapper">
    <div class="header">
      <p>Ehor Vasiliev Host is creating the match</p>
    </div>
    <div class="create-body">
      <p class="hosted">
        Hosted by
      </p>
      <img
        src="~/static/images/brackets/popups/team-icon.svg"
        alt
      >
      <ul>
        <li>
          <span class="name">Lesly Prayer</span>
          <img
            src="~/static/images/brackets/golden-rank.svg"
            alt
          >
        </li>
      </ul>
    </div>
    <div class="footer">
      <default-button
        type="button"
        class="default-banger-btn"
      >
        CONFIRM
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
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/sizes.scss";
.host-wrapper {
  width: 100%;
  padding: 3em;
  .header {
    width: 100%;
    text-align: center;
    p {
      margin: 0;
      font-weight: 800;
      font-size: 32px;
      line-height: 115%;
      color: $text-secondary-color;
      margin-bottom: 1em;
    }
  }

  .create-body {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 3em 0;
    .hosted {
      font-weight: 900;
      font-size: 14px;
      line-height: 120%;
      color: $text-primary-color;
      margin: 0;
    }
    img {
      margin-left: 1em;
      width: 50px;
    }
    ul {
      padding: 0;
      margin: 0;
      margin-left: 1em;
      list-style: none;
      li {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        .name {
          font-weight: normal;
          font-size: 16px;
          line-height: 140%;
          color: $text-primary-color;
        }
        img {
          width: 20px;
          margin: 0;
        }
      }
    }
  }
  .footer {
    width: 100%;
    .default-banger-btn {
      width: 100%;
    }
  }
}
</style>
