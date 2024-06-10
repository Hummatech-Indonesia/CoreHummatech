<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\NewsInterface;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsRepository extends BaseRepository implements NewsInterface
{
    public function __construct(News $news)
    {
        $this->model = $news;
    }
    public function latest(int $limit = 5, array $args = []): mixed
    {
        $query = $this->model->query()->latest()->limit($limit);
        if (count($args)) {
            $query = $query->where($args);
        }
        return $query->get();
    }
    public function where(mixed $slug)
    {
        return $this->model->query()->where('slug' , $slug)->get();
    }
    public function whereHas(string $relation, $query)
    {
        return $this->model->query()->whereHas($relation, $query);
    }
    public function get(): mixed
    {
        return $this->model->query()->latest()->get();
    }

    // public function customPaginate(Request $request, int $pagination = 10): mixed
    // {
    //     return $this->model->query()->latest()->paginate($pagination);
    // }

    public function customPaginate(Request $request, int $pagination = 10): mixed
    {
        $order = $request->input('order', 'desc');
        $query = $this->model->newQuery()->orderBy('date', $order);
        return $query->paginate($pagination);
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
        ->when($request->title, function($query) use ($request){
            $query->where('title', 'LIKE', '%' . $request->title . '%');
        })->get();
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
