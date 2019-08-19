<?php

namespace App\Services;

// use App\Repositories\Contracts\TestQuestionRepositoryInterface as TestQuestionRepository;
use App\Imports\ExerciseImport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelService
{
    // protected $testQuestionRepository;
    // protected $fileRepository;
    // public function __construct(
    //     FileRepository $fileRepository,
    //     TestQuestionRepository $testQuestionRepository
    // ) {
    //     $this->fileRepository = $fileRepository;
    //     $this->testQuestionRepository = $testQuestionRepository;
    // }
    public function importFileQuestion($request)
    {
        // dd($request->file('file'));
        $exerciseImport = new ExerciseImport();
        // try {
            Excel::import($exerciseImport, $request->file('file'));
        // } catch (Exception $exception) {
        //     return redirect()->back()->with('action_fault', config('constant.action_fault'));
        // }
        // $this->fileRepository->saveSingleAudio($request->file('file_import'), 'importexercise');
        // foreach ($selected_tests as $test_id) {
        //     foreach ($questionImport->datas as $question) {
        //         $testQuestion = [
        //             'test_id' => $test_id,
        //             'question_id' => $question->id
        //         ];
        //         $this->testQuestionRepository->create($testQuestion);
        //     }
        // }
    }
}
