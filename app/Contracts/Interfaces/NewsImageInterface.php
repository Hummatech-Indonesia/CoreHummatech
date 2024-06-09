<?php

namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\DeleteInterface;
use App\Contracts\Interfaces\Eloquent\ShowInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;

interface NewsImageInterface extends StoreInterface, DeleteInterface , ShowInterface
{
    public function whereNews($id);
}
