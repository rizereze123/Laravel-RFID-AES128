@extends('/dashboard/layouts/main')

@section('container')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">List Kartu RFID</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Kartu UID (Enkripsi)</th>
                                    <th>Status Kepemilikan</th>
                                    <th>Nama Ruangan</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$userCards)
                                @else
                                    @foreach ($userCards as $userCard)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $userCard->userInfo ? $userCard->userInfo->name : 'Belum ditautkan' }}
                                            </td>
                                            <td>{{ $userCard->uid }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $userCard->card_status ? 'badge-success' : 'badge-warning' }}">
                                                    {{ $userCard->card_status ? 'Telah Ada Kepemilikan' : 'Belum Ada Kepemilikan' }} </span>
                                            </td>
                                            <td>{{ $userCard->device->room }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a class="btn btn-link btn-secondary btn-lg"
                                                        href="/dashboard/user-card/{{ $userCard->uid }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-link btn-danger"
                                                        data-toggle="modal" data-target="#deleteModal"
                                                        data-whatever="{{ $userCard->uid }}">
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
    <title>List Kartu RFID</title>
@endpush

@push('scripts')
    <script src="{{ asset('/vendor/template/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#add-row').DataTable({
                "pageLength": 10,
            });
        });
    </script>
@endpush
