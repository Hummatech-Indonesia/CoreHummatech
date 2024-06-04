<?php
namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\DeleteInterface;
use App\Contracts\Interfaces\Eloquent\GetByServiceIdInterface;
use App\Contracts\Interfaces\Eloquent\GetByTypeInterface;
use App\Contracts\Interfaces\Eloquent\GetCountInterface;
use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\SearchInterface;
use App\Contracts\Interfaces\Eloquent\ShowInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use App\Contracts\Interfaces\Eloquent\UpdateInterface;
use App\Contracts\Interfaces\Eloquent\WhereClauseInterface;

interface ProductInterface extends GetInterface , StoreInterface ,UpdateInterface , DeleteInterface , ShowInterface, GetByTypeInterface , GetCountInterface, WhereClauseInterface , SearchInterface, GetByServiceIdInterface
{
    public function draf();
    public function findDraft(mixed $id); 
}