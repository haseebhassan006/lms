@extends(getTemplate() .'.panel.layouts.panel_layout')

@push('styles_top')
<link href="/assets/default/vendors/sortable/jquery-ui.min.css"/>
@endpush

@section('content')
@if (Session::has('message'))
<p class="alert alert-success">{{ Session::get('message') }}</p>

@endif
<form action="/panel/assignments/store" method="post" enctype="multipart/form-data">

    {{ csrf_field() }}

    <div class="form-group">
        <label>Title</label>
        <input type="text" name="title"
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
            <option value="{{ $course->id }}">{{ $course->title }}</option>
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
        </textarea>
        @error('descriptiom')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group">
       <label>DeadLine</label>
       <input type="date" name="deadline" class="form-control">
        @error('deadline')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group mt-15">
        <label class="input-label">File</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <button type="button" class="input-group-text panel-file-manager" data-input="cover_image" data-preview="holder">
                    <i data-feather="arrow-up" width="18" height="18" class="text-white"></i>
                </button>
            </div>
            <input type="text" name="file" id="cover_image" value="" placeholder="Drop File Here" class="form-control @error('image_cover')  is-invalid @enderror"/>

        </div>
    </div>
    <div class="text-right mt-4">
        <button type="submit" class="btn btn-primary">{{ trans('admin/main.submit') }}</button>
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

@endsection
@push('scripts_bottom')
<script src="/assets/default/vendors/sortable/jquery-ui.min.js"></script>
<script src="/assets/default/js/admin/categories.min.js"></script>
<script>



    $('body').on('click', '#sendForReview', function (e) {
$(this).addClass('loadingbar primary').prop('disabled', true);
e.preventDefault();
$('#forDraft').val(0);
$('#webinarForm').trigger('submit');
});
</script>

<script src="/assets/default/js/panel/webinar.min.js"></script>
@endpush
