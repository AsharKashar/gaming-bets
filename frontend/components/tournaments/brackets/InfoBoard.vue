<template>
  <div class="info-wrapper">
    <ul>
      <li>
        <img
          src="~/static/images/brackets/host.svg"
          alt
        >
        <span class="dash" />
        <span>Host</span>
      </li>
      <li>
        <img
          src="~/static/images/brackets/winner-icon.svg"
          alt
        >
        <span class="dash" />
        <span>Winner</span>
      </li>
      <li>
        <img
          src="~/static/images/brackets/golden-rank.svg"
          alt
        >
        <span class="dash" />
        <span>Rank</span>
      </li>
      <li>
        <img
          src="~/static/images/brackets/rec.svg"
          alt
        >
        <span class="dash" />
        <span>You \ Your Team</span>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'InforBoard',
  data() {
    return {};
  },
};
</script>
<style lang="scss" scoped>
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/sizes.scss";
.info-wrapper {
  width: 100%;
  max-height: 350px;
  position: relative;
  background: #a1afd32b;
  clip-path: polygon(100% 0, 100% 91%, 85% 100%, 0 100%, 0 0);
  padding: 1em 2em 1.7em;
  ul {
    padding: 0;
    margin: 0;
    list-style: none;
    width: 100%;
    li {
      width: 100%;
      display: flex;
      align-items: center;
      margin-top: 1em;
      img {
        width: 20px;
      }
      span {
        display: inline-block;
        font-weight: 900;
        font-size: 12px;
        line-height: 100%;
        letter-spacing: 1px;
        color: $text-primary-color;
      }
      .dash {
        width: 10px;
        height: 2px;
        margin: 0 5px;
        background: $text-primary-color;
      }
    }
  }
}
</style>
