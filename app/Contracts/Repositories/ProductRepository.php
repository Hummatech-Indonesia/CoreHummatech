<?php
namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\ProductInterface;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductRepository extends BaseRepository implements ProductInterface
{
    public function __construct(Product $product )
    {
        $this->model = $product ;
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
        return $this->model->query()->withTrashed()->findOrFail($id)->delete($id);
    }
    public function show(mixed $id): mixed
    {
        return $this->model->query()->findOrFail($id);
    }
    public function getByType(mixed $type): mixed
    {
        return $this->model->query()->where('type', $type)->get();
    }
    public function getByServiceId(mixed $id): mixed{
        return $this->model->query()->where('service_id', $id)->get();
    }

    public function GetCount(): mixed
    {
        return $this->model->query()->count();
    }

    public function where(mixed $slug)
    {
        return $this->model->query()->where('category_product_id', $slug)->where('type', 'company')->get();
    }
    public function search(Request $request): mixed
    {
        return $this->model->query()
            ->where('type', '!=', 'portfolio')
            ->when($request->name, function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->name . '%');
            })
            ->get();
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

