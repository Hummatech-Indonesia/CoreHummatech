<?php

namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\DeleteInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use App\Contracts\Interfaces\Eloquent\WhereClauseInterface;

interface NewsCategoryInterface extends StoreInterface, DeleteInterface, WhereClauseInterface
{
    public function whereNews($id);
    public function deleteByNewsId($id);
}
