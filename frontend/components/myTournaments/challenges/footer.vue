<template>
  <div>
    <div
      v-if="status === 'live'"
      class="card-footer"
    >
      <default-button class="default-btn">
        i’ve won
      </default-button>
      <default-button class="default-btn">
        i’ve lost
      </default-button>
    </div>
    <div
      v-if="status === 'soon'"
      class="card-footer"
    >
      <a class="outline-btn">invite</a>
      <a class="link-btn">details</a>
    </div>
    <div
      v-if="status === 'lost'"
      class="card-footer lost"
    >
      <div class="lost">
        <img
          src="~/static/images/brackets/popups/coins.svg"
          alt=""
        >
        <p class="bonus">
          +100
        </p>
      </div>
      <p class="xp">
        +200 xp
      </p>
    </div>
  </div>
</template>

<script>
import DefaultButton from 'components/DefaultButton.vue';
export default {
  name: 'ChallengesFooter',
  components: {
    DefaultButton,
  },

  props: {
    status: {
      type: String,
      required: true,
    },
  },
};
</script>
<style lang="scss" scoped>
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes.scss";

.card-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  .outline-btn {
    text-decoration: none;
    border: 1px solid $border-primary-color;
    border-radius: 50px;
    font-weight: 900;
    font-size: 16px;
    line-height: 120%;
    padding: 1em 3em;
    color: $text-secondary-color;
  }
  .link-btn {
    text-decoration: none;
    border-radius: 50px;
    font-weight: 900;
    font-size: 16px;
    line-height: 120%;
    padding: 1em 3em;
    color: $text-primary-color;
  }

  P {
    margin: 0;
    font-weight: 900;
    font-size: 20px;
    line-height: 110%;
    color: $text-primary-color;
  }
  .xp {
    margin-right: 1em;
  }
  .lost {
    display: flex;
    align-items: center;
  }
}
.default-btn {
  font-size: 16px !important;
}

@media screen and (max-width: 1301px) {
  .card-footer {
    flex-wrap: wrap;
    a,
    .default-btn {
      text-align: center;
      width: 100%;
      margin: 8px 0;
    }
  }
}
@media screen and (max-width: 960px) {
  .card-footer {
    flex-wrap: nowrap;
  }
  a,
  .default-btn {
    text-align: right;
    width: auto !important;
    margin: 8px 0;
  }
}
</style>

