<?php
namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\ComingSoonProductInterface;
use App\Models\ComingSoonProduct;
use Illuminate\Http\Request;

class ComingSoonProductRepository extends BaseRepository implements ComingSoonProductInterface
{
    public function __construct(ComingSoonProduct $comingSoonProduct )
    {
        $this->model = $comingSoonProduct ;
    }

    public function get(): mixed
    {
        return $this->model->query()->get();
    }

    public function store(array $data): mixed
    {
        return $this->model->query()->create($data);
    }
    public function update(mixed $id, array $data): mixed
    {
        return $this->model->query()->findOrFail($id)->update($data);
    }
    public function delete(mixed $id): mixed
    {
        return $this->model->query()->findOrFail($id)->delete($id);
    }
    public function show(mixed $id): mixed
    {
        return $this->model->query()->findOrFail($id);
    }
    public function draf()
    {
        return $this->model->query()->onlyTrashed()->paginate(10);
    }   
    public function findDraft(mixed $id)
    {
        return $this->model->query()->withTrashed()->findOrFail($id);
    } 
}

