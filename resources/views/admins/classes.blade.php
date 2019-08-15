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
                        <li class="breadcrumb-item" aria-current="page">{{ trans('message.classMangement') }}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('message.class') }}</li>
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

                    @if (Gate::allows('class_managerment'))
                    <li role="presentation" class="active">
                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab">{{ trans('message.running') }}</a>
                    </li>
                    <li role="presentation"  class="status2">
                        <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">{{ trans('message.upcoming') }}</a>
                    </li>
                    <li role="presentation" class="status3">
                        <a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">{{ trans('message.finished') }}</a>
                    </li>
                    @endif

                    @if (Gate::allows('teacher_class'))
                    <li role="presentation" class="active">
                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab">{{ trans('message.running') }}</a>
                    </li>
                    <li role="presentation"  class="teacherClass2">
                        <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">{{ trans('message.upcoming') }}</a>
                    </li>
                    <li role="presentation" class="teacherClass3">
                        <a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">{{ trans('message.finished') }}</a>
                    </li>
                    @endif

                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    @if (Gate::allows('class_managerment'))
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <p>{{ trans('message.running') }}</p>
                            <button type="button" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#addNewClass">{{ trans('message.addNew') }} {{ trans('message.class') }}</button>
                            <table class="table table-bordered" id="happenning" data-url={{ route('classesDatatable', config('messages.happenning')) }}>
                                <thead>
                                    <tr>
                                        <th>{{ trans('message.id') }}</th>
                                        <th>{{ trans('message.name') }}</th>
                                        <th>{{ trans('message.subject') }}</th>
                                        <th>{{ trans('message.teacher') }}</th>
                                        <th>{{ trans('message.created_at') }}</th>
                                        <th>{{ trans('message.action') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="profile">
                            <p>{{ trans('message.upcoming') }}</p>
                            <table class="table table-bordered" id="upcomming" data-url={{ route('classesDatatable', config('messages.upcomming')) }}>
                                <thead>
                                    <tr>
                                        <th>{{ trans('message.id') }}</th>
                                        <th>{{ trans('message.name') }}</th>
                                        <th>{{ trans('message.subject') }}</th>
                                        <th>{{ trans('message.teacher') }}</th>
                                        <th>{{ trans('message.created_at') }}</th>
                                        <th>{{ trans('message.action') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="messages">
                            <p>{{ trans('message.finished') }}</p>
                            <table class="table table-bordered" id="finished" data-url={{ route('classesDatatable', config('messages.finished')) }}>
                                <thead>
                                    <tr>
                                        <th>{{ trans('message.id') }}</th>
                                        <th>{{ trans('message.name') }}</th>
                                        <th>{{ trans('message.subject') }}</th>
                                        <th>{{ trans('message.teacher') }}</th>
                                        <th>{{ trans('message.created_at') }}</th>
                                        <th>{{ trans('message.action') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    @endif

                    @if (Gate::allows('student_class'))
                        <table class="table table-bordered" id="StudenClass" data-url={{ route('studentClassDatatable', Auth::user()->id) }}>
                            <thead>
                                <tr>
                                    <th>{{ trans('message.id') }}</th>
                                    <th>{{ trans('message.name') }}</th>
                                    <th>{{ trans('message.created_at') }}</th>
                                    <th>{{ trans('message.action') }}</th>
                                </tr>
                            </thead>
                        </table>
                    @endif

                    @if (Gate::allows('teacher_class'))
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <p>{{ trans('message.running') }}</p>
                            <table class="table table-bordered" id="teacherClass-happen" data-url={{ route('teacherClassDatatable',[Auth::user()->id, config('messages.happenning')])}}>
                                <thead>
                                    <tr>
                                        <th>{{ trans('message.id') }}</th>
                                        <th>{{ trans('message.name') }}</th>
                                        <th>{{ trans('message.created_at') }}</th>
                                        <th>{{ trans('message.action') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="profile">
                            <p>{{ trans('message.upcoming') }}</p>
                            <table class="table table-bordered" id="teacherClass-upcomming" data-url={{ route('teacherClassDatatable',[Auth::user()->id, config('messages.upcomming')])}}>
                                <thead>
                                    <tr>
                                        <th>{{ trans('message.id') }}</th>
                                        <th>{{ trans('message.name') }}</th>
                                        <th>{{ trans('message.created_at') }}</th>
                                        <th>{{ trans('message.action') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="messages">
                            <p>{{ trans('message.finished') }}</p>
                             <table class="table table-bordered" id="teacherClass-finished" data-url={{ route('teacherClassDatatable', [Auth::user()->id, config('messages.finished')])}}>
                                <thead>
                                    <tr>
                                        <th>{{ trans('message.id') }}</th>
                                        <th>{{ trans('message.name') }}</th>
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

{{-- modal add New  --}}
<div id="addNewClass" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ trans('message.addNew') }}</h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST" role="form" novalidate id="addData">
                    @csrf
                    <legend>{{ trans('message.addNew') }} {{ trans('message.class') }} </legend>
                    <div class="form-group">
                        <label for="">{{ trans('message.course') }}</label>
                        <select name="course_id" id="course" class="form-control">
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}" >{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">{{ trans('message.teacher') }}</label>
                        <select name="course_id" id="teacher" class="form-control">
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" >{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">{{ trans('message.name') }} {{ trans('message.class') }}</label>
                        <input type="text" class="form-control" id="add-name" name="title" placeholder="Input field">
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

{{-- add detail --}}
<div id="addDetail" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ trans('message.addDetail') }} {{ trans('message.class') }}</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="AddStudent2Class" data-status= {{ route('changestatus') }}>
                <thead>
                    <tr>
                        <th>{{ trans('message.id') }}</th>
                        <th>{{ trans('message.name') }}</th>
                        <th>{{ trans('message.email') }}</th>
                        <th>{{ trans('message.created_at') }}</th>
                        <th>{{ trans('message.action') }}</th>
                    </tr>
                </thead>
            </table>
            </div>
            <div class="modal-footer float-right">
                <button type="button" class="btn btn-default float-right " data-dismiss="modal">{{ trans('message.close') }}</button>
            </div>
        </div>

    </div>
</div>

@section('ajax')
    <script src="{{ asset('js/classes.js') }}"></script>
@endsection
{{-- <p>
    // 1 union gộp 2 bản ghi nếu có cungf số lwuongj cột . join là phải có điểm chung
// 2. btract và interface chỉ khai báo biến và hàm. 
// phạm  vi trong interface cỉ có public 
1 class kees thừa ? interface 
// 3. eloquen và query builer 
// 4. dependentcy 
// 5. index trong sql , 

6.accept modified 
7. auth : Remember me clicked: lưu token trong DB (remember token trong BD) gửi secction_id lên service chạy hàm giải mã => ra 2 chuỗi so sánh vs remember token trong BD. 
8 reponsitory 
9 pb và != và empty(kiểm tra có tồn tại không. rồi so sánh rỗng hay k. )
10. Sao MVC chỉ có 3 phần : tối ưu rồi mà vãn đủ. :v :v
11. Tại sao dùng repository mà k dùng service 
</p> --}}

