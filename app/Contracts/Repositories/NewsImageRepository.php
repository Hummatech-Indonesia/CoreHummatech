<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\NewsImageInterface;
use App\Models\NewsImage;

class NewsImageRepository extends BaseRepository implements NewsImageInterface {
    public function __construct(NewsImage $newsImage)
    {
        $this->model = $newsImage;
    }

    /**
     * store
     *
     * @param  mixed $data
     * @return mixed
     */
    public function store(array $data): mixed
    {
        return $this->model->query()
            ->create($data);
    }

    /**
     * delete
     *
     * @param  mixed $id
     * @return mixed
     */
    public function delete(mixed $id): mixed
    {
        return $this->model->query()
            ->findOrFail($id)
            ->delete();
    }

    public function show(mixed $id): mixed
    {
        return $this->model->query()->findOrFail($id)->show($id);
    }

    public function whereNews($id)
    {
        return $this->model->query()->where('news_id', $id)->get();
    }
}
