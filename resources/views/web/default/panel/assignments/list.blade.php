@extends(getTemplate() .'.panel.layouts.panel_layout')

@push('styles_top')

@endpush

@section('content')
<div class="section-header">
    <h1>Assignments</h1>
    <div class="section-header-breadcrumb">

        <div class="breadcrumb-item"></div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped font-14">
                        <tr>
                            <th>File</th>
                            <th class="text-left">Title</th>
                            <th>Course</th>
                            <th>Deadline</th>
                            <th>Action</th>
                        </tr>
                        @foreach($assignments as $assignment)

                            <tr>
                                <td>
                                    {{-- <iframe src="{{ $assignment->file }}" frameborder="0" style="width:30px"></iframe> --}}
                                    <img src="{{ $assignment->file }}" width="30" alt="">
                                </td>
                                <td class="text-left">{{ $assignment->title }}</td>
                                <td>{{ $assignment->course->title }}</td>
                              
                                <td>{{ $assignment->deadline }}</td>
                                

                                <td>

                                        <a href="/panel/assignments/files/{{$assignment->id}}" class="btn-sm btn-primary w-10 mt-2">
                                            <i class="fas fa-download"></i>
                                        </a>|
                                        <a href="/panel/assignments/upload/{{ $assignment->id }}" class="btn-sm btn-primary w-10 mt-2">
                                            <i class="fas fa-upload"></i>
                                         </a>



                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            <div class="card-footer text-center">
                {{ $assignments->links() }}
            </div>
        </div>
    </div>
</div>


@endsection
@push('scripts_bottom')
@endpush
