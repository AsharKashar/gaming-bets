import Vue from 'vue';
export const listenForNotification = (notification, ctx) => {
  ctx.dispatch('notifications/getUserNotifications');

  const notificationDetails = notificationType(notification.reason);

  Vue.notify({
    group: 'custom-notification',
    title: notificationDetails.title,
    type: notificationDetails.type
  });

  console.log(notification);
};

export const notificationType = reason => {
  switch (reason) {
    case 'tournament_started': {
      return {
        title: 'Tournament started',
        type: 'info'
      };
    }
    case 'winner_reward': {
      return {
        title: 'Tournament winner!',
        type: 'info'
      };
    }
    case 'join_tournament': {
      return {
        title: 'Tournament joined',
        type: 'info'
      };
    }
    case 'cancel_tournament': {
      return {
        title: 'Tournament was canceled',
        type: 'info'
      };
    }
    case 'bombs_refund': {
      return {
        title: 'Bombs refund',
        type: 'info'
      };
    }
    case 'join_tournament_invitation': {
      return {
        title: 'Invitation to join tournament',
        type: 'info'
      };
    }
    case 'tournament_will_start_soon': {
      return {
        title: 'Tournament will start soon',
        type: 'info'
      };
    }
    case 'team_kicked':{
      return {
        title: 'Your team was eliminated from tournament',
        type: 'info'
      };
    }
    case 'match_is_finished':{
      return {
        title: 'Match is finished? (Provide with results)',
        type: 'info'
      };
    }
    case 'result_conflict':{
      return {
        title: 'Match results conflict',
        type: 'info'
      };
    }
    case 'match_win':{
      return {
        title: 'Congratulations! You have made to round x',
        type: 'info'
      };
    }
    case 'create_match':{
      return {
        title: 'Please Create Match and Invite players listed below',
        type: 'info'
      };
    }
    case 'host_creating_match':{
      return {
        title: 'Host is creating the match',
        type: 'info'
      };
    }
    case 'join_match':{
      return {
        title: 'You have the invitation to join the match, check email',
        type: 'info'
      };
    }
    case 'match_loose':{
      return {
        title: 'Better next time',
        type: 'info'
      };
    }
    case 'match_will_start_soon':{
      return {
        title: 'Match will start soon',
        type: 'info'
      };
    }
    default:
      return {
        title: 'Received some notification, but handler was not found',
        type: 'error'
      };
  }
};
