@extends('layouts.app', ['page' => __('User Management'), 'pageSlug' => 'users'])

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{asset('assets/js/jquery-3.4.1.min.js')}}"></script>
<script>


function assignRole(){
    console.log('actve');
        role=$("#admin_role").val();
        var dataSent={};
        dataSent['role']=role;
        $.ajax({
                  url: '/api/assignRole/'+role_user_id,
                  //dataSent['role']=role;
                  type: 'POST',
                  data: dataSent,
                  success: function (data) {
                    console.log('done');
                    setTimeout(() => location.reload(true), 2000);
                    $("#message").css("display", "block");

                  }

        });



    }




    </script>
<div id="overlay" style="background-color:black;opacity:0.8;width:100vw;height:100vh;position:fixed;z-index:9;display:none" onclick="closeOverlay()"></div>
<center><div id="popupSelect" style="width:650px;height:150px;position:fixed;z-index:10;margin:auto;background-color:#252F5A;padding:50px;margin-top:100px;margin-left:150px;display:none">
    Assign Role
    <select  style="color:white" id="admin_role">
        <option style="color:white" value="" selected>---</option>
        <option style="color:white" value="owner">Owner</option>
        <option style="color:white" value="lead">Lead Admin</option>
        <option style="color:white" value="admin">Admin</option>
        <option style="color:white" value="market">Marking Team</option>
      </select>
      <button id="submitRole" onclick="assignRole()">Assign</button><br><br>
      <button onclick="closeOverlay()">Close</button>
      <span id="message" style="display:none;color:red;font-size:15px">Role Assigned</span>
</div></center>
    <div class="row">
        <div class="col-md-12">
            <div class="card ">



@if(auth()->user()->admin_type=='owner' || auth()->user()->admin_type=='lead')
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{ __('Admins') }}</h4>
                        </div>
                        <!--<div class="col-4 text-right">
                            <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">{{ __('Add user') }}</a>
                        </div>-->
                    </div>
                </div>
                                                <div class="">
                                                    <table class="table tablesorter " id="">
                                                        <thead class=" text-primary">
                                                            <th scope="col">{{ __('Name') }}</th>
                                                            <th scope="col">{{ __('Email') }}</th>
                                                            <th scope="col">{{ __('Creation Date') }}</th>
                                                            <th scope="col">{{ __('Current Role') }}</th>
                                                            <th scope="col">{{ __('Role Assign') }}</th>
                                                            {{--<th scope="col"></th>--}}
                                                        </thead>
                                                        <tbody>

                                                @foreach ($users as $user)
                                                @if($user->user_type=='admin')
                                                    <tr>
                                                        <td>{{ $user->name }}</td>
                                                        <td>
                                                            <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                                        </td>
                                                        <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                                        <td>{{ $user->admin_type }}</td>
                                                        <td>
                                                            <a href="#!" onclick="openOverlay({{$user->id}})">Assign Role</a>
                                                            {{-- <select  style="color:white" id="admin_role">
                                                                <option style="color:white" value="" selected>---</option>
                                                                <option style="color:white" value="owner">Owner</option>
                                                                <option style="color:white" value="lead">Lead Admin</option>
                                                                <option style="color:white" value="admin">Admin</option>
                                                                <option style="color:white" value="marking">Marking Team</option>
                                                              </select>
                                                              <button onclick="assignRole({{$user->id}})">Assign</button> --}}
                                                        </td>

                                                    </tr>
                                                @endif
                                                @endforeach





                                            </tbody>
                                        </table>
                                    </div>
@endif
                                    <br>


                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{ __('Users') }}</h4>
                        </div>
                        <!--<div class="col-4 text-right">
                            <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">{{ __('Add user') }}</a>
                        </div>-->
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Email') }}</th>
                                <th scope="col">{{ __('Creation Date') }}</th>
                                {{--<th scope="col"></th>--}}
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                @if($user->user_type!='admin')
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                        </td>
                                        <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                       {{-- <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        @if (auth()->user()->id != $user->id)
                                                            <form action="{{ route('user.destroy', $user) }}" method="post">
                                                                @csrf
                                                                @method('delete')

                                                                <a class="dropdown-item" href="{{ route('user.edit', $user) }}">{{ __('Edit') }}</a>
                                                                <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                                            {{ __('Delete') }}
                                                                </button>
                                                            </form>
                                                        @else
                                                            <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Edit') }}</a>
                                                        @endif
                                                    </div>
                                                </div>
                                        </td>--}}
                                    </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>



                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $users->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>

@endsection
