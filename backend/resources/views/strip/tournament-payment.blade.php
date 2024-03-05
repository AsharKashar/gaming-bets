<?php
if (auth()->check()) {
    $user_card = \App\UserCard::where('user_id', auth()->id())->orderBy('id', 'DESC')->first();
} else {
    $user_card = null;
}
?>
<div class="modal fade login-modal" id="payment" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <div class="logo-area">
                    <img class="logo" src="assets/images/logo.png" alt="">
                </div>
                <div class="header-area">
                    <h4 class="title">Payment Method</h4>
                    <p class="sub-title">Enter your details below</p>
                </div>
                <div class="form-area">
                    <form action="{{route("pay.stripe")}}" method="POST">
                        <input type="hidden" name="tournament_id" value="{{$id}}">
                        <div class="form-group">
                            <label for="card-number">Card Number*</label>
                            <input type="text" name="card_no" class="input-field number-only"
                                value="{{$user_card ? $user_card->number : ''}}" id="card-number" placeholder="Enter your card number" pattern="[0-9]{14,16}" maxlength="16" required>
                            <small>Please enter 14 digit number</small>
                        </div>

                        <div class="form-group">
                            <label for="card-cvc">CVC*</label>
                            <input type="text" value="{{$user_card ? $user_card->cvc : ''}}" name="cvv_number" class="input-field number-only" id="card-cvc" placeholder="Enter your card cvc" pattern="[0-9]{3,4}" maxlength="4" required>
                        </div>

                        <div class="form-group">
                            <label for="card-expiry-month">Expiration Month*</label>
                            <input type="text" name="exp_month" value="{{$user_card ? $user_card->exp_month : ''}}" class="input-field number-only card-expiry-month" id="card-expiry-month" placeholder="MM" required>
                        </div>

                        <div class="form-group">
                            <label for="card-expiry-year">Expiration Year*</label>
                            <input type="text" name="exp_year" value="{{$user_card ? $user_card->exp_year : ''}}" class="input-field number-only card-expiry-year" id="card-expiry-year" placeholder="YYYY" required>
                        </div>

                        {{csrf_field()}}

                        <div class="form-group">
                            <button type="submit" class="mybtn1">Pay</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade login-modal" id="payments" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <!--<div class="logo-area">
                    <img class="logo" src="assets/images/logo.png" alt="">
                </div>-->
                <div class="header-area">
                    <h4 class="title">Payment Method</h4>
                    <p class="sub-title">Enter your details below</p>
                </div>
                <div class="form-area">
                    <form action="{{route("pay.stripe")}}" method="POST">
                        <input type="hidden" name="tournament_id" value="{{$id}}">
                        <div class="form-group">
                            <label for="card-number">Card Number*</label>
                            <input type="text" name="card_no" class="input-field number-only"
                                value="{{$user_card ? $user_card->number : ''}}" id="card-number" placeholder="Enter your card number" pattern="[0-9]{14,16}" maxlength="16" required>
                            <small>Please enter 14 digit number</small>
                        </div>

                        <div class="form-group">
                            <label for="card-cvc">CVC*</label>
                            <input type="text" value="{{$user_card ? $user_card->cvc : ''}}" name="cvv_number" class="input-field number-only" id="card-cvc" placeholder="Enter your card cvc" pattern="[0-9]{3,4}" maxlength="4" required>
                        </div>

                        <div class="form-group">
                            <label for="card-expiry-month">Expiration Month*</label>
                            <input type="text" name="exp_month" value="{{$user_card ? $user_card->exp_month : ''}}" class="input-field number-only card-expiry-month" id="card-expiry-month" placeholder="MM" required>
                        </div>

                        <div class="form-group">
                            <label for="card-expiry-year">Expiration Year*</label>
                            <input type="text" name="exp_year" value="{{$user_card ? $user_card->exp_year : ''}}" class="input-field number-only card-expiry-year" id="card-expiry-year" placeholder="YYYY" required>
                        </div>

                        {{csrf_field()}}

                        <div class="form-group">
                            <button data-toggle="modal"
                                data-target="#confirmation"
                                data-dismiss="modal" type="" class="mybtn1">Pay
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade login-modal" id="activisionid" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <!--<div class="logo-area">
                    <img class="logo" src="assets/images/logo.png" alt="">
                </div>-->
                <div class="header-area">
                    <h4 class="title" style="font-size: 14px">Enter your Activision ID (Example#12345678) for Call of Duty: Modern Warfare</h4>

                </div>
                <div class="form-area">
                    <form action="" method="">
                        <input type="hidden" name="tournament_id" value="{{$id}}">
                        <div class="form-group">

                            <input type="text" name="card_no" class="input-field number-only"
                                value="{{$user_card ? $user_card->number : ''}}" id="card-number" placeholder="Activision ID (Example#12345678)" pattern="[0-9]{14,16}" maxlength="16" required>

                        </div>

                        {{csrf_field()}}

                        <div class="form-group">
                            <button data-toggle="modal"
                                data-target="#teamname"
                                data-dismiss="modal" type="" class="mybtn1">Save
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade login-modal" id="teamname" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <!--<div class="logo-area">
                    <img class="logo" src="assets/images/logo.png" alt="">
                </div>-->
                <div class="header-area">
                    <h4 class="title" style="font-size: 18px">CONFIRMATION NEEDED</h4>

                </div>
                <div class="form-area">
                    <form action="" method="">
                        <input type="hidden" name="tournament_id" value="{{$id}}">
                        <div class="form-group">
                            <label for="card-expiry-year">Team name</label>
                            <input type="text" name="card_no" class="input-field number-only"
                                value="{{$user_card ? $user_card->number : ''}}" id="card-number" placeholder="Team name must be between 3 to 15 characters" pattern="[0-9]{14,16}" maxlength="16" required>

                        </div>
                        <div class="form-group">
                            <label for="card-expiry-year">Team member (1 required)</label><br>
                            <small>Enter the Activision ID (Example#12345678) of the other team members</small>
                            <input type="text" name="card_no" class="input-field number-only"
                                value="{{$user_card ? $user_card->number : ''}}" id="card-number" placeholder="Teammate #1's Activision ID (Example#12345678)" pattern="[0-9]{14,16}" maxlength="16" required>
                            <label>This tournament is free to enter</label><br>

                        </div>
                        <div class="check-group">
                            <input type="checkbox" class="check-box-field" name="terms" id="input-terms" checked required>
                            <label for="input-terms" style="font-size: 14px">
                                I confirm that all team members agree to abide by the rule and regulations of this tournament.
                                <a href="/terms-conditions">terms and Conditions</a> and
                                <a href="/terms-conditions-details">privacy policy</a>
                            </label>
                        </div>
                        <div class="check-group">
                            <input type="checkbox" class="check-box-field" name="terms" id="input-terms" checked required>
                            <label for="input-terms" style="font-size: 14px">
                                I confirm all the members are eligible to participate according to the rule and regulations of the tournament.
                                <a href="/terms-conditions">terms and Conditions</a> and
                                <a href="/terms-conditions-details">privacy policy</a>
                            </label>
                        </div>

                        {{csrf_field()}}

                        <div class="form-group">
                            <button data-toggle="modal"
                                data-target="#payments"
                                data-dismiss="modal" type="" class="mybtn1">Join
                            </button>
                            <button data-dismiss="modal" type="" class="mybtn1">Cancel</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade login-modal" id="confirmation" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <!--<div class="logo-area">
                    <img class="logo" src="assets/images/logo.png" alt="">
                </div>-->
                <div class="header-area">
                    <h4 class="title" style="font-size: 14px">YOU HAVE JOINED THIS TOURNAMENT</h4>

                </div>
                <div class="form-area">
                    <form action="" method="">
                        <input type="hidden" name="tournament_id" value="{{$id}}">
                        <div class="form-group">

                            <p>When this tournament starts, you will see a match card on this page. You will need to check in with in the first 10 minutes of this tournaments.</p>
                            <p>After checking in, follow instructions on your match card, and you will be told who will your opponent is and when you have to play</p>
                        </div>

                        {{csrf_field()}}

                        <div class="form-group">
                            <button
                                data-dismiss="modal" type="" class="mybtn1">close
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

