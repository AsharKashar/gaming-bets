<script>
import MatchGrid from './grids/MatchGrid';
import LargeGrid from './grids/LargeGrid';
import AccentGrid from './grids/AccentGrid';
import AccentGridFadeless from './grids/AccentGridFadeless';
import SquareGrid from './grids/SquareGrid';
import BlogTableGrid from './grids/BlogTableGrid';
import GamesGrid from './grids/GamesGrid';
import TournamentsGrid from './grids/TournamentsGrid';
import TournamentsGridFeatured from './grids/TournamentsGridFeatured';

export default {
  name: 'CardsGrid',
  props: {
    type: {
      type: String,
      default: 'large',
    },
    items: {
      type: Array,
      default: () => [],
    },
    data: {
      type: Object,
      default: () => ({}),
    },
    setPage: {
      type: Function,
      default: () => [],
    },
  },
  computed: {
    renderItem() {
      return ({
        large: LargeGrid,
        accent: AccentGrid,
        'accent-fadeless': AccentGridFadeless,
        'square-row': SquareGrid,
        'blog-table-grid': BlogTableGrid,
        'games-grid': GamesGrid,
        'tournaments-grid': TournamentsGrid,
        'tournaments-featured': TournamentsGridFeatured,
        MatchGrid,
      })[this.type] || null;
    }
  },
  render(h) {
    const props = { items: this.items, setPage: this.setPage, data: this.data };
    return h(this.renderItem, { props });
  },
};
</script>
