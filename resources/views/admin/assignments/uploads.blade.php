@extends('admin.layouts.app')

@push('libraries_top')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Assignments</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">{{trans('admin/main.dashboard')}}</a>
                </div>
                <div class="breadcrumb-item"></div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>

                                        <th class="text-left">Title</th>
                                        <th class="text-left">Submited By</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach($uploads as $upload)

                                        <tr>
                                            <td>{{ $upload->course->title }}</td>
                                            <td>{{ $upload->user->full_name }}</td>
                                            <td>
                                                @can('admin_categories_edit')
                                                    <a href="/admin/assignments/{{ $upload->id }}/edit"
                                                       class="btn-transparent btn-sm text-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('admin_categories_delete')
                                                    @include('admin.includes.delete_button',['url' => '/admin/assignments/'.$upload->id.'/delete'])
                                                @endcan

                                                | <a href="/admin/assignments/download/{{ $upload->id }}" class="btn-sm btn-primary w-10 mt-2">
                                                    <i class="fas fa-download"></i>
                                                 </a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $uploads->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
