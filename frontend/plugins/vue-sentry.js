import Vue from 'vue';
import { Vue as VueIntegration } from '@sentry/integrations';
import * as Sentry from '@sentry/browser';
import { VUE_SENTRY_DSN, VUE_MODE } from 'configs/config';

Sentry.init({
  dsn: VUE_SENTRY_DSN,
  integrations: [new VueIntegration({
    Vue,
    attachProps: true,
    logErrors: VUE_MODE === 'development'
  })],
});
