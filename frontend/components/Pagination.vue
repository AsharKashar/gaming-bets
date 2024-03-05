<template>
  <div
    class="pagination-container"
    :class="{'pagination--style-second': styleSecond, 'pagination--right': isRight}"
  >
    <template v-if="!styleSecond">
      <div
        v-for="pageIndex in pagesIndexes"
        :key="pageIndex"
        class="page-block pagination-block"
        :class="{ active: pageIndex === page }"
        @click="() => goToPage(pageIndex)"
      >
        {{ pageIndex }}
      </div>
      <div class="separator pagination-block">
        of
      </div>
      <div
        class="total page-block pagination-block"
        @click="() => goToPage(total)"
      >
        {{ total }}
      </div>
    </template>
    <div
      v-else
      class="paginate-block-second"
    >
      {{ $t('Results') }} {{ page }} {{ $t('of') }} {{ total }}
    </div>
    <div class="arrows-block">
      <div
        class="prev-page"
        @click="prevPage"
      >
        <arrow />
      </div>
      <div
        class="next-page"
        @click="nextPage"
      >
        <arrow />
      </div>
    </div>
  </div>
</template>

<script>
import Arrow from 'components/svgIcons/Arrow';

export default {
  name: 'Pagination',
  components: {
    Arrow
  },
  props: {
    page:{
      type: Number,
      default: 1
    },
    total:{
      type: [Number, String],
      default: 1
    },
    limit:{
      type: [Number, String],
      default: 3
    },
    setPage:{
      type: Function,
      default: () => {}
    },
    styleSecond: {
      type: Boolean,
      default: false,
    },
    isRight: {
      type: Boolean,
      default: false,
    }
  },
  computed: {
    pagesIndexes() {
      const { page, total, limit } = this;
      let indexes = [];

      if (total<=limit) {
        for (let i = 1; i <= total; i++) {
          indexes.push(i);
        }
        return indexes;
      }

      if (page === 1) {
        for (let i = 1; i <= limit; i++) {
          indexes.push(i);
        }
      }

      if (page === total) {
        for (let i = total; i > total-limit; i--) {
          indexes.unshift(i);
        }
      }

      if (page < total && page > 1) {
        const step = parseInt(limit/2);
        const start = page-step;

        for (let i = start; i < start+limit; i++) {
          indexes.push(i);
        }
      }

      return indexes;
    }
  },
  methods:{
    goToPage(index){
      if (index === this.page) {
        return;
      }

      this.setPage(index);
    },
    nextPage(){
      if (this.page+1 <= this.total) {
        this.setPage(this.page+1);
      }
    },
    prevPage(){
      if (this.page-1 >= 1) {
        this.setPage(this.page-1);
      }
    }
  }
};
</script>

<style scoped lang="scss">
  @import "~/assets/styles/sizes";
  @import "~/assets/styles/colors";
  .pagination {
    &--right {
      &.pagination-container {
        justify-content: flex-end;
        .arrows-block{
          margin-left: 0;
        }
      }
    }
  }
  .pagination-container{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;

    .arrows-block{
      display: flex;
      justify-content: center;
      align-items: baseline;
      margin-left: auto;
      padding-top: 5px;
    }

    .prev-page{
      transform: rotateY(180deg);
      margin-right: 30px;
    }

    .prev-page,
    .next-page{
      svg {
        height: 24px;
      }
      cursor: pointer;
    }

    .next-page{
      margin-left: 11px;
    }

    .pagination-block{
      display: flex;
      justify-content: center;
      align-items: center;
      border-color: transparent;
      color: $text-primary-color;
      font-family: Telegraf-UltraBold, serif;
      font-style: normal;
      font-weight: 800;
      font-size: 20px;
      line-height: 94%;
    }

    .page-block{
      position: relative;
      margin: 0 8px;
      padding: 0 5px;
      min-width: 48px;
      min-height: 47px;

      &.active,
      &:hover{
        background-color: rgba(190, 19, 56, 0.2);
        cursor: pointer;
        color: $border-primary-color;

        &:before{
          content:'';
          height:4px;
          background: $border-primary-color;
          position: absolute;
          bottom:0;
          width: calc(100% - 2px);
          left: 50%;
          transform: translate(-50%, 0);
          clip-path: polygon(14% 0, 86% 0%, 100% 100%, 0% 100%);
        }
      }
    }
    .total{
      margin-right: 50px;
    }

    &.pagination--style-second {
      justify-content: flex-end;
      .paginate-block-second {
        color: #515982;
        font-weight: 800;
        line-height: 1.2;
      }
      .arrows-block {
        margin-left: 32px;
      }
    }

  }

 @media only screen and (max-width: $mobile) {
   .pagination-container {
     .page-block {
       margin: 0 5px;
     }
   }
  }
</style>
