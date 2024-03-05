<template>
  <div class="team-member-wrapper">
    <ul>
      <li :team-id="member.team_id">
        <img
          src="~/static/images/brackets/team-member-icon.png"
          alt="avtar team member"
          class="team-member-img"
        >
        <span class="lnr lnr-star" />
        <span class="team-member-name">
          <v-tooltip
            v-model="show"
            top
          >
            <template v-slot:activator="{ on, attrs }">
              <span
                v-bind="attrs"
                v-on="on"
              >{{ member.name }}</span>
            </template>
            <span>{{ member.name }}</span>
          </v-tooltip>
        </span>
        <img
          src="~/static/images/brackets/golden-rank.svg"
          alt="rank icon"
          class="rank-icon"
        >
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    member: {
      type: Object,
      default: () => ({})
    },
  },
  data() {
    return {};
  },
};
</script>
<style lang="scss" scoped>
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/sizes.scss";
.v-expansion-panel-content__wrap {
  padding: 0 !important;
}
.team-member-wrapper {
  position: relative;
  width: 100%;
  ul {
    padding: 0;
    margin: 0;
    li {
      list-style: none;
      display: flex;
      align-items: center;
      margin: 10px 0;
      transition: 0.3s all;

      &:hover {
        background: #a1afd31f;
      }
      .team-member-img {
        width: 40px;
        height: 40px;
        margin: 0 0 0 10px;
        border-radius: 50%;
      }
      .team-member-name {
        display: inline-block;
        padding-left: 1em;
        font-size: 14px;
        line-height: 110%;
        color: #a1afd3;
        max-width: 109px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }
      .rank-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
      }
    }
  }
}
@media screen and(max-width:1480px) {
  .team-member-wrapper {
    ul {
      li {
        .team-member-img {
          width: 30px;
          height: 30px;
        }
        .team-member-name {
          font-size: 10px;
        }
        .rank-icon {
          position: absolute;
          right: 10px;
          top: 50%;
          transform: translateY(-50%);
        }
      }
    }
  }
}
</style>
