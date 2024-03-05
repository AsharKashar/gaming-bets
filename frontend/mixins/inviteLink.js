import  Vue from 'vue';

export default {
  computed: {
    teamInvitationLink() {
      console.log(this.team);
      const origin = window.location.origin;
      return `${origin}/profile/team/join?team_token=${this.team.token}`;
    }
  },
  methods: {
    copyInvitationLink() {
      navigator.clipboard.writeText(this.teamInvitationLink).then(() => {
        Vue.notify({
          group: 'error',
          title: 'Link copied',
          text: 'Invitation link was successfully copied to clipboard',
          type: 'app'
        });
      });
    },
  }
};