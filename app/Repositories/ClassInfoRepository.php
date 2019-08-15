<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\ClassInfor;

class ClassInfoRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return ClassInfor::class;
    }
}
