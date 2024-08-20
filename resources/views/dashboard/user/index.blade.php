@extends('/dashboard/layouts/main')

@section('container')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">List Akun Website Pengguna</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$users)
                                @else
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td><span
                                                    class="badge {{ $user->status ? 'badge-success' : 'badge-warning' }}">{{ $user->status ? 'Aktif' : 'Pasif' }}</span>
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a class="btn btn-link btn-warning btn-lg"
                                                        href="/admin/users/{{ $user->id }}/edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-link btn-danger"
                                                        data-toggle="modal" data-target="#deleteModal"
                                                        data-whatever="{{ $user->id }}">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('/dashboard/partials/deleteModal')
@endsection

@push('title')
    <title>List Akun Website Pengguna</title>
@endpush
