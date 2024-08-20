@extends('/dashboard/layouts/main')

@section('container')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Informasi Kartu RFID</h4>
                    </div>
                </div>
                <div class="card-body">
                    {{-- <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="idDeviceName">Nama Perangkat</label>
                                            <input type="text" value="{{ $device->device_name }}" class="form-control" id="idDeviceName" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="idDeviceDept">Nama Ruangan</label>
                                            <input type="text" value="{{ $device->room }}" class="form-control" id="idDeviceDept" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="idDeviceMode">Status Perangkat</label>
                                            <input type="text" value="{{ ($device->device_mode) ? 'Aktif' : 'Pasif' }}" class="form-control" id="idDeviceMode" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="idDeviceUID">UID Perangkat</label>
                                            <input type="text" value="{{ $device->uid }}" class="form-control" id="idDeviceUID" readonly>
                                        </div>
                                    </div>
                                </div> --}}
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Kartu UID (Dekripsi)</th>
                                    <th>Nama</th>
                                    <th>Status Kepemilikan</th>
                                    <th>Nama Ruangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    {{-- <td>{{ $userCard->uid }}</td> --}}
                                    <td>
                                        <?php
                                        $decryptedUid = '';
                                        try {
                                            $encryptedUid = $userCard->uid;
                                            // $x = hex2bin($encryptedUid);
                                            $ascii_string = '';
                                            for ($i = 0; $i < strlen($encryptedUid); $i += 8) {
                                                $ascii_string .= chr(bindec(substr($encryptedUid, $i, 8)));
                                            }
                                            $key = hex2bin('31313131313131313131313131313131'); // Ubah key dari format hex menjadi biner
                                            $iv = hex2bin('32323232323232323232323232323232'); // Ubah IV dari format hex menjadi biner
                                            $decryptedUid = openssl_decrypt($ascii_string, 'aes-128-cbc', $key, OPENSSL_RAW_DATA, $iv);
                                        } catch (\Exception $e) {
                                            $decryptedUid = 'Gagal dekripsi';
                                            // Di sini Anda dapat menambahkan log pesan kesalahan atau tindakan lain yang sesuai
                                            Log::error('Gagal dekripsi UID: ' . $e->getMessage());
                                        }
                                        ?>
                                        {{ $decryptedUid }}
                                    </td>
                                    
                                    <td>{{ $userCard->userInfo ? $userCard->userInfo->name : 'Belum ditautkan' }}</td>
                                    <td>{{ $userCard->card_status ? 'Telah Ada Kepemilikan' : 'Belum Ada Kepemilikan' }}</td>
                                    <td>{{ $userCard->device ? $userCard->device->room : '' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex align-items-center">
                        <a class="btn btn-primary btn-round" href="/dashboard/user-card">Kembali</a>
                        {{-- <a class="btn btn-warning btn-round ml-auto" href="/dashboard/user-info/{{ $userInfo->id }}/edit">Perbarui</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('/dashboard/partials/deleteModal')
@endsection

@push('title')
    <title>Informasi Kartu RFID</title>
@endpush

@push('scripts')
    <script src="{{ asset('/vendor/template/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#add-row').DataTable({
                "pageLength": 5,
            });
        });
    </script>
@endpush
