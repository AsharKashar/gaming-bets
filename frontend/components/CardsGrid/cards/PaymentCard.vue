<template>
  <div class="payment-card">
    <div
      class="payment-card__inner"
      @click="$emit('clickCard', cardId)"
    >
      <div class="payment-card__content">
        <div class="card__number">
          **** **** **** {{ number }}
        </div>
        <div class="card__date">
          {{ month }}/{{ year }}
        </div>
        <div class="card__footer">
          <div
            class="card__name"
            v-text="name"
          />
          <div class="card-brand">
            <svg-icon :name="brand.toLowerCase()" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SvgIcon from 'components/svgIcons/SvgIcon';
export default {
  name: 'PaymentCard',
  components: {SvgIcon},
  props: {
    cardId: {
      type: Number,
      required: true,
    },
    number: {
      type: Number,
      default: 2222,
    },
    expMonth: {
      type: String,
      default: '3'
    },
    expYear: {
      type: String,
      default: '2022'
    },
    brand: {
      type: String,
      default: 'Visa'
    },
    name: {
      type: String,
      default: 'John Doe'
    }
  },
  computed: {
    year() {
      return this.expYear.length === 4 ? this.expYear.slice(2,4) : this.expYear;
    },
    month() {
      return this.expMonth.length === 1 ? '0' + this.expMonth : this.expMonth;
    }
  }
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";

.payment-card {
  width: 100%;
  flex: 0 0 50%;
  max-width: 50%;
  padding: 0 10px 15px;
  &__inner {
    padding: 10px 14px;
    width: 100%;
    height: 120px;
    background: url('~static/images/bgCardPayment.png') 50% 50% / cover no-repeat;
    border-radius: 8px;
    display: flex;
    align-items: flex-end;
    color: $text-hover-color;
    font-weight: 900;
    line-height: 1;
    text-transform: uppercase;
    border: 2px solid transparent;
  }
  &.active &__inner {
    border-color: $border-primary-color;
  }
  &__content {
    width: 100%;
  }
  .card {
    &__number {
      margin-bottom: 8px;
    }
    &__date {
      margin-bottom: 15px;
    }
    &__footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 100%;
    }
  }
}
</style>
