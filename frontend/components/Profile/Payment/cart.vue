<template>
  <v-row class="payment-method">
    <template v-for="(cart, i) in cards">
      <PaymentMethod
        :key="i"
        :last4="cart.last_four"
        :holdername="cart.name"
        :exp-month="cart.expiry.substr(5,2)"
        :exp-year="cart.expiry.substr(2,2)"
        :brand="cart.brand"
      />
    </template>
  </v-row>
</template>

<script>
import PaymentMethod from 'components/Profile/Payment/PaymentMethod.vue';
export default {
  name: 'DebitCart',
  components: {
    PaymentMethod,
  },
  props: {
    cards: {
      type: Array,
      default: () => [],
    },
  },
};
</script>

<style scoped>
.payment-method {
  padding: 0 0 0 5px;
}
</style>
