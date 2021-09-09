@extends('admin.layouts.app')
@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/daterangepicker/daterangepicker.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/bootstrap-timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/bootstrap-tagsinput/bootstrap-tagsinput.min.css">
    <link rel="stylesheet" href="/assets/vendors/summernote/summernote-bs4.min.css">
    <style>
        .bootstrap-timepicker-widget table td input {
            width: 35px !important;
        }
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">{{trans('admin/main.dashboard')}}</a>
                </div>
                <div class="breadcrumb-item">{{ $pageTitle}}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="col-12 ">
                        <div class="card">

@if(empty($template))

 <form method="post"  action="/admin/certificates/templates/store" id="webinarForm" class="webinar-form">
@else
<form method="post"  action='{{ route('update.certificate',$template->id) }}' id="webinarForm" class="webinar-form">
    @endif

                                    {{ csrf_field() }}

                                    <section>
                                        <h2 class="section-title after-line">Upload Certificate Template<h2>

                                        <div class="row">
                                            <div class="col-12 col-md-5">

                                                <div class="form-group mt-15">
                                                    <label class="input-label">Image</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <button type="button" class="input-group-text admin-file-manager" data-input="thumbnail" data-preview="holder">
                                                                <i class="fa fa-upload"></i>
                                                            </button>
                                                        </div>
                                                        <input type="text" name="image" id="thumbnail" value="{{ !empty($template) ? $template->image : old('image') }}" class="form-control @error('image')  is-invalid @enderror"/>
                                                        <div class="input-group-append">
                                                            <button type="submit" class="input-group-text admin-file-view" data-input="thumbnail">
                                                                <i class="fa fa-eye"></i>
                                                            </button>
                                                        </div>
                                                        @error('image')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group mt-15">
                                                    <label class="input-label">{{ trans('public.title') }}</label>
                                                    <input type="text" name="title" value="{{ !empty($template) ? $template->title : old('title') }}" class="form-control @error('title')  is-invalid @enderror" placeholder="Title"/>
                                                    @error('title')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-15">
                                                    <label class="input-label">Position X</label>
                                                    <input type="text" name="position_x" value="{{ !empty($template) ? $template->position_x : old('position_x') }}" class="form-control @error('position_x')  is-invalid @enderror" placeholder="Position X"/>
                                                    @error('position_x')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-15">
                                                    <label class="input-label">Position Y</label>
                                                    <input type="text" name="position_y" value="{{ !empty($template) ? $template->position_y : old('position_y') }}" class="form-control @error('position_y')  is-invalid @enderror" placeholder="Position Y"/>
                                                    @error('position_y')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-15">
                                                    <label class="input-label">Color</label>
                                                    <input type="text" name="text_color" value="{{ !empty($template) ? $template->text_color : old('text_color') }}" class="form-control @error('color')  is-invalid @enderror" placeholder="Color"/>
                                                    @error('color')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-15">
                                                    <label class="input-label">Font Size</label>
                                                    <input type="text" name="font_size" value="{{ !empty($template) ? $template->font_size : old('font_size') }}" class="form-control @error('font_size')  is-invalid @enderror" placeholder="Font Size"/>
                                                    @error('font_size')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group mt-15">
                                                            <label class="input-label">{{ trans('public.description') }}</label>
                                                            <textarea id="summernote" name="body" class="form-control @error('body')  is-invalid @enderror" placeholder="">{{ !empty($template) ? $template->body : old('font_size') }}</textarea>
                                                            @error('body')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>



                                            </div>
                                        </div>


                                    </section>





                                    <div class="row">
                                        <div class="col-12">
                                            <button type="submit" id="aveAndPublish" class="btn btn-success">Upload</button>

                                        </div>
                                    </div>
                                </form>


                                @include('admin.webinars.modals.prerequisites')
                                @include('admin.webinars.modals.quizzes')
                                @include('admin.webinars.modals.ticket')
                                @include('admin.webinars.modals.session')
                                @include('admin.webinars.modals.file')
                                @include('admin.webinars.modals.faq')
                                @include('admin.webinars.modals.testLesson')

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>





@endsection

@push('scripts_bottom')
    {{-- <script>
        ;(function (){
        'use strict'
        var saveSuccessLang = '{{ trans('webinars.success_store') }}';
        var zoomJwtTokenInvalid = '{{ trans('admin/main.teacher_zoom_jwt_token_invalid') }}';
        }())
    </script> --}}

    <script src="{{ asset('assets/default/vendors/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('/assets/default/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('/assets/default/vendors/moment.min.js') }}"></script>
    <script src="{{ asset('/assets/default/vendors/daterangepicker/daterangepicker.min.js') }}"></script>
    <script src="{{ asset('/assets/default/vendors/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('/assets/default/vendors/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('/assets/vendors/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/js/webinar.min.js') }}"></script>
@endpush

