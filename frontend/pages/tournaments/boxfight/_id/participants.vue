<router>
  {
    meta:{
      savePosition:true
    }
  }
</router>
<template>
  <div class="participants__wrap">
    <box-match-participants />
  </div>
</template>

<script>
import BoxMatchParticipants from 'components/boxfight/BoxMatchParticipants';
import { APP_URL } from 'configs/config';
export default {
  name: 'Participants',
  components: {BoxMatchParticipants },
  middleware: ['hideHeader'],
  head () {
    const route = APP_URL + this.$route.path;
    return {
      title: 'Participants',
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
