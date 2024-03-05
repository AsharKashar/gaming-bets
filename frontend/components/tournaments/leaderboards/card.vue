<template>
  <div class="card-wrapper">
    <div class="upper-card">
      <div class="avatar-card">
        <!-- <img :src="card.avatarsrc" alt /> -->
        <img
          :src="getAvatar"
          alt
        >
      </div>

      <!-- {{card}} -->
      <div class="info-card">
        <p class="team-name">
          {{ card.name }}
        </p>
        <ul>
          <li>
            <img
              src="~/static/images/leaderBoard/uk.svg"
              alt
              class="flag"
            >
            <span>Dr. Lupo</span>
          </li>
          <li>
            <img
              src="~/static/images/leaderBoard/flag.svg"
              alt
              class="flag"
            >
            <span>Gommru</span>
          </li>
          <li>
            <img
              src="~/static/images/leaderBoard/uk.svg"
              alt
              class="flag"
            >
            <span>AlexJJ</span>
          </li>
          <li>
            <img
              src="~/static/images/leaderBoard/flag.svg"
              alt
              class="flag"
            >
            <span>Gingerpop</span>
          </li>
        </ul>
      </div>
    </div>
    <div class="lower-card">
      <div class="postion">
        <img
          :src="getPosition"
          alt
          class="postion-icon"
        >
      </div>
      <div class="postion-info">
        <p class="place">
          Place
        </p>
        <p class="price">
          {{ roundOf(card.prize) }}€
        </p>
        <p class="reward">
          reward
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    card: {
      type: Object,
      default: () => ({})
    },
  },
  computed: {
    getAvatar() {
      if (this.card.position === 1) {
        return require('~/static/images/leaderBoard/rouge.svg');
      }
      if (this.card.position === 2) {
        return require('~/static/images/leaderBoard/bear.svg');
      }
      return require('~/static/images/leaderBoard/titan.svg');
    },
    getPosition() {
      if (this.card.position === 1) {
        return require('~/static/images/leaderBoard/position1.svg');
      }
      if (this.card.position === 2) {
        return require('~/static/images/leaderBoard/position2.svg');
      }
      return require('~/static/images/leaderBoard/position3.svg');
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

.card-wrapper {
  width: 100%;
  background: #a1afd324;
  clip-path: polygon(5% 0, 100% 0, 100% 95%, 95% 100%, 0 100%, 0 5%);
  display: flex;
  flex-direction: column;
  padding: 2em 0;
  cursor: pointer;
  transition: 0.3s background;

  &:hover {
    background: #a1afd345;
  }

  .upper-card {
    display: flex;
    width: 100%;
    border-bottom: 1px solid #a1afd359;
    box-sizing: border-box;
    padding-bottom: 1em;
    .avatar-card {
      flex-basis: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .info-card {
      flex-basis: 50%;
      display: flex;
      flex-direction: column;
      .team-name {
        font-weight: 900;
        font-size: 20px;
        line-height: 110%;
        text-transform: uppercase;
        color: $text-primary-color;
      }

      ul {
        padding: 0;
        margin: 0;
        list-style: none;
        width: 100%;
        li {
          display: flex;
          align-items: center;
          .flag {
            max-width: 30px;
            margin-right: 1em;
          }
          span {
            font-weight: 900;
            font-size: 16px;
            line-height: 120%;
            color: $text-hover-color;
          }
        }
      }
    }
  }
  .lower-card {
    display: flex;
    justify-content: center;
    align-items: center;

    .postion {
      flex-basis: 50%;
      display: flex;
      justify-content: center;
    }

    .postion-info {
      flex-basis: 50%;
      p {
        margin: 0;
        font-weight: 900;
      }
      .place {
        font-size: 24px;
        line-height: 130%;
        color: $text-secondary-color;
      }
      .price {
        font-size: 32px;
        line-height: 115%;
        color: $text-primary-color;
      }
      .reward {
        font-size: 20px;
        line-height: 110%;
        color: $text-primary-color;
      }
    }
  }
}

@media screen and (max-width: $tablet-large-width) {
  .postion-info {
    .price {
      font-size: 26px;
    }
  }
}
@media screen and (max-width: $tablet-large-width) {
  .postion-info {
    p {
      font-size: 18px !important;
    }
  }
}
</style>
