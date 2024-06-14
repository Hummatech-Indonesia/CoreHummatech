<?php
namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\JobVacancyInterface;
use App\Models\JobVacancy;

class JobVacancyRepository extends BaseRepository implements JobVacancyInterface
{
    public function __construct(JobVacancy $jobVacancy)
    {
        $this->model = $jobVacancy;
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
}
