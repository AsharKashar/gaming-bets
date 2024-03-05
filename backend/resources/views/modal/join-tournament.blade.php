@if (auth()->user()->canJoinTournament($tournament))
    <?php
    $titleName = strtoupper($game->name) == "FORTNITE" ? 'Epic Game User Name' : 'Activision ID';
    $id = $tournament->id;
    ?>

    <div class="modal fade login-modal" id="make-team-{{$tournament->id}}" tabindex="-1" role="dialog"
         aria-labelledby="login" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-body">

                <div class="row">
                <div class="col-lg-6"><h4 class="title wager-title" style="">Create your own team</h4></div>
                <div class="col-lg-6"><p class="sub-title wager-details" style="font-size:12px;margin-top:26px;line-height: 20px;width: 225px;margin-left:-20px">Fill out this form to create your team with your friends</p></div>
</div>
                    <div class="form-area">
                        <form class="make-team ajax-form" action="{{route("make.team")}}" method="POST">
                            <input type="hidden" name="tournament_id" value="{{$id}}">

                            <div class="form-group" style="border-bottom:2px  solid #a1afd3">
                                <label for="team">Team Name* </label>
                                <input type="text" name="team" class="input-field" id="team" placeholder="Team Name"
                                       required>
                            </div>

                            <div class="form-group" style="border-bottom:2px  solid #a1afd3">
                                <label for="activision">{{ $titleName}}* </label>
                                <input type="text" name="activision" class="input-field" placeholder="{{$titleName}}"
                                       required>
                            </div>

                            @csrf
                            <div class="form-group">
                                <div class="row justify-content-end" style="margin: 100px 0px 0px 40px">
                                    <div class="col-lg-6 col-sm-6">
                                    <button type="submit" class="mybtn1" style="font-size:20px;color:#010432;font-family:'Telegraf-UltraBold'">Confirm</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <div class="row" style="margin-top:20px"><a  data-toggle="modal" data-target="#report-issue" data-dismiss="modal" class="report-modal-text">Report issue</a> </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade login-modal" id="join-team-{{$tournament->id}}" tabindex="-1" role="dialog"
         aria-labelledby="login" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-body">

                <div class="row">
                <div class="col-lg-6"><h4 class="title wager-title" style="">Join your own team</h4></div>
                <div class="col-lg-6"><p class="sub-title wager-details" style="font-size:12px;margin-top:26px;line-height: 20px;width: 225px;margin-left:-20px">Fill out this form to join your team with your friends</p></div>
</div>
                    <div class="form-area">
                        <form class="ajax-form" action="{{route("join.team")}}" method="POST">
                            <input type="hidden" name="tournament_id" value="{{$id}}">
                            <div class="form-group" style="border-bottom:2px  solid #a1afd3">
                                <label for="team-token">Team Token*
                                    <i class="fa fa-info-circle" data-toggle="tooltip"
                                       title="Ask Team Leader to provide team token to join team"></i>
                                </label>
                                <input type="text" name="team_token" class="input-field" id="team-token"
                                       value="{{$token??''}}"
                                       placeholder="Ask Team Leader to provide team token to join team" required>
                            </div>
                            <div class="form-group" style="border-bottom:2px  solid #a1afd3">
                                <label for="activision">{{$titleName}}* </label>
                                <input type="text" name="activision" class="input-field" placeholder="{{$titleName}}"
                                       required>
                            </div>

                            @csrf
                            <div class="form-group">
                            <div class="row justify-content-end" style="margin: 100px 0px 0px 40px">
                                    <div class="col-lg-6 col-sm-6">
                                    <button type="submit" class="mybtn1" style="font-size:20px;color:#010432;font-family:'Telegraf-UltraBold'">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row" style="margin-top:20px"><a data-toggle="modal" data-target="#report-issue" data-dismiss="modal" class="report-modal-text">Report issue</a> </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@else
    <div class="modal fade login-modal" id="make-team-{{$tournament->id}}" tabindex="-1" role="dialog"
         aria-labelledby="login" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">

                    <div class="header-area">
                        <h4 class="title">Note</h4>
                    </div>
                    <div class="form-area">
                        <p class="lead">
                            You don't have enough bomb to join tournament
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade login-modal" id="join-team-{{$tournament->id}}" tabindex="-1" role="dialog"
         aria-labelledby="login" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">

                    <div class="header-area">
                        <h4 class="title">Note</h4>
                    </div>
                    <div class="form-area">
                        <p class="lead">
                            You don't have enough bomb to join tournament
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endif
