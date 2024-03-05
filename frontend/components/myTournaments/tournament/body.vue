<template>
  <div class="trounament-body">
    <p class="heading">
      Marathon Ninja Masters Pro League Multifan
    </p>
    <ul>
      <li>
        <span class="tournament-title">Starts</span><span class="reward">MAY 20 / 08:00PM</span>
      </li>
      <li>
        <span class="tournament-title">Reward</span><span class="reward">Banger games</span>
      </li>
      <li>
        <span class="tournament-title">playtype</span><span class="reward">Solo</span>
      </li>
    </ul>
  </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors";
@import "~/assets/styles/sizes.scss";

.trounament-body {
  width: 100%;
  padding: 1em 6em 1em 1em;
  border-bottom: 1px solid #fff;
  .heading {
    font-weight: 800;
    font-size: 24px;
    line-height: 130%;
    color: $text-hover-color;
    margin: 0;
  }
  ul {
    position: relative;
    width: 100%;
    padding: 0;
    margin: 0;
    margin: 0.5em 0;
    list-style: none;
    display: flex;
    justify-content: space-between;

    li {
      display: flex;
      flex-direction: column;

      .tournament-title {
        font-weight: 900;
        font-size: 14px;
        line-height: 115%;
        color: $text-primary-color;
        padding-bottom: 5px;
      }

      .reward {
        font-weight: 900;
        font-size: 16px;
        line-height: 120%;
        color: $text-hover-color;
      }
    }
  }
}
</style>

