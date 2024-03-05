export default {
  loadOptions: false,
  options: [],
  types: [
    {
      type: 'join_links',
      name: 'Join links',
      group: 'links'
    },
    {
      type: 'stream_links',
      name: 'Stream links',
      group: 'links'
    },
    {
      type: 'support_links',
      name: 'Support links',
      group: 'links'
    }
  ],
  group: {
    links: [
      {
        name: 'Discord',
        code: 'discord'
      }, {
        name: 'Instagram',
        code: 'insta'
      }, {
        name: 'Twitch',
        code: 'twitch'
      }, {
        name: 'YouTube',
        code: 'youtube'
      },
    ]
  },
};
