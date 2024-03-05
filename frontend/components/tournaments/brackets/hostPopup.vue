<template>
  <div class="host-wrapper">
    <div class="header">
      <p>Please Create Match and Invite players listed below</p>
    </div>
    <div class="match-detail">
      <p class="detail">
        Match Details
      </p>
      <p class="time">
        14 min left
      </p>
    </div>
    <div class="game-details">
      <img
        src="~/static/images/brackets/popups/game-logo.svg"
        alt
        class="game-logo"
      >
      <img
        src="~/static/images/brackets/popups/platfom-icon.svg"
        alt
        class="platform-logo"
      >
      <ul>
        <li>
          <img
            src="~/static/images/brackets/host.svg"
            alt
            class="host-icon"
          >
          <span class="dash" />You are host of this match
        </li>
      </ul>
    </div>
    <div class="match-details">
      <p class="heading">
        Box fights
      </p>
      <ul>
        <li>
          <span class="match">match:</span>
          <span class="vs">5vs5</span>
        </li>
        <li>
          <span class="match">date :</span>
          <span class="vs">10 Jun</span>
        </li>
        <li>
          <span class="match">time:</span>
          <span class="vs">16:00</span>
        </li>
      </ul>
    </div>
    <div class="teams">
      <p class="team-name">
        Friendly
      </p>
      <a
        href
        class="team-member"
      >
        <div class="avatar">
          <img
            src="~/static/images/brackets/popups/team-icon.svg"
            alt
            class="avatar"
          >
          <p class="member-name">Mark Pain</p>
        </div>
        <p class="copy">copy username</p>
      </a>
      <a
        href
        class="team-member"
      >
        <div class="avatar">
          <img
            src="~/static/images/brackets/popups/team-icon.svg"
            alt
          >
          <p class="member-name">Mark Pain</p>
        </div>

        <p class="copy">copy username</p>
      </a>
    </div>
    <div class="teams">
      <p class="team-name">
        Opponent
      </p>
      <a
        href
        class="team-member"
      >
        <div class="avatar">
          <img
            src="~/static/images/brackets/popups/team-icon.svg"
            alt
          >
          <p class="member-name">Mark Pain</p>
        </div>
        <p class="copy">copy username</p>
      </a>
      <a
        href
        class="team-member"
      >
        <div class="avatar">
          <img
            src="~/static/images/brackets/popups/team-icon.svg"
            alt
          >
          <p class="member-name">Mark Pain</p>
        </div>
        <p class="copy">copy username</p>
      </a>
    </div>
    <div class="footer">
      <default-button
        type="button"
        class="default-banger-btn"
      >
        CONFIRM
      </default-button>
      <!-- <default-button type="button" class="default-banger-btn" :on-click="host"></default-button> -->
      <a class="link-btn">details</a>
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
  padding: 2em;
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

  .match-detail {
    width: 100%;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    .detail {
      font-style: normal;
      font-weight: 900;
      font-size: 24px;
      line-height: 130%;
      color: $text-primary-color;
    }
    .time {
      font-weight: 900;
      font-size: 11px;
      line-height: 12px;
      background: #3b416c;
      padding: 1em 2em;
      border-radius: 6px;
      color: $text-primary-color;
    }
  }

  .game-details {
    width: 100%;
    display: flex;
    align-items: center;
    .platform-logo {
      margin-left: 1em;
    }
    ul {
      padding: 0;
      margin: 0;
      margin-left: 2em;

      list-style: none;
      width: 100%;
      li {
        width: 100%;
        display: flex;
        align-items: center;
        .dash {
          margin-left: 1em;
        }
      }
    }
  }

  .match-details {
    width: 100%;
    position: relative;
    display: flex;
    align-items: center;
    margin: 1em 0;
    .heading {
      font-weight: 900;
      font-size: 24px;
      line-height: 130%;
      color: $text-hover-color;
    }
    ul {
      padding: 0;
      margin: 0;
      margin-left: 2em;
      list-style: none;
      width: 50%;
      display: flex;
      li {
        width: 100%;
        display: flex;
        flex-direction: column;
        span {
          display: block;
        }

        .match {
          font-weight: normal;
          font-size: 14px;
          line-height: 130%;
          display: flex;
          align-items: center;
          letter-spacing: 0.02em;
          color: $text-primary-color;
        }

        .vs {
          font-weight: 800;
          font-size: 14px;
          line-height: 150%;
          color: $text-hover-color;
        }
      }
    }
  }
  .teams {
    width: 100%;
    margin-bottom: 1em;
    .team-name {
      font-style: normal;
      font-weight: 900;
      font-size: 24px;
      line-height: 130%;
      color: $text-primary-color;
    }
    .team-member {
      width: 100%;
      text-decoration: none;
      border: 1px solid #a1afd326;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 1em;
      p {
        margin: 0;
      }
      .avatar {
        display: flex;
        align-items: center;
        .member-name {
          margin-left: 1em;
          font-weight: normal;
          font-size: 16px;
          line-height: 140%;
          color: $text-primary-color;
        }
      }

      .copy {
        font-weight: 900;
        font-size: 16px;
        line-height: 120%;
        justify-self: flex-end;
        color: $text-secondary-color;
      }
    }
  }
  .footer {
    width: 100%;
    display: flex;
    align-items: center;
    padding: 1em;
    .link-btn {
      font-weight: 900;
      font-size: 20px;
      line-height: 100%;
      text-transform: uppercase;
      color: $text-primary-color;
      margin-left: 4em;
    }
  }
}
</style>
