<?php
$members = auth()->check() ? auth()->user()->hasTournamentTeam($id) : false;
?>
@if ($members)
    <style>
        .token {
            color: #eee;
            background: rgba(0,0,0,0.4);
            padding: 4px;
        }
    </style>
<div class="modal fade login-modal" id="team-member" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <!--<div class="logo-area">
                    <img class="logo" src="assets/images/logo.png" alt="">
                </div>-->
                <div class="header-area">
                    <h4 class="title" style="font-size: 14px">YOUR TEAM MEMBER</h4>
                </div>
                <div class="form-area">
                    Team Token # <b class="token">{{$members->first()->token}}</b>
                    <table class="table text-light">
                        <tbody>
                        @foreach($members as $member)
                            <tr>
                                <td>{{$loop->iteration}} - {{$member->player}} {{$member->is_leader == 1 ? "(Leader)":''}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif


<div class="modal fade login-modal" id="invite-link" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <!--<div class="logo-area">
                    <img class="logo" src="assets/images/logo.png" alt="">
                </div>-->
                <div class="header-area">
                    <h4 class="title" style="font-size: 14px">INVITE YOUR FRIENDS TO JOIN THE TOURNAMENT</h4>

                </div>
                <div class="form-area">
                    <div class="input-group mb-3">
                        <input type="text" id="link" class="form-control" value="{{$members ? route('invite-link',[$members->first()->token,$id]):''}}">
                        <div class="input-group-append" title="Click to Copy Link" id="copy-link" >
                            <span class="input-group-text fa fa-clipboard btn-clipboard" ></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(".btn-invite").click(function () {
        $("#link").val($(this).data('link'));
    });
    $("#copy-link").click(function () {
        $("#link").select();
        document.execCommand('copy');
    })


</script>
