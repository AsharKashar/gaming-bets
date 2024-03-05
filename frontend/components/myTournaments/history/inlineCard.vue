<template>
  <div class="history-card-wrapper">
    <div class="header">
      <ul>
        <li>Date</li>
        <li>placement</li>
        <li class="tournament">
          tournament
        </li>
        <li class="resultt">
          <span>Team</span>
          <span class="result-label">result</span>
        </li>
        <li>bombs earned</li>
        <li>Points earned</li>
        <li>prize</li>
      </ul>
    </div>
    <div class="inline-card">
      <ul
        v-for="index in 10"
        :key="index"
      >
        <li>7 Oct, 2020</li>
        <li class="position">
          <img
            src="~/static/images/brackets/history/polygon.svg"
            alt=""
          >
          <span>1st</span>
        </li>
        <li class="tournament">
          DreamHack Open Summer 2020
        </li>
        <li class="result">
          <div>
            <img
              src="~/static/images/brackets/history/avat1.svg"
              alt=""
            >
            <span>3-0</span>
            <img
              src="~/static/images/brackets/history/avat2.svg"
              alt=""
            >
          </div>
        </li>
        <li />
        <li>250</li>
        <li>800</li>
        <li>$50,000</li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style lang='scss' scoped>
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes.scss";

.history-card-wrapper {
  width: 100%;
  .header {
    width: 100%;
    position: relative;
    ul {
      padding: 0;
      margin: 0;
      list-style: none;
      display: flex;
      align-items: center;
      width: 100%;
      padding: 1em;
      li {
        font-style: normal;
        font-weight: 800;
        font-size: 14px;
        line-height: 120%;
        color: $text-primary-color;
        text-transform: uppercase;
        width: 12%;
      }
      .tournament {
        width: 15%;
      }
      .resultt {
        width: 25%;
        .result-label {
          margin-left: 1em;
        }
      }
    }
  }

  .inline-card {
    width: 100%;
    position: relative;
    ul {
      padding: 0;
      margin: 0;
      list-style: none;
      display: flex;
      width: 100%;
      padding: 1em;
      background: #e7e7e729;
      align-items: center;
      margin: 3px 0;
      cursor: pointer;
      transition: 0.3s background;
      &:hover {
        background: #e7e7e735;
      }
      li {
        font-weight: 900;
        font-size: 16px;
        line-height: 120%;
        color: $text-hover-color;
        width: 12%;
      }
      .tournament {
        width: 15%;
      }
      .position {
        display: flex;
        align-items: center;
        span {
          display: block;
          margin-left: 1em;
        }
      }
      .result {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 15%;
        div {
          display: flex;
          align-items: center;
          span {
            display: block;
            margin: 0 1em;
          }
        }
      }
    }
  }
}
</style>