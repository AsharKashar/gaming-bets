<style>
    .token {
        color:      #eee;
        background: rgba(0, 0, 0, 0.4);
        padding:    4px;
    }
</style>
@if (isset($ajax))
    <div class="col-lg-12">
        <button class="btn mybtn-tournament" data-toggle="modal" data-target="#team-members-{{$id}}" type="button">TEAM DETAILS</button>
    </div>
@endif

<div class="modal fade login-modal" id="team-members-{{$id}}" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <!--<div class="logo-area">
                    <img class="logo" src="assets/images/logo.png" alt="">
                </div>-->
                <div class="header-area">
                    <h4 class="title" style="font-size: 44px">Invite Link</h4>
                </div>
                <div class="form-area" style="margin-bottom:80px">
                    <div class="mb-3"><h4>Team Token # </h4><b class="token">{{ $members->first() ? $members->first()->token : ''}}</b>
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
                    <h4>Invite Link</h4>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control link" value="{{ $url ?? url()->current()}}">
                        <div class="input-group-append copy-link" title="Click to Copy Link">
                            <span class="input-group-text fa fa-clipboard btn-clipboard"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


