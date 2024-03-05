<?php
    if(auth()->check()){
        $user_card = \App\UserCard::where('user_id',auth()->id())->orderBy('id', 'DESC')->first();
    }else{
        $user_card = null;
    }
?>
<div class="modal fade login-modal" id="payment" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">

                <div class="header-area">
                    <div class="row">
                        <div class="col-lg-6"><h4 class="cards-title">Bomb coins</h4></div>
                        <div class="col-lg-6"><p class="cards-sub-title">Please enter your payment method to buy bombs.</p></div>
                    </div>


                </div>
                <div class="form-area">
                    <form action="{{route("award-pay.stripe")}}" method="POST">
                        <input type="hidden" name="allowed_tournaments" value="0" id="allowed_tournaments">
                        <input type="hidden" name="bomb" value="0" id="bomb">
                        <input type="hidden" name="cost" value="10" id="cost">

                        <h4 class="text-center" style="color:#a1afd3;font-family:'Telegraf-Regular'">Price &euro;<span id="price">10</span> Euro</h4>
                        <hr>
                        <div class="form-group" style="height:40px">
                            <label for="card-number">Card Number*</label>
                            <input type="text" name="card_no" class="input-field number-only"
                                   value="{{$user_card ? $user_card->number : ''}}" id="card-number" placeholder="Enter your card number" pattern="[0-9]{14,16}"  maxlength = "16" required>
                            <small>Please enter 14 digit number</small>
                        </div>
                        <hr>
                        <div class="form-group" style="height:40px">
                            <label for="card-cvc">CVV*</label>
                            <input type="text"  value="{{$user_card ? $user_card->cvc : ''}}" name="cvv_number" class="input-field number-only" id="card-cvc" placeholder="Enter your card cvc" pattern="[0-9]{3,4}" maxlength = "4" required>
                        </div>
                        <hr>
                        <div class="form-group" style="height:40px">
                            <label for="card-expiry-month">Expiration Month*</label>
                            <input type="text" name="exp_month" value="{{$user_card ? $user_card->exp_month : ''}}" class="input-field number-only" id="card-expiry-month" placeholder="MM" required>
                        </div>
                        <hr>
                        <div class="form-group" style="height:40px">
                            <label for="card-expiry-year">Expiration Year*</label>
                            <input type="text" name="exp_year" value="{{$user_card ? $user_card->exp_year : ''}}" class="input-field number-only" id="card-expiry-year" placeholder="YYYY" required>
                        </div>
                        <hr>
                        {{csrf_field()}}

                        <div class="form-group">
                            <div class="row justify-content-end">
                                <div class="col-lg-5">
                                <button type="submit" class="wagerbtn">Pay</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

