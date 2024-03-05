<template>
  <div class="blogs-block">
    <home-title
      :title="title"
      :description="description"
      :clamp-des="clampDes"
    />
    <div class="articles-grid">
      <cards-grid
        type="accent-fadeless"
        :items="latestPosts.data"
      />
    </div>
  </div>
</template>

<script>
import CardsGrid from 'components/CardsGrid';
import HomeTitle from 'components/HomeTitle';

import { createNamespacedHelpers } from 'vuex';
const { mapState } = createNamespacedHelpers('blog');

export default {
  name: 'Blogs',
  components: {
    CardsGrid,
    HomeTitle
  },
  props: {
    title:{
      type: String,
      default: 'Blogs'
    },
    description:{
      type: String,
      default: 'Fake text. Ad molorrovid qui dolentur abo. Nam destium que nus quo int eria doluptatias nonesci taturibus accumque aut offic test voloria dis'
    },
    clampDes: {
      type: Boolean,
      default: false,
    },
  },
  computed: {
    ...mapState(['latestPosts'])
  }
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
      margin-top: 40px;
      margin-bottom: 129px;
    }
  }

  @media only screen and (min-width: $tablet-small-width){
    .blogs-block{
      margin-top: 55px;
      padding: 0;
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
      margin-top: 15px;
      margin-bottom: 129px;
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
