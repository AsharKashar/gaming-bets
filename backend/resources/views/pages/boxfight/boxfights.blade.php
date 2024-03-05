@extends('layouts.app', ['page' => __('boxfights'), 'pageSlug' => 'boxfights'])

@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">{{ __('Box Fight (conflicts)') }}</h4>
                    </div>
                    <!--<div class="col-4 text-right">
                        <a href="{{ route("add.tournament") }}" class="btn btn-sm btn-primary">{{ __('Add Tournament') }}</a>
                    </div>-->
                </div>
            </div>
            <div class="card-body">
                @include('alerts.success')

                <div class="">
                    <table class="table tablesorter " id="">
                        <thead class=" text-primary">
                        <th scope="col">{{ __('Game') }}</th>
                        <th scope="col">{{ __('Platform') }}</th>
                        <th scope="col">{{ __('Region') }}</th>
                        <th scope="col">{{ __('Start At') }}</th>
                        {{-- <th scope="col">{{ __('End At') }}</th> --}}
                        <th scope="col">{{ __('Bid ammount') }}</th>
                        <th scope="col">{{ __('Host Name') }}</th>
                        {{-- <th scope="col">{{ __('team 2 id') }}</th> --}}
                        <th scope="col">{{ __('Match type') }}</th>
                        </thead>
                        <tbody>
                        @foreach($boxfights as $boxfight)
                            @if($boxfight->conflict_flag==2 && $boxfight->status=='4')
                            <tr>
                                @if($boxfight->game_id==1)
                                    <td>Fortnite</td>
                                @endif
                                @if($boxfight->game_id==2)
                                    <td>Call of duty</td>
                                @endif
                                <td>{{$boxfight->platform}}</td>
                                <td>{{$boxfight->region}}</td>
                                <td>{{$boxfight->time}}</td>
                                {{-- <td>2019-12-24 09:38:12</td> --}}
                                <td>{{$boxfight->bid_amount}}</td>
                                <td>{{$boxfight->username}}</td>
                                {{-- <td>#ofghf049</td> --}}
                                @if($boxfight->game_type==1)
                                    <td>1 VS 1</td>
                                @endif
                                @if($boxfight->game_type==2)
                                    <td>2 VS 2</td>
                                @endif
                                <td>

                                        <a class="btn btn-sm btn-info rematch-btn " onclick="viewmatchid({{$boxfight}})" data-toggle="modal" data-target="#rematchs" data-link="">Evidence</a>


                                </td>
                                <td>

                                    <a class="btn btn-sm btn-info rematch-btn " onclick="deleteMatch({{$boxfight}})">Delete</a>


                                </td>

                                <!--<td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>

                                    </div>
                                </td>-->
                            </tr>
                            @endif
                        @endforeach
                            {{-- <tr>
                                <td>Fortnite</td>
                                <td>PC</td>
                                <td>NA WEST</td>
                                <td>2019-12-24 09:38:12</td>
                                <td>2019-12-24 09:38:12</td>
                                <td>200</td>
                                <td>#023u4r0f</td>
                                <td>#ofghf049</td>
                                <td>2 VS 2</td>
                                <td>

                                    <a class="btn btn-sm btn-info rematch-btn " data-toggle="modal" data-target="#rematchs" data-link="">Evidence</a>
                                </td>
                                <!--<td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>

                                    </div>
                                </td>-->
                            </tr> --}}

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-4">
                <nav class="d-flex justify-content-end" aria-label="...">

                </nav>
            </div>
        </div>
    </div>
</div>







<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">{{ __('Box Fight') }}</h4>
                    </div>
                    <!--<div class="col-4 text-right">
                        <a href="{{ route("add.tournament") }}" class="btn btn-sm btn-primary">{{ __('Add Tournament') }}</a>
                    </div>-->
                </div>
            </div>
            <div class="card-body">
                @include('alerts.success')

                <div class="">
                    <table class="table tablesorter " id="">
                        <thead class=" text-primary">
                        <th scope="col">{{ __('Game') }}</th>
                        <th scope="col">{{ __('Platform') }}</th>
                        <th scope="col">{{ __('Region') }}</th>
                        <th scope="col">{{ __('Start At') }}</th>
                        {{-- <th scope="col">{{ __('End At') }}</th> --}}
                        <th scope="col">{{ __('Bid ammount') }}</th>
                        <th scope="col">{{ __('Host Name') }}</th>
                        {{-- <th scope="col">{{ __('team 2 id') }}</th> --}}
                        <th scope="col">{{ __('Match type') }}</th>
                        </thead>
                        <tbody>
                        @foreach($boxfights as $boxfight)
                            @if(!($boxfight->conflict_flag==2 && $boxfight->status=='4'))
                            <tr>
                                @if($boxfight->game_id==1)
                                    <td>Fortnite</td>
                                @endif
                                @if($boxfight->game_id==2)
                                    <td>Call of duty</td>
                                @endif
                                <td>{{$boxfight->platform}}</td>
                                <td>{{$boxfight->region}}</td>
                                <td>{{$boxfight->time}}</td>
                                {{-- <td>2019-12-24 09:38:12</td> --}}
                                <td>{{$boxfight->bid_amount}}</td>
                                <td>{{$boxfight->username}}</td>
                                {{-- <td>#ofghf049</td> --}}
                                @if($boxfight->game_type==1)
                                    <td>1 VS 1</td>
                                @endif
                                @if($boxfight->game_type==2)
                                    <td>2 VS 2</td>
                                @endif
                                <td>



                                    @if(!$boxfight->conflict_flag && $boxfight->status=='3')
                                    Live
                                    @endif
                                    @if(!$boxfight->conflict_flag && $boxfight->status=='1')
                                    Pending
                                    @endif
                                    @if(!$boxfight->conflict_flag && $boxfight->status=='2')
                                    Lobby Full
                                    @endif
                                    @if(!$boxfight->conflict_flag && $boxfight->status=='4')
                                    Result Pending
                                    @endif
                                    @if($boxfight->conflict_flag=='1' && $boxfight->status=='4')
                                    Conflict! Evidence Pending
                                    @endif
                                    @if($boxfight->status=='6')
                                    Match Cancelled
                                    @endif
                                    @if($boxfight->status=='5')
                                    Match Finished
                                    @endif
                                </td>
                                <td>

                                    <a class="btn btn-sm btn-info rematch-btn " onclick="deleteMatch({{$boxfight}})">Delete</a>


                                </td>

                                <!--<td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>

                                    </div>
                                </td>-->
                            </tr>
                            @endif
                        @endforeach
                            {{-- <tr>
                                <td>Fortnite</td>
                                <td>PC</td>
                                <td>NA WEST</td>
                                <td>2019-12-24 09:38:12</td>
                                <td>2019-12-24 09:38:12</td>
                                <td>200</td>
                                <td>#023u4r0f</td>
                                <td>#ofghf049</td>
                                <td>2 VS 2</td>
                                <td>

                                    <a class="btn btn-sm btn-info rematch-btn " data-toggle="modal" data-target="#rematchs" data-link="">Evidence</a>
                                </td>
                                <!--<td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>

                                    </div>
                                </td>-->
                            </tr> --}}

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-4">
                <nav class="d-flex justify-content-end" aria-label="...">

                </nav>
            </div>
        </div>
    </div>
</div>

    <!-- Rematch Modal -->
    <div class="modal modal-black fade" id="rematchs" tabindex="-1" role="dialog" aria-labelledby="rematchs" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="rematchForm">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">{{__("Evidence")}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group{{ $errors->has('start_at') ? ' has-danger' : '' }}">
                            <label>{{ __('Team 1') }}</label><br>
                            <span id="t1u1"> &nbsp</span><a href="" target="_blank" id="t1u1b" class="btn btn-secondary" >Evidence 1</a><a href="" id="t1u1bv" target="_blank" class="btn btn-secondary" >Evidence 2</a>&nbsp;

                            <span id="t1u2"> &nbsp</span><a href="" target="_blank" id="t1u2b" class="btn btn-secondary" >Evidence 1</a><a href="" id="t1u2bv" target="_blank" class="btn btn-secondary" >Evidence 2</a>&nbsp;


                            <center><input style="margin-top: 45px"  type="radio" class="radio" id="selected" value="1" name="fooby[1][]" required/>  Winner Team 2</label></center>
                            @include('alerts.feedback', ['field' => 'start_at'])
                        </div>

                        <div class="form-group{{ $errors->has('end_at') ? ' has-danger' : '' }}">
                            <label>{{ __('Team 2') }}</label><br>
                            <span id="t2u1"> &nbsp</span><a href="" target="_blank" id="t2u1b" class="btn btn-secondary" >Evidence 1</a><a href="" id="t2u1bv" target="_blank" class="btn btn-secondary" >Evidence 2</a>&nbsp;

                            <span id="t2u2"> &nbsp</span><a href="" target="_blank" id="t2u2b" class="btn btn-secondary" >Evidence 1</a><a href="" id="t2u2bv" target="_blank" class="btn btn-secondary" >Evidence 2</a>&nbsp;

                            <center><input style="margin-top: 5px" type="radio" class="radio" id="selected" value="2" name="fooby[1][]" required/>  Winner Team 1</label></center>
                            @include('alerts.feedback', ['field' => 'end_at'])
                        </div>


                    </div>
                    <center><input style="margin-top: 45px"  type="radio" class="radio" id="selected" value="3" name="fooby[1][]" required/>  Cancel Match</label></center>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit Result</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    var selected_match;
    function viewmatchid(details){
        //console.log(details.id);
        selected_match=details;
                        $("#t2u2b").css("display", "inline-block");
                        $("#t1u2b").css("display", "inline-block");
                        $("#t2u1b").css("display", "inline-block");
                        $("#t1u1b").css("display", "inline-block");
                        $("#t2u2bv").css("display", "inline-block");
                        $("#t1u2bv").css("display", "inline-block");
                        $("#t2u1bv").css("display", "inline-block");
                        $("#t1u1bv").css("display", "inline-block");

        $.ajax({
                url: '/api/getEvidenceteam1/'+details.match_id,
                type: 'GET',

                //data: ,
                success: function (data) {
                    console.log(data);
                    if(data[0].game_type==1){
                        $("#t2u2b").css("display", "none");
                        $("#t2u2").css("display", "none");
                        $("#t1u2").css("display", "none");
                        $("#t1u2b").css("display", "none");
                        $("#t1u2bv").css("display", "none");
                        $("#t2u2bv").css("display", "none");
                        $("#t1u1").text(data[0].username);
                        //source of btn
                        if(data[0].proof)
                        {$("#t1u1b").attr("href", data[0].proof);}
                        else{
                            $("#t1u1b").css("display", "none");
                        }
                        if(data[0].proof_secondary)
                        {$("#t1u1bv").attr("href", data[0].proof_secondary);
                        console.log(data[0].proof_secondary);}
                        else{
                            $("#t1u1bv").css("display", "none");
                        }



                        $.ajax({
                                url: '/api/getEvidenceteam2/'+details.match_id,
                                type: 'GET',

                                //data: ,
                                success: function (data) {
                                    $("#t2u1").text(data[0].username);
                                    //source of btn
                                    if(data[0].proof){
                                    $("#t2u1b").attr("href", data[0].proof);}
                                    else{
                                        $("#t2u1b").css("display", "none");
                                    }

                                    if(data[0].proof_secondary){
                                    $("#t2u1bv").attr("href", data[0].proof_secondary);}
                                    else{
                                        $("#t2u1bv").css("display", "none");
                                    }
                                 },
                                error: function (request, status, error) {

                                    console.log(request.responseText)
                                }
                            });
                        }
                    else if(data[0].game_type==2){
                        $("#t1u1").text(data[0].username);
                        $("#t1u2").text(data[1].username);
                        //btn source
                        if(data[0].proof)
                        {$("#t1u1b").attr("href", data[0].proof);}
                        else{
                            $("#t1u1b").css("display", "none");
                        }
                        if(data[0].proof_secondary)
                        {$("#t1u1bv").attr("href", data[0].proof_secondary);}
                        else{
                            $("#t1u1bv").css("display", "none");
                        }



                        if(data[1].proof)
                        {$("#t1u2b").attr("href", data[1].proof);}
                        else{
                            $("#t1u2b").css("display", "none");
                        }
                        if(data[1].proof_secondary)
                        {$("#t1u2bv").attr("href", data[1].proof_secondary);}
                        else{
                            $("#t1u2bv").css("display", "none");
                        }

                        $.ajax({
                                url: '/api/getEvidenceteam2/'+details.match_id,
                                type: 'GET',

                                //data: ,
                                success: function (data) {
                                    $("#t2u1").text(data[0].username);
                                    $("#t2u2").text(data[1].username);
                                    //source of btn
                                    if(data[0].proof)
                                    {$("#t2u1b").attr("href", data[0].proof);}
                                    else{
                                        $("#t2u1b").css("display", "none");
                                    }
                                    if(data[0].proof_secondary)
                                    {$("#t2u1bv").attr("href", data[0].proof_secondary);}
                                    else{
                                        $("#t2u1bv").css("display", "none");
                                    }


                                    if(data[1].proof)
                                    {$("#t2u2b").attr("href", data[1].proof);}
                                    else{
                                        $("#t2u2b").css("display", "none");
                                    }
                                    if(data[1].proof_secondary)
                                    {$("#t2u2bv").attr("href", data[1].proof_secondary);}
                                    else{
                                        $("#t2u2bv").css("display", "none");
                                    }
                                 },
                                error: function (request, status, error) {

                                    console.log(request.responseText)
                                }
                            });
                    }
                },
                error: function (request, status, error) {

                    console.log(request.responseText)
                }
            });








    }


function deleteMatch(data){
    var match_id=data.id;
    $.ajax({
                                url: '/api/deleteMatchAdmin/'+match_id,
                                type: 'GET',
                                success: function () {
                                    location.reload(true);
                                 },
                                error: function (request, status, error) {

                                    console.log(request.responseText)
                                }
            });
}

jQuery(document).ready(function () {
    $( "#rematchForm" ).submit(function( event ) {

  event.preventDefault();
  var result={};
  var team=$('input[name="fooby[1][]"]:checked').val();
  result['winner']=team;
  //console.log(team);

 $.ajax({
                                url: '/api/adminResult/'+selected_match.id,
                                type: 'POST',

                                data: result,
                                success: function (data) {
                                    location.reload(true);
                                },
                                error: function (request, status, error) {

                                    console.log(request.responseText)
                                }
                            });

});

});
    //
</script>
@endsection
