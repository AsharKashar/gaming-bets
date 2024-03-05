<template>
    <b-container class="profile-page">
        <b-row>
            <b-col cols="3">
                <b-avatar src="https://placekitten.com/300/300" size="6rem"></b-avatar>
                <p>
                    <span class="username">username</span>
                </p>
            </b-col>
            <b-col cols="6">
                <b-nav vertical class="w-25">
                    <b-nav-item ><router-link :to="{name: 'profile'}">Profile</router-link></b-nav-item>
                    <b-nav-item><router-link :to="{name: 'profile-payment'}">Payment</router-link></b-nav-item>
                    <b-nav-item><router-link :to="{name: 'profile-tournament'}">Tournament</router-link></b-nav-item>
                    <b-nav-item><router-link :to="{name: 'profile-cash'}">Cash</router-link></b-nav-item>
                    <b-nav-item><router-link :to="{name: 'profile-withdrawal'}">Withdrawal</router-link></b-nav-item>
                    <b-nav-item><router-link :to="{name: 'profile-teams'}">Teams</router-link></b-nav-item>
                </b-nav>
            </b-col>
            <b-col cols="3">
                <b-list-group>
                    <b-list-group-item class="d-flex justify-content-between align-items-center">
                        Total Points
                        <b-badge variant="primary" pill>{{ totalPoints }}</b-badge>
                    </b-list-group-item>

                    <b-list-group-item class="d-flex justify-content-between align-items-center">
                        Total Bombs
                        <b-badge variant="primary" pill>{{ totalBombs }}</b-badge>
                    </b-list-group-item>

                    <b-list-group-item class="d-flex justify-content-between align-items-center">
                        Win Record
                        <b-badge variant="primary" pill>{{ winRecord }}</b-badge>
                    </b-list-group-item>
                </b-list-group>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
  import { getMe , getStats } from 'Api/profile'
  export default {
    name: 'ProfileHeader',
    data: () => ({
      me: {},
      totalPoints: '',
      totalBombs: '',
      winRecord: '',
    }),

    mounted () {

      getMe().then(response => {
        if (response.data.status === 'success') {
          this.me = response.data.data

        }
      })

      getStats().then(response => {
        if (response.data.status === 'success') {
          this.totalPoints = response.data.data.totalPoints
          this.totalBombs = response.data.data.totalBombs
          this.winRecord = response.data.data.winRecord
        }
      })

    }
  }
</script>

<style scoped>

</style>
