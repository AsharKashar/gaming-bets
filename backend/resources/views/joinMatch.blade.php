@extends('layout.mainlayout')


@section('content')


<div class="modal fade login-modal show" id="usernameBox" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true" style="margin-top:50px;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
            <div class="modal-body"><br><br>
<center>
                <div class="row" >

                    <div class="col-lg-12">
                            <p id="gametype1" class="sub-title wager-details"></p>
                            <p id="platform1" class="sub-title wager-details"></p>
                            <p id="region1" class="sub-title wager-details" ></p>
                            <p id="host1" class="sub-title wager-details" ></p>
                            <p id="time1" class="sub-title wager-details" ></p>
                            <p id="bid1" class="sub-title wager-details" ></p>
                    </div>
                </div>
            </center>
                <div class="form-area" style="margin-top:20px">
                    <form id="enterUsername">
                        <div class="form-group">
                            <center><label for="login-input-email">Epic Game Username</label></center>
                            <center><input type="text" name="name" class="input-field" id="username"  placeholder="Enter your Username" required></center>
                        </div>


                        </div>
                        <div class="alert alert-danger" id="limaError" style="display: none" role="alert">
                            Not enough Bomb in your account
                        </div>
                        <div class="alert alert-danger" id="existingmatch" style="display: none" role="alert">
                            You already have a live match at the starting time of this match.
                        </div>

                        <div class="form-group">
                            <center><button type="submit" class="mybtn1">Join</button></center>
                        </div>
                    </form>
                </div>



            </div>
        </div>
    </div>
</div>







<div class="modal fade login-modal show" id="alreadyExists" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true" style="margin-top:50px;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
            <div class="modal-body">


                <div class="form-area" style="margin-top:20px">

                        <h5>You have already joined the match</h5>
                        <!--<div class="form-group">
                            <label for="login-input-email">Username</label>
                            <input type="name" name="email" class="input-field" id="login-input-email"  placeholder="Enter your Username" required>
                        </div>

                        <div class="alert alert-danger" id="loginMsg" style="display: none" role="alert">

                        </div>
                        <div class="form-group">
                            <button  type="submit" id="loginBtn" class="mybtn1">Join</button>
                        </div>-->

                </div>



            </div>
        </div>
    </div>
</div>






<div class="modal fade login-modal show" id="boxFull" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true" style="margin-top:50px;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
            <div class="modal-body">


                <div class="form-area" style="margin-top:20px">

                        <h5>The Box match is already full</h5>
                        <!--<div class="form-group">
                            <label for="login-input-email">Username</label>
                            <input type="name" name="email" class="input-field" id="login-input-email"  placeholder="Enter your Username" required>
                        </div>

                        <div class="alert alert-danger" id="loginMsg" style="display: none" role="alert">

                        </div>
                        <div class="form-group">
                            <button  type="submit" id="loginBtn" class="mybtn1">Join</button>
                        </div>-->

                </div>



            </div>
        </div>
    </div>
</div>


<div class="modal fade login-modal show" id="boxCancel" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true" style="margin-top:50px;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
            <div class="modal-body">


                <div class="form-area" style="margin-top:20px">

                        <h5>The Box match has been canceled because of late response</h5>
                        <!--<div class="form-group">
                            <label for="login-input-email">Username</label>
                            <input type="name" name="email" class="input-field" id="login-input-email"  placeholder="Enter your Username" required>
                        </div>

                        <div class="alert alert-danger" id="loginMsg" style="display: none" role="alert">

                        </div>
                        <div class="form-group">
                            <button  type="submit" id="loginBtn" class="mybtn1">Join</button>
                        </div>-->

                </div>



            </div>
        </div>
    </div>
</div>



<div class="modal fade login-modal show" id="joinFight" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true" style="margin-top:50px;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
            <div class="modal-body">


                <div class="form-area" style="margin-top:20px">

                        <h5>Box Fight joined</h5>
                        <!--<div class="form-group">
                            <label for="login-input-email">Username</label>
                            <input type="name" name="email" class="input-field" id="login-input-email"  placeholder="Enter your Username" required>
                        </div>

                        <div class="alert alert-danger" id="loginMsg" style="display: none" role="alert">

                        </div>
                        <div class="form-group">
                            <button  type="submit" id="loginBtn" class="mybtn1">Join</button>
                        </div>-->

                </div>



            </div>
        </div>
    </div>
</div>



<script>
const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('match_id');
    const myParam2 = urlParams.get('team_id');
     console.log(myParam);
     console.log(myParam2);






     //jQuery(document).ready(function () {
    var data={}
    data['team_id']=myParam2;
    //data['username']="Test";
    data['user_id']='<?php echo auth()->user()->id; ?>';
    $.ajax({
              url: '/api/checkBoxFight/'+myParam,
              type: 'POST',
              data: data,
              success: function (data) {
                               console.log(data);
                               if(data=='exists'){
                                $("#alreadyExists").css("display", "block");
                               }
                               else if(data=='full'){
                                $("#boxFull").css("display", "block");
                               }
                               else{
                                //display block
                                $("#usernameBox").css("display", "block");
                                if (data.game_type == 2) {
                                    $('#gametype1').text("Game Type: 2 V 2");
                                } else if (data.game_type == 1) {
                                    $('#gametype1').text("Game Type: 1 V 1");
                                }
                                $('#platform1').text("Platform: " + data.platform);
                                $('#region1').text("Region: " + data.region);
                                $('#time1').text("Time: " + data.time);
                                $('#host1').text("Host: " + data.username);
                                $('#bid1').text("Amount: " + data.bid_amount);




                               }
                                     }
                                    });


    $("#enterUsername").submit(function(e){
        e.preventDefault();
        //console.log('worked');
        data['username']=$('#username').val();
        $.ajax({
              url: '/api/joinBoxFight/'+myParam,
              type: 'POST',
              data: data,
              success: function (data) {
                if(data=='Failed'){
                        $("#limaError").css("display", "block");
                        setTimeout(() => $("#limaError").css("display", "none"), 3000);
                         }
                else if(data=='cancel'){
                        $("#boxCancel").css("display", "block");
                        $("#usernameBox").css("display", "none");

                    }
                else if(data=='match'){
                    $("#existingmatch").css("display", "block");
                        setTimeout(() => $("#existingmatch").css("display", "none"), 3000);

                    }
                else{
                $("#existingmatch").css("display", "none");
                $("#limaError").css("display", "none");
                $("#joinFight").css("display", "block");
                $("#usernameBox").css("display", "none");
                //setTimeout(() =>  window.location.href = window.location.href+'?status=true#bt-role', 3000);
                if(data=='1'){
                setTimeout(() =>  window.location.href = '/tournaments-1?status=true#bt-role', 3000);}
                else if(data=='2'){
                    setTimeout(() =>  window.location.href = '/tournaments-2?status=true#bt-role', 3000);
                }
              }}
            });


        });
//////
//});
</script>
@endsection
