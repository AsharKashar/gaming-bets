<template>
  <div
    v-if="memberList.length || limitMember"
    class="add-team-members"
  >
    <div class="add-team-members__title">
      {{ $t('Team Members') }}
    </div>
    <div
      v-if="memberList.length"
      class="add-team-members__fields"
    >
      <v-slide-x-transition group>
        <v-text-field
          v-for="(el, i) in memberList"
          :key="i"
          validate-on-blur
          :label="`${i+1}.E-mail`"
          autocomplete="off"
          placeholder="example@gmail.com"
          :rules="rules"
          append-icon="mdi-minus"
          @change="changeInput($event, i)"
          @click:append="removeMembers(i)"
        />
      </v-slide-x-transition>
    </div>
    <div
      v-if="limitMember"
      class="add-team-members__btn"
      @click="addMember"
    >
      {{ $t('add member') }} &plus;
    </div>
  </div>
</template>

<script>

export default {
  name: 'AddMember',
  props: {
    rules: {
      type: Array,
      default: () => ([]),
    },
    name: {
      type: String,
      required: true,
    },
    maxSize: {
      type: Number,
      required: true,
    }
  },
  data: () => ({
    memberList: [],
  }),
  computed: {
    limitMember() {
      return (this.memberList.length+1) < this.maxSize;
    }
  },
  methods: {
    addMember() {
      this.memberList.push('');
    },
    removeMembers(i) {
      this.memberList = this.memberList.filter((el, index) => index !== i);
      this.updateData();
    },
    updateData() {
      this.$emit('setData', {[this.name]: this.memberList.filter((val) => !!val)});
    },
    changeInput(val, i) {
      this.$set(this.memberList, i, val);
      this.updateData();
    }
  }
};
</script>

<style lang="scss" scoped>
.add-team-members {
  &__title {
    font-size: 20px;
    font-weight: 800;
    margin-bottom: 15px;
  }
  &__btn {
    font-weight: 800;
    font-size: 16px;
    text-decoration: underline;
    cursor: pointer;
    margin-bottom: 32px;
  }
}
</style>
