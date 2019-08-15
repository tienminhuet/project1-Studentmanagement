<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\LessonDocument;

class LessonDocumentRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return LessonDocument::class;
    }
}
