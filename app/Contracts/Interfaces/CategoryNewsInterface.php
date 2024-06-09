<?php
namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\DeleteInterface;
use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\SearchInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use App\Contracts\Interfaces\Eloquent\UpdateInterface;
use App\Contracts\Interfaces\Eloquent\WhereClauseInterface;

interface CategoryNewsInterface extends GetInterface, StoreInterface, DeleteInterface, UpdateInterface, WhereClauseInterface, SearchInterface
{
    public function wheredata($id);
}