<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\JobVacancyInterface;
use App\Enums\JobVacancyStatusEnum;
use App\Models\JobVacancy;
use App\Http\Requests\StoreJobVacancyRequest;
use App\Http\Requests\UpdateJobVacancyRequest;
use App\Services\JobVacancyService;

class JobVacancyController extends Controller
{
    private JobVacancyInterface $jobVacancy;
    private JobVacancyService $service;

    public function __construct(JobVacancyInterface $jobVacancy, JobVacancyService $service)
    {
        $this->jobVacancy = $jobVacancy;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activeJobs = $this->jobVacancy->whereStatus(JobVacancyStatusEnum::ACTIVE->value);
        $nonActiveJobs = $this->jobVacancy->whereStatus(JobVacancyStatusEnum::NONACTIVE->value);
        return view('admin.pages.job-vacancy.index', compact('activeJobs', 'nonActiveJobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.job-vacancy.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobVacancyRequest $request)
    {

        try {
            $data = $this->service->store($request);
            $this->jobVacancy->store($data);
            return to_route('job-vacancy.index')->with('success' , 'Berhasil menambahkan lowongan');
        } catch (\Throwable $th) {
            return back()->with('danger' , $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(JobVacancy $jobVacancy)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobVacancy $jobVacancy)
    {
        return view('admin.pages.job-vacancy.edit', compact('jobVacancy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobVacancyRequest $request, JobVacancy $jobVacancy)
    {
        try {
            $data = $this->service->update($jobVacancy, $request);
            $this->jobVacancy->update($jobVacancy->id, $data);
            return to_route('job-vacancy.index')->with('success', 'Lowongan berhasil diperbarui');
        } catch (\Throwable $th) {
            return back()->with('danger' , $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobVacancy $jobVacancy)
    {
        try {
            $this->service->delete($jobVacancy);
            $this->jobVacancy->delete($jobVacancy->id);
            return back()->with('success', 'Lowongan berasil dihapus');
        } catch (\Throwable $th) {
            return back()->with('danger' , $th->getMessage());
        }
    }
}
