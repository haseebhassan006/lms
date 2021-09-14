@extends('admin.layouts.app')

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

        <section class="section">
            <div class="section-header">
                <h1>New Subscribe Package</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">Subscribe</div>
                </div>
            </div>


            <div class="section-body card">

                <div class="d-flex align-items-center justify-content-between">
                    <div class="">
                        <h2 class="section-title ml-4">Create</h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-8 col-lg-6">
                            <div class="card-body">
                                <form action="/admin/financial/subscribes/store" method="Post">
                            {{ csrf_field() }}

                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control  " value="">
                                                                        </div>

                                    <div class="form-group">
                                        <label>Description (Optional)</label>
                                        <input type="text" name="description" class="form-control " value="" placeholder="Example: Suggested for Professionals.">
                                    </div>


                                    <div class="form-group">
                                        <label>Subscribe Times</label>
                                        <input type="text" name="usable_count" class="form-control  " value="">
                                                                        </div>

                                    <div class="form-group">
                                        <label>Days</label>
                                        <input type="text" name="days" class="form-control  " value="">
                                                                        </div>


                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" name="price" class="form-control  " value="">
                                                                        </div>

                                    <div class="form-group mt-15">
                                        <label class="input-label">Icon</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button type="button" class="input-group-text admin-file-manager" data-input="icon" data-preview="holder">
                                                    <i class="fa fa-chevron-up"></i>
                                                </button>
                                            </div>
                                            <input type="text" name="icon" id="icon" value="" class="form-control ">
                                                                                    <div class="input-group-append">
                                                <button type="button" class="input-group-text admin-file-view" data-input="icon">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group custom-switches-stacked">
                                        <label class="custom-switch pl-0">
                                            <input type="hidden" name="is_popular" value="0">
                                            <input type="checkbox" name="is_popular" id="isPopular" value="1" class="custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                            <label class="custom-switch-description mb-0 cursor-pointer" for="isPopular">Popular Badge</label>
                                        </label>
                                    </div>

                                    <div class=" mt-4">
                                        <button class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </section>
    </section>





@endsection

@push('scripts_bottom')

@endpush
