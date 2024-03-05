<template>
  <div class="mobile-wrapper">
    <ul>
      <li
        v-ripple
        @click="mobileMenu(1)"
      >
        <a>
          <img
            src="~/static/images/brackets/mobile-icon.svg"
            alt
            class="start-icon"
          >
        </a>
        <p>Round 1</p>
      </li>
      <li
        v-ripple
        @click="mobileMenu(2)"
      >
        <a>
          <img
            src="~/static/images/brackets/mobile-icon.svg"
            alt
            class="start-icon"
          >
        </a>
        <p>Round 2</p>
      </li>
      <li
        v-ripple
        @click="mobileMenu(3)"
      >
        <a>
          <img
            src="~/static/images/brackets/mobile-icon.svg"
            alt
            class="start-icon"
          >
        </a>
        <p>Round 3</p>
      </li>
      <li
        v-ripple
        @click="mobileMenu(4)"
      >
        <a>
          <img
            src="~/static/images/brackets/mobile-icon.svg"
            alt
            class="start-icon"
          >
        </a>
        <p>Round 4</p>
      </li>
      <li
        v-ripple
        @click="mobileMenu(5)"
      >
        <a>
          <img
            src="~/static/images/brackets/mobile-icon.svg"
            alt
            class="start-icon"
          >
        </a>
        <p>Round 5</p>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'MobileGroupNavi',
  methods: {
    mobileMenu(id) {
      this.$emit('mobileMenu', id);
      console.log('id ', id);
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/sizes.scss";

.mobile-wrapper {
  z-index: 10;
  width: 100%;
  background: #a1afd326;
  position: absolute;
  left: 0;
  right: 0;
  top: 2em;
  padding: 1em;
  text-align: center;
  ul {
    z-index: 1;
    margin: 0;
    padding: 0;
    list-style: none;
    width: 100%;
    display: flex;
    justify-content: space-between;

    li {
      width: 100%;
      a {
        display: inline-block;
        width: 100%;
        position: relative;
        .start-icon {
          width: 40px;
        }
      }
      p {
        font-weight: 800;
        font-size: 10px;
        line-height: 94%;
        margin: 0;
      }
    }
  }
}
</style>
