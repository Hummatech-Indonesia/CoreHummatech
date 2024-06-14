<?php

namespace App\Services;

use App\Http\Requests\StoreJobVacancyRequest;
use App\Http\Requests\UpdateJobVacancyRequest;
use App\Models\JobVacancy;
use Illuminate\Support\Str;


class JobVacancyService
{
    public function store(StoreJobVacancyRequest $request): array|bool
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($request->name);

        return $data;
    }

    public function update(JobVacancy $jobVacancy, UpdateJobVacancyRequest $request): array|bool
    {
        $data = $request->validated();

        if($request->name !== $jobVacancy->name) {
            $data['slug'] = Str::slug($request->name);
        } else {
            $data['slug'] = $jobVacancy->slug;
        }

        return $data;
    }
}
