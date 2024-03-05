<template>
  <div
    class="table-item"
    @mouseover="hover = true"
    @mouseleave="hover = false"
    @click="onClick"
  >
    <div class="left-part">
      <div class="tag">
        <!-- TODO::Display post's tags-->
      </div>
      <v-clamp
        autoresize
        :max-lines="2"
        class="item-title"
      >
        {{ item.content_detail.name }}
      </v-clamp>
      <div class="stats-row">
        <div class="updated-at">
          {{ updatedFromNow }}
        </div>
        <div class="comments-count">
          <!-- TODO::Display post's comments count-->
        </div>
      </div>
    </div>
    <div class="right-part">
      <div
        class="preview-img"
        :style="rowStyle"
      >
        <div
          v-if="hover"
          class="read-more"
        >
          {{ $t('read more') }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VClamp from 'vue-clamp';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
dayjs.extend(relativeTime);

export default {
  name: 'BlogTableRow',
  components:{
    VClamp
  },
  props:{
    item:{
      type:Object,
      default:() => ({})
    }
  },
  data() {
    return {
      hover: false,
    };
  },
  computed:{
    rowStyle () {
      if (!this.hover) {
        return {'background-image': `url(${ this.item.preview_image_url })`};
      }

      return {'background-image': `linear-gradient(0deg, rgba(1, 4, 50, 0.73), rgba(1, 4, 50, 0.73)), url(${ this.item.preview_image_url })`};
    },
    updatedFromNow () {
      let timeFromNow = '';

      try {
        timeFromNow = dayjs(this.item.created_at).fromNow();
      } catch (e) {
        timeFromNow = '';
      }

      return timeFromNow;
    }
  },
  methods:{
    onClick(){
      this.$router.push(this.item.full_post_slug);
    }
  }
};
</script>

<style scoped lang="scss">
  @import "~/assets/styles/sizes";
  @import "~/assets/styles/colors";

  .table-item{
    overflow: hidden;
    display: flex;
    justify-content: flex-start;
    border-bottom: 1px solid;
    padding-left: 2px;
    cursor: pointer;
    position: relative;

    .left-part{
      flex-basis: 77%;
      padding-right: 10px;

      .tag,
      .item-title{
        font-family: Telegraf-UltraBold, serif;
        font-style: normal;
        font-weight: 800;
        font-size: 16px;
        line-height: 94%;
        color: $border-primary-color;
      }

      .item-title{
        color:#fff;
      }

      .stats-row{
        display: flex;
        justify-content: flex-start;
        color: $border-primary-color;
        position: absolute;
        bottom: 10px;

        .comments-count{
          margin-left: 57px;
        }
      }
    }

    .right-part{
      flex-basis: 23%;
      display: flex;
      align-items: center;

      .preview-img{
        width: 100%;
        border-radius: 10px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        border: 1px solid transparent;

        .read-more{
          display: flex;
          justify-content: center;
          align-items: center;
          text-align: center;
          height: 100%;
          width: 100%;
          font-family: Telegraf-UltraBold, serif;
          font-style: normal;
          font-weight: 800;
          font-size: 20px;
          line-height: 94%;
          text-transform: uppercase;
        }
      }
    }

    &:hover{
      border-color: $border-primary-color;

      .right-part{
        .preview-img{
          border-color: $border-primary-color;
        }
      }
    }
  }

  @media only screen and (min-width: $min-resolution) {
    .table-item{
      height: 86px;
      margin-bottom: 3px;
      padding: 0 16px;

      .left-part{
        .item-title{
          font-size: 14px;
          margin-top: 13px;
        }
        .stats-row{
          font-size: 13px;
        }
        .tag{
          display: none;
        }
      }

      .right-part{
        .preview-img{
          height: 80%;
        }
      }
    }
  }

  @media only screen and (min-width: $tablet-small-width) {
    .table-item{
      height: 97px;
      margin-bottom: 15px;
      padding: 0;

      .left-part{
        .item-title{
          font-size: 16px;
          margin-top: 5px;
        }
        .stats-row{
          font-size: 16px;
        }
        .tag{
          display: block;
        }
      }

      .right-part{
        .preview-img{
          height: 93%;
        }
      }
    }
  }

  @media only screen and (min-width: $tablet-large-width) {
    .table-item{
      height: 103px;
      margin-bottom: 10px;

      .left-part{
        .item-title{
          font-size: 24px;
        }
      }
    }
  }
</style>
