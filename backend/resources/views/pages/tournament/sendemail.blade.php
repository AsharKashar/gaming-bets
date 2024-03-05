@extends('layouts.app', ['page' => __('Start Tournament '), 'pageSlug' => 'tournament'])

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
            <form method="POST">
                @csrf
                <div class="card ">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8">
                                <h4 class="card-title">{{ __('Send Email') }}</h4>
                            </div>
                            <div class="col-4 text-right">
                                <button type="submit" class="btn btn-sm btn-primary">{{ __('Send') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('alerts.success')
                        @if ($is_team)

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Start At:</label>
                                        <input type="text" name="start_at" class="form-control datepick" placeholder="start at">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>End At:</label>
                                        <input type="text" name="end_at" class="form-control datepick" placeholder="end at">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Email Content:</label>
                                <textarea name="body" id="editor-0"></textarea>
                            </div>

                        @else
                            @for($i=0; $i<$number;$i++)
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Match Title:</label>
                                            <input type="text" name="title[]" class="form-control"
                                                placeholder="Title For Match">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Start At:</label>
                                            <input type="text" name="start_at[]" class="form-control datepick" placeholder="start at">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Email Content:</label>
                                    <textarea name="body[]" id="editor-{{$i}}"></textarea>
                                </div>
                            @endfor
                        @endif

                    </div>
                    <div class="card-footer py-4 text-right">
                        <button type="submit" class="btn btn-sm btn-primary">{{ __('Send') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{asset("assets/js/ckeditor.js")}}"></script>
    <script>
        @for($i=0; $i<$number;$i++)
        ClassicEditor
            .create(document.querySelector('#editor-{{$i}}'), {
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
        @endfor
    </script>
@endpush
