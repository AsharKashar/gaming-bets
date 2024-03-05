import Dots from 'components/svgIcons/Dots';
import Crown from 'components/svgIcons/Crown';
import Cross from 'components/svgIcons/Cross';
import DefaultModal from 'components/modals/DefaultModal';
import ConfirmForm from 'components/forms/ConfirmForm';

export default {
  components: {
    ConfirmForm,
    Dots,
    Crown,
    Cross,
    DefaultModal
  },
  data:() => ({
    dotMenuOpen:false,
    showConfirmModal:false,
  }),
  methods:{
    closeConfirmModal(){
      this.showConfirmModal = false;
    }
  }
};
