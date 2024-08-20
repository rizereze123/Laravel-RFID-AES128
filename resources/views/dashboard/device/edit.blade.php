@extends('/dashboard/layouts/main')

@section('container')
    <div class="row">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Ubah Perangkat DoorLock RFID</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form id="deleteForm" action="/dashboard/device/{{ $device->uid }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="idDevice_uid">UID Perangkat</label>
                            <input type="text" class="form-control" id="idDevice_uid" placeholder="{{ $device->uid }}"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="idDeviceName">Nama Perangkat</label>
                            <input type="text" class="form-control" id="idDeviceName"
                                placeholder="Masukan nama perangkat..." name="device_name"
                                value="{{ old('device_name', $device->device_name) }}">
                        </div>
                        <div class="form-group">
                            <label for="idDeviceDept">Nama Ruangan Perangkat</label>
                            <input type="text" class="form-control" id="idDeviceDept"
                                placeholder="Masukan nama ruangan..." name="room"
                                value="{{ old('room', $device->room) }}">
                        </div>
                        <div class="form-group">
                            <label for="inputState">Status Mode Perangkat</label>
                            <select id="inputState" class="form-control" name="device_mode">
                                <option value="1" {{ $device->device_mode ? 'selected' : '' }}>Log History</option>
                                <option value="0" {{ !$device->device_mode ? 'selected' : '' }}>Pendaftaran Kartu</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex align-items-center">
                        <a class="btn btn-primary btn-round" href="/dashboard/device">Kembali</a>
                        <button type="button" id="deleteButton" class="btn btn-warning btn-round ml-auto">Ubah</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('title')
    <title>Ubah Perangkat DoorLock RFID</title>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#deleteButton").click(function() {
                $("#deleteForm").submit();
            });
        });
    </script>
@endpush
