<template>
  <div>
    <div
      v-if="status === 'live'"
      class="card-tag"
    >
      <div class="live-tag">
        <span />
        <p>live</p>
      </div>
    </div>
    <div
      v-else
      class="card-tag soon"
    >
      <div class="live-tag">
        <p v-if="status === 'soon'">
          soon
        </p>
        <p v-if="status === 'lost'">
          lost
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ChallengesTag',
  props: {
    status: {
      type: String,
      required: true,
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes.scss";

.card-tag {
  position: absolute;
  right: 0;
  top: 0;
  background: #be133847;
  text-align: center;
  clip-path: polygon(0 0, 100% 0, 100% 100%, 10% 100%);
  width: 150px;
  .live-tag {
    position: relative;
    display: flex;
    align-items: center;
    padding: 0.5em 0px;
    justify-content: flex-end;
    margin-right: 1em;
    span {
      display: inline-block;
      height: 10px;
      width: 10px;
      border-radius: 50%;
      background: $text-secondary-color;
    }
    p {
      font-weight: 800;
      font-size: 16px;
      line-height: 120%;
      margin: 0;
      margin-left: 1em;
      color: $text-secondary-color;
    }
  }
}
.soon {
  position: absolute;
  right: 0;
  top: 0;
  background: #a1afd33d !important;
  text-align: center;
  clip-path: polygon(0 0, 100% 0, 100% 100%, 10% 100%);
  width: 150px;
  .live-tag {
    position: relative;
    display: flex;
    align-items: center;
    padding: 0.5em 0px;
    justify-content: flex-end;
    margin-right: 1em;
  }
  p {
    font-weight: 800;
    font-size: 16px;
    line-height: 120%;
    margin: 0;
    margin-left: 1em;
    color: $text-hover-color !important;
  }
}

@media screen and (max-width: 1301px) {
  .card-tag {
    width: 80px;
  }
}
@media screen and (max-width: 960px) {
  .card-tag {
    width: 150px;
  }
}
</style>
