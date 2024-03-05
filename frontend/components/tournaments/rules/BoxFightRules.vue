<template>
  <div class="mb-10">
    <loader
      :loading="loading"
      center
      :overlay="false"
    >
      <div class="rules">
        <v-expansion-panels>
          <v-expansion-panel
            v-for="(rule,i) in rules"
            :key="i"
          >
            <v-expansion-panel-header>
              <p class="head mb-0">
                {{ rule.title }}
              </p>
              <div class="icons">
                <img
                  src="~/static/icons/plus.svg"
                  class="plus "
                  alt="plus "
                >
                <img
                  src="~/static/icons/minus.svg"
                  class="minus"
                  alt="minus "
                >
              </div>
            </v-expansion-panel-header>
            <v-expansion-panel-content>
              <ul>
                <li>{{ rule.description }}</li>
              </ul>
            </v-expansion-panel-content>
          </v-expansion-panel>
        </v-expansion-panels>
      </div>
    </loader>
  </div>
</template>

<script>
// import Api from 'services/api';
import Loader from '@/components/Loader';
export default {
  name:'BoxFightRules',
  components:{
    Loader
  },
  props:{
    gameId:{
      type:[String , Number],
      default:''
    }
  },
  data(){
    return{
      rules:[
        {title:'Heading' , description:'Lorem Ipsum is simply dummy text of the printing and typesetting industry'},
        {title:'Heading2' , description:'Lorem Ipsum is simply dummy text of the printing and typesetting industry'},
        {title:'Heading3' , description:'Lorem Ipsum is simply dummy text of the printing and typesetting industry'},
        {title:'Heading4' , description:'Lorem Ipsum is simply dummy text of the printing and typesetting industry'},
      ],
      loading : false
    };
  },
  async created(){
    // this.loading = true;
    // const res = await Api.post('box-match-rules/get-game-rule' , {game_id : this.gameId});
    // this.rules = res.data.Rules;
    // this.loading = false;
  }
};
</script>

<style lang="scss" scoped>
.rules{
  width: 100%;
  max-width: 650px;
  &::v-deep .theme--dark.v-expansion-panels .v-expansion-panel{
      background-color: rgba(161, 175, 211, 0.2);
      margin-top: 0;
      margin-bottom: 3px;
    }

    &::v-deep .v-expansion-panel-header{
      display: flex;
      align-items: center;
      justify-content: space-between;
      .icons{
        text-align: right;
        .minus{
          display: none;
        }
      }
    }

    &::v-deep .v-expansion-panel-header--active{
        .icons{
          text-align: right;
          .minus{display: inline-block;}
          .plus{display: none;}

        }
    }
    p.head{
      font-weight: 900;
      font-size: 20px;
      line-height: 110%;
    }

    ul{
      li{
        font-size: 16px;
        line-height: 140%;
        color: #A1AFD3;
      }
    }
}
</style>
