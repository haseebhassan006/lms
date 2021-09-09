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
                                        <th>Webinar</th>
                                        <th>teacher</th>
                                        <th> quizQuestions</th>
                                        <th>quizResults</th>


                                        <th></th>
                                    </tr>

                                    @foreach($quizzes as $quiz)
                                        <tr>
                                            <th scope="row">{{ $quiz->webinar->title }}</th>
                                            <td>{{ $quiz->teacher->full_name }}</td>
                                            <td>
                                                @foreach($quiz->quizQuestions as $quiztitle)
                                                {{ $quiztitle->title }}
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($quiz->quizResults as $res)
                                                {{ $res->status }}
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ url('admin/quizzes/'.$quiz->id.'/edit') }}" data-quiz-id="{{ $quiz->id }}" data-webinar-id="" class="edit-quiz btn-transparent text-primary mt-1" data-toggle="tooltip" data-placement="top" title="{{ trans('admin/main.edit') }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                {{-- @include('admin.includes.delete_button',['url' => '/admin/quiz/'. $quiz->id .'/delete', 'btnClass' => ' mt-1']) --}}
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
