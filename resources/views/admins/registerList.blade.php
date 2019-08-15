@extends('layouts.admin')
@section('content-content')

<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">

            <h3 class="page-title">{{ trans('message.register') }} {{ trans('message.list') }}</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">{{ trans('message.register') }}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('message.register') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-body">
            <div class="group-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    @if (Gate::allows('change_status'))
                        <li role="presentation" class="active">
                            <a href="#home" aria-controls="home" role="tab" data-toggle="tab">{{ trans('message.register') }} {{ trans('message.list') }}</a>
                        </li>
                        <li role="presentation"  class="status2">
                            <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">{{ trans('message.Confirmed') }}</a>
                        </li>
                    @endif
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    @if (Gate::allows('change_status'))
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <p>{{ trans('message.register') }}</p>
                            <table class="table table-bordered" id="registerStudent" data-url={{ route('registerDatatable', config('messages.deactive')) }}>
                                <thead>
                                    <tr>
                                        <th>{{ trans('message.id') }}</th>
                                        <th>{{ trans('message.name') }}</th>
                                        <th>{{ trans('message.email') }}</th>
                                        <th>{{ trans('message.subject') }}</th>
                                        <th>{{ trans('message.created_at') }}</th>
                                        <th>{{ trans('message.action') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="profile">
                            <p>{{ trans('message.confirmed') }}</p>
                            <table class="table table-bordered" id="confirmed" data-url={{ route('registerDatatable', config('messages.active')) }}>
                                <thead>
                                    <tr>
                                        <th>{{ trans('message.id') }}</th>
                                        <th>{{ trans('message.name') }}</th>
                                        <th>{{ trans('message.email') }}</th>
                                        <th>{{ trans('message.subject') }}</th>
                                        <th>{{ trans('message.created_at') }}</th>
                                        <th>{{ trans('message.action') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


@section('ajax')
    <script src="{{ asset('js/admin.js') }}"></script>
@endsection
