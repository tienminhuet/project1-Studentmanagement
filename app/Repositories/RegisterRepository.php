<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\RegisterCustom;

class RegisterRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return RegisterCustom::class;
    }
}
