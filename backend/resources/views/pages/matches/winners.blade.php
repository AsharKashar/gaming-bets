@extends('layouts.app', ['page' => __('Matches '), 'pageSlug' => 'matches'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4>Add Positions For {{$match->title}}</h4>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="card-body">
                        <form method="post" autocomplete="off">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-lg-3">
                                    <label for="">Team</label>
                                    <select name="player_id" id="" class="form-control">
                                        <option disabled selected>Select Team</option>
                                        @foreach($match->teams as $player)
                                            <option value="{{$player->team_id}}">{{$player->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-lg-3">
                                    <label for="">Position</label>
{{--                                    <input type="text" name="position" class="form-control" placeholder="Position">--}}
                                    <select name="position" id="" class="form-control">
                                        @for($i=1; $i <= $match->tournament->top_players ; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn mt-4 btn-primary">{{ __('Add') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="winners-tab" data-toggle="pill" href="#winners" role="tab" aria-controls="winners" aria-selected="true">Winners</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="evidence-tab" data-toggle="pill" href="#evidence" role="tab" aria-controls="evidence" aria-selected="false">Evidence</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="winners" role="tabpanel" aria-labelledby="winners-tab">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Position</th>
                                    <th>Team</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($match->results as $result)
                                    <tr>
                                        <td>{{$result->position}}</td>
                                        <td>{{$result->team->name}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center">No Record Found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="evidence" role="tabpanel" aria-labelledby="evidence-tab">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Team</th>
                                    <th colspan="2" class="text-center">Evidence</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($evidences as $evidence)
                                    <tr>
                                        <td>{{$evidence->team_name}}</td>
                                        <td>
                                            <a href="{{ asset("storage/".$evidence->e_image) }}">Download Image</a>
                                        </td>
                                        <td>
                                            <a href="{{ asset("storage/".$evidence->e_video) }}">Download Video</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center">No Record Found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
@endsection
