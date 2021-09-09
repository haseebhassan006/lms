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

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-striped text-center font-14">

                                    <tr>
                                        <th>Student Name</th>
                                        <th>Quiz Title</th>
                                        <th>Webinar Title</th>
                                        <th>Quiz Result</th>

                                        <th></th>
                                    </tr>

                                    @foreach($certificates as $ticket)
                                        <tr>
                                            <th scope="row">{{ $ticket->quiz->title }}</th>
                                            <th scope="row">{{ $ticket->quiz->webinar_title }}</th>
                                            <td>{{ $ticket->student->full_name }}</td>
                                            <td>{{ $ticket->quizzesResult->status }}</td>

                                            <td>


                                                @include('admin.includes.delete_button',['url' => '/admin/tickets/'. $ticket->id .'/delete', 'btnClass' => ' mt-1'])
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>





                        </div>



                    </div>
                </div>
            </div>
        </div>
    </section>





@endsection

@push('scripts_bottom')

@endpush
