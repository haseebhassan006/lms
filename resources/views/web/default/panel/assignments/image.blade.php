<section>
    <h3 class="section-title after-line mt-35">Upload Assignment</h3>

    <div class="row mt-20">


        <div class="col-12 col-lg-4">
            <form action="/panel/assignments/submit" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
            <div class="form-group">
                <label class="input-label">Upload File</label>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button type="button" class="input-group-text panel-file-manager" data-input="cover_img" data-preview="holder">
                                <i data-feather="arrow-up" width="18" height="18" class="text-white"></i>
                            </button>
                        </div>
                        <input type="text" name="file" id="cover_img" value="" class="form-control " placeholder="{{ trans('forms.course_cover_size') }}"/>
                        <input type="hidden" name="assignment_id" value="{{ $file->id }}">
                    </div>

                </div>
                <div class="form-group">
                    <div class="input-group">
                        <button type="submit" class="btn btn-primary" >Upload</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</section>

<div class="modal fade" id="avatarCropModalContainer" tabindex="-1" role="dialog" aria-labelledby="avatarCrop">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">{{ trans('public.edit_selected_image') }}</h4>
            </div>
            <div class="modal-body">
                <div id="imageCropperContainer">
                    <div class="cropit-preview"></div>
                    <div class="cropit-tools">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="mr-20">
                                <button type="button" class="btn btn-transparent rotate-cw mr-10">
                                    <i data-feather="rotate-cw" width="18" height="18"></i>
                                </button>
                                <button type="button" class="btn btn-transparent rotate-ccw">
                                    <i data-feather="rotate-ccw" width="18" height="18"></i>
                                </button>
                            </div>

                            <div class="d-flex align-items-center justify-content-center">
                                <span>-</span>
                                <input type="range" class="cropit-image-zoom-input mx-10">
                                <span>+</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-transparent" id="cancelAvatarCrop">{{ trans('public.cancel') }}</button>
                        <button class="btn btn-green" id="storeAvatar">{{ trans('public.select') }}</button>
                    </div>
                    <input type="file" class="cropit-image-input">
                </div>
            </div>
        </div>
    </div>
</div>
