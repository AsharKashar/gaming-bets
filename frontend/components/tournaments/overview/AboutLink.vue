<template>
  <div class="tournaments-overview__about-link">
    <div class="tournaments-overview__about-link-list">
      <div
        v-for="({heading, link}) in links"
        :key="link"
        class="tournaments-overview__about-link-item"
      >
        <div
          class="tournaments-overview__about-link-item-heading"
          v-text="heading"
        />
        <div class="tournaments-overview__about-link-item-action">
          <a
            :href="link"
            target="_blank"
            v-text="link"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'TournamentsOverviewAboutLink',
  props: {
    links: {
      type: Array,
      default: () => ([
        {
          heading: 'JOIN DISCORD',
          link: 'https://discord.com/invite/H4kMw5R'
        }, {
          heading: 'FOLLOW US ON INSTAGRAM',
          link: 'https://www.instagram.com/teamvsn.ggs/?igshid=1xi3h129yq3qv',
        }, {
          heading: 'SUBSCRIBE TO US ON YOUTUBE',
          link: 'https://www.youtube.com/channel/UCgiB8RdepqLQH6f7swfg3pQ?sub_confirmation=1',
        },
      ]),
    }
  }
};
</script>

<style scoped lang="scss">
  @import "~/assets/styles/colors.scss";
  .tournaments-overview__about-link {
    color: $text-primary-color;
    line-height: 1.1;
    &-item {
      font-size: 16px;
      padding-bottom: 25px;
      &-heading {
        text-transform: uppercase;
        margin-bottom: 8px;
      }
      a {
        text-decoration: none;
        color: $text-secondary-color;
        word-break: break-word;

        &:hover {
          text-decoration: underline;
        }
      }
    }
  }

</style>
