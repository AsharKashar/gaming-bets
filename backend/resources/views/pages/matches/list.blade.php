@extends('layouts.app', ['page' => __('Matches '), 'pageSlug' => 'matches'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4>Matches</h4>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Team 1</th>
                                <th scope="col">Team 2</th>
                                <th scope="col">Winner</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($matches as $match)
                                <tr>
                                    <td>{{$match->match_id}}</td>
                                    <td>{{$match->title}}</td>
                                    <td>{{$match->teamA?$match->teamA->name:'-'}}</td>
                                    <td>{{$match->teamB?$match->teamB->name:'-'}}</td>

                                    <td class="{{!$match->winner_id ? 'text-right' : ''}}">
                                        @if (($match->winner_id == null || $match->winner_id == 0) && $match->team_1 && $match->team_2)
                                        <a class="btn btn-sm btn-info winner-btn" data-toggle="modal" data-target="#evidence"
                                            data-match="{{$match->match_id}}"
                                            data-team1="{{$match->team_1}}"
                                            data-team2="{{$match->team_2}}"
                                            data-e_image1="{{asset('storage/'.$match->e_image1)}}"
                                            data-e_image2="{{asset('storage/'.$match->e_image2)}}"
                                            data-e_video1="{{asset('storage/'.$match->e_video1)}}"
                                            data-e_video2="{{asset('storage/'.$match->e_video2)}}" > Mark Winner</a>
                                        @else
                                            {{$match->winnerTeam?$match->winnerTeam->name:'-'}}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Evidence Modal -->
    <div class="modal modal-black fade" id="evidence" tabindex="-1" role="dialog" aria-labelledby="Evidence" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form  method="post">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">{{__("Evidence")}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group{{ $errors->has('start_at') ? ' has-danger' : '' }}">
                            <label>{{ __('Team 1') }}</label>
                            <a target="_blank" href="" id="e_image1" class="btn btn-secondary" >Download Photo</a><a target="_blank" href="" id="e_video1" class="btn btn-secondary" >Download Video</a>&nbsp;
                            <center><input style="margin-top: 45px"  type="radio" class="radio" value="" name="winner" id="team1" required />  Winner</label></center>

                        </div>

                        <div class="form-group{{ $errors->has('end_at') ? ' has-danger' : '' }}">
                            <label>{{ __('Team 2') }}</label>
                            <a target="_blank" href="" id="e_image2" class="btn btn-secondary" >Download Photo</a><a target="_blank" href="" id="e_video2" class="btn btn-secondary" >Download Video</a>&nbsp;
                            <center><input style="margin-top: 5px" type="radio" class="radio" value="" name="winner" id="team2" required />  Winner</label></center>
                        </div>


                    </div>
                    <div class="modal-footer">
                        @csrf
                        <input type="hidden" name="match" id="match_id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script>
        $('.winner-btn').click(function () {
            var match = $(this);
            $('#team1').val(match.data('team1'));
            $('#team2').val(match.data('team2'));
            $('#match_id').val(match.data('match'));
            $('#e_image1').attr('href',match.data('e_image1'));
            $('#e_image2').attr('href',match.data('e_image2'));
            $('#e_video1').attr('href',match.data('e_video1'));
            $('#e_video2').attr('href',match.data('e_video2'));
        })
    </script>
@endpush


