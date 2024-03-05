<template>
  <div class="challange-card">
    <ul>
      <li class="header title-bar">
        <p class="image" />
        <p class="name">
          Game Challenge
        </p>
        <p class="prize">
          prize
        </p>
        <p class="type">
          PlayType
        </p>
        <p class="platform">
          Platform
        </p>
        <p class="time">
          Starts
        </p>
        <p class="button" />
      </li>
    </ul>
    <ul
      v-for="index in 5 "
      :key="index"
    >
      <li class="desktop">
        <img
          src="~/static/images/challenge/c1.svg"
          alt=""
        >
        <p class="name">
          Marathon Ninja Masters Pro League Multifan
        </p>
        <p class="prize">
          $ 11.00
        </p>
        <p class="type">
          DUO
        </p>
        <p class="platform">
          PS4
        </p>
        <p class="time">
          MAY 20 / 08:00PM
        </p>
        <default-button
          type="button"
          :on-click="accpet"
        >
          Accept
        </default-button>
      </li>
      <li class="mobile">
        <img
          src="~/static/images/challenge/c1.svg"
          alt=""
        >
        <div class="content">
          <div class="header">
            <p class="name">
              Marathon Ninja Masters Pro League Multifan
            </p>
          </div>
          <v-expansion-panels>
            <v-expansion-panel>
              <v-expansion-panel-header>
                <p class="prize">
                  $ 11.00
                </p>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <div class="content-body">
                  <p class="type">
                    <span>playtype:</span> DUO
                  </p>
                  <p class="platform">
                    <span>platform:</span>  PS4
                  </p>
                  <p class="time">
                    <span>Starts:</span>  MAY 20 / 08:00PM
                  </p>
                  <default-button
                    type="button"
                    :on-click="accpet"
                    class="accept"
                  >
                    Accept
                  </default-button>
                </div>
              </v-expansion-panel-content>
            </v-expansion-panel>
          </v-expansion-panels>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
import DefaultButton from 'components/DefaultButton.vue';
export default {
  components: {
    DefaultButton,
  },
  methods: {
    accpet() {},
  },
};
</script>

<style lang='scss' scoped>
@import '~/assets/styles/colors';
@import '~/assets/styles/sizes.scss';
.challange-card {
  width: 100%;
  position: relative;
  padding: 0 0.8em;
  ul {
    padding: 0;
    margin: 0;
    width: 100%;
    li {
      width: 100%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #ffffff17;
      padding: 0 1em 0 0;
      margin: 3px 0;
      transition: 0.3s background;
      cursor: pointer;
      &:hover {
        background: #ffffff30;
      }
      .name {
        width: 15%;
      }
      p {
        font-style: normal;
        font-weight: 900;
        font-size: 16px;
        line-height: 120%;
        margin: 0;
        color: $text-hover-color;
      }
      .prize {
        font-style: normal;
        font-weight: 900;
        font-size: 20px;
        line-height: 110%;
        color: $text-secondary-color;
      }
      .time {
        width: 10%;
      }
    }
    .header {
      padding: 1em;
      .image {
        margin-right: 8em;
      }
      .button {
        margin-right: 12em;
      }
      p {
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: $text-primary-color;
        font-style: normal;
        font-weight: 900;
        font-size: 14px;
        line-height: 120%;
        margin: 0;
      }
    }

    .mobile {
     
      img
      {
        position: static;
        top: 0;
        left: 0;
      }
      position: relative;
      display: none;
      align-items: flex-start;
      .content {
        width: 100%;

        .prize
        {
          font-size: 16px;
        }
        p
        {
          margin: 5px 0;
          width: 100%;
          font-size: 14px;
          span
          {
            font-style: normal;
            font-weight: 800;
            font-size: 12px;
            line-height: 94%;
            display: inline-block;
            margin-right: 1em;
            color: $text-primary-color;
            text-transform: uppercase;
          }
        }


        .accept
        {
          margin-top: 5px;
        }

      }
    }
  }
}

@media screen and (max-width: $tablet) {
  .challange-card {
    ul {
      .desktop ,.title-bar{
        display: none;
      }
      .mobile {
        display: flex;
      }
    }
  }
}
</style>