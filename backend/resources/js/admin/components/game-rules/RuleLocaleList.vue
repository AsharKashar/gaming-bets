<template>
  <location-rules-view
    :show="show"
    :rules="rules"
    :load="load"
    @send="submit"
    @deleteRule="deleteRule"
    @toggleShow="show = !show"
  />
</template>

<script>

import api from '../../services/api';
import LocationRulesView from './LocationRulesView';
export default {
  name: 'RuleLocaleList',
  components: {LocationRulesView},
  props: {
    initRules: {
      type: Array,
      default: () => ([]),
    },
    gameModeId: {
      type: Number,
      required: true,
    },
  },
  data: () => ({
    show: false,
    load: false,
    rules: [],
  }),
  mounted() {
    this.rules = this.initRules;
  },
  methods: {
    async submit({data, itemId}) {
      if (this.load) return;
      this.load = true;
      try {
        if (!itemId) {
          await api.post(`game-modes/${this.gameModeId}/rules`, data);
          this.show = false;
        } else {
          await api.put(`game-modes/${this.gameModeId}/rules/${itemId}`, data);
        }
        await this.updateRules();
      } catch (e) {
        console.error(e);
      } finally {
        this.load = false;
      }
    },
    async updateRules() {
      const { data } = await api.get(`game-modes/${this.gameModeId}/rules`);
      this.rules = data.data;
    },
    async deleteRule(id) {
      if (this.load) return;
      this.load = true;
      try {
        await api.delete(`game-modes/${this.gameModeId}/rules/${id}`);
        await this.updateRules();
      } catch (e) {
        console.error(e);
      } finally {
        this.load = false;
      }
    }
  }
};
</script>
