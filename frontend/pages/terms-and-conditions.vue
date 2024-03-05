<template>
  <div class="page-wrapper">
    <static-page-wrapper page-title="Terms & Conditions">
      <div slot="left-detail-section">
        <!--  -->
        <div
          class="mb-3"
        >
          {{ $t('Please read these TERMS AND CONDITIONS OF PURCHASE and the PRIVACY POLICY carefully before using this website. You can print out these terms and conditions if you wish. By using this website or placing an order through it, the user accepts our TERMS AND CONDITIONS OF PURCHASE as well as our PRIVACY POLICY. Therefore, if you do not agree to them, you should not use the website.') }}
        </div>
        <div class="mb-3">
          <div class="heading">
            {{ $t('GENERAL INFORMATION') }}
          </div>
          {{ $t('In compliance with the disclosure obligation set forth in Article 10 of Spanish Law 34/2002, of 11 July, on Information Society Services and Electronic Commerce, we hereby inform you that the website is owned by BANGER GAMES, S.L., with Tax ID Code (CIF) B88628276 and registered office at Pº DE SAN FRANCISCO DE SALES Nº41 ESC. 2 PISO 3, PUERTA D, 28003, MADRID (SPAIN), and whose e-mail address is CUSTOMERSERVICE@BANGERGAMES.COM , hereinafter, BANGER GAMES, S.L.') }}
        </div>

        <div class="mb-3 bullets">
          <div class="heading">
            {{ $t('WEBSITE USAGE') }}
          </div>
          <p>{{ $t('By using this platform and placing orders through it, the user agrees to the following') }}:</p>
          <p>• {{ $t('Use the platform only for the purposes of consulting and playing different tournaments and similar, as well as consulting products and placing orders.') }}</p>
          <p>• {{ $t('Do not place any fraudulent or false orders. If an order is reasonably considered to be fraudulent, BANGER GAMES, S.L. is authorised to cancel it and inform the relevant authorities.') }}</p>
          <p>• {{ $t('Have legal capacity to enter into contracts.') }}</p>
          <p>• {{ $t('Provide your contact details in a truthful and accurate way in order for us to be able to send you the orders.') }}</p>
        </div>

        <div class="mb-3">
          <div class="heading">
            {{ $t('PERSONAL DATA PROTECTION') }}
          </div>{{ $t('BANGER GAMES, S.L. informs the users of this website about its policy regarding processing and protection of personal data which may be collected by means of browsing or contracting services through the privacy policy. You can access the privacy policy from the website at any time.') }}
        </div>

        <div class="mb-3">
          <div class="heading">
            {{ $t('TERMS AND CONDITIONS OF PURCHASE') }}
          </div>{{ $t('Service availability. Users have the possibility of placing orders for items offered through the website both for delivery to an address within Spain and to a European destination.') }}
        </div>
        <div class="mb-3">
          <div class="heading">
            {{ $t('Language.') }}
          </div>{{ $t('The contract shall be concluded in English.') }}
        </div>
        <div class="mb-3">
          <div class="heading">
            {{ $t('Product availability.') }}
          </div>
          {{ $t('Orders are subject to product availability. If there are any difficulties in supplying the products or if there are no articles left in stock, BANGER GAMES, S.L. will inform the customer of such circumstance, either by e-mail or by telephone, and will refund any amount paid for the product or products not available or will exchange the product for another one of the same value, as decided by the customer.') }}
        </div>

        <!--  -->
        <div class="mb-3">
          <div class="heading">
            {{ $t('Prices of products.') }}
          </div>
          <div
            class="mb-3"
          >
            {{ $t('The prices of the articles include all current taxes but do not include shipping costs, which will be added to the total price. BANGER GAMES, S.L. reserves the right to modify the prices at any time, although the products will be invoiced on the basis of the price in force at the time the order is placed (subject to product availability).') }}
          </div>
          <div
            class="mb-3"
          >
            {{ $t('The purchase order shall indicate both the total price of the product/products, including taxes and the corresponding shipping costs, as indicated in the following sections.') }}
          </div>
          <div
            class="mb-3"
          >
            {{ $t('The mandatory taxes will be applied at all times in accordance with Spanish legislation.') }}
          </div>
        </div>
        <!-- red -->
        <div class="secondery--text">
          <div class="mb-3">
            <div class="heading">
              {{ $t('Costs for shipping to addresses in Spain.') }}
            </div>
            {{ $t('For orders under € ___, the shipping costs amount to € , an amount to be added to the total price. Shipping costs will therefore be charged to the customer.') }}
          </div>
          <div
            class="mb-3"
          >
            {{ $t('For orders equal to or greater than € , no shipping charges will be applied.') }}
          </div>

          <div class="mb-3">
            <div class="heading">
              {{ $t('Costs for shipping to addresses outside Spain.') }}
            </div>
            {{ $t('For orders with a destination country within the European Union below € , the shipping costs amount to € , which is to be added to the total price. Shipping costs will therefore be charged to the customer.') }}
          </div>

          <div
            class="mb-3"
          >
            {{ $t('For orders equal to or greater than € , no shipping charges will be applied.') }}
          </div>
        </div>
        <!--  -->
        <div class="mb-3">
          <div class="heading">
            {{ $t('How to place an order.') }}
          </div>
          {{ $t('To place an order, you must select the desired item(s). Once you have selected all the items you want, they will be added to your shopping cart. The next step will be to process the order and make the payment. To do this you must follow the steps requested on the website and follow the purchasing instructions that appear on the screen. You will only be asked for the data necessary for the purchase and subsequent delivery of the order. Before formalising the purchase, you must EXPRESSLY ACCEPT these terms and conditions as well as the privacy policy.') }}
        </div>
        <div
          class="mb-3"
        >
          {{ $t('The data recorded by the website constitutes proof of the transactions made. The customer will receive confirmation of the order by e-mail.') }}
        </div>
        <div
          class="mb-3"
        >
          {{ $t('During the process, before making the payment, you can modify the data of your order. The order is not formalised until the process is completed, which will occur when you have made the payment. Clicking on "Pay" implies that you purchase and pay for the selected items; this step is a binding commitment.') }}
        </div>
        <div
          class="mb-3"
        >
          {{ $t('There are no purchase limits. The user can order by the number of articles he wants, without established minimums or maximums.') }}
        </div>

        <!-- bullets -->
        <div class="mb-3">
          <div class="heading">
            {{ $t('Right to cancel the order.') }}
          </div>
          <div
            class="mb-5"
          >
            {{ $t('BANGER GAMES, S.L. reserves the right to refuse an order from a customer with whom there is a dispute.') }}
          </div>
          <p>{{ $t('Likewise, BANGER GAMES, S.L. has the right to reject or cancel an order for justified reasons, such as') }}:</p>
          <p>• {{ $t('By error in the billing data (that is incorrect or impossible to verify)') }}</p>
          <p>• {{ $t('If bank card fraud is suspected') }}</p>
          <p>• {{ $t('If it is not possible to send it to the address indicated') }}</p>
          <p>• {{ $t('If there are reasons to suspect that the user is not an end user') }}</p>
          <p>• {{ $t('If the user does not have legal capacity to enter into contracts') }}</p>
          <p>• {{ $t('If full payment has not been made.') }}</p>
        </div>
        <!--  -->
        <!-- methods of payment -->
        <div class="mb-3">
          <div class="heading">
            {{ $t('Method of payment.') }}
          </div>
          <div
            class="mb-5"
          >
            {{ $t('You can use as a means of payment bank card, PayPal or bank transfer. In the case of payment by card or PayPal the total cost of the order, which will include the corresponding shipping costs, will be charged to the customers account at the time of purchase. Payments are accepted in the following currencies:') }}
          </div>
          <div class="counteries mb-3">
            <div
              v-for="(item, i) in countries"
              :key="i"
              class="single-country"
            >
              - {{ item }}
            </div>
          </div>
          <div
            class="mb-3"
          >
            {{ $t('When paying by card, in the event of any incident during the process (e.g. the terminal reporting the refusal of the card) the order will be automatically cancelled. Payment by bank card is made through the "Stripe" payment gateway') }}
          </div>
          <div class="mb-3">
            {{ $t('By clicking on "Pay" the user confirms the payment of the order as well as the fact that he owns the credit card. To minimise the risk of unauthorised access, your credit card details will be encrypted. Credit cards will be subject to checks and authorisations by the issuing entity, but if the entity does not authorise payment, the order will be automatically cancelled, and the system will inform the customer of the cancellation.') }}
          </div>
          <div
            class="mb-3"
          >
            {{ $t('BANGER GAMES,S.L. also offers you the possibility to pay by bank transfer.') }}
          </div>
          <div
            class="mb-3"
          >
            {{ $t('The order will be sent to the address you provide once the payment of the total price of the order has been confirmed. If the amount is not the total, BANGER GAMES, S.L. reserves the right not to send the order until it is fully paid for by the customer.') }}
          </div>
        </div>
        <div class="mb-3">
          <div class="heading">
            {{ $t('Delivery') }}
          </div>
          <div class="mb-3">
            {{ $t('The products will be sent to the address that the user has indicated.') }}
          </div>
          <div
            class="mb-3"
          >
            {{ $t('The delivery time for addresses outside Spain is between 7 and 10 working days.') }}
          </div>
          <div
            class="mb-3"
          >
            {{ $t('The times indicated will be respected as long as there are no unforeseen or extraordinary circumstances beyond our control. If for any reason we are unable to meet the delivery date, we will inform you of this circumstance and give you the option of either proceeding with the purchase by setting a new delivery date or cancelling the order with a full refund of the price paid.') }}
          </div>
          <div
            class="mb-3"
          >
            {{ $t('Under these terms and conditions, it will be deemed that "delivery" has been made or that the order has been "delivered" at the time when you or a third party indicated by you acquires material possession of the products, which will be evidenced by your signature on receipt of the order at the agreed delivery address.') }}
          </div>
        </div>

        <!--  -->
      </div>

      <div slot="right-detail-section">
        <!--  -->
        <div class="mb-3">
          <div class="heading">
            {{ $t('Impossibility of delivery.') }}
          </div>
          <div
            class="mb-3"
          >
            {{ $t('If it were impossible to deliver the order to the indicated address, BANGER GAMES, S.L. will try to deliver it to a third party indicated by the customer or to try again at a later date. If you are not going to be at home, please contact BANGER GAMES, S.L. to agree on another day for delivery.') }}
          </div>
          <div
            class="mb-3"
          >
            {{ $t('If within 15 days, counting from the moment your order is available for delivery, it has not been possible to deliver the order due to causes not attributable to BANGER GAMES, S.L., we will understand that you wish to withdraw from the contract and we will consider it terminated.') }}
          </div>
          <div
            class="mb-3"
          >
            {{ $t('As a consequence of the termination of the contract, we will refund all payments received from the user, including delivery costs, without any undue delay and in any event no later than 14 days from the date on which we consider the contract terminated. Please bear in mind that any transportation resulting from the termination may carry an additional cost and that, accordingly, BANGER GAMES, S.L. will be authorised to charge you the corresponding costs.') }}
          </div>
        </div>
        <!--  -->
        <div class="mb-3">
          <div class="heading">
            {{ $t('Cancellation of an order.') }}
          </div>
          <div
            class="mb-2"
          >
            {{ $t('The user has the right to cancel the order of a product without giving an explanation as to the reasons. This right is the right of withdrawal established by Article 102 of Spanish Royal Legislative Decree 1/2007, of 16 November, which approves the recast text of the Spanish General Law for the Defence of Consumers and users, as well as other supplementary laws.') }}
          </div>

          <div
            class="mb-3"
          >
            {{ $t('It is not possible to cancel the purchase of the "bombs" (game currencies within the platform). Consent is requested for the transfer of "bombs" immediately to your account once the user requests them by using a payment method accepted on the platform.') }}
          </div>

          <div
            class="mb-3"
          >
            {{ $t('To cancel the order of a product you can use the form at the link "RIGHT OF WITHDRAWAL" or you can notify it by e-mail to CUSTOMERSERVICE@BANGERGAMES.COM or by post to the address Pº DE SAN FRANCISCO DE SALES Nº41 ESC. 2 PISO 3, PUERTA D, 28003, MADRID (SPAIN).') }}
          </div>

          <div
            class="mb-3"
          >
            {{ $t('If you send us an e-mail or written notification, please include the details of your order to help us identify it.') }}
          </div>
          <div
            class="mb-3"
          >
            {{ $t('The withdrawal period shall expire 14 calendar days after the day on which the customer or a third party indicated by the customer, other than the carrier, has acquired material possession of the goods or, in the case of products which make up the order being delivered separately, 14 calendar days after the day on which the customer or a third party indicated by the customer, other than the carrier, has acquired material possession of the last of the said products.') }}
          </div>

          <div
            class="mb-3"
          >
            {{ $t('Once the right of withdrawal has been exercised, the user must send the products delivered to the address indicated, thus assuming the costs of return. Please note that if you choose to return the items to us "carriage forward”, we are entitled to charge you for any costs we may incur as a result.') }}
          </div>

          <div
            class="mb-3"
          >
            {{ $t('The right to withdraw from the contract shall apply only to those products that are returned in the same condition that they were received by the customer. No refund will be made if the product has been used beyond merely opening it of products that are not in the same condition as they were delivered or have been damaged in any way. Therefore, you must be careful with the product(s) while they are in your possession. Please return the item using or including all original packaging with all labels. Please do not remove the labels until you are sure you want to keep each item.') }}
          </div>

          <div
            class="mb-3"
          >
            {{ $t('After examining the article, we will inform you whether you are entitled to a refund of the amounts paid. If the return includes the entire purchase, the correct procedure has been followed and the products are new and unused, we will proceed to reimburse the total amount of the purchase plus shipping costs within 14 days of receiving the cancelled order.') }}
          </div>
          <div
            class="mb-3"
          >
            {{ $t('If the return only includes a part of the order, the correct procedure has been followed and the products are new and unused, we will only refund the value of the returned products, without the shipping costs.') }}
          </div>
        </div>
        <!--  -->
        <div class="mb-3">
          <div class="heading">
            {{ $t('Return of defective products.') }}
          </div>
          {{ $t('If you return the products to us because they are defective or the descriptions do not correspond to the products, we will proceed to reimburse the full price of the products, together with the resulting shipping costs and the return of the item.') }}
        </div>
        <!--  responsibilities-->
        <div class="mb-3">
          <div class="heading">
            {{ $t('RESPONSIBILITIES') }}
          </div>
          <div
            class="mb-3"
          >
            {{ $t('Access to and use of this website are the responsibility of the users. The following is not guaranteed by BANGER GAMES, S.L.:') }}
          </div>
          <div
            class="mb-1"
          >
            - {{ $t('The infallibility, availability, continuity or non-existence of security deficiencies of the website.') }}
          </div>
          <div
            class="mb-1"
          >
            • {{ $t('That the content of the page or the information that passes through it is free of viruses or other harmful elements, or of omissions or inaccuracies.') }}
          </div>
          <div
            class="mb-1"
          >
            • {{ $t('Possible damages that could be derived from interferences, omissions, interruptions, computer viruses, breakdowns or disconnections in the operation of the website.') }}
          </div>
          <div class="mb-1">
            • {{ $t('Delays or blockages in the use of this website caused by deficiencies or overloading of the data processing centre, or damage that may be caused by third parties through illegal intrusions beyond the control of BANGER GAMES, S.L.') }}
          </div>
          <div
            class="mb-3"
          >
            • {{ $t('BANGER GAMES, S.L. is exonerated from responsibility for any damage or harm that the user may suffer as a result of errors, defects or omissions in the information provided, provided that it comes from other sources.') }}
          </div>
          <div
            class="mb-3"
          >
            {{ $t('Merely accessing the website does not imply any kind of commercial relationship between BANGER GAMES, S.L. and the user.') }}
          </div>
          <div
            class="mb-3"
          >
            {{ $t('BANGER GAMES, S.L. only supplies products for domestic and private use. The customer agrees not to use the product for commercial, advertising or resale purposes. BANGER GAMES, S.L. assumes no responsibility for any loss of profits, loss of business, business interruption or loss of business opportunities of the customer.') }}
          </div>
        </div>
        <!--  -->
        <div class="mb-3">
          <div class="heading">
            {{ $t('Assignment of rights and obligations.') }}
          </div>
          {{ $t('The contract is binding both for the customer and for BANGER GAMES, S.L., as well as for our respective heirs, successors and assignees. The customer may not transfer, assign, encumber or in any other way transfer a contract or any of the rights or obligations arising from it, without having obtained the prior written consent of BANGER GAMES, S.L. We may transfer, assign, encumber, subcontract or otherwise transfer a contract or any of the rights or obligations under it at any time during its term. For the avoidance of doubt, any such transfer, assignment, encumbrance or other transfer shall not affect any rights that you, as a consumer, may have under law nor shall it negate, reduce or otherwise limit any warranties, whether express or implied, that we may have given you.') }}
        </div>
        <!--  -->
        <div class="mb-3">
          <div class="heading">
            {{ $t('INFORMATION AND CONTENT OF THE WEBSITE') }}
          </div>

          <div
            class="mb-3"
          >
            {{ $t('The information shown on the website is that which is current on the date of the last update. BANGER GAMES, S.L. reserves the right to update/modify/delete information on this website at any time and without prior notice.') }}
          </div>
          <div
            class="mb-3"
          >
            {{ $t('In the event that the website contains links to other websites and materials of third parties, such links are provided for information purposes only, without BANGER GAMES, S.L. having any control over the content of such websites or materials. Therefore, we do not accept any responsibility for any damage or loss arising from its use.') }}
          </div>
          <div
            class="mb-3"
          >
            {{ $t('BANGER GAMES, S.L. reserves the right to modify the Terms and Conditions of Purchase. The changes made will not be retroactive. If you do not agree with the changes made, we recommend that you do not use our website.') }}
          </div>
        </div>
        <!--  -->
        <div class="mb-3">
          <div class="heading">
            {{ $t('VIRUSES, HACKING AND OTHER CYBER ATTACKS') }}
          </div>
          {{ $t('The user must not misuse this website by intentionally introducing viruses, Trojans, worms, logic bombs or any other technologically harmful or damaging programs or materials into the website. The user shall not attempt to gain unauthorised access to this website, to the server on which the website is hosted or to any server, computer or database related to our website. The user agrees not to attack this website. Failure to comply with this clause could lead to the commission of offences under the applicable legislation. We will report any breach of these regulations to the relevant authorities and cooperate with them in discovering the identity of the attacker. Also, in the event of breach of this clause, you will immediately cease to be authorised to use this website. We will not be liable for any damage or loss resulting from a denial of service attack, viruses or any other technologically harmful or damaging programs or materials that may affect your computer, computer equipment, data or materials as a result of using this website or downloading content from it or to which it redirects.') }}
        </div>
        <!--  -->
        <div class="mb-3">
          <div class="heading">
            {{ $t('INTELLECTUAL PROPERTY AND COPYRIGHT') }}
          </div>
          {{ $t('The user acknowledges and consents that all copyright, registered trademark and other industrial and intellectual property rights over the materials or content provided as part of the website correspond at all times to BANGER GAMES, S.L. The user may use such material only as expressly authorised.') }}
        </div>
        <!--  -->
        <div class="mb-3">
          <div class="heading">
            {{ $t('APPLICABLE LAW AND JURISDICTION') }}
          </div>
          <div
            class="mb-2"
          >
            {{ $t('The use of this website and contracts for the purchase of products through this website shall be governed by Spanish law. Any dispute arising out of or in connection with the use of the website or such contracts shall be submitted to the courts of the city of Madrid, provided that such express submission does not contravene the rules of the corresponding Spanish mandatory legislation.') }}
          </div>
          <div
            class="mb-2"
          >
            {{ $t('However, in accordance with Article 14(1) of Regulation (EU) 524/2013, the European Commission provides a free access platform for the resolution of online disputes between the USER and the PROVIDER, without the need to resort to the courts of law, through the intervention of a third party, called the Dispute Resolution Body, which acts as an intermediary between the two. This body is neutral and will dialogue with both parties to reach an agreement and may eventually suggest and/or impose a solution to the conflict.') }}
          </div>
          <div class="mb-2">
            {{ $t('Link to the ODR platform:') }}
            <a
              href="http://ec.europa.eu/consumers/odr/"
            >http://ec.europa.eu/consumers/odr/</a>
          </div>
          <div
            class="mb-2"
          >
            {{ $t('You can submit any complaints or claims to BANGER GAMES, S.L. by e-mail to CUSTOMERSERVICE@BANGERGAMES.COM or by post to Pº DE SAN FRANCISCO DE SALES Nº41 ESC. 2 PISO 3, PUERTA D, 28003, MADRID (SPAIN).') }}
          </div>
        </div>
        <!--  -->
      </div>
    </static-page-wrapper>
  </div>
</template>

<script>
import StaticPageWrapper from '@/components/StaticPages/StaticPageWrapper';
import { APP_URL } from 'configs/config';

export default {
  name: 'Terms',
  components: {
    StaticPageWrapper
  },
  data: () => ({
    countries: [
      'Australian Dollar, AUD',
      'Brazilian Real, BRL',
      'British Pound, GBP',
      'Canadian Dollar, CAD',
      'Czech Koruna, CZK',
      'Danish Krone, DKK',
      'Euro, EUR',
      'Hong Kong Dollar, HKD',
      'Hungarian Forint, HUF',
      'Israeli New Sheqel, ILS',
      'Japanese Yen, JPY',
      'Malaysian Ringgit, MYR',
      'Mexican Peso, MXN',
      'New Taiwan Dollar, TWD',
      'New Zealand Dollar, NZD',
      'Norwegian Krone, NOK',
      'Philippine Peso, PHP',
      'Polish Złoty, PLN',
      'Romania Leu, RON',
      'Russian Ruble, RUB',
      'Singapore Dollar, SGD',
      'Swedish Krona, SEK',
      'Swiss Franc, CHF',
      'Thai Baht, THB',
      'United States Dollar, USD'
    ]
  }),
  head () {
    const route = APP_URL + this.$route.path;

    return {
      title: 'Terms',
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

.page-wrapper p {
  margin-bottom: 5px;
}

.heading {
  font-family: Telegraf-UltraBold, serif;
  font-weight: 900;
  margin-bottom: 4px;
}
</style>
