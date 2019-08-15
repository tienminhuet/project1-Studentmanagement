<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Repositories\ClassesRepository;
use App\Repositories\LessonRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\ClassInfoRepository;
use App\Repositories\UserRepository;
use Yajra\Datatables\Datatables;
use App\Http\Requests\TestRequest;
use Illuminate\Support\Facades\Auth;

class ClassesController extends Controller
{
    protected $reponsitory;

    public function __construct(ClassesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $repo = new SubjectRepository();
        $subjects = $repo->getAll();
        $repoteacher = new UserRepository();
        $teachers = $repoteacher->findCondition('role_id', config('messages.roleTeacher'));

        return view('admins/classes', compact('subjects', 'teachers'));
    }

    public function classesDatatable($status)
    {
        $data = $this->repository->findCondition('status', $status)->load('subject', 'teacher')->map(function($item) {
            $item['subject_id'] = $item->subject->name;
            $item['user_id'] = $item->teacher->name;

            return $item;
        });
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                return '<a href="#" class="btn btn-sm btn-success adddetail" id="show" data-id="' . $data->id . '"><i class="fa fa-plus"></i></a>
                        <a href="'. route('classDetail', $data->id) . '" class="btn btn-sm btn-warning Gotoclass" data-id="' . $data->id . '"><i class="fa fa-sign-in"></i></a>';
            })
            ->rawColumns([ 
                'action',
            ])
            ->make(true);
    }


    public function studentClassDatatable($user_id)
    {
        $classinforepo = new ClassInfoRepository();
        $data = $classinforepo->findCondition('user_id', $user_id)->load('classes')->map(function($item) {
            $item['name'] = $item->classes->name;

            return $item;
        });
        // dd($data);
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                return '<a href="'. route('classDetail', $data->class_id) .'" class="btn btn-sm btn-warning Gotoclass" data-id="' . $data->class_id . '"><i class="fa fa-sign-in"></i></a>';
            })
            ->rawColumns([ 
                'action',
            ])
            ->make(true);
    }

    public function teacherClassDatatable($user_id, $status)
    {
        // dd($user_id);
        $classrepo = new ClassesRepository();
        $data = $classrepo->findConditionClass('user_id', $user_id, 'status', $status);
// dd($data);
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                return '<a href="'. route('classDetail', $data->id) .'" class="btn btn-sm btn-warning Gotoclass" data-id="' . $data->id . '"><i class="fa fa-sign-in"></i></a>';
            })
            ->rawColumns([ 
                'action',
            ])
            ->make(true);
    }

    public function addclass(TestRequest $request)
    {
        $data = $request->all();
        $data['status'] = config('messages.upcomming');
        $data['slug'] = str_slug($data['name']);
        $data = $this->repository->create($data);

        return response()->json([ 'error' => false, 'success' => trans('message.success') ]);
    }

    public function addLesson(Request $request)
    {
        $data = $request->all();
        $data['slug'] = str_slug($data['name']);
        $repoLesson = new LessonRepository();
        $data = $repoLesson->create($data);

        return response()->json([ 'error' => false, 'success' => trans('message.success') ]);
    }

    public function datatablesAdddetail($classId)
    {
        //list student actived
        $repo = new UserRepository();
        $data = $repo->findConditionClass('role_id', config('messages.roleStudent'), 'status', config('messages.active'))->load('classes');
        foreach ($data as $value) {
            foreach ($value['classes'] as $value1) {
                if ($value1['pivot']['class_id'] == $classId) {
                    $value['classstatus'] = config('messages.active');
                }
            }
        }

        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                if ($data['classstatus'] == config('messages.active')) {
                    return "<label class='switch switch-border switch-danger ahihi' title='Active'>
                        <input type='checkbox' id='' data-status='status' checked> 
                        <span class='switch-indicator' user-id=' " . $data->id . " ' data-status='1'></span>
                    </label>";
                }
                else {
                    return "<label class='switch switch-border switch-danger ahihi' title='Active'>
                        <input type='checkbox' id='' data-status='status' > 
                        <span class='switch-indicator' user-id=' " . $data->id . " ' data-status='0'></span>
                    </label>";
                }
            })
            // })
            ->rawColumns([ 
                'action',
            ])
            ->make(true);
    }

    public function addStudentToClass(Request $request)
    {
        if (Auth::user()->role_id == config('messages.roleAdmin')) {
            $data= $request->all();
            $inforrepo = new ClassInfoRepository();
            if ($data['inclass'] == config('messages.active')) {
                $student = $inforrepo->findConditionClass('class_id', $data['class_id'], 'user_id', $data['user_id']);
                $student = $inforrepo->delete($student[0]['id']);
            } else {
                $data = $inforrepo->create($data);
            }

            return response()->json([ 'error' => false, 'success' => trans('message.success') ]);
        }
        else {
            return response()->json([ 'error' => true, 'success' => trans('message.permission') ]);
        }
    }
}
