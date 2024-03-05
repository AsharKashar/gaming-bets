<template>
  <static-page-wrapper page-title="Withdrawal">
    <span
      slot="left-detail-section"
    >
      {{ $t('Nulla commodo nisi aute sint fugiat laboris aliqua veniam fugiat quis commodo id laborum nulla. Magna in exercitation laboris culpa dolor et in culpa proident Lorem do. Cillum do ullamco dolor culpa sit magna eiusmod ut nisi. Exercitation nostrud adipisicing esse minim ullamco ad ullamco ullamco. Commodo duis ad adipisicing dolor non eiusmod eiusmod excepteur non tempor ex anim ut anim. Voluptate aliqua ex consectetur ex elit sunt. Aliquip mollit ullamco ad laborum elit. Dolore velit anim amet ea ex dolor aliquip ut occaecat ea sint occaecat. Commodo Lorem aliquip esse irure deserunt reprehenderit sint aliquip laboris sint veniam. Cupidatat eu mollit est mollit elit eu veniam laboris velit amet cupidatat reprehenderit do. Quis Lorem excepteur pariatur ad. Est reprehenderit ut ullamco magna culpa adipisicing laboris id irure enim ex pariatur exercitation laboris. Occaecat nulla eu dolor ut do reprehenderit aliqua ullamco quis commodo magna.') }}
    </span>
    <span
      slot="right-detail-section"
    >
      {{ $t('Nulla commodo nisi aute sint fugiat laboris aliqua veniam fugiat quis commodo id laborum nulla. Magna in exercitation laboris culpa dolor et in culpa proident Lorem do. Cillum do ullamco dolor culpa sit magna eiusmod ut nisi. Exercitation nostrud adipisicing esse minim ullamco ad ullamco ullamco. Commodo duis ad adipisicing dolor non eiusmod eiusmod excepteur non tempor ex anim ut anim. Voluptate aliqua ex consectetur ex elit sunt. Aliquip mollit ullamco ad laborum elit. Dolore velit anim amet ea ex dolor aliquip ut occaecat ea sint occaecat. Commodo Lorem aliquip esse irure deserunt reprehenderit sint aliquip laboris sint veniam. Cupidatat eu mollit est mollit elit eu veniam laboris velit amet cupidatat reprehenderit do. Quis Lorem excepteur pariatur ad. Est reprehenderit ut ullamco magna culpa adipisicing laboris id irure enim ex pariatur exercitation laboris. Occaecat nulla eu dolor ut do reprehenderit aliqua ullamco quis commodo magna.') }}
    </span>
  </static-page-wrapper>
</template>

<script>
import StaticPageWrapper from '@/components/StaticPages/StaticPageWrapper';
import { APP_URL } from 'configs/config';

export default {
  name: 'Withdrawals',
  components: {
    StaticPageWrapper
  },
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Withdrawals',
      link: [
        {
          rel: 'canonical',
          href: route
        }
      ]
    };
  }
};
</script>
