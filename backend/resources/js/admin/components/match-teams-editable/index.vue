<template>
  <div class="match-team-editable">
    <h3>Teams</h3>
    <div
      v-for="(item) in data.teams"
      :key="item.id"
      class="teams"
    >
      <div class="team">
        <div class="name">
          <b>Team:</b>
          {{ item.team.name }}
        </div>
        <div class="place">
          <b>Place:</b>
          <input
            type="number"
            :value="item.place"
            @input="updatePlace(item.id, $event)"
          >
        </div>
        <div class="files">
          <b style="width:100%">Evidences</b>
          <div
            v-for="(file) in item.evidence.files"
            :key="file.id"
            class="file"
          >
            <img
              v-if="file.mime.startsWith('image')"
              :src="file.uri"
              @click="openFileinNewTab(file.uri)"
            >
            <video
              v-if="file.mime.startsWith('video')"
              controls
              :src="file.uri"
            />
          </div>
        </div>
      </div>
    </div>
    <div class="save-action">
      <button @click="save">
        Update places
      </button>
    </div>
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
const matchesModule = createNamespacedHelpers('matches');

export default {
  name: 'MatchTeamEditable',
  props: {
    data: {
      type: Object,
      default: () => ({
        files:[]
      }),
    }
  },
  data() {
    return {
      places:{}
    };
  },
  created() {
    console.log(this.data);
  },
  methods:{
    ...matchesModule.mapActions(['setPlaces']),
    updatePlace(matchTeamId, event) {
      this.places[matchTeamId] = event.target.value;
    },
    async save() {
      const placesChanged = Object.keys(this.places).length;

      if (placesChanged) {
        const { match_id } = this.data.match;
        await this.setPlaces({match_id, places: this.places});
        location.reload();
      }
    },
    openFileinNewTab(uri){
      window.open(uri);
    }
  }
};
</script>

<style lang="scss" scoped>
  .match-team-editable{
    position: relative;
    padding: 15px;
    .teams{
      display: flex;
      flex-direction: column;

      .team{
        display: flex;
        flex-wrap: wrap;
        margin: 10px 0;
        border: 1px solid grey;
        border-radius: 10px;
        padding: 5px;

        .name, .place, .files{
          margin:0 10px;
        }

        .place{
          border: 1px solid red;
          border-radius: 5px;
        }
        .files{
          display: flex;
          flex-wrap: wrap;
          width: 100%;
          .file{
            img,video{
              max-width: 200px;
              max-heigth: 200px;
            }
          }
        }
      }
    }
    .save-action{
      display: flex;
      justify-content:flex-end;

      button{
        background-color: #3c8dbc;
        padding: 5px 10px;
        border-radius: 5px;
        color: white
      }
    }
  }
</style>
