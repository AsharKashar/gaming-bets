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
                    <h5 class="title">{{ __('Add Tournament Winners') }}</h5>
                </div>
                <form method="post" action="{{ route('add.result',$tournament->id) }}" enctype="multipart/form-data" autocomplete="off">
                    <div class="card-body">
                        @csrf

                        @include('alerts.success')
                        <div class="row">
                            <div class="col-lg-6">


                                <div class="form-group{{ $errors->has('first_place') ? ' has-danger' : '' }}">
                                    <label>{{ __('First Place') }}</label>
                                    <select name="first_place" class="form-control{{ $errors->has('first_place') ? ' is-invalid' : '' }}" required>
                                        <option disabled selected>Select Team</option>
                                        @foreach($teams as $team)
                                            <option value="{{$team->id}}" {{ $results->first_place == $team->id ? 'selected' : '' }}>{{$team->name}}</option>
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'first_place'])
                                </div>

                                <div class="form-group{{ $errors->has('second_place') ? ' has-danger' : '' }}">
                                    <label>{{ __('Second Place') }}</label>
                                    <select name="second_place" class="form-control{{ $errors->has('second_place') ? ' is-invalid' : '' }}" required>
                                        <option disabled selected>Select Team</option>
                                        @foreach($teams as $team)
                                            <option value="{{$team->id}}" {{ $results->second_place == $team->id ? 'selected' : '' }}>{{$team->name}}</option>
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'second_place'])
                                </div>

                                <div class="form-group{{ $errors->has('third_place') ? ' has-danger' : '' }}">
                                    <label>{{ __('Third Place') }}</label>
                                    <select name="third_place" class="form-control{{ $errors->has('third_place') ? ' is-invalid' : '' }}" required>
                                        <option disabled selected>Select Team</option>
                                        @foreach($teams as $team)
                                            <option value="{{$team->id}}" {{ $results->third_place == $team->id ? 'selected' : '' }}>{{$team->name}}</option>
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'third_place'])
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
@endsection
