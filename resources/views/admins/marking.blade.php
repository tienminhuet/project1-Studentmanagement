@extends('layouts.admin')

@section('content-content')

<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">{{ trans('message.marking') }}</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">{{ trans('message.marking') }}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('message.marking') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $lesson_id }}</h3>
            <ul class="box-controls pull-right">
                <li><a class="box-btn-slide" href="#"></a></li>
            </ul>
        </div>
        <div class="box-body">
            <div class="accordion" id="accordionExample">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>{{ trans('message.id') }}</th>
                            <th>{{ trans('message.name') }}</th>
                            <th>{{ trans('message.email') }}</th>
                            <th>{{ trans('message.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($studentInClasses as $studentInClass)
                        <tr>
                            <td>{{ $studentInClass->users[0]['id'] }}</td>
                            <td>{{ $studentInClass->users[0]['name'] }}</td>
                            <td>{{ $studentInClass->users[0]['email'] }}</td>
                            <th>
                                <a href="{{ route('markingLession', [$lesson_id, $class_id, $studentInClass->users[0]['id'] ]) }}" class="btn btn-sm btn-success marking" title="marking"><i class="fa fa-check"></i></a>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
