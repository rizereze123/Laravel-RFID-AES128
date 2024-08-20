@extends('/dashboard/layouts/main')
@section('container')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">List Informasi Pengguna Kartu RFID</h4>
                        @can('isAdmin')
                            <a class="btn btn-primary btn-round ml-auto" href="/dashboard/user-info/create">
                                <i class="fa fa-plus"> </i> Tambah Data
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Status Pengguna</th>
                                    <th>Kartu UID (Enkripsi)</th>
                                    <th>Sidik Jari (Enkripsi)</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$userinfos)
                                @else
                                    @foreach ($userinfos as $userinfo)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $userinfo->name }}</td>
                                            <td>{{ $userinfo->role }}</td>
                                            <td><span
                                                    class="badge {{ $userinfo->status ? 'badge-success' : 'badge-warning' }}">{{ $userinfo->status ? 'Aktif' : 'Pasif' }}</span>
                                            </td>
                                            <td>{{ $userinfo->user_card_uid }}</td>
                                            <td>{{ $userinfo->unique_identity }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    @can('isStaff')
                                                        <a class="btn btn-link btn-secondary btn-lg"
                                                            href="/dashboard/anyshow/{{ $userinfo->id }}">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    @endcan
                                                    @can('isAdmin')
                                                        <a class="btn btn-link btn-secondary btn-lg"
                                                            href="/dashboard/user-info/{{ $userinfo->id }}">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a class="btn btn-link btn-warning btn-lg"
                                                            href="/dashboard/user-info/{{ $userinfo->id }}/edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-link btn-danger"
                                                            data-toggle="modal" data-target="#deleteModal"
                                                            data-whatever="{{ $userinfo->id }}">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    @endcan
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
    <title>List Pengguna Kartu RFID</title>
@endpush

@push('scripts')
    <script src="{{ asset('vendor/template/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#add-row').DataTable({
                "pageLength": 10,
            });

            $(document).ready(function() {
                $("#addRowButton").click(function() {
                    $("#myForm").submit();
                });
            });
        });

        function myFunction() {
            var copyText = document.getElementById("myInput");

            navigator.clipboard.writeText(copyText.value);

            alert("Copied : " + copyText.value);
        }
    </script>
@endpush
