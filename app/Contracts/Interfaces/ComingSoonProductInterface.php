<?php
namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\DeleteInterface;
use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use App\Contracts\Interfaces\Eloquent\UpdateInterface;

interface ComingSoonProductInterface extends GetInterface , StoreInterface ,UpdateInterface , DeleteInterface 
{
    public function draf();
    public function findDraft(mixed $id); 
}