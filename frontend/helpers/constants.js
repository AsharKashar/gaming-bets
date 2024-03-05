export const STATE_STATUSES = {
  READY: 'ready',
  PENDING: 'pending',
  ERROR: 'error',
  INIT: 'init',
  DRAFT: 'draft',
  CONNECTED: 'connected'
};

export const JOINING_MATCH_STATES = {
  CAN_JOIN: 'Open for joining', //1
  JOINED: 'joined', //2
  FULL: 'full', //3
  LIVE: 'match is live', //4
  RESULT_REQUIRED: 'match ended result required', //5
  RESULT_UPLOADED: 'result entered', //6
  CONFLICT_RESULT_REQUIRED: 'conflict! evidence required', //7
  CONFLICT_RESULT_UPLOADED: 'evidence uploaded', //8
  CONFLICT_TIME_OVER: 'conflict! evidence upload time is over', //9
  NOT_LOGGED_IN: 'User not logged In',
  NOT_AVAILABLE: 'Not available', // 11
  WON: 'won', //12
  LOST: 'lost' //13
};

export const TOURNAMENT_STATUS = {
  UPCOMING: 'upcoming',
  REGISTRATION: 'registration',
  LIVE: 'started',
  ENDED: 'ended',
  FULL: 'full',
  CANCELED: 'canceled',
  FINISH_REGISTRATION: 'finish_registration',
};

export const PAYMENT_STEPS = {
  SETUP: 'SetupPaymentMethod',
  ADD_CARD: 'AddNewCard',
  CHOOSE_CARD: 'ChooseCard'
};
