@extends('admin.layouts.app')

@section('subcontent')
    <div class="py-1"></div>
    <div class="px-3">
        <div class="page-title">
            <div class="d-flex justify-content-between">
                <div class="p-0">
                    <h3>Lowongan</h3>
                </div>
                <div class="ms-auto">
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#create-modal">Tambah</button>
                </div>

                {{-- <div class="col-sm-5 ">
                    <div class="d-flex align-items-center">
                        <form action="">
                            <div class="col-12 col-lg-12 d-flex justify-content-end">
                                <div class="d-flex justify-content-lg-end justify-content-start">
                                    <div class="d-flex align-items-center gap-2 mx-2">
                                        <label for="search">Cari:</label>
                                        <input type="text" name="name" value="{{ request()->name }}" id="search" class="form-control mx-3">
                                        <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                            data-bs-target="#create-modal">Tambah</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="row mt-3">
    @forelse ($jobVacancies as $jobVacancy)
        <div class="col-xxl-3 col-xl-50 col-sm-6 proorder-xl-2">
            <div class="card since">
                <div class="card-body">
                    <div class="text-end mb-3 mx-2">
                        <button class="col col-auto bg-transparent border-0 text-primary fs-5 btn-edit" type="button"
                        data-id="{{ $jobVacancy->id }}"
                        data-name="{{ $jobVacancy->name }}" 
                        data-description="{{ $jobVacancy->description }}"
                        data-qualification="{{ $jobVacancy->qualification }}"
                        data-salary="{{ $jobVacancy->salary }}"
                        data-whatsapp="{{ $jobVacancy->whatsapp }}"
                        data-status="{{ $jobVacancy->status }}">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button class="col col-auto bg-transparent border-0 text-danger fs-5 btn-delete" type="button" data-id="{{ $jobVacancy->id }}">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </div>
                    <div class="mx-2">
                        <h4 class="">{{ $jobVacancy->name }}</h4>
                        <p class="mt-0 mb-2" style="font-size: 17px">{!! Str::words($jobVacancy->description, 14, '...') !!}</p>
                    </div>
                    <div class="mx-2 mt-4 d-flex justify-content-between gap-2">
                        <button type="button" class="btn btn-primary w-100 btn-detail" 
                        data-id="{{ $jobVacancy->id }}"
                        data-name="{{ $jobVacancy->name }}" 
                        data-description="{{ $jobVacancy->description }}"
                        data-qualification="{{ $jobVacancy->qualification }}"
                        data-salary="{{ number_format($jobVacancy->salary, 0, ',', '.') }}"
                        data-whatsapp="{{ $jobVacancy->whatsapp }}"
                        data-status="{{ $jobVacancy->status }}"
                        >Detail</button>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="d-flex justify-content-center">
            <img src="{{ asset('nodata.jpg') }}" alt="" width="400px">
        </div>
        <h5 class="text-center">
            Data Masih Kosong
        </h5>
    @endforelse
</div>

{{-- add modal start --}}
<div class="modal fade" id="create-modal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Lowongan Pekerjaan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('job-vacancy.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-sm-8">
                            <label for="name">Posisi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" placeholder="Masukan posisi">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col col-sm-4">
                            <label for="salary">Gaji <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                <input type="text" class="form-control" name="salary" value="{{ old('salary') }}" placeholder="Masukkan gaji" aria-label="Masukkan gaji" aria-describedby="basic-addon1">
                            </div>
                            @error('salary')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                      </div>
                    <div class="mb-3">
                        <label for="description">Deskripsi <span class="text-danger">*</span></label>
                        <div class="wysiwyg" id="description-editor" style="height: 100px">{!! old('description') !!}</div>
                        <textarea name="description" class="d-none wysiwyg-area" id="description" cols="30" rows="10" placeholder="Masukkan deskripsi lowongan">{!! old('description') !!}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="qualification">Kualifikasi <span class="text-danger">*</span></label>
                        <div class="wysiwyg" id="qualification-editor" style="height: 100px">{!! old('qualification') !!}</div>
                        <textarea name="qualification" class="d-none wysiwyg-area" id="qualification" cols="30" rows="10" placeholder="Masukkan kualifikasi lowongan">{!! old('qualification') !!}</textarea>
                        @error('qualification')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="benefit">Nomor whatsApp <span class="text-danger">*</span></label>
                        <input type="text" name="whatsapp" class="form-control" value="{{ old('whatsapp') }}" placeholder="Masukkan nomor whatsApp yang bisa dihubungi pelamar">
                        @error('whatsapp')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="d-flex gap-3">
                        <label for="status">Status lowongan: <span class="text-danger">*</span></label>
                        <div class="">
                            <label for="active">Aktif</label>
                            <input type="radio" name="status" id="active" value="active">
                        </div>
                        <div class="">
                            <label for="nonactive">Tidak Aktif</label>
                            <input type="radio" name="status" id="nonactive" value="nonactive">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- add modal end --}}

{{-- edit modal start --}}
<div class="modal fade" id="update-modal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Lowongan Pekerjaan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-update" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-sm-8">
                            <label for="name">Posisi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name-edit" placeholder="Masukan posisi">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col col-sm-4">
                            <label for="salary">Gaji <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                <input type="text" class="form-control" name="salary" id="salary-edit" value="{{ old('salary') }}" placeholder="Masukkan gaji" aria-label="Masukkan gaji" aria-describedby="basic-addon1">
                            </div>
                            @error('salary')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                      </div>
                    <div class="mb-3">
                        <label for="description">Deskripsi <span class="text-danger">*</span></label>
                        <div class="wysiwyg" id="description-editor-edit" style="height: 100px">{!! old('description') !!}</div>
                        <textarea name="description" class="d-none wysiwyg-area" id="description-edit" cols="30" rows="10" placeholder="Masukkan deskripsi lowongan">{!! old('description') !!}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="qualification">Kualifikasi <span class="text-danger">*</span></label>
                        <div class="wysiwyg" id="qualification-editor-edit" style="height: 100px">{!! old('qualification') !!}</div>
                        <textarea name="qualification" class="d-none wysiwyg-area" id="qualification-edit" cols="30" rows="10" placeholder="Masukkan kualifikasi lowongan">{!! old('qualification') !!}</textarea>
                        @error('qualification')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="benefit">Nomor whatsApp <span class="text-danger">*</span></label>
                        <input type="text" name="whatsapp" class="form-control" id="whatsapp-edit" value="{{ old('whatsapp') }}" placeholder="Masukkan nomor whatsApp yang bisa dihubungi pelamar">
                        @error('whatsapp')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="d-flex gap-3" id="status-edit">
                        <label for="status">Status lowongan: <span class="text-danger">*</span></label>
                        <div class="">
                            <label for="active">Aktif</label>
                            <input type="radio" name="status" id="active-edit" value="active">
                        </div>
                        <div class="">
                            <label for="nonactive">Tidak Aktif</label>
                            <input type="radio" name="status" id="nonactive-edit" value="nonactive">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- edit modal end --}}

{{-- detail modal start --}}
<div class="modal fade" id="detail-modal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Lowongan Pekerjaan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 border-bottom pb-2">
                    <h5><b>Posisi: </b><span id="name-detail"></span><span class="badge bg-success ms-3" id="status-detail"></span></h5>
                </div>
                <div class="mb-3 border-bottom">
                    <h5 class="fw-bold">Deskripsi</h5>
                    <div id="description-detail"></div>
                </div>
                <div class="mb-3 border-bottom">
                    <h5 class="fw-bold">Kualifikasi</h5>
                    <div id="qualification-detail"></div>
                </div>
                <div class="mb-3 row text-center">
                    <div class="col">
                        <h5 class="fw-bold">Gaji</h5>
                        <p>Rp. <span id="salary-detail"></span></p>
                    </div>
                    <div class="col border-start">
                        <h5 class="fw-bold">No. whatsApp</h5>
                        <p id="whatsapp-detail"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- detail modal end --}}

@include('admin.components.delete-modal-component')

@endsection

@section('script')
    <script>
        $('.btn-delete').on('click', function() {
            var id = $(this).data('id');
            $('#form-delete').attr('action', '/admin/job-vacancy/' + id);
            $('#modal-delete').modal('show');
        });

        $('.btn-edit').click(function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var description = $(this).data('description');
            var qualification = $(this).data('qualification');
            var salary = $(this).data('salary');
            var whatsapp = $(this).data('whatsapp');
            var status = $(this).data('status');
            $('#name-edit').val(name);
            desc2.root.innerHTML = description;
            qual2.root.innerHTML = qualification;
            $('#salary-edit').val(salary);
            $('#whatsapp-edit').val(whatsapp);

            if (status === 'active') {
                $('#active-edit').prop('checked', true);
            } else if (status === 'nonactive') {
                $('#nonactive-edit').prop('checked', true);
            }
            $('#form-update').attr('action', '/admin/job-vacancy/' + id);
            $('#update-modal').modal('show');
        });

        $('.btn-detail').click(function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var description = $(this).data('description');
            var qualification = $(this).data('qualification');
            var salary = $(this).data('salary');
            var whatsapp = $(this).data('whatsapp');
            var status = $(this).data('status');
            $('#name-detail').text(name);
            $('#description-detail').html(description);
            $('#qualification-detail').html(qualification);
            $('#salary-detail').text(salary);
            $('#whatsapp-detail').text(whatsapp);
            $('#status-detail').text(status);
            $('#detail-modal').modal('show');
        });
    </script>

    <script>
        var customToolbar = [
            [{ 'font': [] }],
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
            ['bold', 'italic', 'underline', 'strike', 'blockquote'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'script': 'sub'}, { 'script': 'super' }],
            [{ 'indent': '-1'}, { 'indent': '+1' }],
            [{ 'direction': 'rtl' }],
            [{ 'color': [] }, { 'background': [] }],
            [{ 'align': [] }],
            ['link'],
            ['clean'],
            ['code-block'],
            [{ 'html': 'HTML' }]
        ];

        const desc = new Quill('#description-editor', {
            theme: 'snow',
            placeholder: "Masukkan deskripsi lowongan",
            modules: {
                toolbar: {
                    container: customToolbar,
                }
            },
        });
        desc.on('text-change', (eventName, ...args) => {
            $('#description').val(desc.root.innerHTML);
        });

        const desc2 = new Quill('#description-editor-edit', {
            theme: 'snow',
            placeholder: "Masukkan deskripsi lowongan",
            modules: {
                toolbar: {
                    container: customToolbar,
                }
            },
        });
        desc2.on('text-change', (eventName, ...args) => {
            $('#description-edit').val(desc2.root.innerHTML);
        });

        const qual = new Quill('#qualification-editor', {
            theme: 'snow',
            placeholder: "Masukkan deskripsi lowongan",
            modules: {
                toolbar: {
                    container: customToolbar,
                }
            },
        });
        qual.on('text-change', (eventName, ...args) => {
            $('#qualification').val(qual.root.innerHTML);
        });
        const qual2 = new Quill('#qualification-editor-edit', {
            theme: 'snow',
            placeholder: "Masukkan deskripsi lowongan",
            modules: {
                toolbar: {
                    container: customToolbar,
                }
            },
        });
        qual2.on('text-change', (eventName, ...args) => {
            $('#qualification-edit').val(qual2.root.innerHTML);
        });
    </script>
@endsection
