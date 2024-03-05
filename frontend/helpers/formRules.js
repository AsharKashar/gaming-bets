import moment from 'dayjs';

const regExp = {
  // eslint-disable-next-line no-useless-escape
  email: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
  password: /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/,
};

export default {
  required: [
    (v) => !!v || 'Is field required',
  ],
  email: [
    (v) => !!v || 'Email is Required!',
    (v) => !v || regExp.email.test(v) || 'Email is invalid',
  ],
  password: [
    (v) => !!v || 'Password is Required!',
    (v) => regExp.password.test(v) || 'Password must include 8 characters and 1 special character',
  ],
  confirmPass: (pass) => ([
    (v) => pass === v || 'Password mismatch',
  ]),
  countries: [
    (v) => !!v || 'Please select a city to continue',
  ],
  gender: [
    (v) => !!v || 'Please select your gender to continue',
  ],
  dateOfBirth: [
    // (v) => !!v || 'Please enter your date of birth',
    (v) => {
      const date = moment(v, 'DD/MM/YYYY');
      if (!date.isValid()) {
        return 'Please enter a valid date';
      }
      if (moment().subtract(18, 'years').diff(date) <= 0) {
        return 'You must be 18 years old or above for signup';
      }
      if (moment().subtract(90, 'years').diff(date) >= 0) {
        return 'You must be under 90 years of age to register';
      }
      return true;
    },
  ],
  uploadImage: [
    (v) => /\.(jpe?g|png)$/i.test(v.name) || 'This format is not supported',
    (v) => (v && v.size < 2000000) || 'Avatar size should be less than 2 MB!',
    (v) => (v.width <= 240 || v.height <= 240) || 'Max size avatar 240x240'
  ],
  uploadFiles: (extensions, sizeMb) => ([
    (v) => !!v.length || 'Please upload the file',
    (v) => !v.map(({name}) => extensions.test(name)).includes(false) || 'This format is not supported',
    (v) =>  !v.map(({size}) => size < sizeMb * 1048576).includes(false) || `Maximum file size ${sizeMb} MB!`,
  ]),
  teamName: [
    (v) => !!v || 'Please write your team name',
    (v) => !!v && v.length < 300 || 'Team name must not exceed 300 characters',
  ],
  joinTeam: [
    'Please select or create a team to continue',
  ]
};
