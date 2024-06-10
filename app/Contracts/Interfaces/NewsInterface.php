<?php

namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\CustomPaginationInterface;
use App\Contracts\Interfaces\Eloquent\DeleteInterface;
use App\Contracts\Interfaces\Eloquent\GetCountInterface;
use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\HasRelationInterface;
use App\Contracts\Interfaces\Eloquent\LatestQueryInterface;
use App\Contracts\Interfaces\Eloquent\SearchInterface;
use App\Contracts\Interfaces\Eloquent\SlugInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use App\Contracts\Interfaces\Eloquent\UpdateInterface;
use App\Contracts\Interfaces\Eloquent\WhereClauseInterface;

interface NewsInterface extends CustomPaginationInterface, HasRelationInterface, UpdateInterface, StoreInterface, DeleteInterface, GetInterface, SlugInterface, LatestQueryInterface,GetCountInterface ,WhereClauseInterface, SearchInterface 
{
    public function draf();
    public function findDraft(mixed $id); 
}