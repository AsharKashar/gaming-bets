<template>
  <div class="card-body">
    <ul class="general-info">
      <li>
        <span class="title">match:</span><span class="subheading">2vs2</span>
      </li>
      <li>
        <span class="title">date:</span><span class="subheading">10 Jun</span>
      </li>
      <li>
        <span class="title">time:</span><span class="subheading">16:00</span>
      </li>
    </ul>
    <div class="player-information">
      <ul>
        <li>
          <img
            src="~/static/images/brackets/popups/av1.svg"
            alt=""
            class="player-avatar"
          >
        </li>
        <li>
          <img
            src="~/static/images/brackets/popups/av2.svg"
            alt=""
            class="player-avatar"
          >
        </li>
        <li>
          <img
            src="~/static/images/brackets/popups/av3.svg"
            alt=""
            class="player-avatar"
          >
        </li>
        <li>
          <img
            src="~/static/images/brackets/popups/av4.svg"
            alt=""
            class="player-avatar"
          >
        </li>
      </ul>
      <div class="vs-info">
        <p class="vs-count">
          4/4
        </p>
        <p class="joind-status">
          Players joined
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ChallengesBody'
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes.scss";

.card-body {
  position: relative;
  width: 100%;
  .general-info {
    padding: 0;
    margin: 0;
    list-style: none;
    display: flex;
    justify-content: space-between;
    li {
      span {
        display: block;
      }
      .title {
        font-weight: normal;
        font-size: 16px;
        line-height: 140%;
        color: $text-primary-color;
      }
      .subheading {
        font-weight: 800;
        font-size: 16px;
        line-height: 120%;
        color: $text-hover-color;
      }
    }
  }

  .player-information {
    position: relative;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1em 0;
    ul {
      max-width: 70%;
      padding: 0;
      margin: 0;
      list-style: none;
      display: flex;
      li {
        margin-left: -0.5em;
      }
    }

    .vs-info {
      width: 100;
      p {
        margin: 0;
      }
      .vs-count {
        font-weight: 800;
        font-size: 16px;
        line-height: 120%;
        color: $text-hover-color;
      }
      .joind-status {
        font-weight: normal;
        font-size: 16px;
        line-height: 140%;
        color: $text-primary-color;
      }
    }
  }
}

@media screen and (max-width: 1301px) {
  .player-information {
    flex-wrap: wrap;
  }
}
@media screen and (max-width: 960px) {
  .player-information {
    flex-wrap: nowrap;
  }
}
</style>
