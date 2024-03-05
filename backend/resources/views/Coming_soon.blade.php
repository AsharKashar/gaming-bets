
@extends('layout.maincoming_soon')

@section('content')

    <div class="coming">
        <div class="row toparea">
            <div class="col-lg-3 p1"><a>
                <img style="width: 300px ; margin-left:-15px" src="/assets/images/bangers-logo.png"  alt="" >
            </a></div>
            <div class="col-lg-2 p2"><div class="row"></div>
            <div class="row"><h5 class="title1">FORTNITE</h5></div>
            <div class="row"><h5 class="title1">CALL OF DUTY</h5></div>
            <div class="row"><h5 class="title1">CSGO</h5></div></div>
            <div class="col-lg-3 p5"><img class="gtag" style="" src="/assets/images/PNG/stories3.png"  alt="" ></div>
            <div class="col-lg-4 p3"><h5 class="title2">FIRST MONTH <strong style="font-weight: 800">&euro;30,000</strong> CASH REWARDS!</h5><br><h5 class="title3"> SIGN UP TODAY AND SECURE YOUR POSITION IN THE FIRST MONTH OF CASH PRIZE GIVEAWAYS.</h5></div>
            <div class="col-lg-2 p4"><button id="elite" data-toggle="modal" data-target="#signin" class="mybtn2 cbtn">SIGN UP</button></div>
            <div class="col-lg-9 p6"><img class="ctag" style="" src="/assets/images/PNG/stories3.png"  alt="" ></div>
            <div class="col-lg-3 p7"><h5 class="title4"> SIGN UP TODAY AND SECURE YOUR POSITION IN THE FIRST MONTH OF CASH PRIZE GIVEAWAYS.</h5></div></div>
        </div>



        </div>

    </div>



<!-- SignIn Area Start -->
<div class="modal fade login-modal sign-in" id="signin" tabindex="-1" role="dialog" aria-labelledby="signin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">

            <div class="modal-body">

                <div class="header-area">
                    <h4 class="title">Welcome</h4>

                </div>
                <div class="form-area">
                    <form action="{{url('/register')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="input-name">Username*</label>
                            <input type="text" name="name" class="input-field" id="input-name"  placeholder="Enter your Username" required>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="input-email">E-mail*</label>
                            <input type="email" name="email" class="input-field" id="input-email"  placeholder="example@gmail.com" required>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="input-password">Password*</label>
                            <input type="password" name="password" class="input-field" id="input-password"  placeholder="&nbsp;Enter your password" required>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="input-con-password">Confirm password**</label>
                            <input type="password" name="password_confirmation" class="input-field" id="input-con-password"  placeholder="Re-Enter your Password" required>
                        </div>
                        <hr>
{{--                        <div class="form-group">--}}
{{--                            <select>--}}
{{--                                <option value="0">BTC</option>--}}
{{--                                <option value="1">USD</option>--}}
{{--                                <option value="2">EUR</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
                       <!-- <div class="form-group">
                            <div class="check-group">
                                <input type="checkbox" class="check-box-field" name="terms" id="input-terms" checked required>
                                <label for="input-terms">
                                    I agree with <a href="/terms-conditions">terms and Conditions</a> and  <a href="/terms-conditions-details">privacy policy</a>
                                </label>
                            </div>
                        </div>-->
                        <div class="form-group fbtn" style="">
                            <input type="hidden" id="role" name="role" value="user">
                            <button type="submit" class="mybtn2">Sign up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- SignIn Area End -->

@endsection
