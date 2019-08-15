<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\Lesson;

class LessonRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Lesson::class;
    }
}
