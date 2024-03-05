<template>
  <div
    :id="card.id"
    class="inline-card-wrapper"
    :teamid="card.team_id"
    :poition="card.position"
  >
    <div class="inline-card">
      <div class="inline-position">
        <img
          src="~/static/images/leaderBoard/postion-inline.svg"
          alt
        >
        <span>{{ index }}</span>
      </div>
      <div class="inline-body">
        <div class="team-logo">
          <img
            :src="getAvatar"
            alt
          >
        </div>
        <p class="team-name">
          {{ card.name }}
        </p>
        <p class="team-price">
          {{ roundOf(card.prize) }}
        </p>
      </div>
    </div>
  </div>
</template>xR

<script>
export default {
  props: {
    card: {
      type: Object,
      default: () => ({}),
    },
    index: {
      type: Number,
      default: 0,
    },
  },

  computed: {
    getAvatar() {
      if (this.card.position === 4) {
        return require('~/static/images/leaderBoard/navi.svg');
      }
      if (this.card.position === 5) {
        return require('~/static/images/leaderBoard/virtuspro.svg');
      }
      if (this.card.position === 6) {
        return require('~/static/images/leaderBoard/cloud.svg');
      }
      if (this.card.position === 7) {
        return require('~/static/images/leaderBoard/virtuspro.svg');
      }
      if (this.card.position === 8) {
        return require('~/static/images/leaderBoard/fnatic.svg');
      }
      if (this.card.position === 9) {
        return require('~/static/images/leaderBoard/teamsolo.svg');
      }
      return require('~/static/images/leaderBoard/virtuspro.svg');
    },
  },

  methods: {
    roundOf(value) {
      return Number(value).toFixed(1);
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/sizes.scss";
.inline-card-wrapper {
  width: 100%;
  .inline-card {
    width: 100%;
    display: flex;
    align-items: center;
    cursor: pointer;
    transition: 0.3s background;
    &:hover {
      background: #a1afd345;
    }
    .inline-position {
      flex-basis: 10%;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: flex-end;
      position: relative;
      span {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-weight: 800;
        font-size: 20px;
        line-height: 110%;
        color: $text-primary-color;
      }
    }

    .inline-body {
      flex-basis: 90%;
      display: flex;
      align-items: center;
      border-bottom: 1px solid #a1afd34f;
      padding: 0 2em;
      p {
        margin: 0;
      }
      .team-name {
        margin-left: 2em;
        font-weight: 900;
        font-size: 24px;
        line-height: 130%;
        color: $text-primary-color;
      }
      .team-price {
        font-weight: 900;
        font-size: 24px;
        line-height: 130%;
        color: $text-secondary-color;
        text-align: right;
        width: 100%;
      }
    }
  }
}

@media screen and (max-width: $tablet-small-width) {
  .inline-card-wrapper {
    width: 100%;
    .inline-card {
      img {
        width: 40px;
      }
      .inline-body {
        padding: 0 1em;
        p {
          margin: 0;
          font-size: 16px !important;
        }
        .team-name {
          margin-left: 1em;
        }
      }
    }
  }
}
</style>
