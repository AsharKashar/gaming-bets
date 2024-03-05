@extends('layouts.app', ['page' => __('Categories '), 'pageSlug' => 'category'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{ __('Categories') }}</h4>
                        </div>

                        <div class="col-4 text-right">
                            <a data-toggle="modal" data-target="#add-category" class="btn btn-sm btn-primary">{{ __('Add Category') }}</a>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                            <tr>
                                <th scope="col" width="5%">{{ __('Sr#') }}</th>
                                <th scope="col">{{ __('Category') }}</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $sr=1; ?>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $sr++ }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                                                <form action="{{ route('categories.delete', $category->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>

                                                <a class="dropdown-item edit-btn" data-toggle="modal" data-target="#edit-category" data-name="{{$category->name}}" data-link="{{ route('categories.update',$category->id) }}">{{ __('Edit') }}</a>

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


    <!-- add game Modal -->
    <div class="modal modal-black fade" id="add-category" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="post" enctype="multipart/form-data" id="winnerForm">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">{{__("Add Category")}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label>{{ __('Category Name') }}</label>
                            <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Category Name') }}" value="{{ old('name') }}" required>
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>
                    </div>
                    <div class="modal-footer">
                        @csrf
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- edit game Modal -->
    <div class="modal modal-black fade" id="edit-category" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action=""  enctype="multipart/form-data" method="post" id="editForm">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">{{__("Edit Category")}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label>{{ __('Category Name') }}</label>
                            <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Game Name') }}" value="{{ old('name') }}" required>
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
            var name = $(this).data('name');
            console.log(url);
            $("#editForm :input[name='name']").val(name);
            $("#editForm").attr('action', url);
        });
    </script>
@endpush
