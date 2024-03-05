@extends('layout.indexlayout')

@section('content')
    <style>
        .faq-wrapper .nav-link {
            font-size: 15px !important;
        }
    </style>
    <!-- user-profile-area-header Start -->
    <section class="user-profile-area">
        <div class="container">
            <div class="row user-dash-top">
                <div class="col-lg-6" style="margin-left:44px">
                    <h4 class="user-dashboard-title">Hello {{$user->name}}!</h4>
                    <h4 class="user-dashboard-subtitle">Welcome to your dashboard</h4>
                    <p class="user-dashboard-paragraf">Here you can customize your profile, view current and previous tournaments, edit payment options and withdraw earnings through your prefered methods.</p>
                </div>
            </div>
            </div>
        </div>
    </section>
    <!--user-profile-area-header ends-->
    <!-- user-profile-area-nav Start -->
    <section class="user-profile-area-nav">
        <div class="container">
            <div class="row" style="padding-top:50px">
                <div class="col-lg-3">
                    <div class="user-profile-thumb-section text-center">
                <img  src="{{url('/storage/'.$user->image)}}" onerror="this.onerror=null; this.src='assets/images/affiliate/ps1.png'" class="img-thumbnail user-profile-img" alt="Profile Picture">
                <h4 class=" user-profile-name" style="">{{$user->name}}</h4>
               </div>
            </div>

                <div class="col-lg-3">
                       <ul class="user-dashboard-list">
                            <li ><a  class="user-dashboard-list-items" href="#dashboard-profile-details" id="dashboard-profile"> Profile</a></li>
                            <li ><a class="user-dashboard-list-items" href="#!" id="dashboard-payments">Payments</a></li>
                            <li ><a class="user-dashboard-list-items" href="#!" id="dashboard-tournaments">Tournaments</a></li>
                            <li ><a class="user-dashboard-list-items" href="#dashboard-cashwithdrawal-details" id="dashboard-cashwithdrawal">Cash withdrawal</a></li>
                            <li ><a class="user-dashboard-list-items" href="#dashboard-teams-details" id="dashboard-teams">Teams</a></li>
                       </ul>
                </div>
                <div class="col-lg-4" >
                <ul class="user-dashboard-list" id="dashboard-payments-datails">
                            <li><a  class="user-dashboard-list-items" href="#dashboard-payment-history-details"  id="dashboard-payment-history">Payment History</a></li>
                            <li ><a class="user-dashboard-list-items" href="#dashboard-payment-method-details" id="dashboard-payment-method">Payment Method</a></li>
                       </ul>
                       <ul class="user-dashboard-list"  id="dashboard-tournaments-details">
                            <li ><a class="user-dashboard-list-items" href="#dashboard-tournaments-history-details" id="dashboard-tournaments-history">History</a></li>
                            <li ><a class="user-dashboard-list-items" href="#dashboard-tournaments-active-details" id="dashboard-tournaments-active">Active Tournaments</a></li>
                       </ul>
                </div>
                <div class="col-lg-2">
                @auth
                                    <li>
                                        <a href="javascript: $('#logout').submit();" class="sign-in" >
                                            <i class="fas fa-user-lock"></i> Log Out
                                        </a>
                                    </li>
                                @endauth
                <ul class="user-dashboard-list">
                            <li class="user-dashboard-list-itemsx">Total points:<a class="user-info-figures"><span class="dashboard-span">&nbsp;{{auth()->user()->points()->points??'N/A'}}</span></a></li>
                            <li class="user-dashboard-list-itemsx">total bombs:<a class="user-info-figures"><span class="dashboard-span">&nbsp;{{auth()->user()->total_bomb()}}</span></a></li>
                            <li class="user-dashboard-list-itemsx">Win record:<a class="user-info-figures"><span class="dashboard-span">&nbsp;{{$user->wins}}</span></a></li>
                       </ul>
                </div>
            </div>
            </div>
        </div>
    </section>

    <!--user-profile-area-nav ends-->
    <section class="user-profile-area-details" id="dashboard-profile-details">
    <div class="container">
    <div class="row justify-content-center">
            <!-- SignIn Area Start -->
    <div class="login-modal sign-in">
                                    <div class="modal-dialog" role="document" style="max-width:740px">
                                        <div class="modal-content" style="border:none">
                                            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                                            <div class="modal-body" style="max-width:700px">
                                                <!--<div class="logo-area">
                                                        <img class="logo" src="assets/images/logo.png" alt="">
                                                </div>-->
                                                <div class="header-area">

                                                <div class="form-area" style="padding-top:0px">
                                                    <form method="POST">
                                                        @method("put")
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                            <div class="form-group" style="border-bottom: 2px solid #a1afd3;padding-bottom:26px">
                                                            <label for="input-name">Profile Picture</label>
                                                            <img  src="{{url('/storage/'.$user->image)}}" onerror="this.onerror=null; this.src='assets/images/affiliate/ps1.png'" class="img-thumbnail user-profile-img1" alt="Profile Picture">
                                                        </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                            <div class="form-group" style="border-bottom: 2px solid #a1afd3;">
                                                            <label for="input-name">Name*</label>
                                                            <input type="text" style="color:#bf1438" class="input-field" id="input-name" name="account_number" placeholder="" value="{{$user->name}}" required>
                                                        </div>
                                                            </div>
                                                            <div class="col-md-12">


                                                        <div class="form-group" style="border-bottom: 2px solid #a1afd3;">
                                                            <label for="input-email">Username ID*</label>
                                                            <input type="text" style="color:#bf1438" class="input-field" id="input-email" name="last_four" placeholder="" value="AJG MAster" required>
                                                        </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                            <div class="form-group" style="border-bottom: 2px solid #a1afd3;">
                                                            <label for="input-email">E-mail*</label>
                                                            <input type="text" style="color:#bf1438" class="input-field user-dash-field" id="input-email" name="holder_name" placeholder="example@gmail.com" value="" required>
                                                        </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                            <div class="form-group" style="border-bottom: 2px solid #a1afd3;">
                                                            <label for="input-email">Current password*</label>
                                                            <input type="text" style="color:#bf1438" class="input-field" id="input-email" name="email" placeholder="Enter your password" value="" required>
                                                        </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                            <div class="form-group" style="border-bottom: 2px solid #a1afd3;">
                                                            <label for="input-email">Change password*</label>
                                                            <input type="text" style="color:#bf1438" class="input-field" id="input-email" name="email" placeholder="Enter new password" value="" required>
                                                        </div>
                                                            </div>

                                                        </div>



                                      <div style="float:right" class="col-lg-4 ">
                                                        <div class="form-group" >
                                                            <button style="width:30;margin-top:10px" type="btn" class="wagerbtn">Save</button>
                                                        </div></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- SignIn Area End -->
        </div>
    </div>
    </section>
    <section class="user-profile-area-details" id="dashboard-cashwithdrawal-details">
    <!-- SignIn Area Start -->
    <div class="login-modal sign-in">
                                    <div class="modal-dialog" role="document" style="max-width:740px">
                                        <div class="modal-content" style="border:none">
                                            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                                            <div class="modal-body" style="max-width:700px">
                                                <!--<div class="logo-area">
                                                        <img class="logo" src="assets/images/logo.png" alt="">
                                                </div>-->
                                                <div class="header-area">


                                                </div>
                                                <div class="form-area" style="padding-top:0px">
                                                    <form method="POST">
                                                        @method("put")
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                            <div class="form-group" style="border-bottom: 2px solid #a1afd3;">
                                                            <label for="input-name">Bomb*</label>
                                                            <input type="number" class="input-field" id="input-name" name="amount" placeholder="Bomb amount for transfer" max="{{auth()->user()->total_bomb()}}" value="" required>
                                                        </div>
                                                            </div>


                                                            <div class="col-md-12">
                                                                <div class="form-group" style="border-bottom: 2px solid #a1afd3;">
                                                                    <label for="input-name">Stripe ID*</label>
                                                                    <input type="number" class="input-field" id="input-name" name="destination" placeholder="Enter Stripe ID" value="" required>
                                                                </div>
                                                            </div>



                                                            <div class="col-md-12">
                                                            <div class="form-group" style="border-bottom: 2px solid #a1afd3;">
                                                            <label for="input-name">Account number*</label>
                                                            <input type="number" class="input-field" id="input-name" name="account_number" placeholder="Enter number" value="" required>
                                                        </div>
                                                            </div>
                                                            <div class="col-md-12">


                                                        <div class="form-group" style="border-bottom: 2px solid #a1afd3;">
                                                            <label for="input-email">Last4*</label>
                                                            <input type="number" class="input-field" id="input-email" name="last_four" placeholder="Enter Last4*" value="" required>
                                                        </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                            <div class="form-group" style="border-bottom: 2px solid #a1afd3;">
                                                            <label for="input-email">Account-holder name*</label>
                                                            <input type="text" class="input-field" id="input-email" name="holder_name" placeholder="Enter name*" value="" required>
                                                        </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                            <div class="form-group" style="border-bottom: 2px solid #a1afd3;">
                                                            <label for="input-email">Account-holder type*</label>
                                                            <select style="width:50%;color:#bf1438;border-radius: 0px;text-decoration:underline;" name="holder_type">
                                                            <option value="select">Select</option>
                                                            <option value="individual">Individual</option>
										<option value="company">Business</option>

									</select>
                                                        </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                            <div class="form-group" style="border-bottom: 2px solid #a1afd3;">
                                                            <label for="input-email">Bank name*</label>
                                                            <input type="text" class="input-field" id="input-email" name="email" placeholder="Enter name*" value="" required>
                                                        </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                            <div class="form-group" style="border-bottom: 2px solid #a1afd3;">
                                                            <label for="input-email">Currency*</label>
                                                            <select style="width:50%;color:#bf1438;border-radius: 0px;text-decoration:underline;" name="currency">
                                                            <option value="select">Select</option>
                                                            <option value="0">USD</option>
                                                            </select>
                                                        </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                            <div class="form-group" style="border-bottom: 2px solid #a1afd3;">
                                                            <label for="input-email">Country*</label>
                                                                                                                   <select style="width:50%;color:#bf1438;border-radius: 0px;text-decoration:underline;" id="country" name="country">

                                                                                                                   <option value="select">Select</option>  <option value="Afganistan">Afghanistan</option>
   <option value="Albania">Albania</option>
   <option value="Algeria">Algeria</option>
   <option value="American Samoa">American Samoa</option>
   <option value="Andorra">Andorra</option>
   <option value="Angola">Angola</option>
   <option value="Anguilla">Anguilla</option>
   <option value="Antigua & Barbuda">Antigua & Barbuda</option>
   <option value="Argentina">Argentina</option>
   <option value="Armenia">Armenia</option>
   <option value="Aruba">Aruba</option>
   <option value="Australia">Australia</option>
   <option value="Austria">Austria</option>
   <option value="Azerbaijan">Azerbaijan</option>
   <option value="Bahamas">Bahamas</option>
   <option value="Bahrain">Bahrain</option>
   <option value="Bangladesh">Bangladesh</option>
   <option value="Barbados">Barbados</option>
   <option value="Belarus">Belarus</option>
   <option value="Belgium">Belgium</option>
   <option value="Belize">Belize</option>
   <option value="Benin">Benin</option>
   <option value="Bermuda">Bermuda</option>
   <option value="Bhutan">Bhutan</option>
   <option value="Bolivia">Bolivia</option>
   <option value="Bonaire">Bonaire</option>
   <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
   <option value="Botswana">Botswana</option>
   <option value="Brazil">Brazil</option>
   <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
   <option value="Brunei">Brunei</option>
   <option value="Bulgaria">Bulgaria</option>
   <option value="Burkina Faso">Burkina Faso</option>
   <option value="Burundi">Burundi</option>
   <option value="Cambodia">Cambodia</option>
   <option value="Cameroon">Cameroon</option>
   <option value="Canada">Canada</option>
   <option value="Canary Islands">Canary Islands</option>
   <option value="Cape Verde">Cape Verde</option>
   <option value="Cayman Islands">Cayman Islands</option>
   <option value="Central African Republic">Central African Republic</option>
   <option value="Chad">Chad</option>
   <option value="Channel Islands">Channel Islands</option>
   <option value="Chile">Chile</option>
   <option value="China">China</option>
   <option value="Christmas Island">Christmas Island</option>
   <option value="Cocos Island">Cocos Island</option>
   <option value="Colombia">Colombia</option>
   <option value="Comoros">Comoros</option>
   <option value="Congo">Congo</option>
   <option value="Cook Islands">Cook Islands</option>
   <option value="Costa Rica">Costa Rica</option>
   <option value="Cote DIvoire">Cote DIvoire</option>
   <option value="Croatia">Croatia</option>
   <option value="Cuba">Cuba</option>
   <option value="Curaco">Curacao</option>
   <option value="Cyprus">Cyprus</option>
   <option value="Czech Republic">Czech Republic</option>
   <option value="Denmark">Denmark</option>
   <option value="Djibouti">Djibouti</option>
   <option value="Dominica">Dominica</option>
   <option value="Dominican Republic">Dominican Republic</option>
   <option value="East Timor">East Timor</option>
   <option value="Ecuador">Ecuador</option>
   <option value="Egypt">Egypt</option>
   <option value="El Salvador">El Salvador</option>
   <option value="Equatorial Guinea">Equatorial Guinea</option>
   <option value="Eritrea">Eritrea</option>
   <option value="Estonia">Estonia</option>
   <option value="Ethiopia">Ethiopia</option>
   <option value="Falkland Islands">Falkland Islands</option>
   <option value="Faroe Islands">Faroe Islands</option>
   <option value="Fiji">Fiji</option>
   <option value="Finland">Finland</option>
   <option value="France">France</option>
   <option value="French Guiana">French Guiana</option>
   <option value="French Polynesia">French Polynesia</option>
   <option value="French Southern Ter">French Southern Ter</option>
   <option value="Gabon">Gabon</option>
   <option value="Gambia">Gambia</option>
   <option value="Georgia">Georgia</option>
   <option value="Germany">Germany</option>
   <option value="Ghana">Ghana</option>
   <option value="Gibraltar">Gibraltar</option>
   <option value="Great Britain">Great Britain</option>
   <option value="Greece">Greece</option>
   <option value="Greenland">Greenland</option>
   <option value="Grenada">Grenada</option>
   <option value="Guadeloupe">Guadeloupe</option>
   <option value="Guam">Guam</option>
   <option value="Guatemala">Guatemala</option>
   <option value="Guinea">Guinea</option>
   <option value="Guyana">Guyana</option>
   <option value="Haiti">Haiti</option>
   <option value="Hawaii">Hawaii</option>
   <option value="Honduras">Honduras</option>
   <option value="Hong Kong">Hong Kong</option>
   <option value="Hungary">Hungary</option>
   <option value="Iceland">Iceland</option>
   <option value="Indonesia">Indonesia</option>
   <option value="India">India</option>
   <option value="Iran">Iran</option>
   <option value="Iraq">Iraq</option>
   <option value="Ireland">Ireland</option>
   <option value="Isle of Man">Isle of Man</option>
   <option value="Israel">Israel</option>
   <option value="Italy">Italy</option>
   <option value="Jamaica">Jamaica</option>
   <option value="Japan">Japan</option>
   <option value="Jordan">Jordan</option>
   <option value="Kazakhstan">Kazakhstan</option>
   <option value="Kenya">Kenya</option>
   <option value="Kiribati">Kiribati</option>
   <option value="Korea North">Korea North</option>
   <option value="Korea Sout">Korea South</option>
   <option value="Kuwait">Kuwait</option>
   <option value="Kyrgyzstan">Kyrgyzstan</option>
   <option value="Laos">Laos</option>
   <option value="Latvia">Latvia</option>
   <option value="Lebanon">Lebanon</option>
   <option value="Lesotho">Lesotho</option>
   <option value="Liberia">Liberia</option>
   <option value="Libya">Libya</option>
   <option value="Liechtenstein">Liechtenstein</option>
   <option value="Lithuania">Lithuania</option>
   <option value="Luxembourg">Luxembourg</option>
   <option value="Macau">Macau</option>
   <option value="Macedonia">Macedonia</option>
   <option value="Madagascar">Madagascar</option>
   <option value="Malaysia">Malaysia</option>
   <option value="Malawi">Malawi</option>
   <option value="Maldives">Maldives</option>
   <option value="Mali">Mali</option>
   <option value="Malta">Malta</option>
   <option value="Marshall Islands">Marshall Islands</option>
   <option value="Martinique">Martinique</option>
   <option value="Mauritania">Mauritania</option>
   <option value="Mauritius">Mauritius</option>
   <option value="Mayotte">Mayotte</option>
   <option value="Mexico">Mexico</option>
   <option value="Midway Islands">Midway Islands</option>
   <option value="Moldova">Moldova</option>
   <option value="Monaco">Monaco</option>
   <option value="Mongolia">Mongolia</option>
   <option value="Montserrat">Montserrat</option>
   <option value="Morocco">Morocco</option>
   <option value="Mozambique">Mozambique</option>
   <option value="Myanmar">Myanmar</option>
   <option value="Nambia">Nambia</option>
   <option value="Nauru">Nauru</option>
   <option value="Nepal">Nepal</option>
   <option value="Netherland Antilles">Netherland Antilles</option>
   <option value="Netherlands">Netherlands (Holland, Europe)</option>
   <option value="Nevis">Nevis</option>
   <option value="New Caledonia">New Caledonia</option>
   <option value="New Zealand">New Zealand</option>
   <option value="Nicaragua">Nicaragua</option>
   <option value="Niger">Niger</option>
   <option value="Nigeria">Nigeria</option>
   <option value="Niue">Niue</option>
   <option value="Norfolk Island">Norfolk Island</option>
   <option value="Norway">Norway</option>
   <option value="Oman">Oman</option>
   <option value="Pakistan">Pakistan</option>
   <option value="Palau Island">Palau Island</option>
   <option value="Palestine">Palestine</option>
   <option value="Panama">Panama</option>
   <option value="Papua New Guinea">Papua New Guinea</option>
   <option value="Paraguay">Paraguay</option>
   <option value="Peru">Peru</option>
   <option value="Phillipines">Philippines</option>
   <option value="Pitcairn Island">Pitcairn Island</option>
   <option value="Poland">Poland</option>
   <option value="Portugal">Portugal</option>
   <option value="Puerto Rico">Puerto Rico</option>
   <option value="Qatar">Qatar</option>
   <option value="Republic of Montenegro">Republic of Montenegro</option>
   <option value="Republic of Serbia">Republic of Serbia</option>
   <option value="Reunion">Reunion</option>
   <option value="Romania">Romania</option>
   <option value="Russia">Russia</option>
   <option value="Rwanda">Rwanda</option>
   <option value="St Barthelemy">St Barthelemy</option>
   <option value="St Eustatius">St Eustatius</option>
   <option value="St Helena">St Helena</option>
   <option value="St Kitts-Nevis">St Kitts-Nevis</option>
   <option value="St Lucia">St Lucia</option>
   <option value="St Maarten">St Maarten</option>
   <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
   <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
   <option value="Saipan">Saipan</option>
   <option value="Samoa">Samoa</option>
   <option value="Samoa American">Samoa American</option>
   <option value="San Marino">San Marino</option>
   <option value="Sao Tome & Principe">Sao Tome & Principe</option>
   <option value="Saudi Arabia">Saudi Arabia</option>
   <option value="Senegal">Senegal</option>
   <option value="Seychelles">Seychelles</option>
   <option value="Sierra Leone">Sierra Leone</option>
   <option value="Singapore">Singapore</option>
   <option value="Slovakia">Slovakia</option>
   <option value="Slovenia">Slovenia</option>
   <option value="Solomon Islands">Solomon Islands</option>
   <option value="Somalia">Somalia</option>
   <option value="South Africa">South Africa</option>
   <option value="Spain">Spain</option>
   <option value="Sri Lanka">Sri Lanka</option>
   <option value="Sudan">Sudan</option>
   <option value="Suriname">Suriname</option>
   <option value="Swaziland">Swaziland</option>
   <option value="Sweden">Sweden</option>
   <option value="Switzerland">Switzerland</option>
   <option value="Syria">Syria</option>
   <option value="Tahiti">Tahiti</option>
   <option value="Taiwan">Taiwan</option>
   <option value="Tajikistan">Tajikistan</option>
   <option value="Tanzania">Tanzania</option>
   <option value="Thailand">Thailand</option>
   <option value="Togo">Togo</option>
   <option value="Tokelau">Tokelau</option>
   <option value="Tonga">Tonga</option>
   <option value="Trinidad & Tobago">Trinidad & Tobago</option>
   <option value="Tunisia">Tunisia</option>
   <option value="Turkey">Turkey</option>
   <option value="Turkmenistan">Turkmenistan</option>
   <option value="Turks & Caicos Is">Turks & Caicos Is</option>
   <option value="Tuvalu">Tuvalu</option>
   <option value="Uganda">Uganda</option>
   <option value="United Kingdom">United Kingdom</option>
   <option value="Ukraine">Ukraine</option>
   <option value="United Arab Erimates">United Arab Emirates</option>
   <option value="United States of America">United States of America</option>
   <option value="Uraguay">Uruguay</option>
   <option value="Uzbekistan">Uzbekistan</option>
   <option value="Vanuatu">Vanuatu</option>
   <option value="Vatican City State">Vatican City State</option>
   <option value="Venezuela">Venezuela</option>
   <option value="Vietnam">Vietnam</option>
   <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
   <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
   <option value="Wake Island">Wake Island</option>
   <option value="Wallis & Futana Is">Wallis & Futana Is</option>
   <option value="Yemen">Yemen</option>
   <option value="Zaire">Zaire</option>
   <option value="Zambia">Zambia</option>
   <option value="Zimbabwe">Zimbabwe</option>
</select>

                                                        </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                            <div class="form-group" style="border-bottom: 2px solid #a1afd3;">
                                                            <label for="input-email">Routing number*</label>
                                                            <input type="text" class="input-field" id="input-email" name="routing" placeholder="Enter Routing number*" value="" required>
                                                        </div>
                                                            </div>
                                                            -->
                                                        </div>


<div style="float:right" class="col-lg-4 ">
                                                        <div class="form-group" >
                                                            <button style="width:30;margin-top:10px" type="btn" class="wagerbtn">Claim</button>
                                                        </div></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- SignIn Area End -->
    </section>
    <section class="user-profile-area-details" id="dashboard-payment-history-details">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-lg-10">
<div class="row">
    <div class="col-lg-12" style="height:50vh;overflow:auto">
    <div class="responsive-table">
                        <table class="table" style="color:#a1afd3">
                            <thead>
                            <tr>
                                <th style="border-top:none" scope="col">TYPE</th>
                                <th style="border-top:none" scope="col">TOURNAMENT/BOMB COINS</th>
                                <th style="border-top:none" scope="col">AMOUNT</th>
                                <th style="border-top:none" scope="col">DATE</th>
                            </tr>
                            </thead>
                            <tbody >
                                        <tr style="bordor-bottom:3px solid #a1afd3">
                                            <td>
                                                104
                                            </td>
                                            <td>
                                                <h4 class="dashboard-table-text">Warzone/<span class="dashboard-span">1700.00</span></h4>
                                            </td>
                                            <td>
                                            <span class="dashboard-span">1700.00</span>
                                            </td>
                                            <td>
                                            <span class="dashboard-span">00/00/00</span>
                                            </td>
                                        </tr>


                            </tbody>
                        </table>
                    </div>
    </div>
</div>
            </div>
        </div>

    </div>
    </section>
    <section class="user-profile-area-details" id="dashboard-payment-method-details">
    <div class="container">
    <div class="row justify-content-center">
            <div class="col-lg-6">
<div class="row">
    <div class="col-lg-10">
        <h4 class="payment-method-text">Visa Debit</h4>
        <h4 class="payment-method-text">**** **** **** 0011</h4>
        <h4 class="payment-method-text">Nicolas Francisco G Valdes</h4>
        <h4 class="payment-method-text">Loyds, US</h4>

    </div>
    <div class="col-lg-2 ">
    <br><br><br><br>
    <a style="color:#bf1438; " href="">Delete</a>
    </div>
    <hr>
</div>
<div class="row">
    <div class="col-lg-10">
        <h4 class="payment-method-text">Visa Debit</h4>
        <h4 class="payment-method-text">**** **** **** 0011</h4>
        <h4 class="payment-method-text">Nicolas Francisco G Valdes</h4>
        <h4 class="payment-method-text">Loyds, US</h4>

    </div>
    <div class="col-lg-2 ">
    <br><br><br><br>
    <a style="color:#bf1438;" href="">Delete</a>
    </div>
    <hr>

</div>
<div class="row justify-content-end">
        <div class="col-lg-4 ">
        <button style="width:30;margin-top:10px" type="btn" class="mybtn-dashboard">ADD+</button>
        </div>
    </div>
            </div>

        </div>
    </div>
    </section>
    <section class="user-profile-area-details" id="dashboard-tournaments-history-details">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-lg-10">
<div class="row">
    <div class="col-lg-12" style="height:50vh;overflow:auto">
    <div class="responsive-table">
                        <table class="table" style="color:#a1afd3">
                            <thead>
                            <tr>
                                <th style="border-top:none" scope="col">PLACE</th>
                                <th style="border-top:none" scope="col">GAME</th>
                                <th style="border-top:none" scope="col">ACCESSED DATE</th>
                                <th style="border-top:none" scope="col">WL</th>
                                <th style="border-top:none" scope="col">WR</th>
                            </tr>
                            </thead>
                            <tbody >
                                        <tr style="bordor-bottom:3px solid #a1afd3">
                                            <td>
                                                104
                                            </td>
                                            <td>
                                                <h4 class="dashboard-table-text">Warzone</h4>
                                            </td>
                                            <td>
                                            <span class="dashboard-span">00/00/00</span>
                                            </td>
                                            <td>
                                            <span class="dashboard-span">1700.00</span>
                                            </td>
                                            <td>
                                            <span class="dashboard-span">1700.00</span>
                                            </td>
                                        </tr>


                            </tbody>
                        </table>
                    </div>
    </div>
</div>
            </div>
        </div>

    </div>
    </section>
    <section class="user-profile-area-details" id="dashboard-tournaments-active-details">
    active tournaments
    </section>
    <section class="user-profile-area-details" id="dashboard-teams-details">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-lg-10">
<div class="row">
    <div class="col-lg-12" style="height:50vh;overflow:auto">
    <div class="responsive-table">
                        <table class="table" style="color:#a1afd3">
                            <thead>
                            <tr>
                                <th style="border-top:none" scope="col">TEAM</th>
                                <th style="border-top:none" scope="col">GAME</th>
                                <th style="border-top:none" scope="col">SIZE</th>
                                <th style="border-top:none" scope="col"></th>
                                <th style="border-top:none" scope="col"></th>
                            </tr>
                            </thead>
                            <tbody >
                                        <tr style="bordor-bottom:3px solid #a1afd3">
                                            <td>
                                            <h4 class="dashboard-table-text">Air racer</h4>
                                            </td>
                                            <td>
                                                <h4 class="dashboard-table-text">Warzone</h4>
                                            </td>
                                            <td>
                                            <span class="dashboard-table-span">03</span>
                                            </td>
                                            <td>
                                            <span class="dashboard-table-span">Modify</span>
                                            </td>
                                            <td>
                                            <span class="dashboard-table-span text-right">Invite a player</span>
                                            </td>

                                        </tr>
                                        <tr style="bordor-bottom:3px solid #a1afd3">
                                            <td>
                                            <h4 class="dashboard-table-text">Air racer</h4>
                                            </td>
                                            <td>
                                                <h4 class="dashboard-table-text">Warzone</h4>
                                            </td>
                                            <td>
                                            <span class="dashboard-table-span">03</span>
                                            </td>
                                            <td>
                                            <span class="dashboard-table-span">Modify</span>
                                            </td>
                                            <td>
                                            <span class="dashboard-table-span text-right">Invite a player</span>
                                            </td>

                                        </tr>


                            </tbody>
                        </table>
                    </div>
                    <button style="width:auto;padding: 0px 20px 0px 20px;margin-left:700px" type="button" class="btn wagerbtn" data-toggle="modal" data-target="#craete-team" >Create Team</button>
    </div>
</div>
            </div>
        </div>

    </div>
    </section>
    <!-- user dashbaord ends-->
    <!---- user dashboard popups starts----->
    <!---- create team section starts------->
    <div class="modal fade login-modal" id="craete-team" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <!--<button type="button" id="close_icon" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
            <div class="modal-body">
               <!-- <div class="logo-area">
                    <img class="logo" src="assets/images/logo.png" alt="">
                </div>-->
                <div class="form-area">
                    <form>
                        {{csrf_field()}}


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" style="border-bottom:1px solid #a1afd3;margin-bottom:13px">
                                    <label for="input-name">Team name*</label>
                                    <input type="text" name="name" class="oppo input-field" id="input-name"  placeholder="Enter your team name" required>
                                </div>
                                    <div class="form-group" style="border-bottom:1px solid #a1afd3;margin-bottom:13px">
                                    <label class="same_team" for="input-name">Game*</label>
                                    <input type="text" name="name" class="same same_team input-field" id="input-name"  placeholder="select a game" required>
                                </div>
                                    <div class="form-group">
                                    <label class="same_team" for="input-name">Team size*</label>
                                    <input type="text" name="name" class="same same_team input-field" id="input-name"  placeholder="select team size" required>
                                </div>
                            </div>


                        </div>

                       <div class="form-group">
                        <!--<button data-dismiss="modal" id="close_icon" type="" class="mybtn1">OK</button>-->
                        <button onclick="" style="width:auto;padding: 0px 20px 0px 20px;margin-left:47%" id="" type="" class="wagerbtn">Create Team</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!---- create team section ends------->
<!---- create team section starts------->
    <!---- user dashboard popups ends----->
        <div class="subscribe-area" style="display: none;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="subscribe-box">
                        <form action="#">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="heading-area">
                                        <h5 class="sub-title">
                                            subscribe to Fortnite
                                        </h5>
                                        <h4 class="title">
                                            To Get Exclusive Benefits
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-4 d-flex align-self-center">
                                    <div class="icon">
                                        <img src="assets/images/mail-box.png" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-8 d-flex align-self-center">
                                    <div class="form-area">
                                        <input type="text" placeholder="Your Email Address">
                                    </div>
                                </div>
                                <div class="col-lg-3 d-flex align-self-center">
                                    <div class="button-area">
                                        <button class="mybtn1" type="submit">Subscribe
                                            <span><i class="fas fa-paper-plane"></i></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--<section class="dashboard">
        <div class="info-table">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-box">
                            <div class="row">
                                <div class="col-lg-4 side_bar"></div>
                                <div class="col-lg-8 main_menu"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>-->

    <!-- faq-section start -->
    <section class="faq-section " style="padding-bottom:100%;display:none">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="section-heading">
                        <!--<h5 class="subtitle">
                            Fortnite
                        </h5>-->
                        <!--<small>{{$user->total_points}} points </small>-->

                        <h2 class="title">
                            Dashboard
                        </h2>
                        <p class="text">
                            Welcome to Your dashboard. Here you can customise your profile, view current and previous tournaments, edit payment options and withdraw earnings through your preferred methods.
                        </p>
                    </div>
                </div>
            </div>
               	<!-- Dashbaord head Area Start -->
	<footer class="footer" id="footer" style="padding-top:0px">
			<div class="subscribe-area">
				<div class="container ">
					<div class="row" style="">
						<div class="col-lg-12">
							<div class="subscribe-boxe" >
									<form action="#">
								<div class="row justify-content-between">
									<div class="col-lg-12">

										<!--<div class="heading-area">
												<h5 class="sub-title">
														subscribe to Dooplo
												</h5>
												<h4 class="title">
														To Get Exclusive Benefits
												</h4>
										</div>-->
									</div>
									<!--<div class="col-lg-3 col-4 d-flex align-self-center">
										<div class="icon">
											<img src="assets/images/mail-box.png" alt="">
										</div>
									</div>
									<div class="col-lg-6 col-8 d-flex align-self-center">
										<div class="form-area">
												<input type="text" placeholder="Your Email Address">
										</div>
									</div>-->
									<div class="col-lg-4 d-flex align-self-center">




                            <div class="top-area">
                                <img  style="width:100px;height:100px;border-radius:200px;margin-left:60%;margin-top:15%"  src="{{url('/storage/'.$user->image)}}" onerror="this.onerror=null; this.src='assets/images/affiliate/ps1.png'" class="img-thumbnail" alt="Profile Picture">
                            <div class="left">

                                <h4 class="name" style="padding-top:10px;padding-left:80%">
                                    {{$user->name}}
                                </h4>

                            </div>

                            </div>
                            <div class="bottom-area"style="padding-top:20px">
                                <div class="left" >

                                </div>

                            </div>

                                       	<!-- Affiliate Process area Start -->
										<!--<div class="button-area">
											<button class="mybtn1" type="submit">Subscribe
												<span><i class="fas fa-paper-plane"></i></span>
											</button>
										</div>-->
									</div>




                                    <p class="date">
                                    <p style="margin-top:30px;margin-left:30px"><img src="assets/images/awards/ic4.png"  style="width=20px">	&nbsp;Total Points : {{$user->total_points}}</p>

                                    </p>
                                    <p class="date" style="padding-top:30px">
                                    <p style="margin-top:30px;margin-left:30px"><img src="assets/images/awards/ic2.png"  style="width=20px">	&nbsp;Total Bomb :<i class="fas fa-coins"></i> {{$user->total_prize}}</p>

                                    </p>

								</div>
							</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--<div class="container">
				<div class="row">
					<div class="col-sm-6 col-lg-3">
						<div class="footer-widget info-link-widget">
							<h4 class="title">
								About
							</h4>
							<ul class="link-list">
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>	About Us
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>	Contact Us
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>	Latest Blog
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>	Authenticity Guarantee
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>	Customer Reviews
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>	Privacy Policy

									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6 col-lg-3">
						<div class="footer-widget info-link-widget">
							<h4 class="title">
								My Account
							</h4>
							<ul class="link-list">
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i> Manage Your Account
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i> How to Deposit
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i> How to Withdraw
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i> Account Varification
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i> Safety & Security
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i> Membership Level

									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6 col-lg-3">
						<div class="footer-widget info-link-widget">
							<h4 class="title">
								help center
							</h4>
							<ul class="link-list">
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>Help centre
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>FAQ
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>Quick Start Guide
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>Tutorials
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>Borrow
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>Lend

									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6 col-lg-3">
						<div class="footer-widget info-link-widget">
							<h4 class="title">
								Legal Info
							</h4>
							<ul class="link-list">
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>Risk Warnings
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>Privacy Notice
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>Security
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>Terms of Service
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>Become Affiliate
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-angle-double-right"></i>Complaints Policy

									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>-->
			<!--<div class="copy-bg">
				<div class="container">
					<div class="row">
						<div class="col-lg-5">
							<div class="left-area">
								<p>Copyright © 2019.All Rights Reserved By <a href="#">Dooplo</a>
								</p>
							</div>
						</div>
						<div class="col-lg-7">
							<ul class="copright-area-links">
								<li>
									<a href="#">Terms Of Use</a>
								</li>
								<li>
									<a href="#">Privacy Policy</a>
								</li>
								<li>
									<a href="#">Gamble</a>
								</li>
								<li>
									<a href="#">Aware</a>
								</li>
								<li>
									<a href="#">Help Cente</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>-->
            <p class="date">

		</footer>
	<!-- dashboard head Area End -->
            <div class="row ">

                <div class="col-lg-3">
                    <div class="faq-wrapper" >
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a style="width: 251.891px;margin-left:23px;text-align: center;" class="nav-link active" id="ticket-tab" data-toggle="tab" href="#ticket" role="tab" aria-controls="ticket" aria-selected="true">Edit Profile</a>
                            </li>
                            <li class="nav-item">
                                <a style="width: 251.891px;margin-left:23px;text-align: center;" class="nav-link" id="image-tab" data-toggle="tab" href="#image" role="tab" aria-controls="image" aria-selected="false">Profile Picture</a>
                            </li>
                            <li class="nav-item">
                                <a style="width: 251.891px;margin-left:23px;text-align: center;"class="nav-link" id="banking-tab" data-toggle="tab" href="#banking" role="tab" aria-controls="banking" aria-selected="false">Payment History</a>
                            </li>
                            <li class="nav-item">
                                <a style="width: 251.891px;margin-left:23px;text-align: center;"class="nav-link" id="tournaments-tab" data-toggle="tab" href="#tournaments" role="tab" aria-controls="tournaments" aria-selected="false">Tournament history</a>
                            </li>
                            <li class="nav-item">
                                <a style="width: 251.891px;margin-left:23px;text-align: center;"class="nav-link " id="results-tab" data-toggle="tab" href="#results" role="tab" aria-controls="results" aria-selected="false">Active Tournaments</a>
                            </li>
                            <li class="nav-item">
                                <a style="width: 251.891px;margin-left:23px;text-align: center;"class="nav-link " id="cash-withdrawal-tab" data-toggle="tab" href="#cash-withdrawal" role="tab" aria-controls="cash-withdrawal" aria-selected="false">Cash withdrawal</a>
                            </li>
                            <!--<li class="nav-item">
                            <a class="nav-link" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="false">About JeUgo</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="false">general</a>
                            </li>-->
                        </ul>
                        <!--<div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade" id="ticket" role="tabpanel" aria-labelledby="ticket-tab">
                            <div class="accordion sorteo-accordion" id="accordionExample">
                                <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-question"></i> What is the meaning of business with example?</button>
                                    </h2>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                    <p>scelerisque consectetuer ac a at nunc, in lectus. Ut lectus erat. Sit praesent tellus, ac eget pede risus, urna ante nec tincidunt vel, tincidunt tortor sit lacinia. Enim massa in, porttitor felis justo, aenean habitant velit nunc, maecenas eget magna viverra imperdiet magna tincidunt. Lacinia eleifend luctus ante fermentum, lectus faucibus mi id, orci congue, amet donec erat nisl vestibulum. Ut ac luctus semper curabitur ipsum, odio pretium nec interdum tellus urna.</p>
                                    </div>
                                </div>
                                </div>
                                <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-question"></i> What is a business simple definition?</button>
                                    </h2>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                    </div>
                                </div>
                                </div>
                                <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="fa fa-question"></i> how to payment?</button>
                                    </h2>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                    </div>
                                </div>
                                </div>
                                <div class="card">
                                <div class="card-header" id="headingFour">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"><i class="fa fa-question"></i> why we are best for digital agency</button>
                                    </h2>
                                </div>
                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                    <div class="card-body">
                                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                            <div class="tab-pane fade" id="banking" role="tabpanel" aria-labelledby="banking-tab">
                            <div class="accordion sorteo-accordion" id="accordionExample2">
                                <div class="card">
                                <div class="card-header" id="headingFive">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive"><i class="fa fa-question"></i> What is the meaning of business with example?</button>
                                    </h2>
                                </div>
                                <div id="collapseFive" class="collapse show" aria-labelledby="headingFive" data-parent="#accordionExample2">
                                    <div class="card-body">
                                    <p>scelerisque consectetuer ac a at nunc, in lectus. Ut lectus erat. Sit praesent tellus, ac eget pede risus, urna ante nec tincidunt vel, tincidunt tortor sit lacinia. Enim massa in, porttitor felis justo, aenean habitant velit nunc, maecenas eget magna viverra imperdiet magna tincidunt. Lacinia eleifend luctus ante fermentum, lectus faucibus mi id, orci congue, amet donec erat nisl vestibulum. Ut ac luctus semper curabitur ipsum, odio pretium nec interdum tellus urna.</p>
                                    </div>
                                </div>
                                </div>
                                <div class="card">
                                <div class="card-header" id="headingSix">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix"><i class="fa fa-question"></i> What is a business simple definition?</button>
                                    </h2>
                                </div>
                                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample2">
                                    <div class="card-body">
                                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                            <div class="tab-pane fade" id="winning" role="tabpanel" aria-labelledby="winning-tab">
                            <div class="accordion sorteo-accordion" id="accordionExample3">
                                <div class="card">
                                <div class="card-header" id="headingSeven">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven"><i class="fa fa-question"></i> What is the meaning of business with example?</button>
                                    </h2>
                                </div>
                                <div id="collapseSeven" class="collapse show" aria-labelledby="headingSeven" data-parent="#accordionExample3">
                                    <div class="card-body">
                                    <p>scelerisque consectetuer ac a at nunc, in lectus. Ut lectus erat. Sit praesent tellus, ac eget pede risus, urna ante nec tincidunt vel, tincidunt tortor sit lacinia. Enim massa in, porttitor felis justo, aenean habitant velit nunc, maecenas eget magna viverra imperdiet magna tincidunt. Lacinia eleifend luctus ante fermentum, lectus faucibus mi id, orci congue, amet donec erat nisl vestibulum. Ut ac luctus semper curabitur ipsum, odio pretium nec interdum tellus urna.</p>
                                    </div>
                                </div>
                                </div>
                                <div class="card">
                                <div class="card-header" id="headingEight">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight"><i class="fa fa-question"></i> What is a business simple definition?</button>
                                    </h2>
                                </div>
                                <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample3">
                                    <div class="card-body">
                                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                            <div class="tab-pane fade show active" id="results" role="tabpanel" aria-labelledby="results-tab">
                            <div class="accordion sorteo-accordion" id="accordionExample4">
                                <div class="card">
                                <div class="card-header" id="headingNine">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine"><i class="fa fa-question"></i>What are lottery results alerts?</button>
                                    </h2>
                                </div>
                                <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample4">
                                    <div class="card-body">
                                    <p>scelerisque consectetuer ac a at nunc, in lectus. Ut lectus erat. Sit praesent tellus, ac eget pede risus, urna ante nec tincidunt vel, tincidunt tortor sit lacinia. Enim massa in, porttitor felis justo, aenean habitant velit nunc, maecenas eget magna viverra imperdiet magna tincidunt. Lacinia eleifend luctus ante fermentum, lectus faucibus mi id, orci congue, amet donec erat nisl vestibulum. Ut ac luctus semper curabitur ipsum, odio pretium nec interdum tellus urna.</p>
                                    </div>
                                </div>
                                </div>
                                <div class="card">
                                <div class="card-header" id="headingTen">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen"><i class="fa fa-question"></i>What are jackpot alerts?</button>
                                    </h2>
                                </div>
                                <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordionExample4">
                                    <div class="card-body">
                                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                    </div>
                                </div>
                                </div>
                                <div class="card">
                                <div class="card-header" id="heading11">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse11" aria-expanded="true" aria-controls="collapse11"><i class="fa fa-question"></i>How do I sign up to receive SMS winning alerts?</button>
                                    </h2>
                                </div>
                                <div id="collapse11" class="collapse show" aria-labelledby="heading11" data-parent="#accordionExample4">
                                    <div class="card-body">
                                    <p>To subscribe to FREE SMS winning alerts, please fill in your mobile phone number in the 'SMS Number' field in the Notification settings and save the changes. To unsubscribe, please uncheck the box next to the 'SMS Number' field and save the changes.</p>
                                    </div>
                                </div>
                                </div>
                                <div class="card">
                                <div class="card-header" id="heading12">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse12" aria-expanded="false" aria-controls="collapse12"><i class="fa fa-question"></i>When are lottery results updated on the site?</button>
                                    </h2>
                                </div>
                                <div id="collapse12" class="collapse" aria-labelledby="heading12" data-parent="#accordionExample4">
                                    <div class="card-body">
                                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                    </div>
                                </div>
                                </div>
                                <div class="card">
                                <div class="card-header" id="heading13">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse13" aria-expanded="false" aria-controls="collapse13"><i class="fa fa-question"></i>How do I read the lottery results?</button>
                                    </h2>
                                </div>
                                <div id="collapse13" class="collapse" aria-labelledby="heading13" data-parent="#accordionExample4">
                                    <div class="card-body">
                                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                            <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
                            <div class="accordion sorteo-accordion" id="accordionExample5">
                                <div class="card">
                                <div class="card-header" id="heading14">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse14" aria-expanded="true" aria-controls="collapse14"><i class="fa fa-question"></i> What is the meaning of business with example?</button>
                                    </h2>
                                </div>
                                <div id="collapse14" class="collapse show" aria-labelledby="heading14" data-parent="#accordionExample5">
                                    <div class="card-body">
                                    <p>scelerisque consectetuer ac a at nunc, in lectus. Ut lectus erat. Sit praesent tellus, ac eget pede risus, urna ante nec tincidunt vel, tincidunt tortor sit lacinia. Enim massa in, porttitor felis justo, aenean habitant velit nunc, maecenas eget magna viverra imperdiet magna tincidunt. Lacinia eleifend luctus ante fermentum, lectus faucibus mi id, orci congue, amet donec erat nisl vestibulum. Ut ac luctus semper curabitur ipsum, odio pretium nec interdum tellus urna.</p>
                                    </div>
                                </div>
                                </div>
                                <div class="card">
                                <div class="card-header" id="heading15">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse15" aria-expanded="false" aria-controls="collapse15"><i class="fa fa-question"></i> What is a business simple definition?</button>
                                    </h2>
                                </div>
                                <div id="collapse15" class="collapse" aria-labelledby="heading15" data-parent="#accordionExample5">
                                    <div class="card-body">
                                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                            <div class="tab-pane fade" id="general" role="tabpanel" aria-labelledby="general-tab">
                            <div class="accordion sorteo-accordion" id="accordionExample6">
                                <div class="card">
                                <div class="card-header" id="heading16">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse16" aria-expanded="true" aria-controls="collapse16"><i class="fa fa-question"></i>What is the meaning of business with example?</button>
                                    </h2>
                                </div>
                                <div id="collapse16" class="collapse show" aria-labelledby="heading16" data-parent="#accordionExample6">
                                    <div class="card-body">
                                    <p>scelerisque consectetuer ac a at nunc, in lectus. Ut lectus erat. Sit praesent tellus, ac eget pede risus, urna ante nec tincidunt vel, tincidunt tortor sit lacinia. Enim massa in, porttitor felis justo, aenean habitant velit nunc, maecenas eget magna viverra imperdiet magna tincidunt. Lacinia eleifend luctus ante fermentum, lectus faucibus mi id, orci congue, amet donec erat nisl vestibulum. Ut ac luctus semper curabitur ipsum, odio pretium nec interdum tellus urna.</p>
                                    </div>
                                </div>
                                </div>
                                <div class="card">
                                <div class="card-header" id="heading17">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse17" aria-expanded="false" aria-controls="collapse17"><i class="fa fa-question"></i> What is a business simple definition?</button>
                                    </h2>
                                </div>
                                <div id="collapse17" class="collapse" aria-labelledby="heading17" data-parent="#accordionExample6">
                                    <div class="card-body">
                                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>-->
                    </div>

                </div>
                <div class="col-lg-9">
                    <div class="faq-wrapper" style="background-color:#070b28;max-height:650px">

                        <ul class="nav nav-tas" id="myTab" role="tablist">
                            <!--<<li class="nav-item">
                            <a class="nav-link" id="ticket-tab" data-toggle="tab" href="#ticket" role="tab" aria-controls="ticket" aria-selected="false">Cryptogames</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" id="banking-tab" data-toggle="tab" href="#banking" role="tab" aria-controls="banking" aria-selected="false">banking</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" id="winning-tab" data-toggle="tab" href="#winning" role="tab" aria-controls="winning" aria-selected="false">winning</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link active" id="results-tab" data-toggle="tab" href="#results" role="tab" aria-controls="results" aria-selected="true">results & alerts</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="false">About JeUgo</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="false">general</a>
                            </li>-->
                        </ul><div style="background-color:#252f5a;border-radius:10px;max-width:760px;margin-left:40px;height:620px;overflow: scroll;">
                        <div class="tab-content dashboard-box" id="myTabContent" style="padding: 0 15px">

                            <div class="tab-pane fade active show" id="ticket" role="tabpanel" aria-labelledby="ticket-tab">

                                <!---->
                                <!-- SignIn Area Start -->
                                <div class="login-modal sign-in">
                                    <div class="modal-dialog" role="document" style="max-width:740px">
                                        <div class="modal-content">
                                            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                                            <div class="modal-body" style="max-width:700px">
                                                <!--<div class="logo-area">
                                                        <img class="logo" src="assets/images/logo.png" alt="">
                                                </div>-->
                                                <div class="header-area">
                                                   <centre> <h4 class="title">Great to have you back!</h4>
                                                    <p class="sub-title">Enter your details below.</p></centre>
                                                </div>
                                                <div class="form-area">
                                                    <form method="POST">
                                                        @method("put")
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="input-name">Name*</label>
                                                            <input type="text" class="input-field" id="input-name" name="name" placeholder="Enter your Name" value="{{$user->name}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="input-email">Email*</label>
                                                            <input type="email" class="input-field" id="input-email" name="email" placeholder="Enter your Email" value="{{$user->email}}" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="input-password">Current Password*</label>
                                                            <input type="password" class="input-field" id="input-password" name="password" placeholder="Enter your password" value="">
                                                        </div>
                                                        {{--								<div class="form-group">--}}
                                                        {{--										<label for="input-password">New Password</label>--}}
                                                        {{--										<input type="password" class="input-field" id="input-password"  placeholder="Enter your password" value="">--}}
                                                        {{--								</div>--}}
                                                        {{--								<div class="form-group">--}}
                                                        {{--										<label for="input-con-password">Confirm password</label>--}}
                                                        {{--										<input type="password" class="input-field" id="input-con-password"  placeholder="Enter your Confirm Password" value="">--}}
                                                        {{--								</div>--}}
                                                    <!--<div class="form-group">
										<select>
											<option value="0">BTC</option>
											<option value="1">USD</option>
											<option value="2">EUR</option>
										</select>
								</div>-->
                                                        {{--								<div class="form-group">--}}
                                                        {{--									<div class="check-group">--}}
                                                        {{--											<input type="checkbox" class="check-box-field" id="input-terms" checked>--}}
                                                        {{--											<label for="input-terms">--}}
                                                        {{--													I agree with <a href="#">terms and Conditions</a> and  <a href="#">privacy policy</a>--}}
                                                        {{--											</label>--}}
                                                        {{--									</div>--}}
                                                        {{--								</div>--}}
                                                        <div class="form-group">
                                                            <button type="submit" class="mybtn1">Update Profile</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- SignIn Area End -->
                                <!---->
                                <!--<div class="accordion sorteo-accordion" id="accordionExample">
                                    <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-question"></i> What is the meaning of business with example?</button>
                                        </h2>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">
                                        <p>scelerisque consectetuer ac a at nunc, in lectus. Ut lectus erat. Sit praesent tellus, ac eget pede risus, urna ante nec tincidunt vel, tincidunt tortor sit lacinia. Enim massa in, porttitor felis justo, aenean habitant velit nunc, maecenas eget magna viverra imperdiet magna tincidunt. Lacinia eleifend luctus ante fermentum, lectus faucibus mi id, orci congue, amet donec erat nisl vestibulum. Ut ac luctus semper curabitur ipsum, odio pretium nec interdum tellus urna.</p>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h2 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-question"></i> What is a business simple definition?</button>
                                        </h2>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                        <div class="card-body">
                                        <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h2 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="fa fa-question"></i> how to payment?</button>
                                        </h2>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                        <div class="card-body">
                                        <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="card">
                                    <div class="card-header" id="headingFour">
                                        <h2 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"><i class="fa fa-question"></i> why we are best for digital agency</button>
                                        </h2>
                                    </div>
                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                        <div class="card-body">
                                        <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                        </div>
                                    </div>
                                    </div>
                                </div>-->
                            </div>
                            <div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="image-tab" >
                            <br>

                            <center><h3>Choose profile picture</h3></center><br>
                            <div class="inner-table" style="margin-left:10%;margin-right:10%" >
                                    @if (auth()->user()->image)
                                        <div class="row">
                                            <img  style="height:150px !important;"  src="{{url('/storage/'.$user->image)}}" class="img-thumbnail" alt="Profile Picture">
                                        </div>
                                    @endif
                                    <div class="row mt-5">
                                       <form action="{{route("profile.picture")}}" enctype="multipart/form-data" method="post">
                                            @csrf
                                            <div class="form-group">
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input" id="customFile" required>
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                            </div>
                                            <div>
                                                <button class="btn btn-info" type="submit">Upload</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="banking" role="tabpanel" aria-labelledby="banking-tab"><br>
                                <h3 class="text-center">Payment History</h3>
                                <div class="inner-table">
                                    <div class="responsive-table">
                                        <table class="table text-white">
                                            <thead>
                                            <tr>
                                                <th scope="col">Type</th>
                                                <th scope="col">Tournament/Bomb</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col>">Date</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($user->payments as $payment)
                                                <tr>
                                                    <td>{{$payment->name ? "Tournament" : "Bomb"}}</td>
                                                    <td>{{$payment->name ? $payment->name : $payment->bomb}}</td>
                                                    <td>$ {{$payment->amount}}</td>
                                                <td>{{ \Carbon\Carbon::parse($payment->date)->format('d/m/Y')}}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2" class="text-center">No payments</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--Cash Withdrawal start-->
                            <div class="tab-pane fade" id="cash-withdrawal" role="tabpanel" aria-labelledby="cash-withdrawal-tab"><br>
                                <!-- SignIn Area Start -->
                                <div class="login-modal sign-in">
                                    <div class="modal-dialog" role="document" style="max-width:740px;margin-top:-41px">
                                        <div class="modal-content">
                                            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                                            <div class="modal-body" style="max-width:700px">
                                                <!--<div class="logo-area">
                                                        <img class="logo" src="assets/images/logo.png" alt="">
                                                </div>-->
                                                <div class="header-area">
                                                   <centre> <h4 class="title">Great to have you back!</h4>
                                                    <p class="sub-title">Enter your details below.</p></centre>
                                                </div>
                                                <div class="form-area">
                                                    <form method="POST">
                                                        @method("put")
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                            <div class="form-group">
                                                            <label for="input-name">Account number*</label>
                                                            <input type="number" class="input-field" id="input-name" name="name" placeholder="Enter your Account number" value="">
                                                        </div>
                                                            </div>
                                                            <div class="col-md-6">


                                                        <div class="form-group">
                                                            <label for="input-email">Last4*</label>
                                                            <input type="number" class="input-field" id="input-email" name="email" placeholder="Enter Last4*" value="" >
                                                        </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                            <div class="form-group">
                                                            <label for="input-email">Account-holder name*</label>
                                                            <input type="text" class="input-field" id="input-email" name="email" placeholder="Enter Account-holder name*" value="" >
                                                        </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                            <div class="form-group">
                                                            <label for="input-email">Account-holder type*</label>
                                                            <select>
										<option value="0">Individual</option>
										<option value="1">Business</option>

									</select>
                                                        </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                            <div class="form-group">
                                                            <label for="input-email">Bank name*</label>
                                                            <input type="text" class="input-field" id="input-email" name="email" placeholder="Enter Bank name*" value="" >
                                                        </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                            <div class="form-group">
                                                            <label for="input-email">Currency*</label>
                                                            <select>
										<option value="0">USD</option>

									</select>
                                                        </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                            <div class="form-group">
                                                            <label for="input-email">Account-holder type*</label>
                                                            <select id="country" name="country">
   <option value="Afganistan">Afghanistan</option>
   <option value="Albania">Albania</option>
   <option value="Algeria">Algeria</option>
   <option value="American Samoa">American Samoa</option>
   <option value="Andorra">Andorra</option>
   <option value="Angola">Angola</option>
   <option value="Anguilla">Anguilla</option>
   <option value="Antigua & Barbuda">Antigua & Barbuda</option>
   <option value="Argentina">Argentina</option>
   <option value="Armenia">Armenia</option>
   <option value="Aruba">Aruba</option>
   <option value="Australia">Australia</option>
   <option value="Austria">Austria</option>
   <option value="Azerbaijan">Azerbaijan</option>
   <option value="Bahamas">Bahamas</option>
   <option value="Bahrain">Bahrain</option>
   <option value="Bangladesh">Bangladesh</option>
   <option value="Barbados">Barbados</option>
   <option value="Belarus">Belarus</option>
   <option value="Belgium">Belgium</option>
   <option value="Belize">Belize</option>
   <option value="Benin">Benin</option>
   <option value="Bermuda">Bermuda</option>
   <option value="Bhutan">Bhutan</option>
   <option value="Bolivia">Bolivia</option>
   <option value="Bonaire">Bonaire</option>
   <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
   <option value="Botswana">Botswana</option>
   <option value="Brazil">Brazil</option>
   <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
   <option value="Brunei">Brunei</option>
   <option value="Bulgaria">Bulgaria</option>
   <option value="Burkina Faso">Burkina Faso</option>
   <option value="Burundi">Burundi</option>
   <option value="Cambodia">Cambodia</option>
   <option value="Cameroon">Cameroon</option>
   <option value="Canada">Canada</option>
   <option value="Canary Islands">Canary Islands</option>
   <option value="Cape Verde">Cape Verde</option>
   <option value="Cayman Islands">Cayman Islands</option>
   <option value="Central African Republic">Central African Republic</option>
   <option value="Chad">Chad</option>
   <option value="Channel Islands">Channel Islands</option>
   <option value="Chile">Chile</option>
   <option value="China">China</option>
   <option value="Christmas Island">Christmas Island</option>
   <option value="Cocos Island">Cocos Island</option>
   <option value="Colombia">Colombia</option>
   <option value="Comoros">Comoros</option>
   <option value="Congo">Congo</option>
   <option value="Cook Islands">Cook Islands</option>
   <option value="Costa Rica">Costa Rica</option>
   <option value="Cote DIvoire">Cote DIvoire</option>
   <option value="Croatia">Croatia</option>
   <option value="Cuba">Cuba</option>
   <option value="Curaco">Curacao</option>
   <option value="Cyprus">Cyprus</option>
   <option value="Czech Republic">Czech Republic</option>
   <option value="Denmark">Denmark</option>
   <option value="Djibouti">Djibouti</option>
   <option value="Dominica">Dominica</option>
   <option value="Dominican Republic">Dominican Republic</option>
   <option value="East Timor">East Timor</option>
   <option value="Ecuador">Ecuador</option>
   <option value="Egypt">Egypt</option>
   <option value="El Salvador">El Salvador</option>
   <option value="Equatorial Guinea">Equatorial Guinea</option>
   <option value="Eritrea">Eritrea</option>
   <option value="Estonia">Estonia</option>
   <option value="Ethiopia">Ethiopia</option>
   <option value="Falkland Islands">Falkland Islands</option>
   <option value="Faroe Islands">Faroe Islands</option>
   <option value="Fiji">Fiji</option>
   <option value="Finland">Finland</option>
   <option value="France">France</option>
   <option value="French Guiana">French Guiana</option>
   <option value="French Polynesia">French Polynesia</option>
   <option value="French Southern Ter">French Southern Ter</option>
   <option value="Gabon">Gabon</option>
   <option value="Gambia">Gambia</option>
   <option value="Georgia">Georgia</option>
   <option value="Germany">Germany</option>
   <option value="Ghana">Ghana</option>
   <option value="Gibraltar">Gibraltar</option>
   <option value="Great Britain">Great Britain</option>
   <option value="Greece">Greece</option>
   <option value="Greenland">Greenland</option>
   <option value="Grenada">Grenada</option>
   <option value="Guadeloupe">Guadeloupe</option>
   <option value="Guam">Guam</option>
   <option value="Guatemala">Guatemala</option>
   <option value="Guinea">Guinea</option>
   <option value="Guyana">Guyana</option>
   <option value="Haiti">Haiti</option>
   <option value="Hawaii">Hawaii</option>
   <option value="Honduras">Honduras</option>
   <option value="Hong Kong">Hong Kong</option>
   <option value="Hungary">Hungary</option>
   <option value="Iceland">Iceland</option>
   <option value="Indonesia">Indonesia</option>
   <option value="India">India</option>
   <option value="Iran">Iran</option>
   <option value="Iraq">Iraq</option>
   <option value="Ireland">Ireland</option>
   <option value="Isle of Man">Isle of Man</option>
   <option value="Israel">Israel</option>
   <option value="Italy">Italy</option>
   <option value="Jamaica">Jamaica</option>
   <option value="Japan">Japan</option>
   <option value="Jordan">Jordan</option>
   <option value="Kazakhstan">Kazakhstan</option>
   <option value="Kenya">Kenya</option>
   <option value="Kiribati">Kiribati</option>
   <option value="Korea North">Korea North</option>
   <option value="Korea Sout">Korea South</option>
   <option value="Kuwait">Kuwait</option>
   <option value="Kyrgyzstan">Kyrgyzstan</option>
   <option value="Laos">Laos</option>
   <option value="Latvia">Latvia</option>
   <option value="Lebanon">Lebanon</option>
   <option value="Lesotho">Lesotho</option>
   <option value="Liberia">Liberia</option>
   <option value="Libya">Libya</option>
   <option value="Liechtenstein">Liechtenstein</option>
   <option value="Lithuania">Lithuania</option>
   <option value="Luxembourg">Luxembourg</option>
   <option value="Macau">Macau</option>
   <option value="Macedonia">Macedonia</option>
   <option value="Madagascar">Madagascar</option>
   <option value="Malaysia">Malaysia</option>
   <option value="Malawi">Malawi</option>
   <option value="Maldives">Maldives</option>
   <option value="Mali">Mali</option>
   <option value="Malta">Malta</option>
   <option value="Marshall Islands">Marshall Islands</option>
   <option value="Martinique">Martinique</option>
   <option value="Mauritania">Mauritania</option>
   <option value="Mauritius">Mauritius</option>
   <option value="Mayotte">Mayotte</option>
   <option value="Mexico">Mexico</option>
   <option value="Midway Islands">Midway Islands</option>
   <option value="Moldova">Moldova</option>
   <option value="Monaco">Monaco</option>
   <option value="Mongolia">Mongolia</option>
   <option value="Montserrat">Montserrat</option>
   <option value="Morocco">Morocco</option>
   <option value="Mozambique">Mozambique</option>
   <option value="Myanmar">Myanmar</option>
   <option value="Nambia">Nambia</option>
   <option value="Nauru">Nauru</option>
   <option value="Nepal">Nepal</option>
   <option value="Netherland Antilles">Netherland Antilles</option>
   <option value="Netherlands">Netherlands (Holland, Europe)</option>
   <option value="Nevis">Nevis</option>
   <option value="New Caledonia">New Caledonia</option>
   <option value="New Zealand">New Zealand</option>
   <option value="Nicaragua">Nicaragua</option>
   <option value="Niger">Niger</option>
   <option value="Nigeria">Nigeria</option>
   <option value="Niue">Niue</option>
   <option value="Norfolk Island">Norfolk Island</option>
   <option value="Norway">Norway</option>
   <option value="Oman">Oman</option>
   <option value="Pakistan">Pakistan</option>
   <option value="Palau Island">Palau Island</option>
   <option value="Palestine">Palestine</option>
   <option value="Panama">Panama</option>
   <option value="Papua New Guinea">Papua New Guinea</option>
   <option value="Paraguay">Paraguay</option>
   <option value="Peru">Peru</option>
   <option value="Phillipines">Philippines</option>
   <option value="Pitcairn Island">Pitcairn Island</option>
   <option value="Poland">Poland</option>
   <option value="Portugal">Portugal</option>
   <option value="Puerto Rico">Puerto Rico</option>
   <option value="Qatar">Qatar</option>
   <option value="Republic of Montenegro">Republic of Montenegro</option>
   <option value="Republic of Serbia">Republic of Serbia</option>
   <option value="Reunion">Reunion</option>
   <option value="Romania">Romania</option>
   <option value="Russia">Russia</option>
   <option value="Rwanda">Rwanda</option>
   <option value="St Barthelemy">St Barthelemy</option>
   <option value="St Eustatius">St Eustatius</option>
   <option value="St Helena">St Helena</option>
   <option value="St Kitts-Nevis">St Kitts-Nevis</option>
   <option value="St Lucia">St Lucia</option>
   <option value="St Maarten">St Maarten</option>
   <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
   <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
   <option value="Saipan">Saipan</option>
   <option value="Samoa">Samoa</option>
   <option value="Samoa American">Samoa American</option>
   <option value="San Marino">San Marino</option>
   <option value="Sao Tome & Principe">Sao Tome & Principe</option>
   <option value="Saudi Arabia">Saudi Arabia</option>
   <option value="Senegal">Senegal</option>
   <option value="Seychelles">Seychelles</option>
   <option value="Sierra Leone">Sierra Leone</option>
   <option value="Singapore">Singapore</option>
   <option value="Slovakia">Slovakia</option>
   <option value="Slovenia">Slovenia</option>
   <option value="Solomon Islands">Solomon Islands</option>
   <option value="Somalia">Somalia</option>
   <option value="South Africa">South Africa</option>
   <option value="Spain">Spain</option>
   <option value="Sri Lanka">Sri Lanka</option>
   <option value="Sudan">Sudan</option>
   <option value="Suriname">Suriname</option>
   <option value="Swaziland">Swaziland</option>
   <option value="Sweden">Sweden</option>
   <option value="Switzerland">Switzerland</option>
   <option value="Syria">Syria</option>
   <option value="Tahiti">Tahiti</option>
   <option value="Taiwan">Taiwan</option>
   <option value="Tajikistan">Tajikistan</option>
   <option value="Tanzania">Tanzania</option>
   <option value="Thailand">Thailand</option>
   <option value="Togo">Togo</option>
   <option value="Tokelau">Tokelau</option>
   <option value="Tonga">Tonga</option>
   <option value="Trinidad & Tobago">Trinidad & Tobago</option>
   <option value="Tunisia">Tunisia</option>
   <option value="Turkey">Turkey</option>
   <option value="Turkmenistan">Turkmenistan</option>
   <option value="Turks & Caicos Is">Turks & Caicos Is</option>
   <option value="Tuvalu">Tuvalu</option>
   <option value="Uganda">Uganda</option>
   <option value="United Kingdom">United Kingdom</option>
   <option value="Ukraine">Ukraine</option>
   <option value="United Arab Erimates">United Arab Emirates</option>
   <option value="United States of America">United States of America</option>
   <option value="Uraguay">Uruguay</option>
   <option value="Uzbekistan">Uzbekistan</option>
   <option value="Vanuatu">Vanuatu</option>
   <option value="Vatican City State">Vatican City State</option>
   <option value="Venezuela">Venezuela</option>
   <option value="Vietnam">Vietnam</option>
   <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
   <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
   <option value="Wake Island">Wake Island</option>
   <option value="Wallis & Futana Is">Wallis & Futana Is</option>
   <option value="Yemen">Yemen</option>
   <option value="Zaire">Zaire</option>
   <option value="Zambia">Zambia</option>
   <option value="Zimbabwe">Zimbabwe</option>
</select>

                                                        </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                            <div class="form-group">
                                                            <label for="input-email">Routing number*</label>
                                                            <input type="text" class="input-field" id="input-email" name="email" placeholder="Enter Routing number*" value="" >
                                                        </div>
                                                            </div>
                                                        </div>



                                                        <div class="form-group">
                                                            <button type="submit" class="mybtn1">Cash Withdrawal</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- SignIn Area End -->
                            </div>
                            <!--end cash withdrawal-->

                            <div class="tab-pane fade" id="tournaments" role="tabpanel" aria-labelledby="tournaments-tab"><br>
                            <center><h3>Tournament History</h3></center><br>
                                <div class="inner-table">
                                    <div class="responsive-table">
                                        <table class="table text-light">
                                            <thead>
                                            <tr>
                                                <th scope="col">Tournament</th>
                                                <th scope="col">Place</th>
                                                <th scope="col">Points</th>
                                                <th scope="col">Bomb</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if (isset($user->tournaments['ended']))
                                                @foreach($user->tournaments['ended'] as $tour)
                                                    <?php
                                                    $place = '--';
                                                    $point = '--';
                                                    $prize = '--';
                                                    if ($tour->first_place == auth()->id()) {
                                                        $place = "First";
                                                        $point = $tour->first_points;
                                                        $prize = $tour->first_prize;
                                                    } elseif ($tour->second_place == auth()->id()) {
                                                        $place = "Second";
                                                        $point = $tour->second_points;
                                                        $prize = $tour->second_prize;
                                                    } elseif ($tour->third_place == auth()->id()) {
                                                        $place = "Third";
                                                        $point = $tour->third_points;
                                                        $prize = $tour->third_prize;
                                                    }

                                                    ?>
                                                    <tr>
                                                        <td>{{$tour->name}}</td>
                                                        <td>{{$place}}</td>
                                                        <td>{{$point}}</td>
                                                        <td>{{$prize}}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="4" class="text-center"> No History</td>
                                                </tr>
                                            @endif

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="winning" role="tabpanel" aria-labelledby="winning-tab"><br>

                                <div class="accordion sorteo-accordion" id="accordionExample3">
                                    <div class="card">
                                        <div class="card-header" id="headingSeven">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven"><i
                                                        class="fa fa-question"></i> What is the meaning of business with example?
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseSeven" class="collapse show" aria-labelledby="headingSeven" data-parent="#accordionExample3">
                                            <div class="card-body">
                                                <p>scelerisque consectetuer ac a at nunc, in lectus. Ut lectus erat. Sit praesent tellus, ac eget pede risus, urna ante nec tincidunt vel, tincidunt tortor sit lacinia. Enim massa in, porttitor felis justo, aenean habitant velit nunc, maecenas eget magna viverra imperdiet magna tincidunt. Lacinia eleifend luctus ante fermentum, lectus faucibus mi id, orci congue, amet donec erat nisl vestibulum. Ut ac luctus semper curabitur ipsum, odio pretium nec interdum tellus urna.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingEight">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight"><i
                                                        class="fa fa-question"></i> What is a business simple definition?
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample3">
                                            <div class="card-body">
                                                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade  " id="results" role="tabpanel" aria-labelledby="results-tab"><br>
                            <center><h3>Active Tournaments</h3></center><br>
                                @if (isset($user->tournaments['started']))
                                    <section >
                                        <br><br>
                                        <div class="row">
                                            <div class="col-lg-12">

                                            <div class="gaming-activities">
                                                <div class="gaming-activities-inner">

                                                    <div class="row">
                                                        @foreach($user->tournaments['started'] as $tournament)
                                                            <div class="col-lg-6 col-md-6 mt-5">
                                                                <div class="single-activities"
                                                                     onclick="location.href='{{route('tournament.details',$tournament->tournament_id)}}';"
                                                                     style="cursor: pointer;">
                                                                    <div class="top-area">
                                                                        <div class="left">
                                                                            <div class="icon">
                                                                                <img src="/storage/{{$tournament->image}}" onerror="this.onerror=null; this.src='assets/images/game/icon2.png'" alt="">
                                                                                {{--                                                                                                    <span>4.5 <i class="fas fa-star"></i></span>--}}
                                                                            </div>
                                                                        </div>
                                                                        <div class="right">
                                                                            <h4 class="title">
                                                                                {{$tournament->name}}
                                                                            </h4>
                                                                            <p class="text">
                                                                                {{$tournament->game->name}}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="bottom-area">
                                                                        <h4 class="title">Registered:</h4>
                                                                        <div class="players-count">
                                                                            @if ($tournament->players->count() > 5)
                                                                                <?php $remaining = $tournament->players->count() - 5;?>
                                                                                <ul class="players-list">
                                                                                    @foreach($tournament->players->splice(0,4) as $team)
                                                                                        <li>
                                                                                            <img src="/storage/{{$team->image}}" alt="">
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                                <div class="count-num">
                                                                                    {{ "+".$remaining }}
                                                                                </div>
                                                                            @else
                                                                                <ul class="players-list">
                                                                                    @foreach($tournament->players as $team)
                                                                                        <li>
                                                                                            <img src="/storage/{{$team->image}}" alt="">
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            @endif
                                                                        </div>
                                                                        <div class="pp">
                                                                            <p>{{$tournament->players->count()}}/{{$tournament->bracket_size}} </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </section>
                                @else
                                    <h5 class="w-100 text-center">No Data Found</h5>
                                @endif

                            </div>
                        </div>
                                                </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- faq-section end -->


@endsection

