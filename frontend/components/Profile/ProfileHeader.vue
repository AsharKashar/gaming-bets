<template>
  <div class="profile-header">
    <div class="profile-header-container">
      <div class="header-contain">
        <user-header />
      </div>
    </div>
  </div>
</template>

<script>
import UserHeader from 'layouts/Defaultlayout/UserDetailStatistic';
export default {
  name: 'ProfileHeader',
  components:{
    UserHeader
  }
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/sizes";
@import "~/assets/styles/colors";
.profile-header{
  height: 300px;
}
.header-contain{
    max-width: 1250px;
    margin: auto;
    height: 100%;
    display: flex;
    align-items: center;
}
.profile-header-container {
  // z-index: 2;
  background-color: $app-background;
  position: absolute;
  top: 0;
  left: 0;
  background-image: url("~static/images/bg.svg");
  height: 300px;
  width: 100%;
  background-size: cover;
  background-position: center;
  // padding: 0 4.5% 0 12%;
}

@media only screen and (min-width: $min-resolution) {
  .profile-header,
  .profile-header-container {
    height: 208px;
  }
}

@media only screen and (min-width: $tablet-small-width) {
  .profile-header,
  .profile-header-container {
     height: 400px;
  }
}

@media only screen and (min-width: $tablet-large-width) {
  .profile-header,
  .profile-header-container {
    height: 400px;
  }
}

@media only screen and (min-width: $desktop-width) {
  .profile-header,
  .profile-header-container {
    height: 400px;
  }
}


</style>
