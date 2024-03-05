<template>
  <div class="membership-info">
    <div class="membership-item">
      <div class="left-part">
        {{ $t('Your membership') }}
      </div>
      <div class="right-part">
        <div class="membership-name">
          {{ membership.name }}
        </div>
        <div class="price">
          ({{ membership.pay }}€/month)
        </div>
      </div>
    </div>
    <div class="membership-item">
      <div class="left-part">
        {{ $t('Next Payment due') }}:
      </div>
      <div class="right-part">
        09/10/20
      </div>
    </div>
    <div class="membership-item">
      <div class="left-part">
        <div>{{ $t('Visa Debit') }}</div>
        <div class="card-number">
          **** **** **** 0011
        </div>
      </div>
      <div class="right-part">
        <router-link
          to=""
          class="change-payment"
        >
          {{ $t('Change payment method') }}
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'MembershipInfo',
  props: {
    membership:{
      type: Object,
      default: () => ({})
    }
  }
};
</script>

<style scoped lang="scss">
  @import "~/assets/styles/sizes";
  @import "~/assets/styles/colors";

  .membership-info{
    .membership-item{
      display: flex;
      justify-content: space-between;
      font-family: Telegraf-Regular, serif;
      font-style: normal;
      font-weight: normal;
      font-size: 15px;
      line-height: 94%;
      color: $text-primary-color;
      border-bottom: 2px solid $text-primary-color;
      padding: 10px 0;

      .right-part{
        flex-basis:31%;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;

        .membership-name{
          text-transform: uppercase;
        }

        .price{
          margin-top: 10px;
        }

        .change-payment{
          color:$accent-error-color;
        }
      }

      .left-part{
        .card-number{
          margin-top: 4px;
        }
      }
    }
  }
</style>
