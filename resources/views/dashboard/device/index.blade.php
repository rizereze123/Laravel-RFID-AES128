@extends('/dashboard/layouts/main')

@section('container')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">List Perangkat DoorLock RFID</h4>
                        <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                            <i class="fa fa-plus"></i>
                            Tambah Perangkat
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Modal -->
                    <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header no-bd">
                                    <h5 class="modal-title">
                                        <span class="fw-mediumbold">
                                            Tambah</span>
                                        <span class="fw-light">
                                            Perangkat
                                        </span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="small">Tambahkan perangkat baru</p>
                                    <form action="/dashboard/device" method="POST" id="myForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Nama Perangkat</label>
                                                    <input name="device_name" id="idDeviceName" type="text"
                                                        class="form-control" placeholder="isi nama perangkat...">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Nama Ruangan</label>
                                                    <input name="room" id="idDeviceDept" type="text"
                                                        class="form-control" placeholder="isi nama ruangan...">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="modal-footer no-bd">
                                        <button type="button" id="addRowButton" class="btn btn-primary">Tambah</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Perangkat</th>
                                    <th>Nama Ruangan</th>
                                    <th>Status Mode Perangkat</th>
                                    <th>UID Perangkat</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$devices)
                                @else
                                    @foreach ($devices as $device)
                                        <tr>
                                            <td>{{ $device->device_name }}</td>
                                            <td>{{ $device->room }}</td>
                                            <td><span
                                                    class="badge {{ $device->device_mode ? 'badge-success' : 'badge-warning' }}">{{ $device->device_mode ? 'Log History' : 'Pendaftaran Kartu' }}</span>
                                            </td>
                                            <td>{{ $device->uid }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a class="btn btn-link btn-secondary btn-lg"
                                                        href="/dashboard/device/{{ $device->uid }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-link btn-warning btn-lg"
                                                        href="/dashboard/device/{{ $device->uid }}/edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-link btn-danger"
                                                        data-toggle="modal" data-target="#deleteModal"
                                                        data-whatever="{{ $device->uid }}">
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
    <title>List Perangkat DoorLock RFID</title>
@endpush

@push('scripts')
    <script src="{{ asset('/vendor/template/js/plugin/datatables/datatables.min.js') }}"></script>
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
    </script>
@endpush
