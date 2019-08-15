@extends('layouts.admin')

@section('content-content')

<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">{{ trans('message.class') }} {{ trans('message.management') }}</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">{{ trans('message.lesson') }}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('message.exercise') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $lessons->name }} : {{ $users->name }}</h3>
            <ul class="box-controls pull-right">
                <li><a class="box-btn-slide" href="#"></a></li>
            </ul>
        </div>
        <div class="box-body">
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
                        <div class="card-body">{!! $lessonexercise->exercise->content !!}</div>
                    </div>

                    <div>
                        <a class="float-right btn btn-warning btn-sm showHomework" data-id="{{ $lessonexercise->id }}" data-lessonId="{{ $lessons->id }}" data-userId="{{ $users->id }}" data-toggle="modal" data-target="#showHomework"><i class="fa fa-pencil-square-o"></i> {{ trans('message.show') }} {{ trans('message.homework') }}</a>
                    </div>

                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection


@section('ajax')
    <script src="{{ asset('js/lesson.js') }}"></script>
@endsection

<div class="modal fade" id="showHomework" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('message.show') }} {{ trans('message.homework') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" role="form" >
                    @csrf
                    <div class="form-group">
                        <label for="">{{ trans('message.mark') }}</label>
                        <input type="number" max="10" id="mark1" class="form-control">
                        {{-- <p id="mark1" class="form-control"></p> --}}
                    </div>
                    <div class="form-group">
                        <label for="">{{ trans('message.content') }}</label>
                        <p id="content"  class="form-control" ></p>
                    </div>
                    <div class="form-group">
                        <label for="">{{ trans('message.comment') }}</label>
                        <input type="text" id="comment1" class="form-control">
                        {{-- <p id="comment1" ></p> --}}
                    </div>
                    <button type="button" class="btn btn-default float-right" data-dismiss="modal">{{ trans('message.close')}}</button>
                    <button type="submit" class="btn btn-info float-right submitMarking" data-dismiss="modal" >{{ trans('message.submit') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
