@extends('layouts.app', ['page' => __('Tournament '), 'pageSlug' => 'tournament'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{ __('Tournaments') }}</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route("add.tournament") }}" class="btn btn-sm btn-primary">{{ __('Add Tournament') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                            <th scope="col">{{ __('Game') }}</th>
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col">{{ __('Current Round') }}</th>
                            <th scope="col">{{ __('Platforms') }}</th>
                            <th scope="col">{{ __('Registration Start At') }}</th>
                            <th scope="col">{{ __('Registration End At') }}</th>
                            <th scope="col">{{ __('Start At') }}</th>
                            <th scope="col" colspan="2"></th>
                            </thead>
                            <tbody>
                            @foreach ($tournaments as $tournament)
                                <tr>
                                    <td>{{ $tournament->game->name }}</td>
                                    <td>{{ $tournament->name }}</td>
                                    <td>{{ $tournament->type == 'team' ? $tournament->rounds_finished+1 : '-' }}</td>
                                    <td>{{ $tournament->platforms }}</td>
                                    <td>{{ $tournament->reg_start_at->diffForHumans() }}</td>
                                    <td>{{ $tournament->reg_end_at->diffForHumans() }}</td>
                                    <td>{{ $tournament->start_at->diffForHumans() }}</td>
                                    <td>
                                        @if($tournament->status == "up_coming")
                                            <a class="btn btn-sm btn-info" href="{{ route("pages.email.send",$tournament->id) }}">Start Now</a>
                                        @endif
                                        @if ($tournament->type == "user")

                                            @if($tournament->status == "started")
                                                <a class="btn btn-sm btn-info" href="{{ route("tournament.close",$tournament->id) }}">End Tournament</a>
                                            @endif
                                            @if($tournament->status == "ended")
                                                <a class="btn btn-sm btn-info" href="{{ route("tournament.rematch",$tournament->id) }}">Rematch</a>
                                            @endif
                                        @else
                                            @if ($tournament->rounds_finished == $tournament->match_rounds)
                                                <a class="btn btn-sm btn-info" href="{{ route("tournament.close",$tournament->id) }}">End Tournament</a>
                                            @endif
                                        @endif

                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                                                <form action="{{ route('delete.tournament', $tournament->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>

                                                @if($tournament->type == 'team')
                                                    @if ($tournament->rounds_finished < $tournament->match_rounds)
                                                        <a class="dropdown-item" href="{{ route("tournament.end_round",$tournament->id) }}">Kick Off Teams</a>
                                                        <a class="dropdown-item" href="{{ route("tournament.rematch",$tournament->id) }}">Start Next Round</a>
                                                    @endif
                                                @endif
                                                <a class="dropdown-item" href="{{ route('edit.tournament',$tournament->id) }}">{{ __('Edit') }}</a>
                                                <a class="dropdown-item" href="{{ route('tournament.matches',$tournament->id) }}">{{ __('Matches') }}</a>
                                                <a class="dropdown-item" href="{{ route('add.result',$tournament->id) }}">{{ __('Add Tournament Winners') }}</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $tournaments->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection




