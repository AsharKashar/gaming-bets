@extends('layouts.app', ['page' => __('Reported Issues '), 'pageSlug' => 'issues'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <form method="get">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">{{ __('Issues') }}</h4>
                        </div>

                        <div class="col-6 row text-right">
                                <div class="col-lg-8">
                                    <select name="status" id="status" class="form-control">
                                        <option value="pending">Pending</option>
                                        <option value="in_process">In Process</option>
                                        <option value="resolved">Resolved</option>
                                        <option value="canceled">Cancel</option>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <button class="btn btn-sm btn-primary">{{ __('Filter') }}</button>
                                </div>
                        </div>

                    </div>
                    </form>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                            <tr>
                                <th scope="col" width="5%">{{ __('Sr#') }}</th>
                                <th scope="col">{{ __('Title') }}</th>
                                <th scope="col">{{ __('Email') }}</th>
                                <th scope="col">{{ __('Desc') }}</th>
                                <th scope="col">{{ __('Status') }}</th>
                                <th scope="col">{{ __('Attachment') }}</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $sr=1; ?>
                            @foreach ($issues as $issue)
                                <tr>
                                    <td>{{ $sr++ }}</td>
                                    <td>{{ $issue->title }}</td>
                                    <td>{{ $issue->email }}</td>
                                    <td>{{ $issue->description }}</td>
                                    <td>{{ ucwords(implode(" ",explode('_',$issue->status))) }}</td>
                                    <td>
                                        @if($issue->file)
                                            <a target="_blank" href="{{asset("storage".$issue->file)}}">See Attachment</a>
                                        @else
                                            No Attachment
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                                                <a class="dropdown-item edit-btn" data-toggle="modal" data-target="#edit-issue" data-status="{{$issue->status}}" data-link="{{ route('issue.update',$issue->id) }}">{{ __('Update Status') }}</a>

                                            </div>
                                        </div>
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



    <!-- edit game Modal -->
    <div class="modal modal-black fade" id="edit-issue" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action=""  enctype="multipart/form-data" method="post" id="editForm">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">{{__("Update Status")}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label>{{ __('Status') }}</label>
                            <select name="status" id="status" class="form-control">
                                <option value="pending">Pending</option>
                                <option value="in_process">In Process</option>
                                <option value="resolved">Resolved</option>
                                <option value="canceled">Cancel</option>
                            </select>
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>
                    </div>
                    <div class="modal-footer">
                        @csrf
                        @method("patch")
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
        $(".edit-btn").click(function () {
            var url = $(this).data('link');
            var status = $(this).data('status');
            console.log(url);
            $("#status").val('status');
            $("#editForm").attr('action', url);
        });
    </script>
@endpush
