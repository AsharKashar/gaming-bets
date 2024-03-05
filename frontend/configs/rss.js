const { getRssForBlog } = require('../services/sitemapApi');
const { APP_URL } = require('./config');

const create = async (feed, locale) => {
  feed.options = {
    title: 'Bangergames',
    link: `${ APP_URL }/feed.xml`,
    description: 'Bangergames blog posts feed'
  };

  const posts = await getRssForBlog(locale);
  posts.forEach(post => {
    feed.addItem({
      ...post,
      date:new Date(post.date)
    });
  });

  feed.addCategory('Blog');
};

module.exports = [
  {
    path: '/en/feed.xml',
    create: (feed) => create(feed, 'en'),
    cacheTime: 1000 * 60 * 15,
    type: 'rss2'
  },
  {
    path: '/es/feed.xml',
    create: (feed) => create(feed, 'es'),
    cacheTime: 1000 * 60 * 15,
    type: 'rss2'
  }
];
