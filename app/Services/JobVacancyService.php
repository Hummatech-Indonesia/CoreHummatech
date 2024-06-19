<?php

namespace App\Services;

use App\Enums\TypeEnum;
use App\Http\Requests\StoreJobVacancyRequest;
use App\Http\Requests\UpdateJobVacancyRequest;
use App\Models\JobVacancy;
use App\Traits\UploadTrait;
use Illuminate\Support\Str;


class JobVacancyService
{
    use UploadTrait;

    /**
     * Handle custom upload validation.
     *
     * @param string $disk
     * @param object $file
     * @param string|null $old_file
     * @return string
     */
    public function validateAndUpload(string $disk, object $file, string $old_file = null): string
    {
        if ($old_file) $this->remove($old_file);

        return $this->upload($disk, $file);
    }
    
    public function store(StoreJobVacancyRequest $request): array|bool
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $data['image'] = $request->file('image')->store($data['slug'], TypeEnum::VACANCY->value, 'public');
            return $data;
        }

        return $data;
    }

    public function update(JobVacancy $jobVacancy, UpdateJobVacancyRequest $request): array|bool
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $this->remove($jobVacancy->image);
            $data['image'] = $request->file('image')->store($data['slug'], TypeEnum::VACANCY->value, 'public');
        } else {
            $data['image'] = $jobVacancy->image;
        }                                                                                                                                                                                                           

        return $data;
    }
    
    public function delete(JobVacancy $jobVacancy)
    {
        $this->remove($jobVacancy->image);
    }
}
