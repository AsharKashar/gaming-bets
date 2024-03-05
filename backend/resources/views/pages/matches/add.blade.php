@extends('layouts.app', ['page' => __('Tournament Profile'), 'pageSlug' => 'tournament'])

@section('content')
    <style>
        select option {
            color: #333;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Add Match') }}</h5>
                </div>
                <form method="post" action="{{ route('add.match',$tournament->id) }}" enctype="multipart/form-data" autocomplete="off">
                    <div class="card-body">
                        @csrf

                        @include('alerts.success')
                        <div class="row">
                            <div class="col-lg-12">
                            <div class="form-group{{ $errors->has('match_id') ? ' has-danger' : '' }}">
                                <label>{{ __('Match ID') }}</label>
                                <input type="text" name="match_id" class="form-control{{ $errors->has('match_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Match ID') }}" value="{{ old('match_id') }}" required>
                                @include('alerts.feedback', ['field' => 'match_id'])
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">


                                <div class="form-group{{ $errors->has('first_place') ? ' has-danger' : '' }}">
                                    <label>{{ __('Team A') }}</label>
                                    <select name="team1" class="form-control{{ $errors->has('team1') ? ' is-invalid' : '' }}" required>
                                        <option disabled selected>Select Team</option>
                                        @foreach($teams as $team)
                                            <option value="{{$team->id}}" {{ old('team1') == $team->id ? 'selected' : '' }}>{{$team->name}}</option>
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'team1'])
                                </div>
                            </div>
                            <div class="col-lg-6">

                                <div class="form-group{{ $errors->has('team2') ? ' has-danger' : '' }}">
                                    <label>{{ __('Team B') }}</label>
                                    <select name="team2" class="form-control{{ $errors->has('team2') ? ' is-invalid' : '' }}" required>
                                        <option disabled selected>Select Team</option>
                                        @foreach($teams as $team)
                                            <option value="{{$team->id}}" {{ old('team2') == $team->id ? 'selected' : '' }}>{{$team->name}}</option>
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'team2'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">

                                <div class="form-group{{ $errors->has('match_type') ? ' has-danger' : '' }}">
                                    <label>{{ __('Match Type') }}</label>
                                    <input type="text" name="match_type" class="form-control{{ $errors->has('match_type') ? ' is-invalid' : '' }}" placeholder="{{ __('Match Type') }}" value="{{ old('match_type') }}" required>
                                    @include('alerts.feedback', ['field' => 'match_type'])
                                </div>



                            </div>
                            <div class="col-lg-6">

                            </div>
                        </div>
                        <hr>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
