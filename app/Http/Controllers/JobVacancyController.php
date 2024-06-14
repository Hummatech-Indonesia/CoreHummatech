<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\JobVacancyInterface;
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
        $jobVacancies = $this->jobVacancy->get();
        return view('admin.pages.job-vacancy.index', compact('jobVacancies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobVacancyRequest $request)
    {

        try {
            $data = $this->service->store($request);
            $this->jobVacancy->store($data);
            return back()->with('success' , 'Berhasil menambahkan lowongan');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobVacancyRequest $request, JobVacancy $jobVacancy)
    {
        try {
            $data = $this->service->update($jobVacancy, $request);
            $this->jobVacancy->update($jobVacancy->id, $data);
            return back()->with('success', 'Lowongan berhasil diperbarui');
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
            $this->jobVacancy->delete($jobVacancy->id);
            return back()->with('success', 'Lowongan berasil dihapus');
        } catch (\Throwable $th) {
            return back()->with('danger' , $th->getMessage());
        }
    }
}
