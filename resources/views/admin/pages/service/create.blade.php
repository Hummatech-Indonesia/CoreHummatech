<button class="btn btn-primary m-0" type="button" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Layanan</button>

<!-- Add Modal -->
<div class="modal fade modal-bookmark" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-semibold" id="exampleModalLabel">Tambah Layanan</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form-bookmark needs-validation" action="{{ route('create.service') }}" method="POST" id="bookmark-form" novalidate=""
                enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="row g-2">
                        <div class="form-group mb-3 mt-0 col-md-12">
                            <label for="image">Foto Layanan</label>
                            <input class="form-control" id="image" type="file" name="image" required  />
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3 mt-0 col-md-12">
                            <label for="name">Nama Layanan</label>
                            <input class="form-control" id="name" name="name" type="text" value="{{ old('name') }}" required placeholder="Masukkan nama layanan" />
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3 mt-0 col-md-12">
                            <label for="slug">Slug</label>
                            <input class="form-control" id="slug" name="slug" type="text" value="{{ old('slug') }}" required placeholder="Masukkan slug" />
                            @error('slug')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="my-1">
                            <div class="d-flex justify-content-between">
                                <label for="shortDesciption" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Deskripsi singkat <span style="font-size: .6875rem"
                                    class="text-danger">*Wajib diisi</span>
                                </label>
                                <span class="count">
                                    Jumlah Karakter:
                                    <span class="char">0</span>
                                </span>
                            </div>
                            <div class="wysiwyg" style="height: 100px" oninput="Count()">{!! old('short_description') !!}</div>
                            <textarea name="short_description" class="d-none wysiwyg-area shortDescription" placeholder="Jelaskan deskripsi produknya" oninput="Count()">{!! old('short_description') !!}</textarea>
                             @error('short_decription')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3 mt-0 col-md-12">
                            <label for="bm-title">Deskripsi Layanan</label>
                            <div id="editor" style="height: 300px">{!! old('description') !!}</div>
                            <textarea name="description" class="d-none" id="description" cols="30" rows="10">{!! old('description') !!}</textarea>

                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3 mt-0 col-md-12">
                            <label for="link">Tautan Layanan <small class="text-danger">*Isi jika ada</small></label>
                            <input class="form-control" id="link" name="link" type="url" value="{{ old('link') }}" required placeholder="Masukkan tautan layanan" />
                            @error('link')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3 mt-0 col-md-12">
                            <label for="proposal">File Proposal <small>(opsional)</small></label>
                            <input class="form-control" id="proposal" name="proposal" type="file" required placeholder="Contoh: https://hummatech.com/linknya" />
                            @error('proposal')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-light-danger" type="button" data-bs-dismiss="modal">Batalkan</button>
                        <button class="btn btn-primary" type="submit">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
