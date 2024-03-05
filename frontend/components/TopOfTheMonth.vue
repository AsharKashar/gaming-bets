<template>
  <div class="top-block">
    <home-title
      :title="$t('Top of the month')"
      description="Fake text. Ad molorrovid qui dolentur abo. Nam destium que nus quo int eria doluptatias nonesci taturibus accumque aut offic test voloria dis"
      class="top-of-header"
    />
    <div class="winners">
      <div
        v-for="(winner,i) in winners"
        :key="i"
        class="winner"
      >
        <img
          v-lazy-load
          :src="winner.avatar"
        >
        <div class="titles">
          <div class="place">
            {{ winner.place }}
          </div>
          <div class="name">
            {{ winner.name }}
          </div>
        </div>
      </div>
    </div>
    <div class="counter">
      <div class="counter-title">
        {{ $t('Next monthly winners revealed in') }}
      </div>
      <div>
        <countdown />
      </div>
    </div>
  </div>
</template>

<script>
import HomeTitle from 'components/HomeTitle.vue';
import Countdown from 'components/Countdown.vue';

export default {
  name: 'TopOfTheMonth',
  components: {
    HomeTitle,
    Countdown,
  },
  data() {
    return {
      winners: [
        {
          name: 'Justin_O_O',
          avatar:
            'https://cdn.bangergames.com/demo-files/2nd.png',
          place: '2nd',
        },
        {
          name: 'Bembo',
          avatar:
            'https://cdn.bangergames.com/demo-files/1st.png',
          place: '1st',
        },
        {
          name: 'jhny27',
          avatar:
            'https://cdn.bangergames.com/demo-files/3rd.png',
          place: '3rd',
        },
      ],
    };
  },
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes.scss";

.top-of-header::v-deep .col-left {
  padding-right: 10%;
}

.top-block {
  margin-top: 98px;
}

.winners {
  display: flex;
  margin-top: 105px;
  justify-content: space-between;

  .winner {
    background: #090e53;
    border-radius: 12px;
    flex-basis: 31.5%;
    height: 400px;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: flex-end;
    padding-bottom: 32px;

    .titles {
      font-family: Telegraf-UltraBold, serif;
      font-style: normal;
      font-weight: 800;
      line-height: 120%;
      display: flex;
      align-items: center;
      letter-spacing: 0.05em;
      font-size: 32px;
      flex-direction: column;

      .place {
        color: #e7e7e7;
        margin-bottom: 7px;
      }

      .name {
        color: #a1afd3;
        text-transform: uppercase;
      }
    }

    img {
      position: absolute;
      left: 50%;
      transform: translate(-50%, 0);
      top: -40px;
    }
  }
}

.counter {
  margin-top: 34px;

  .counter-title {
    font-family: Telegraf-UltraBold, serif;
    font-style: normal;
    font-weight: 800;
    font-size: 20px;
    line-height: 94%;
    color: #a1afd3;
    margin-bottom: 18px;
  }
}

@media only screen and (max-width: 1439px) {
  .winners {
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;

    .winner {
      min-width: 250px;
      height: 370px;
      margin: 50px 20px 0;
    }
  }

  .counter {
    .counter-title {
      text-align: center;
    }
    .countdown {
      margin: auto;
    }
  }
}

@media only screen and (max-width: $tablet-small-width) {
  .top-block {
    margin-top: 25px;
  }

  .winners {
    margin-top: 35px;
  }
}

</style>
