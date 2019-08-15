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
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('message.theory') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $lessons->name }}</h3>
            <ul class="box-controls pull-right">
                <li><a class="box-btn-slide" href="#"></a></li>
            </ul>
        </div>
        <div class="box-body">
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
                        <div class="card-body">{!! $lessondocument->document->content !!}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection

@section('ajax')
    <script src="{{ asset('js/classesDetail.js') }}"></script>
@endsection