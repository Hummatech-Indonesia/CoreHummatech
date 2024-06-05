<?php

namespace App\Contracts\Repositories;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Contracts\Interfaces\ServiceInterface;

class ServiceRepository extends BaseRepository implements ServiceInterface
{
    public function __construct(Service $service)
    {
        $this->model = $service;
    }

    public function get(): mixed
    {
        return $this->model->query()->get();
    }

    public function store(array $data): mixed
    {
        return $this->model->query()->create($data);
    }

    public function show(mixed $id): mixed
    {
        return $this->model->query()->findOrFail($id);
    }

    public function update(mixed $id, array $data): mixed
    {
        return $this->model->query()->findOrFail($id)->update($data);
    }

    public function delete(mixed $id): mixed
    {
        return $this->model->query()->findOrFail($id)->delete($id);
    }
    public function slug(mixed $slug): mixed
    {
        return $this->model->query()->where('slug', $slug)->firstOrFail();
    }

    public function GetCount(): mixed
    {
        return $this->model->query()->count();
    }

    public function search(Request $request): mixed
    {
        return $this->model->query()
            ->when($request->name, function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->name . '%');
            });
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
