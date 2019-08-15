@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/editLesson.css') }}">
@endsection

@section('content-content')

<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">

            <h3 class="page-title">{{ trans('message.classMangement') }}</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">{{ trans('message.class') }}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('message.classDetail') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <p>{{ trans('message.classDetail') }}</p>
            <ul class="box-controls pull-right">
                <li><a class="box-btn-slide" href="#"></a></li>
            </ul>
        </div>
        <div class="box-body">
            <div class="board">
                <div class="board-inner">
                    <ul class="nav nav-tabs" id="myTab">
                        {{-- <div class="liner"></div> --}}
                        <li class="active">
                            <a href="#home" data-toggle="tab" title="welcome">
                                <span class="round-tabs one">
                                    <i class="fa fa-info"></i>
                                </span> 
                            </a>
                        </li>

                        <li>
                            <a href="#profile" data-toggle="tab" title="profile">
                            <span class="round-tabs two">
                                <i class="fa fa-book"></i>
                            </span> 
                            </a>
                        </li>

                        <li>
                            <a href="#messages" data-toggle="tab" title="bootsnipp goodies">
                                <span class="round-tabs three">
                                    <i class="fa fa-pencil"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div class="tab-pane fade in active" id="home">
                        <form action="" method="POST" role="form" id="edit-info">
                            @csrf
                            <legend>{{ trans('message.class') }} {{ trans('message.info') }}</legend>
                        
                            <div class="form-group">
                                <label for="">{{ trans('message.id') }}</label>
                                <input type="text" value ="{{ $lessons->id }}" hidden name="id">
                                <p class="form-control" id="" name="id" value ="{{ $lessons->id }}">{{ $lessons->id }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">{{ trans('message.name') }}</label>
                                <input type="text" class="form-control" name="name" id="" placeholder="Input field" value ="{{ $lessons->name }}">
                            </div>
                            <div class="form-group">
                                <label for="">{{ trans('message.time_study') }}</label>
                                <input type="datetime" class="form-control" name="time_study" id="" placeholder="Input field" value ="{{ $lessons->time_study }}">
                            </div>

                            <button type="submit" class="btn btn-primary">{{ trans('message.submit') }}</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="profile">
                        <form action="" method="POST" role="form" id="addTheory" data-lessonid="{{ $lessons->id }}">
                            @csrf
                            <legend>{{ trans('message.select') }} {{ trans('message.theory') }}</legend>
                            <div class="form-group">
                                <select name="" id="addLessionDocument" class="form-control">
                                    @foreach ($documents as $document)
                                        <option data-documentid="{{ $document->id }}">{{ $document->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                        <div class="appendTheory">
                            
                        </div>
                        <div class="accordion" id="accordionExample">
                            @foreach ($lessondocuments as $lessondocument)
                            <div class="card">
                                <div class="card-header" id="{{ $lessondocument->id }}">
                                  <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#{{ $lessondocument->document->slug }}" aria-expanded="true" aria-controls="{{ $lessondocument->document->slug }}">
                                        {{ $lessondocument->document->title }}
                                    </button>
                                  </h2>
                                </div>

                                <div id="{{ $lessondocument->document->slug }}" class="collapse" aria-labelledby="{{ $lessondocument->id }}" data-parent="#accordionExample">
                                  <div class="card-body">
                                    {!! $lessondocument->document->content !!}
                                  </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                    </div>
                    <div class="tab-pane fade" id="messages">
                        <form action="" method="POST" role="form" data-lessonid="{{ $lessons->id }}" id="addExercise">
                            @csrf
                            <legend>{{ trans('message.select') }} {{ trans('message.exercise') }}</legend>
                            {{--  Deadline: <input type="datetime-local" required class="a" value=""/> --}}
                            <div class="form-group">
                                <select name="" id="addLessionExercise" class="form-control">
                                    @foreach ($exercises as $exercise)
                                        <option data-exerciseid="{{ $exercise->id }}">{{ $exercise->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                        <div class="appendExercise">
                            
                        </div>
                        <div class="accordion" id="accordionExample">
                            @foreach ($lessonexercises as $lessonexercise)
                            <div class="card">
                                <div class="card-header" id="{{ $lessonexercise->id }}">
                                  <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#{{ $lessonexercise->exercise->slug }}" aria-expanded="true" aria-controls="{{ $lessonexercise->exercise->slug }}">
                                        {{ $lessonexercise->exercise->title }}
                                    </button>
                                  </h2>
                                </div>

                                <div id="{{ $lessonexercise->exercise->slug }}" class="collapse" aria-labelledby="{{ $lessonexercise->id }}" data-parent="#accordionExample">
                                  <div class="card-body">
                                    {!! $lessonexercise->exercise->content !!}
                                  </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('ajax')
    <script src="{{ asset('js/classesDetail.js') }}"></script>
@endsection
