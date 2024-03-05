@extends('layouts.app', ['page' => __('Tournament Profile'), 'pageSlug' => 'tournament'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Edit Tournament') }}</h5>
                </div>
                <form method="post" enctype="multipart/form-data" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @method("patch")

                        @include('alerts.success')

                        <?php
                        $platforms = explode("/", $tournament->platforms);
                        ?>
                        <div class="row">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group{{ $errors->has('platforms') ? ' has-danger' : '' }}">
                                                <h5>Platforms</h5>
                                                <input type="text" name="platforms" class="form-control{{ $errors->has('platforms') ? ' is-invalid' : '' }}" placeholder="{{ __('Platforms') }}" value="{{ $tournament->platforms }}">
                                                @include('alerts.feedback', ['field' => 'platforms'])
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                                <h5>{{ __('Type') }}</h5>
                                                <select name="type" id="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}">
                                                    <option value="user" {{ $tournament->type == "user" ? 'selected' : '' }}>Player Based</option>
                                                    <option value="team" {{ $tournament->type == "team" ? 'selected' : '' }}>Team Based</option>
                                                </select>
                                                @include('alerts.feedback', ['field' => 'type'])
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group{{ $errors->has('repeat') ? ' has-danger' : '' }}">
                                                <h5>{{ __('Type') }}</h5>
                                                <select name="repeat" id="repeat" class="form-control {{ $errors->has('repeat') ? ' is-invalid' : '' }}">
                                                    <option value="daily" {{ $tournament->repeat == "daily" ? 'selected' : '' }}>Daily</option>
                                                    <option value="weekly" {{ $tournament->repeat == "weekly" ? 'selected' : '' }}>Weekly</option>
                                                    <option value="monthly" {{ $tournament->repeat == "monthly" ? 'selected' : '' }}>Monthly</option>
                                                </select>
                                                @include('alerts.feedback', ['field' => 'repeat'])
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col"><h5 class="title">{{ __('Tournament Details') }}</h5></div>
                            <div class="col"><h5 class="title">{{ __('Add Rules') }}</h5></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">

                                <div class="form-group{{ $errors->has('regions') ? ' has-danger' : '' }}">
                                    <label>{{ __('Regions') }}</label>
                                    <input type="text" name="regions" class="form-control{{ $errors->has('regions') ? ' is-invalid' : '' }}" placeholder="{{ __('Regions') }}" value="{{ $tournament->regions }}">
                                    @include('alerts.feedback', ['field' => 'regions'])
                                </div>


                                <div class="form-group{{ $errors->has('game') ? ' has-danger' : '' }}">
                                    <label>{{ __('Game') }}</label>
                                    <select name="game" class="form-control{{ $errors->has('game') ? ' is-invalid' : '' }}">
                                        @foreach($games as $game)
                                            <option value="{{$game->id}}" {{ $tournament->game_id == $game->id ? 'selected' : '' }}>{{$game->name}}</option>
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'game'])
                                </div>

                                <div class="form-group{{ $errors->has('host') ? ' has-danger' : '' }}">
                                    <label>{{ __('Host') }}</label>
                                    <input type="text" name="host" class="form-control{{ $errors->has('host') ? ' is-invalid' : '' }}" placeholder="{{ __('Host') }}" value="{{ $tournament->hosted_by }}">
                                    @include('alerts.feedback', ['field' => 'host'])
                                </div>

                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label>{{ __('Name') }}</label>
                                    <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ $tournament->name }}">
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>

                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label>{{ __('Description') }}</label>
                                    <input id="asd" type="text" name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}" value="{{ $tournament->description }}">
                                    @include('alerts.feedback', ['field' => 'description'])
                                </div>

                                <div class="form-group{{ $errors->has('entry') ? ' has-danger' : '' }}">
                                    <label>{{ __('Entry Fee') }}</label>
                                    <input type="number" name="entry" class="form-control{{ $errors->has('entry') ? ' is-invalid' : '' }}" placeholder="{{ __('Entry Fee') }}" value="{{ $tournament->entry_fee }}">
                                    @include('alerts.feedback', ['field' => 'entry'])
                                </div>





                                <div class="form-group{{ $errors->has('match_type') ? ' has-danger' : '' }}">
                                    <label>{{ __('Match Type') }}</label>
                                    <input type="text" name="match_type" class="form-control{{ $errors->has('match_type') ? ' is-invalid' : '' }}" placeholder="{{ __('Match Type') }}" value="{{ $tournament->match_type }}" required>
                                    @include('alerts.feedback', ['field' => 'match_type'])
                                </div>


                                <div class="form-group{{ $errors->has('game_type') ? ' has-danger' : '' }}">
                                    <label>{{ __('Game Type') }}</label>
                                    <input type="text" name="game_type" class="form-control{{ $errors->has('game_type') ? ' is-invalid' : '' }}" placeholder="{{ __('Game Type') }}" value="{{ $tournament->game_type }}" required>
                                    @include('alerts.feedback', ['field' => 'game_type'])
                                </div>

                                <div class="form-group{{ $errors->has('match_set') ? ' has-danger' : '' }}">
                                    <label>{{ __('Match Set') }}</label>
                                    <input type="text" name="match_set" class="form-control{{ $errors->has('match_set') ? ' is-invalid' : '' }}" placeholder="{{ __('Match Set') }}" value="{{ $tournament->match_set }}" required>
                                    @include('alerts.feedback', ['field' => 'match_set'])
                                </div>








                            </div>

                            <div class="col-lg-6">


                                <div class="form-group{{ $errors->has('start_at') ? ' has-danger' : '' }}">
                                    <label>{{ __('Start at') }}</label>
                                    <input type="text" name="start_at" class="datepick form-control{{ $errors->has('start_at') ? ' is-invalid' : '' }}" placeholder="{{ __('Start at') }}" value="{{ $tournament->start_at->format("d/m/Y h:i A") }}">
                                    @include('alerts.feedback', ['field' => 'start_at'])
                                </div>

                                <div class="form-group{{ $errors->has('end_at') ? ' has-danger' : '' }}">
                                    <label>{{ __('End at') }}</label>
                                    <input type="text" name="end_at" class="datepick form-control{{ $errors->has('end_at') ? ' is-invalid' : '' }}" placeholder="{{ __('End at') }}" value="{{ $tournament->end_at->format("d/m/Y h:i A") }}">
                                    @include('alerts.feedback', ['field' => 'end_at'])
                                </div>

                                <div class="form-group{{ $errors->has('reg_start_at') ? ' has-danger' : '' }}">
                                    <label>{{ __('Registration Start at') }}</label>
                                    <input type="text" name="reg_start_at" class="datepick form-control{{ $errors->has('reg_start_at') ? ' is-invalid' : '' }}" placeholder="{{ __('Registration Start at') }}" value="{{ $tournament->reg_start_at->format("d/m/Y h:i A") }}">
                                    @include('alerts.feedback', ['field' => 'reg_start_at'])
                                </div>

                                <div class="form-group{{ $errors->has('reg_end_at') ? ' has-danger' : '' }}">
                                    <label>{{ __('Registration End at') }}</label>
                                    <input type="text" name="reg_end_at" class="datepick form-control{{ $errors->has('reg_end_at') ? ' is-invalid' : '' }}" placeholder="{{ __('Registration End at') }}" value="{{ $tournament->reg_end_at->format("d/m/Y h:i A") }}">
                                    @include('alerts.feedback', ['field' => 'reg_end_at'])
                                </div>

                                <div class="form-group{{ $errors->has('check_in') ? ' has-danger' : '' }}">
                                    <label>{{ __('Check in') }}&nbsp;<a href="#"><span class="fas fa-question-circle" tool-tip-toggle="tooltip-demo" data-original-title="Check in time for players in minutes"></span></a></label>
                                    <input type="number" name="check_in" class="form-control{{ $errors->has('check_in') ? ' is-invalid' : '' }}" placeholder="{{ __('Check in') }}" value="{{ $tournament->check_in }}">
                                    @include('alerts.feedback', ['field' => 'check_in'])
                                </div>

                                <div class="form-group{{ $errors->has('kickoff') ? ' has-danger' : '' }}">
                                    <label>{{ __('Kickoff in') }}&nbsp;<a href="#"><span class="fas fa-question-circle" tool-tip-toggle="tooltip-demo" data-original-title="Players be kicked off if not submit evidence with in time [time in minutes]"></span></a></label>
                                    <input type="number" name="kickoff" class="form-control{{ $errors->has('kickoff') ? ' is-invalid' : '' }}" placeholder="{{ __('Time in minutes') }}" value="{{ $tournament->kickoff }}">
                                    @include('alerts.feedback', ['field' => 'kickoff'])
                                </div>

                                <div class="form-group{{ $errors->has('bracket_size') ? ' has-danger' : '' }}">
                                    <label>{{ __('Bracket Size') }}</label>
                                    <input type="text" name="bracket_size" class="number-only form-control{{ $errors->has('bracket_size') ? ' is-invalid' : '' }}" placeholder="{{ __('Bracket Size') }}" value="{{ $tournament->bracket_size }}">
                                    @include('alerts.feedback', ['field' => 'bracket_size'])
                                </div>

                                <div class="form-group{{ $errors->has('bracket_type') ? ' has-danger' : '' }}">
                                    <label>{{ __('Bracket Type') }}</label>
                                    <input type="text" name="bracket_type" class="form-control{{ $errors->has('bracket_type') ? ' is-invalid' : '' }}" placeholder="{{ __('Bracket Type') }}" value="{{ $tournament->bracket_type }}">
                                    @include('alerts.feedback', ['field' => 'bracket_type'])
                                </div>



                                <div class="player form-group{{ $errors->has('per_match') ? ' has-danger' : '' }}">
                                    <label>{{ __('Number of Players per match') }}</label>
                                    <select name="per_match" id="per_match" class=" form-control{{ $errors->has('per_match') ? ' is-invalid' : '' }}">
                                        <option value="50" {{$tournament->per_match == 50 ? "selected" : ''}} >50</option>
                                        <option value="100" {{$tournament->per_match == 100 ? "selected" : ''}} >100</option>
                                        <option value="150" {{$tournament->per_match == 150 ? "selected" : ''}}>150</option>
                                        <option value="200" {{$tournament->per_match == 200 ? "selected" : ''}}>200</option>
                                    </select>
                                    @include('alerts.feedback', ['field' => 'per_match'])
                                </div>

                                <div class="player form-group{{ $errors->has('top_players') ? ' has-danger' : '' }}">
                                    <label>{{ __('Top Players') }}</label>

                                    <input type="number" id="top_players" name="top_players" class="form-control{{ $errors->has('top_players') ? ' is-invalid' : '' }}" placeholder="{{ __('Top Players') }}" max="{{$tournament->per_match}}" value="{{ $tournament->top_players }}">

                                    @include('alerts.feedback', ['field' => 'top_players'])
                                </div>

                                <div class="team-fields form-group{{ $errors->has('team_size') ? ' has-danger' : '' }}">
                                    <label>{{ __('Team Size') }}</label>
                                    <select name="team_size" id="team-size" class="form-control{{ $errors->has('team_size') ? ' is-invalid' : '' }}">
                                        <option value="Single" {{$tournament->team_size == "Single" ? "selected" : ''}} >1 VS 1</option>
                                        <option value="Double" {{$tournament->team_size == "Double" ? "selected" : ''}} >2 VS 2</option>
                                        <option value="Five" {{$tournament->team_size == "Five" ? "selected" : ''}} >5 VS 5</option>
                                    </select>
                                 @include('alerts.feedback', ['field' => 'team_size'])
                                </div>


                                <div class="form-group{{ $errors->has('game_mode') ? ' has-danger' : '' }}">
                                    <label>{{ __('Game Mode') }}</label>
                                    <input type="text" name="game_mode" class="form-control{{ $errors->has('game_mode') ? ' is-invalid' : '' }}" placeholder="{{ __('Game Mode') }}" value="{{ $tournament->game_mode }}" required>
                                    @include('alerts.feedback', ['field' => 'game_mode'])
                                </div>

                                <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                    <h3>{{ __('Image') }}</h3>
                                    <input type="file" name="image" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" placeholder="{{ __('Image') }}">
                                    @include('alerts.feedback', ['field' => 'image'])
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <h5 class="title" style="margin-left:1%">Tournament Prize</h5>&nbsp;<a href="#"><span class="fas fa-question-circle" tool-tip-toggle="tooltip-demo" data-original-title="Tournament prize in euro"></span></a>
                        </div>

                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label>{{ __('Positions') }}</label>
                                    <input type="number" id="total-positions" class="form-control" placeholder="{{ __('Positions') }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <button type="button" class="btn btn-dark mt-4" id="make-positions">Make</button>
                            </div>
                            <div class="col-lg-12" id="positions">

                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-lg-6">

                                <div id="rules">
                                    <?php
                                    $count = 1;
                                    ?>
                                    @forelse($tournament->rules as $rule)
                                        <div class="gr">
                                            <div class="form-group">
                                                <label>{{ __('Rule') }}</label>
                                                <input type="text" name="rules[{{$count}}][title]" class="form-control" placeholder="{{ __('Rule') }}" value="{{$rule->title}}">
                                            </div>
                                            <div class="form-group">
                                                <label>{{ __('Details') }}</label>
                                                <textarea name="rules[{{$count}}][details]" class="form-control" placeholder="{{ __('Rule Details') }}">{{$rule->description}}</textarea>
                                            </div>
                                        </div>
                                        <?php $count++ ?>
                                    @empty
                                        <div class="gr">
                                            <div class="form-group">
                                                <label>{{ __('Rule') }}</label>
                                                <input type="text" name="rules[1][title]" class="form-control" placeholder="{{ __('Rule') }}">
                                            </div>
                                            <div class="form-group">
                                                <label>{{ __('Details') }}</label>
                                                <textarea name="rules[1][details]" class="form-control" placeholder="{{ __('Rule Details') }}"></textarea>
                                            </div>
                                        </div>
                                    @endforelse

                                </div>
                                <input type="hidden" data-count="{{$count}}" id="count">
                                <button type="button" id="addNewRule" class="btn btn-fill btn-primary">{{ __('Add new Rule') }}</button>

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


    <div id="rdata" style="display: none">
        <div class="gr">
            <div class="form-group">
                <label>{{ __('Rule') }}</label>
                <input type="text" name="rules[{count}][title]" class="form-control" placeholder="{{ __('Rule') }}">
            </div>
            <div class="form-group">
                <label>{{ __('Details') }}</label>
                <textarea name="rules[{count}][details]" class="form-control" placeholder="{{ __('Rule Details') }}"></textarea>
            </div>
        </div>
    </div>

    <div id="pdata" style="display: none">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>{{ __('Prize for Position') }}&nbsp;{count}</label>
                    <input type="number" name="position[{count}][prize]" class="form-control" value="0" placeholder="{{ __('Prize') }}" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>{{ __('Points for Position') }}&nbsp;{count}</label>
                    <input type="number" name="position[{count}][point]" class="form-control" value="0" placeholder="{{ __('Prize') }}" required>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $("#addNewRule").on('click', function () {
            var html = $("#rdata").html();
            var count = $("#count").data("count") + 1;
            $("#count").data("count", count);
            html = html.replace(/{(.+?)}/g, count);
            $("#rules").append(html);
        });
        function checkType() {
            if($("#type").val() == 'user'){
                $('.player').show();
                $('.team-fields').hide();
            }else {
                $('.player').hide();
                $('.team-fields').show();
            }
        }

        $("#type").change(function () {
            checkType();
        });
        $("#per_match").change(function () {
            var max = $(this).val();
            $("#top_players").attr("max", max);
        });
        $("#make-positions").click(function () {
            var total = $("#total-positions").val();
            var positions = '';
            for (var i = 1; i <= total; i++) {
                positions += $("#pdata").html().replace(/{(.+?)}/g, i);
            }
            $('#positions').html(positions)
        })
    </script>
@endpush
