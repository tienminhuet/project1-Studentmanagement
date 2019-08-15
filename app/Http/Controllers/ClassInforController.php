<?php

namespace App\Http\Controllers;

use App\Models\ClassInfor;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Exercise;
use App\Repositories\ClassesRepository;
use App\Repositories\ClassInfoRepository;
use App\Repositories\DocumentRepository;
use App\Repositories\ExerciseRepository;
use App\Repositories\LessonRepository;
use App\Repositories\UserRepository;
use App\Repositories\LessonExerciseRepository;
use App\Repositories\LessonDocumentRepository;
use App\Repositories\HomeworkRepository;
use Yajra\Datatables\Datatables;
use App\Http\Requests\TestRequest;
use App\Http\Requests\HomeworksRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
// use Carbon\Carbon;

class ClassInforController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $reponsitory;
    protected $homeworkRepository;

    public function __construct(
        ClassInfoRepository $repository,
        HomeworkRepository $homeworkRepository
    )
    {
        $this->repository = $repository;
        $this->homeworkRepository = $homeworkRepository;
    }

    public function index($id)
    {
        return view('admins/classesInfo', compact('id'));
    }

    public function classDetailDatatable($id){
        $repoLesson = new LessonRepository();
        $data = $repoLesson->findCondition('class_id', $id);

        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                if (Gate::allows('edit_lesson')) {
                    return '<a href="' . route('ShowLession', [$data->id, $data->class_id]) . '" class="btn btn-sm btn-success adddetail" id="show" data-id="' . $data->id . '" title="' . trans('message.showTheory') . '"><i class="fa fa-eye"></i></a>
                        <a href="' . route('ShowExercise', [$data->id, $data->class_id]) . '" class="btn btn-sm btn-warning adddetail" id="show" data-id="' . $data->id . '" title="' . trans('message.showExercise') . '"><i class="fa fa-file" aria-hidden="true"></i></a>
                        <a href="' . route('editLession', [$data->id, $data->class_id]) . '" class="btn btn-sm btn-info showdata"  data-id="' . $data->id . '"><i class="fa fa-edit"></i></a>
                        <a href="' . route('showmarkingLession', [$data->id, $data->class_id]) . '" class="btn btn-sm btn-success marking"  data-id="' . $data->id . '" title="marking"><i class="fa fa-check"></i></a>';
                }
                else {
                    return '<a href="' . route('ShowLession', [$data->id, $data->class_id]) . '" class="btn btn-sm btn-success adddetail" id="show" data-id="' . $data->id . '" title="' . trans('message.showTheory') . '"><i class="fa fa-eye"></i></a>
                        <a href="' . route('ShowExercise', [$data->id, $data->class_id]) . '" class="btn btn-sm btn-warning adddetail" id="show" data-id="' . $data->id . '" title="' . trans('message.marking') . '"><i class="fa fa-file" aria-hidden="true"></i></a>';
                }
            })
            ->rawColumns([ 
                'action',
            ])
            ->make(true);
    }

    public function editLession($lesson_id, $class_id)
    {
        $class = new ClassesRepository();
        $class = $class->find($class_id);
        // infor lesson
        $lesson = new LessonRepository();
        $lessons = $lesson->find($lesson_id);
        // all document
        $document = new DocumentRepository();
        $documents = $document->findCondition('subject_id', $class->subject_id);
        // all exercise
        $exercise = new ExerciseRepository();
        $exercises = $exercise->findCondition('subject_id', $class->subject_id);
        //lessondocument
        $lessondocumentrepo = new LessonDocumentRepository();
        $lessondocuments = $lessondocumentrepo->findCondition('lesson_id', $lessons->id)->load('document')->map(function($item) {
                $item['document'] = $item->document[0];
            return $item;
        });

        $lessonexercise = new LessonExerciseRepository();
        $lessonexercises = $lessonexercise->findCondition('lesson_id', $lessons->id)->load('exercise')->map(function($item) {
            $item['exercise'] = $item->exercise[0];

            return $item;
        });

        return view('admins/editLesson' , compact(['lessons', 'documents', 'exercises', 'lessondocuments', 'lessonexercises']));
    }

    public function editinfo(Request $request)
    {
        $repolesson = new LessonRepository();
        $data = $request->all();
        $data['slug'] = str_slug($data['name']);
        $data = $repolesson->update($data['id'], $data);

        return response()->json(['success' => trans('meassge.successs'), 'error' => false]);
    }

    public function editlessionDocument(Request $request)
    {
        $repo = new LessonDocumentRepository();
        $data = $repo->create($request->all());
        // $data = $this->repository->find($class_id);

        return response()->json(['success' => trans('meassge.successs'), 'error' => false]);
    }

    public function editlessionExercise(Request $request)
    {
        $data = $request->all();
        $repo = new LessonExerciseRepository();
        $data['deadline'] = now()->addDays(2);
        // dd($data);
        $data = $repo->create($data);
        // $data = $this->repository->find($class_id);

        return response()->json(['success' => trans('meassge.successs'), 'error' => false]);
    }

    public function ShowLession($lesson_id, $class_id)
    {
        $lesson = new LessonRepository();
        $lessons = $lesson->find($lesson_id);

        $lessondocumentrepo = new LessonDocumentRepository();
        $lessondocuments = $lessondocumentrepo->findCondition('lesson_id', $lesson_id)->load('document')->map(function($item) {
                $item['document'] = $item->document[0];

            return $item;
        });

        return view('admins/lessonDocument', compact(['lessondocuments', 'lessons']));
    }

    public function showExercise($lesson_id, $class_id)
    {
        $lesson = new LessonRepository();
        $lessons = $lesson->find($lesson_id);

        $lessonexercise = new LessonExerciseRepository();
        $lessonexercises = $lessonexercise->findCondition('lesson_id', $lesson_id)->load('exercise')->map(function($item) {
            $item['exercise'] = $item->exercise[0];

            return $item;
        });

        return view('admins/lessionExercise', compact(['lessonexercises', 'lessons', 'lesson_id', 'class_id']));
    }

    public function submitExercise(HomeworksRequest $request)
    {
        $data =$request->all();
        $data['user_id'] = Auth::user()->id;
        $data['time_commit_ex'] = now();

        return response()->json(['success' => trans('meassge.successs'), 'error' => false]);
    }

    public function showHomework(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $response = $this->homeworkRepository->findHomeworkAnswer($data['lesson_id'], $data['lession_exercise_id'], $data['user_id']);

        return response()->json($response);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassInfor  $classInfor
     * @return \Illuminate\Http\Response
     */
    public function show(ClassInfor $classInfor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassInfor  $classInfor
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassInfor $classInfor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassInfor  $classInfor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassInfor $classInfor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassInfor  $classInfor
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassInfor $classInfor)
    {
        //
    }
}
