<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\Classes;

class ClassesRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Classes::class;
    }
}
