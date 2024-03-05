@extends('layouts.app', ['page' => __('Tournament Profile'), 'pageSlug' => 'tournament'])

@section('content')
    <style>
        .team-name {
            padding-left: 10rem!important;
            text-align: left !important;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('add.result',$tournament->id) }}" enctype="multipart/form-data" autocomplete="off">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="title">{{ __('Add Tournament Winners') }}</h5>
                            </div>
                            <div class="col-6 text-right">
                                <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @csrf

                        @include('alerts.success')
                        <div class="row">
                            <div class="col-lg-6">
                                <?php
                                $teams = $teams->whereNotIn('team_id',$results->pluck('team_id')->toArray());

                                ?>
                                <div class="form-group{{ $errors->has('team') ? ' has-danger' : '' }}">
                                    <label for="team">{{ __('Team') }}</label>
                                    <select name="team" id="team" class="form-control{{ $errors->has('team') ? ' is-invalid' : '' }}" required>
                                        <option disabled selected>Select Team</option>
                                        @foreach($teams as $team)
                                            <option value="{{$team->team_id}}" {{ old('team') == $team->team_id ? 'selected' : '' }}>{{$team->name}}</option>
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'team'])
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <?php $positions = $results->where('team_id', null)->pluck('position') ?>
                                <div class="form-group{{ $errors->has('position') ? ' has-danger' : '' }}">
                                    <label for="position">{{ __('Position') }}</label>
                                    <select name="position" id="position" class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" required>
                                        <option disabled selected>Select Position</option>
                                        @foreach($positions as $position)
                                            <option value="{{$position}}" {{ old('position') == $position ? 'selected' : '' }}>{{$position}}</option>
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'position'])
                                </div>


                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="container-fluid table-responsive">
                                <table class="table text-center">
                                    <thead>
                                    <tr>
                                        <th width="10">Position</th>
                                        <th class="team-name">Team</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($results as $result)
                                        <tr>
                                            <td>{{$result->position}}</td>
                                            <td class="team-name">{{$result->team_id ? $result->team->name : '-' }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
