@extends('admin.layouts.app')

@push('styles_top')
    <link href="/assets/default/vendors/sortable/jquery-ui.min.css"/>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1> Assignment</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">{{ trans('admin/main.dashboard') }}</a>
                </div>
                <div class="breadcrumb-item active">
                    <a href="/admin/assignments">Assignments</a>
                </div>
                <div class="breadcrumb-item">Add New Assignment</div>
            </div>
        </div>

        <div class="section-body">
@if (Session::has('message'))
<p class="alert alert-success">{{ Session::get('message') }}</p>

@endif
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="/admin/assignments/{{$assignment->id}}/update" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" value="{{ $assignment->title }}"
                                           class="form-control  @error('title') is-invalid @enderror"

                                           placeholder="{{ trans('admin/main.choose_title') }}"/>
                                    @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Course</label>

                                    <select name="course" class="form-control  @error('course') is-invalid @enderror">
                                        <option>
                                            Select Course
                                        </option>
                                           @foreach($courses  as $course)
                                        <option @if($assignment->webinar_id == $course->id) selected @endif value="{{ $course->id }}" >{{ $course->title }}</option>
                                        @endforeach

                                     </select>
                                    @error('course')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Description</label>

                                     <textarea class="form-control  @error('description') is-invalid @enderror" name="description">
                                        @if ($assignment->description)

                                       {!! $assignment->description !!}

                                        @endif
                                    </textarea>
                                    @error('descriptiom')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                   <label>DeadLine</label>
                                   <input type="date" name="deadline" class="form-control" value="{{ $assignment->deadline }}">
                                    @error('deadline')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="input-label">File</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button type="button" class="input-group-text admin-file-manager " data-input="icon" data-preview="holder">
                                                <i class="fa fa-upload"></i>
                                            </button>
                                        </div>

                                        <input type="text" name="file" id="icon" value="{{ $assignment->file }}" class="form-control @error('icon') is-invalid @enderror"/>
                                        <div class="invalid-feedback">@error('file') {{ $message }} @enderror</div>
                                    </div>
                                </div>
                                <div class="text-right mt-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>

                            <li class="form-group main-row list-group d-none">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text cursor-pointer move-icon">
                                            <i class="fa fa-arrows-alt"></i>
                                        </div>
                                    </div>

                                    <input type="text" name="sub_categories[record][title]"
                                           class="form-control w-auto flex-grow-1"
                                           placeholder="{{ trans('admin/main.choose_title') }}"/>

                                    <div class="input-group-append">
                                        <button type="button" class="btn remove-btn btn-danger"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </li>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/sortable/jquery-ui.min.js"></script>
    <script src="/assets/default/js/admin/categories.min.js"></script>
@endpush
