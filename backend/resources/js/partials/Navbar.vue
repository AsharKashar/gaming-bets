<template>
  <header class="header">
    <section class="top-header">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="content">
              <div class="left-content">
                <ul class="left-list" />
              </div>
              <div class="right-content">
                <ul class="right-list">
                  <li>
                    <div class="cart-icon tm-dropdown">
                      <a
                        href="/awards"
                        class=""
                      ><img
                        src="/assets/images/awards/cart.png"
                        alt=""
                        style="margin-bottom:2px"
                      > &nbsp;Buy</a>
                      &nbsp; / &nbsp;
                      <a
                        href="/cash-withdrawal"
                        class="link-btn"
                      ><img
                        style="width:20px;"
                        src="assets/images/limas@2x.png"
                        alt=""
                      > 0 Limas</a>
                    </div>
                  </li>
                  <li v-if="!getIsAuthenticated">
                    <b-button
                      class="sign-in"
                      @click="login()"
                    >
                      <i class="fas fa-user" /> Sign In
                    </b-button>
                  </li>
                  <li v-else>
                    <b-button
                      class="sign-in"
                      @click="logout()"
                    >
                      <i class="fas fa-user-lock" /> Log Out
                    </b-button>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <nav
      role="navigation"
      class="mobile-nav"
      style="margin-left:30px"
    >
      <a
        id="toggle"
        href="#"
        style="width:300px"
      ><i
        style="color:#bf1438"
        class="fas fa-bars fa-lg"
      /><img
        style="width:60%;margin-left:10%"
        src="assets/images/bangers-logo.png"
        alt=""
      ></a>
      <ul class="mobile-ul">
        <li>
          <router-link
            :to="{name: 'home'}"
            class="mobile-nav-list"
          >
            Home
          </router-link>
        </li>
        <li>
          <router-link
            :to="{name: 'sponsors'}"
            class="mobile-nav-list"
          >
            Sponsors
          </router-link>
        </li>
        <li>
          <router-link
            :to="{name: 'leaderboards'}"
            class="mobile-nav-list"
          >
            Leaderboards
          </router-link>
        </li>
        <li>
          <router-link
            :to="{name: 'about'}"
            class="mobile-nav-list"
          >
            About
          </router-link>
        </li>
        <li>
          <a
            id=""
            class="mobile-nav-list"
            @click="tog()"
          >Game</a>
        </li>
        <li
          v-for="game in games"
          id="game-name"
          :key="game.name"
          style="diplay:block"
        >
          <a
            v-if="listdisplay"
            class="mobile-nav-list"
            :href="game.href"
          >{{ game.name }}</a>
        </li>

        <li>
          <a
            href="/awards"
            class="mobile-nav-list"
          >Bomb Coins</a>
        </li>
        <li>
          <router-link
            :to="{name: 'membership'}"
            class="mobile-nav-list"
          >
            Membership
          </router-link>
        </li>
        <li>
          <router-link
            :to="{name: 'profile'}"
            class="mobile-nav-list"
          >
            Profile
          </router-link>
        </li>
      </ul>
    </nav>
    <div class="mainmenu-area">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 col-sm-12">
            <div class="row">
              <div class="col-lg-3 col-sm-3">
                <a
                  class="navbar-brand"
                  href="/index"
                >
                  <img
                    class="site-logo"
                    alt=""
                  >
                </a>
              </div>
              <div class="col-lg-2 col-sm-2">
                <ul class="navbar-nav1">
                  <li class="nav-item active">
                    <router-link
                      :to="{name: 'home'}"
                      class="nav-link"
                    >
                      Home
                    </router-link>
                    <router-link
                      :to="{name: 'sponsors'}"
                      style="margin-top:-20px"
                      class="nav-link"
                    >
                      Sponsors
                    </router-link>
                    <router-link
                      :to="{name: 'leaderboards'}"
                      style="margin-top:-20px"
                      class="nav-link"
                    >
                      Leaderboards
                    </router-link>
                    <router-link
                      :to="{name: 'about'}"
                      style="margin-top:-20px"
                      class="nav-link"
                    >
                      About
                    </router-link>
                  </li>
                </ul>
              </div>
              <div class="col-lg-2 col-sm-2">
                <ul class="navbar-nav1">
                  <li class="nav-item">
                    <b-dropdown
                      id="dropdown-dropright"
                      dropright
                      text="Game"
                      variant="primary"
                      class="m-2"
                    >
                      <b-dropdown-item :to="{name: 'game-call-of-duty'}">
                        Call Of Duty
                      </b-dropdown-item>
                      <b-dropdown-item :to="{name: 'game-fortnite'}">
                        Fortnite
                      </b-dropdown-item>
                      <b-dropdown-item :to="{name: 'game-cs-go'}">
                        CS:GO
                      </b-dropdown-item>
                    </b-dropdown>
                    <router-link
                      :to="{name: 'bomb-coins'}"
                      style="margin-top:-20px"
                      class="nav-link"
                    >
                      Bomb Coins
                    </router-link>
                    <router-link
                      :to="{name: 'membership'}"
                      style="margin-top:-20px"
                      class="nav-link"
                    >
                      Membership
                    </router-link>
                    <router-link
                      v-if="getIsAuthenticated"
                      :to="{name: 'profile'}"
                      style="margin-top:-20px"
                      class="nav-link"
                    >
                      Profile
                    </router-link>
                  </li>
                </ul>
              </div>
              <div
                v-if="listdisplay"
                class="col-lg-2 col-sm-2"
              >
                <ul
                  id="gameslist"
                  class="navbar-nav1"
                >
                  <li
                    v-for="game in games"
                    :key="game.name"
                    style="margin-top:8px;height:15px"
                    class="nav-item"
                  >
                    <a
                      class="nav-link1"
                      :href="game.href"
                    >{{ game.name }}</a>
                  </li>
                </ul>
              </div>
              <div class="col-lg-3 col-sm-3">
                <div class="topbtn" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
import Acl from 'Mixins/acl';
import { createNamespacedHelpers } from 'vuex';

const { mapActions, mapGetters } = createNamespacedHelpers('auth');

export default {
  mixins: [Acl],
  data: () => ({
    games: null,
    listdisplay: false,
    temp: null,
  }),
  computed: mapGetters(['getIsAuthenticated']),
  mounted () {

  },

  methods: {
    tog () {
      this.listdisplay = !this.listdisplay;

    },
    login () {
      window.Bus.$emit('open-login');
    },
    ...mapActions({
      logout: 'logout',
    }),
  },
};
</script>

<style>


</style>
