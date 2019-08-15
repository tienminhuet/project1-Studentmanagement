<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\Exercise;

class ExerciseRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Exercise::class;
    }
}
