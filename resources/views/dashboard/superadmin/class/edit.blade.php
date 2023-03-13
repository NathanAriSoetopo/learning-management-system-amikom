@extends('dashboard.superadmin.app')
@section('title-superadmin', 'Buat Event Baru')
@push('superadminheadscript')
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/extensions/choices.js/public/assets/styles/choices.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/extensions/filepond/filepond.css">
    <link rel="stylesheet"
        href="{{ asset('dashboard') }}/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/extensions/toastify-js/src/toastify.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/css/pages/filepond.css">
@endpush
@section('content')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Edit Kelas Baru</h3>
                        <p class="text-subtitle text-muted">Masukkan data kelas dengan benar</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Input</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Kelas</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('superadmin.class.update', ['id' => $class->id])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 pt-3">
                                    <div class="form-group">
                                        <label for="basicInput">Nama Kelas</label>
                                        <input type="text" name="name" class="form-control" id="basicInput" required
                                            placeholder="Masukkan nama kelas" value="{{$class->name}}" autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6 pt-3">
                                    <div class="form-group">
                                        <label for="basicInput">Link Kelas</label>
                                        <input type="url" name="link" class="form-control" id="basicInput"
                                            placeholder="Masukkan Link Meeting" value="{{$class->link ?? null}}" autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pt-3">
                                    <div class="form-group">
                                        <label for="basicInput">Waktu Mulai</label>
                                        <input type="datetime-local" name="start_time" class="form-control" id="basicInput" value="{{$class->start_time}}" required autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6 pt-3">
                                    <div class="form-group">
                                        <label for="basicInput">Waktu Selesai</label>
                                        <input type="datetime-local" name="end_time" class="form-control" id="basicInput" value="{{$class->end_time}}" required autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center mt-3">
                                <div class="col-md-4">
                                    <label for="">Pilih Master Class</label>
                                    <div class="form-group mt-2">
                                        <select class="choices form-select" name="master_class_id">
                                            @foreach ($masterClasses as $masterClass)
                                                <option value="{{ $masterClass->id }}" {{ $masterClass->id == $class->master_class_id ? 'selected' : '' }}>{{ $masterClass->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Pilih Mentor</label>
                                    <div class="form-group mt-2">
                                        <select class="choices form-select" name="responsible_id">
                                            @foreach ($mentors as $mentor)
                                                <option value="{{ $mentor->id }}" {{ $mentor->id == $class->responsible_id ? 'selected' : '' }}>{{ $mentor->name }} /
                                                    {{ $mentor->email }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="basicInput">Kapasitas Mentee</label>
                                        <input type="number" name="capacity" class="form-control" id="basicInput" required
                                            placeholder="Masukkan Kapasitas Kelas" value="{{$class->capacity}}" autofocus>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group with-title mb-3 mt-3">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3">{{$class->description}}</textarea>
                                        <label>Deskripsi Kelas</label>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success float-end" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    @push('superadminscript')
        <script src="{{ asset('dashboard') }}/assets/extensions/filepond/filepond.js"></script>
        <script src="{{ asset('dashboard') }}/assets/js/pages/filepond.js"></script>
        <script src="{{ asset('dashboard') }}/assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
        <script src="{{ asset('dashboard') }}/assets/js/pages/form-element-select.js"></script>
    @endpush
@endsection
