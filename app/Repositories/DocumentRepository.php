<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\Document;

class DocumentRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Document::class;
    }
}
