<template>
  <div class="withdrawal">
    <div class="withdrawal__title">
      {{ $t('Withdrawal') }}
    </div>
    <div class="withdrawal__content">
      <p>
        {{ $t('Nulla commodo nisi aute sint fugiat laboris aliqua veniam fugiat quis commodo id laborum nulla. Magna in exercitation laboris culpa dolor et in culpa proident Lorem do. Cillum do ullamco dolor culpa sit magna eiusmod ut nisi. Exercitation nostrud adipisicing esse minim ullamco ad ullamco ullamco. Commodo duis ad adipisicing dolor non eiusmod eiusmod excepteur non tempor ex anim ut anim. Voluptate aliqua ex consectetur ex elit sunt. Aliquip mollit ullamco ad laborum elit.') }}
      </p>
      <p>
        {{ $t('Nulla commodo nisi aute sint fugiat laboris aliqua veniam fugiat quis commodo id laborum nulla. Magna in exercitation laboris culpa dolor et in culpa proident Lorem do. Cillum do ullamco dolor culpa sit magna eiusmod ut nisi. Exercitation nostrud adipisicing esse minim ullamco ad ullamco ullamco. Commodo duis ad adipisicing dolor non eiusmod eiusmod excepteur non tempor ex anim ut anim. Voluptate aliqua ex consectetur ex elit sunt. Aliquip mollit ullamco ad laborum elit.') }}
      </p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'BombsTabWithdrawal'
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors";
.withdrawal {
  color: $text-primary-color;
  line-height: .94;
  &__title {
    font-size: 24px;
    font-weight: 800;
    margin-bottom: 16px;
  }
  p {
    font-size: 16px;
    margin-bottom: 16px;
  }
}

</style>
