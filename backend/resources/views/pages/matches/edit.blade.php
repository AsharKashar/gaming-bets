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
                <form method="post" action="{{ route('edit.match',[$tournament->id,$match->id]) }}" enctype="multipart/form-data" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @method('patch')
                        @include('alerts.success')
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group{{ $errors->has('match_id') ? ' has-danger' : '' }}">
                                    <label>{{ __('Match ID') }}</label>
                                    <input type="text" name="match_id" class="form-control{{ $errors->has('match_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Match ID') }}" value="{{ $match->match_id }}" required>
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
                                            <option value="{{$team->id}}" {{ $match->team1 == $team->id ? 'selected' : '' }}>{{$team->name}}</option>
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
                                            <option value="{{$team->id}}" {{ $match->team2 == $team->id ? 'selected' : '' }}>{{$team->name}}</option>
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
                                    <input type="text" name="match_type" class="form-control{{ $errors->has('match_type') ? ' is-invalid' : '' }}" placeholder="{{ __('Match Type') }}" value="{{ $match->match_type }}" required>
                                    @include('alerts.feedback', ['field' => 'match_type'])
                                </div>


                                <div class="form-group{{ $errors->has('start_at') ? ' has-danger' : '' }}">
                                    <label>{{ __('Start at') }}</label>
                                    <input type="text" name="start_at" class="datepick form-control{{ $errors->has('start_at') ? ' is-invalid' : '' }}" placeholder="{{ __('Start at') }}" value="{{ $match->start_at->format("m/d/Y h:i:s A") }}">
                                    @include('alerts.feedback', ['field' => 'start_at'])
                                </div>


                                <div class="form-group{{ $errors->has('expire_at') ? ' has-danger' : '' }}">
                                    <label>{{ __('Expire at') }}</label>
                                    <input type="text" name="expire_at" class="datepick form-control{{ $errors->has('expire_at') ? ' is-invalid' : '' }}" placeholder="{{ __('Expire at') }}" value="{{ $match->expire_at->format("m/d/Y h:i:s A") }}">
                                    @include('alerts.feedback', ['field' => 'expire_at'])
                                </div>

                            </div>
                            <div class="col-lg-6">

                                <div class="form-group{{ $errors->has('game_type') ? ' has-danger' : '' }}">
                                    <label>{{ __('Game Type') }}</label>
                                    <input type="text" name="game_type" class="form-control{{ $errors->has('game_type') ? ' is-invalid' : '' }}" placeholder="{{ __('Game Type') }}" value="{{ $match->game_type }}" required>
                                    @include('alerts.feedback', ['field' => 'game_type'])
                                </div>


                                <div class="form-group{{ $errors->has('game_mode') ? ' has-danger' : '' }}">
                                    <label>{{ __('Game Mode') }}</label>
                                    <input type="text" name="game_mode" class="form-control{{ $errors->has('game_mode') ? ' is-invalid' : '' }}" placeholder="{{ __('Game Mode') }}" value="{{ $match->game_mode }}" required>
                                    @include('alerts.feedback', ['field' => 'game_mode'])
                                </div>

                                <div class="form-group{{ $errors->has('match_set') ? ' has-danger' : '' }}">
                                    <label>{{ __('Match Set') }}</label>
                                    <input type="text" name="match_set" class="form-control{{ $errors->has('match_set') ? ' is-invalid' : '' }}" placeholder="{{ __('Match Set') }}" value="{{ $match->match_set }}" required>
                                    @include('alerts.feedback', ['field' => 'match_set'])
                                </div>

                            </div>
                        </div>
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
