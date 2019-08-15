<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\LessonExercise;

class LessonExerciseRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return LessonExercise::class;
    }
}
