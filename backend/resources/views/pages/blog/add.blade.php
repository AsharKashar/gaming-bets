@extends('layouts.app', ['page' => __('Add Blog Post'), 'pageSlug' => 'post'])

@section('content')
    <style>
        .ck .ck-content {
            height: 50vh;
        }

        .ck.ck-editor__main > .ck-editor__editable * {
            color: #000000;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <form method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card ">
                    <div class="card-header">
                        <h4>Fill details</h4>
                    </div>
                    <div class="card-body">
                        @include('alerts.success')

                        <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                            <label>{{ __('Post Title') }}</label>
                            <input type="text" name="title" class="form-control{{ $errors->has('bracket_size') ? ' is-invalid' : '' }}" placeholder="{{ __('Post Title') }}" value="{{ old('title') }}">
                            @include('alerts.feedback', ['field' => 'title'])
                        </div>

                        <div class="form-group{{ $errors->has('category') ? ' has-danger' : '' }}">
                            <label>{{ __('Category') }}</label>
                            <select name="category" class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{ $category->id == old('category') ? 'selected' : '' }}>{{$category->name}}</option>
                            @endforeach
                            </select>
                            @include('alerts.feedback', ['field' => 'category'])
                        </div>

                        <label>Image <a href="#"><span class="fas fa-question-circle" tool-tip-toggle="tooltip-demo" data-original-title="Image for Blog Post"></span></a></label>
                        <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                            <h3 class="btn">{{ __('Image') }}</h3>
                            <input type="file" name="image" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" placeholder="{{ __('Image') }}" value="{{ old('image') }}">
                            @include('alerts.feedback', ['field' => 'image'])

                        </div>
                        <div class="form-group">
                            <label for="">Post Content:</label>
                            <textarea name="body" id="editor"></textarea>
                        </div>

                        <div class="card-footer py-4 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">{{ __('Save') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{asset("assets/js/ckeditor.js")}}"></script>
    <script>

        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
                heading: {
                    options: [
                        {
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        }
                    ]
                }
            })
            .catch(error => {
                console.log(error);
            });

    </script>
@endpush
