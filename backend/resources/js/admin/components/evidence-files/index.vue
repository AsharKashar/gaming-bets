<template>
  <div class="evidence-files">
    <h3>Evidence files</h3>
    <div class="files">
      <div
        v-for="(file) in data.files"
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
</template>

<script>
export default {
  name: 'EvidenceFiles',
  props: {
    data: {
      type: Object,
      default: () => ({
        files:[]
      }),
    }
  },
  created(){
    console.log(this.data);
  },
  methods:{
    openFileinNewTab(uri){
      window.open(uri);
    }
  }
};
</script>

<style lang="scss" scoped>
  .evidence-files{
    position: relative;
    padding: 15px;

    .files{
      display:flex;
      justify-content: center;
      align-items: center;
      margin: 20px;
      cursor: pointer;

      .file{
        img, video {
          max-width: 400px;
          max-height: 300px;
        }
      }
    }
  }
</style>
