<template>
  <div>
    <div class="card">
      <div class="card-number">
        **** **** **** {{ last4 }}
      </div>
      <div class="date">
        {{ expMonth }}/{{ expYear }}
      </div>
      <div class="name">
        {{ holdername }}
      </div>
      <div class="card-type">
        <img
          v-if="brand === 'visa'"
          src="~/static/images/visa.svg"
          alt
        >
        <img
          v-if="brand === 'mastercard'"
          src="~/static/images/mastercard.svg"
          alt
        >
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'PaymentMethod',
  props: {
    last4: {
      type: Number,
      default: 0,
    },
    holdername: {
      type: String,
      default: '',
    },
    expMonth: {
      type: String,
      default: '',
    },
    expYear: {
      type: String,
      default: '',
    },
    brand: {
      type: String,
      default: '',
    },
  },
};
</script>

<style scoped>
.card {
  position: relative;
  width: 255px;
  height: 144px;
  background-image: url("~static/images/card.svg");
  background-repeat: no-repeat;
  background-position: center;
  float: left;
  margin: 15px 0px 15px 15px;
  color: #e7e7e7;
  padding: 16px;
}
.card-number {
  position: absolute;
  font-family: Telegraf-UltraBold;
  font-weight: 800;
  font-size: 20px;
  line-height: 94%;
  align-items: center;
  margin: 20px 37px 62px 0px;
}
.date {
  position: absolute;
  font-family: Telegraf-UltraBold;
  font-weight: 800;
  font-size: 12px;
  line-height: 94%;
  margin: 50px 202px 52px 0px;
}
.name {
  font-family: Telegraf-UltraBold;
  font-weight: 800;
  font-size: 16px;
  line-height: 94%;
  margin: 90px 95px 16px 0px;
}
.card-type {
  position: absolute;
  bottom: 16px;
  right: 16px;
}
</style>
