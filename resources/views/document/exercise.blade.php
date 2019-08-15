@extends('layouts.admin')
@section('content-content')

<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">{{ trans('message.documentMangement') }}</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">{{ trans('message.documentMangement') }}</li>
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
            <h3 class="box-title">{{ trans('message.exercise') }}</h3>
        </div>
        <div class="box-body">
            <form action="{{ route('importData') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Import User Data</button>
            </form>
            <button type="button" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#addNew">{{ trans('message.addNew') }}</button>
            <table class="table table-bordered" id="exercise-table" data-url={{ route('exerciseDatatable') }}>
                <thead>
                    <tr>
                        <th>{{ trans('message.id') }}</th>
                        <th>{{ trans('message.title') }}</th>
                        <th>{{ trans('message.created_at') }}</th>
                        <th>{{ trans('message.action') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section> 

@endsection
{{-- modal add New  --}}
<div id="addNew" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ trans('message.addNew') }}</h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST" role="form" novalidate id="addData" data-url="{{ asset('documents/addTheory') }}">
                    @csrf
                    <legend>{{ trans('message.addNew') }} {{ trans('message.exercise') }} </legend>
                    <div class="form-group">
                        <label for="">{{ trans('message.course') }}</label>
                        <select name="course_id" id="Course" class="form-control">
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}" >{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">{{ trans('message.title') }}</label>
                        <input type="text" class="form-control" id="add-title" name="title" placeholder="Input field">
                    </div>
                    <div class="form-group">
                        <label for="">{{ trans('message.content') }}</label>
                        <textarea name="editor1" id="editor1" rows="10" cols="80" name="content"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer float-right">
                <button type="button" class="btn btn-default float-right " data-dismiss="modal">{{ trans('message.close') }}</button>
                <button type="button" class="btn btn-info float-right submit-add">{{ trans('message.submit') }}</button> 
            </div>
        </div>

    </div>
</div>

{{--. modal edit  --}}
<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ trans('message.edit') }} {{ trans('message.exercise') }}</h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST" role="form" novalidate id="addData">
                    @csrf
                    <legend>{{ trans('message.edit') }} {{ trans('message.exercise') }} </legend>
                    <div class="form-group">
                        <label for="">{{ trans('message.course') }}</label>
                        <select name="course_id" id="edit-Course" class="form-control">
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}" >{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">{{ trans('message.title') }}</label>
                        <input type="text" class="form-control" id="edit-title" name="title" placeholder="Input field">
                    </div>
                    <div class="form-group">
                        <p for="">{{ trans('message.content') }}</p>
                        <textarea name="edit-editor" id="editEditor" rows="10" cols="80" name="content"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer float-right">
                <button type="button" class="btn btn-default float-right " data-dismiss="modal">{{ trans('message.close') }}</button>
                <button type="button" class="btn btn-info float-right submit-edit">{{ trans('message.submit') }}</button> 
            </div>
        </div>

    </div>
</div>

{{-- show  --}}
<div id="show" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ trans('message.theory') }}</h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST" role="form" novalidate id="addData" data-url="{{ asset('documents/addTheory') }}">
                    @csrf
                    <legend>{{ trans('message.detail') }} {{ trans('message.theory') }} </legend>
                    <div class="form-group">
                        <label for="">{{ trans('message.course') }}</label>
                        <select name="course_id" id="show-Course" class="form-control">
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}" >{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <b><label for="">{{ trans('message.title') }}</label></b>
                        <div type="text" id="show-title" name="title" placeholder="Input field"></div>
                    </div>
                    <div class="form-group">
                        <p for=""><b>{{ trans('message.content') }}</b></p>
                        <p id="show-content"></p>
                    </div>
                </form>
            </div>
            <div class="modal-footer float-right">
                <button type="button" class="btn btn-default float-right " data-dismiss="modal">{{ trans('message.close') }}</button>
            </div>
        </div>

    </div>
</div>

@section('ajax')
    <script src="{{ asset('js/exercise.js') }}"></script>
@endsection
