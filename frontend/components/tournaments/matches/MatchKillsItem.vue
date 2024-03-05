<script>
import SvgIcon from 'components/svgIcons/SvgIcon';

export default {
  name: 'MatchKillsItem',
  props: {
    matchResultKills: {
      type: Number,
      default: null,
    },
  },
  render(h) {
    return this.matchResultKills ? h('span', this.matchResultKills) : h(SvgIcon,{props: {name: 'question'}});
  }
};
</script>
