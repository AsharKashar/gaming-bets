<template>
  <div>
    <h1>{{ rank_data.game }}</h1>
    <v-row>
      <v-col class="stat-tab">
        <span>{{ $t('TOTAL POINTS EARNED') }}</span>
        <p>{{ rank_data.total_points_earned || 0 }}</p>
      </v-col>
      <v-col class="stat-tab">
        <span>{{ $t('TOTAL BOMBS EARNED') }}</span>
        <p>{{ rank_data.total_bombs_earned || 0 }}</p>
      </v-col>
      <v-col class="stat-tab">
        <span>{{ $t('WIN-LOSS RECORD') }}</span>
        <p>{{ rank_data.win_loss_record || 0 }} %</p>
      </v-col>
      <v-col class="stat-tab">
        <span>{{ $t('WIN-RATIO') }}</span>
        <p>{{ rank_data.win_ratio || 0 }} %</p>
      </v-col>
    </v-row>

    <v-row>
      <v-col class="statistic">
        <v-row>
          <h1>{{ $t('SQUADS') }}</h1>
        </v-row>
        <v-row class="detail-stats">
          <v-col>
            <h2>{{ $t('POINTS EARNED') }}</h2>
            <span>543</span>
          </v-col>
          <v-col>
            <h2>{{ $t('BOMBS EARNED') }}</h2>
            <span>24</span>
          </v-col>
        </v-row>
        <v-row class="detail-stats">
          <v-col>
            <h2>{{ $t('WIN - LOSS RECORD') }}</h2>
            <span>47.15 %</span>
          </v-col>
          <v-col>
            <h2>{{ $t('WIN - RATIO') }}</h2>
            <span>47.10 %</span>
          </v-col>
        </v-row>
      </v-col>
      <v-col class="statistic">
        <v-row>
          <h1>{{ $t('DUO') }}</h1>
        </v-row>
        <v-row class="detail-stats">
          <v-col>
            <h2>{{ $t('POINTS EARNED') }}</h2>
            <span>543</span>
          </v-col>
          <v-col>
            <h2>{{ $t('BOMBS EARNED') }}</h2>
            <span>24</span>
          </v-col>
        </v-row>
        <v-row class="detail-stats">
          <v-col>
            <h2>{{ $t('WIN - LOSS RECORD') }}</h2>
            <span>47.15 %</span>
          </v-col>
          <v-col>
            <h2>{{ $t('WIN - RATIO') }}</h2>
            <span>47.10 %</span>
          </v-col>
        </v-row>
      </v-col>
      <v-col class="statistic">
        <v-row>
          <h1>{{ $t('SOLO') }}</h1>
        </v-row>
        <v-row class="detail-stats">
          <v-col>
            <h2>{{ $t('POINTS EARNED') }}</h2>
            <span>543</span>
          </v-col>
          <v-col>
            <h2>{{ $t('BOMBS EARNED') }}</h2>
            <span>24</span>
          </v-col>
        </v-row>
        <v-row class="detail-stats">
          <v-col>
            <h2>{{ $t('WIN - LOSS RECORD') }}</h2>
            <span>47.15 %</span>
          </v-col>
          <v-col>
            <h2>{{ $t('WIN - RATIO') }}</h2>
            <span>47.10 %</span>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
const { mapActions, mapState } = createNamespacedHelpers('profile');
export default {
  name: 'GameData',
  props:{
    gameId:{
      type: Number,
      default: null
    }
  },
  computed: {
    ...mapState(['rank_data']),
  },
  watch:{
    gameId: function () {
      this.getRanks({gameId:this.$route.query.gameId});
    }
  },
  mounted () {
    this.getRanks({gameId:this.$route.query.gameId});
  },
  methods:{
    ...mapActions(['getRanks']),
  }
};
</script>

<style scoped lang="scss">
.statistic{
  margin-top:55px;
  margin-left:25px;
  max-width:350px;
  width:350px;
  height:320px;
  background-image:url('~static/images/profile/stat-bg.png');
  padding:30px 25px;
  h1{
    margin:15px 10px;
    font-family: Telegraf-Regular;
    font-style: normal;
    font-weight: 900;
    font-size: 32px;
    line-height: 115%;
    display: flex;
    align-items: center;
    letter-spacing: 0.02em;
    font-feature-settings: 'ss03' on;
    color: #A1AFD3;
  }
  h2{
    font-family: Telegraf-Regular;
    font-style: normal;
    font-weight: 900;
    font-size: 16px;
    line-height: 120%;
    display: flex;
    align-items: center;

    color: #A1AFD3;
  }
  span{
    font-family: Telegraf-Regular;
    font-style: normal;
    font-weight: 800;
    font-size: 24px;
    line-height: 130%;
    display: flex;
    align-items: center;
    color: #E7E7E7;
  }
}
h1 {
  color: #A1AFD3;
}
.stat-tab{
  margin-top:15px;
  transform: skewX(-15deg);
  border-right: 1px solid rgba(231, 231, 231, 0.2);
  padding:10px 20px;
  text-align: center;
  span{
    font-family: Telegraf-Regular;
    font-style: normal;
    font-weight: 900;
    font-size: 16px;
    line-height: 120%;
    display: flex;
    align-items: center;
    color: #A1AFD3;
  }
  p{
    margin-top:10px;
    font-family: Telegraf-Regular;
    font-style: normal;
    font-weight: 900;
    font-size: 32px;
    line-height: 115%;
    display: flex;
    align-items: center;
    letter-spacing: 0.02em;
    font-feature-settings: 'ss03' on;
    color: #BE1338;
  }
}
</style>
