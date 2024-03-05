<template>
  <div class="blogs-block">
    <home-title
      :title="title"
      :description="description"
    />
    <div class="articles-grid">
      <cards-grid
        type="accent"
        :items="latestPosts.data"
      />
    </div>
  </div>
</template>

<script>
import CardsGrid from 'components/CardsGrid';
import HomeTitle from 'components/HomeTitle';

import { createNamespacedHelpers } from 'vuex';
const { mapActions, mapState } = createNamespacedHelpers('blog');

export default {
  name: 'Blogs',
  components: {
    CardsGrid,
    HomeTitle
  },
  props: {
    title:{
      type: String,
      default: 'News'
    },
    description:{
      type: String,
      default: 'Fake text. Ad molorrovid qui dolentur abo. Nam destium que nus quo int eria doluptatias nonesci taturibus accumque aut offic test voloria dis'
    },
  },
  computed: {
    ...mapState(['latestPosts'])
  },
  async created() {
    await this.getLatestPosts();
  },
  methods: {
    ...mapActions([
      'getLatestPosts'
    ])
  },
};
</script>

<style scoped lang="scss">
  @import '~/assets/styles/colors.scss';
  @import '~/assets/styles/sizes.scss';


  .home-title-content{
    .col{
      display: flex;
      align-items: center;
      padding: 0;
    }
  }

  @media only screen and (min-width: $min-resolution){
    .blogs-block{
      margin-top: 14px;
      padding: 0 15px 0 20px;
    }
    .articles-grid{
      margin-top: 45px;
      margin-bottom: 129px;
    }
  }

  @media only screen and (min-width: $tablet-small-width){
    .blogs-block{
      margin-top: 55px;
      padding: 0;
    }
    .articles-grid{
      margin-bottom: 24px;
    }
    .home-title-content{
      .col{
        display: flex;
        align-items: center;
        padding: 0;
      }
    }
  }

  @media only screen and (min-width: $tablet-large-width){
    .blogs-block{
      margin-top: 20px;
    }
    .articles-grid{
      margin-top: 45px;
      margin-bottom: 83px;
    }
  }

  @media only screen and (min-width: $desktop-width){
    .blogs-block{
      margin-top: 90px;
    }
    .articles-grid{
      margin-top: 36px;
      margin-bottom: 97px;
    }
  }

</style>
