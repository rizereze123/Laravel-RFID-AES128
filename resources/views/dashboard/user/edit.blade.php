@extends('dashboard/layouts/main')

@section('container')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Ubah Akun Website Pengguna</h4>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <h2>{{ $error }}</h2>
                        @endforeach
                    @endif
                    <form action="/admin/users/{{ $user->id }}" method="POST" id="userUpdateForm">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="idNama">Nama</label>
                            <input type="text" name="name" class="form-control" id="idNama" aria-describedby="emailHelp"
                                value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat Email</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ $user->email }}">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="idRole">Role</label>
                                    <select class="custom-select" name="role">
                                        <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin
                                        </option>
                                        <option value="Staff" {{ $user->role == 'Staff' ? 'selected' : '' }}>Staff
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="idStatus">Status Akun Website</label>
                                    <select class="custom-select" name="status">
                                        <option value="1" {{ $user->status ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ !$user->status ? 'selected' : '' }}>Pasif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="idPassword">Kata Sandi</label>
                                    <input type="password" name="password" class="form-control" id="idPassword">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="idConfirmPassword">Konfirmasi Kata Sandi</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                        id="idConfirmPassword">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex align-items-center">
                        <a class="btn btn-primary btn-round" href="/admin/users">Kembali</a>
                        <button type="button" class="btn btn-warning btn-round ml-auto" id="updateBtn">Perbarui</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#updateBtn").click(function() {
                $("#userUpdateForm").submit();
            });
        });
    </script>
@endpush
