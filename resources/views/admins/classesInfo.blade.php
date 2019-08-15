@extends('layouts.admin')
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
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('message.lesson') }}</li>
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
            @if (Gate::allows('edit_lesson'))
            <button type="button" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#addNewleson">{{ trans('message.addNew') }} {{ trans('message.lesson') }}</button>
            @endif
            <table class="table table-bordered" id="classDetail" data-url="{{ route('classDetailDatatable', $id) }}" data-id="{{ $id }}" >
                <thead>
                    <tr>
                        <th>{{ trans('message.id') }}</th>
                        <th>{{ trans('message.name') }}</th>
                        <th>{{ trans('message.time_study') }}</th>
                        <th>{{ trans('message.action') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section>

@endsection

<div id="addNewleson" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> {{ trans('message.addNew') }} {{ trans('message.lesson') }}</h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST" role="form">
                    <div class="form-group">
                        <label for="">{{ trans('message.name') }}</label>
                        <input type="text" class="form-control" id="classname" placeholder="Input field">
                    </div>
                    <div class="form-group">
                        <label for="">{{ trans('message.time_study') }}</label>
                        <input type="datetime-local" class="form-control" id="classtimestudy" placeholder="Input field">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info addclass float-right">{{ trans('message.submit') }}</button> 
                <button type="button" class="btn btn-default float-right" data-dismiss="modal">{{ trans('message.close') }}</button>
            </div>
        </div>
    </div>
</div>

@section('ajax')
    <script src="{{ asset('js/classesDetail.js') }}"></script>
@endsection
