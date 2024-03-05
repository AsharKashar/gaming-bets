<template>
  <div class="static-wrapper">
    <static-page-wrapper page-title="Privacy & Policy">
      <div slot="left-detail-section">
        <div class="mb-3">
          {{ $t('BANGER GAMES, S.L., with Tax ID Code B88628276, and registered office at Pº DE SAN FRANCISCO') }}
          {{ $t('DE SALES Nº41 ESC. 2 PISO 3, PUERTA D, 28003, MADRID (SPAIN), and whose e-mail') }}
          {{ $t(' address is CUSTOMERSERVICE@BANGERGAMES.COM, is the owner of the website') }}
          {{ $t('WWW.BANGERGAMES.COM and is responsible for processing personal data provided by users through this website.') }}
        </div>
        <div
          class="mb-3"
        >
          {{ $t('BANGER GAMES, S.L. informs the users of this website about its policy regarding processing and protection of personal data of users and customers that may be collected through browsing and use of this website.') }}
        </div>
        <div
          class="mb-3"
        >
          {{ $t('The purpose of this document is to inform users about what we do with their personal data, how they are collected, what they are used for, users’ rights and all the necessary information established by current regulations.') }}
        </div>
        <div
          class="mb-3"
        >
          {{ $t('By using this website, we understand that you have read and understood the information provided in relation to the processing of your personal data.') }}
        </div>
        <div
          class="mb-3"
        >
          {{ $t('Our main objective is to process personal data in a lawful, loyal and transparent manner.') }}
        </div>

        <div class="mb-3">
          <div class="heading">
            {{ $t('Data collected, purpose and legal basis') }}
          </div>{{ $t('The personal data processed are those provided by the users through the forms available on this website and are the minimum required in order to send you information about our products/services, use the functionalities of the platform, be able to place orders, as well as be able to prepare the invoices corresponding to the payments, inform customers about the status of their orders, handle claims and carry out any other steps necessary to provide the service through this website.') }}
          <p>{{ $t('These purposes are based on the legal principles of data processing set forth in the regulations in force: for the execution of a contract or the provision of a service to users, for the fulfilment of legal obligations, on the basis of the legitimate interest and with the consent of the users.') }}</p>
        </div>

        <div class="mb-3">
          <div class="heading">
            {{ $t('Data collected for the request of information through the web form') }}
          </div>{{ $t('The purpose of the personal data collected through the web forms is to subscribe to the platform in the different modalities offered, accessing the purchase of our products and sending commercial information about our products and services to improve your gaming experience on the platform.') }}
          {{ $t('The processing of the data in this specific case is legitimised by the legitimate interest of the gamer, in offering him the best gaming experience.') }}
        </div>

        <div class="mb-3">
          <div class="heading">
            {{ $t('Operations performed with personal data') }}
          </div>{{ $t('The personal data are registered through the website and stored on electronic media controlled and supervised by the data controller. The media are equipped with the necessary technical and organisational measures to ensure due confidentiality in data processing.') }}
          <p>
            {{ $t('The personnel involved in data processing operations: access, editing, deletion, etc. are qualified for this and are trained and committed to our data protection policy.') }}
          </p>
        </div>
      </div>
      <div slot="right-detail-section">
        <div class="mb-3">
          <div class="heading">
            {{ $t('Data retention') }}
          </div>{{ $t('The personal data will be kept for the time necessary to fulfil the purpose(s) for which they were collected.') }}
        </div>
        <div
          class="mb-3"
        >
          {{ $t('Therefore, we will keep your personal information as long as a contractual and/or commercial relationship exists with you or as long as you do not exercise your right of deletion, cancellation and/or limitation of the processing of your data.') }}
        </div>

        <div
          class="mb-3"
        >
          {{ $t('In these cases, we will keep the data duly blocked, without making any use of them, while they may be necessary for the exercise or defence of claims or may derive some type of legal or contractual responsibility from their processing, which must be attended to and for which their retrieval is necessary.') }}
        </div>

        <div class="mb-3">
          <div class="heading">
            {{ $t('Protection of minors') }}
          </div>{{ $t('This website is not intended for users under 14 years of age. If you are under 14 years of age, please do not try to register. The platform does not allow children under 14 years of age to subscribe. If we discover that we have mistakenly obtained personal information from a child, we will delete that information as soon as possible. Similarly, the age data will be used so that the user can only access those catalogued as suitable for their age.') }}
        </div>
        <div class="mb-3">
          <div class="heading">
            {{ $t('Profile analysis') }}
          </div>
          {{ $t('We perform automated profile analyses to analyse your preferences and all the details related to the way you play in order to offer you the best possible experience and send you the most appropriate notifications, carry out behavioural and browsing habit segmentation and improve our platform.') }}
        </div>
        <div class="mb-3">
          <div class="heading">
            {{ $t('Recipients of your personal data') }}
          </div>
          {{ $t('We inform users that their personal data will not be passed on to third parties, except when such communication of data is required under a legal obligation or when, for the proper provision of the service or the execution of the contract, it is necessary to communicate their data to other data controllers such as other companies in the group, which are data processors. In the case of the tools used to monitor our platform, they will only obtain the login data or username, which they will not be able to use.') }}
          <p>{{ $t('In cases where the communication of data to third parties is not provided for in the legal bases established in the previous section, data will only be passed on to other recipients if the user has given his express consent.') }}</p>
          <p>{{ $t('BANGER GAMES, S.L. bases the selection of data processors on strict criteria and is contractually committed with each one to comply and ensure compliance with the obligations established with regard to data protection.') }}</p>
        </div>

        <div class="mb-3">
          <div class="heading">
            {{ $t('Exercise of rights') }}
          </div>{{ $t('In accordance with the rights conferred by current legislation on personal data protection, users may exercise their rights of access, rectification, limitation of processing, deletion, portability and objection to the processing of their data by sending their request to the postal address indicated or to the e-mail address CUSTOMERSERVICE@BANGERGAMES.COM.') }}
        </div>
        <div
          class="mb-3"
        >
          {{ $t('To exercise your rights, you must identify yourself by presenting your Spanish National Identity card (DNI).') }}
        </div>
        <div class="mb-3">
          {{ $t('Any claims may be submitted to the addresses indicated above. You may also contact the Spanish Data Protection Agency:') }}
          <a
            href="https://www.aepd.es"
            target="_blank"
          >www.aepd.es.</a>
        </div>
      </div>
    </static-page-wrapper>
  </div>
</template>

<script>
import StaticPageWrapper from '@/components/StaticPages/StaticPageWrapper';
import { APP_URL } from 'configs/config';

export default {
  name: 'Policy',
  components: {
    StaticPageWrapper,
  },
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Policy',
      link: [
        {
          rel: 'canonical',
          href: route
        }
      ]
    };
  }
};
</script>
<style scoped lang="scss">
@import "~/assets/styles/colors";

.heading {
  font-family: Telegraf-UltraBold, serif;
  font-weight: 900;
  margin-bottom: 4px;
}
</style>
