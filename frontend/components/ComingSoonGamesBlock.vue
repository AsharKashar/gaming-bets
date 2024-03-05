<template>
  <div class="games-list">
    <div
      v-for="(game,i) in games"
      :key="i"
      class="game-block"
      :style="{'background-image': `url(${game.background })`}"
    >
      <img
        :src="game.svg"
        alt="game"
      >
    </div>
  </div>
</template>

<script>
export default {
  name: 'ComingSoonGamesBlock',
  data: () => ({
    games: [
      {
        svg:
          'https://cdn.bangergames.com/demo-files/soon-warzone.svg',
        background:
          'https://cdn.bangergames.com/demo-files/soon-warzone-min.png'
      },
      {
        svg:
          'https://cdn.bangergames.com/demo-files/soon-cs.svg',
        background:
          'https://cdn.bangergames.com/demo-files/soon-cs-min.png'
      },
      {
        svg:
          'https://cdn.bangergames.com/demo-files/soon-fortnite.svg',
        background:
          'https://cdn.bangergames.com/demo-files/soon-fortnite-min.png'
      },
      {
        svg:
          'https://cdn.bangergames.com/demo-files/soon-valorant.svg',
        background:
          'https://cdn.bangergames.com/demo-files/soon-valorant-min.png'
      },
      {
        svg:
          'https://cdn.bangergames.com/demo-files/soon-ll.svg',
        background:
          'https://cdn.bangergames.com/demo-files/soon-ll-min.png'
      },
      {
        svg:
          'https://cdn.bangergames.com/demo-files/soon-fifa.svg',
        background:
          'https://cdn.bangergames.com/demo-files/soon-fifa-min.png'
      }
    ]
  })
};
</script>

<style scoped lang="scss">
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/sizes.scss";

.games-list {
  display: flex;
  margin-top: 30px;
  padding-bottom: 68px;
  overflow-y: auto;

  .game-block {
    display: flex;
    justify-content: center;
    align-items: center;
  }
}

@media all and (min-width: $min-resolution) {
  .games-list {
    flex-wrap: wrap;
  }

  .game-block {
    background-size: 0;
    flex-wrap: wrap;
    flex-basis: 31%;
    margin: 5% 1%;

    &:nth-child(1) {
      img {
        max-width: 58%;
      }
    }

    &:nth-child(2) {
      img {
        max-width: 108%;
      }
    }

    &:nth-child(3) {
      img {
        max-width: 70%;
      }
    }

    &:nth-child(4) {
      img {
        max-width: 67%;
      }
    }

    &:nth-child(5) {
      img {
        max-width: 67%;
      }
    }

    &:nth-child(6) {
      img {
        min-width: 51%;
      }
    }
  }
}

@media all and (min-width: $tablet-large-width) {
  .game-block {
    background-size: cover;
    margin: 2% 1%;
    clip-path: polygon(10% 0%, 100% 0%, 100% 85%, 90% 100%, 0 100%, 0% 15%);
    height: 166px;
  }
}

@media all and (min-width: $desktop-width) {
  .games-list {
    flex-wrap: nowrap;
  }

  .game-block {
    height: 160px;
    min-width: 250px;
    width: 258px;
    clip-path: polygon(10% 0%, 100% 0%, 100% 85%, 90% 100%, 0 100%, 0% 15%);
    background-size: cover;
    flex-basis: auto;
    margin: 0 17px 0 0;

    &:nth-child(1) {
      img {
        max-height: 60px;
      }
    }

    &:nth-child(2) {
      img {
        max-width: 257px;
      }
    }

    &:nth-child(3) {
      img {
        max-height: 38px;
      }
    }

    &:nth-child(4) {
      img {
        max-height: 24px;
      }
    }

    &:nth-child(5) {
      img {
        max-height: 51px;
      }
    }

    &:nth-child(6) {
      img {
        min-height: 24px;
      }
    }
  }
}
</style>
