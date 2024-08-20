@extends('/dashboard/layouts/main')

@section('container')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Informasi Pengguna Kartu RFID</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="idName">Name</label>
                                <input type="text" name="name" class="form-control" id="idName"
                                    aria-describedby="emailHelp" placeholder="Name..." value="{{ $userInfo->name }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Sidik Jari (Dekripsi)</label>
                                {{-- <input type="text" name="unique_identity" class="form-control" id="exampleInputPassword1"
                                    placeholder="No. Unik..." value="{{ $userInfo->unique_identity }}" readonly> --}}
                                @php
                                    try {
                                        $ascii_string = '';
                                            for ($i = 0; $i < strlen($userInfo->unique_identity); $i += 8) {
                                                $ascii_string .= chr(bindec(substr($userInfo->unique_identity, $i, 8)));
                                            }
                                        // Lakukan dekripsi
                                        $x = openssl_decrypt($ascii_string, 'aes-128-cbc', hex2bin('31313131313131313131313131313131'), OPENSSL_RAW_DATA, hex2bin('32323232323232323232323232323232'));
                                        // $decryptedUidx = substr($x, 0, -1);
                                    } catch (\Exception $e) {
                                        // Tangani kesalahan jika terjadi
                                        $x = 'Gagal dekripsi';
                                    }
                                @endphp
                                    <input type="text" class="form-control" value="{{ $x }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tanggal Lahir</label>
                                <input type="text" name="DOB" class="form-control" id="exampleInputPassword1"
                                    placeholder="No. Unik..." value="{{ $userInfo->DOB }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="form-group">
                                <label for="idAddress">UID Kartu (Dekripsi)</label>
                                {{-- <input type="text" class="form-control" value="{{ $userInfo->user_card_uid }}" readonly> --}}
                                {{-- <input type="text" class="form-control" value="{{ openssl_decrypt(hex2bin($userInfo->user_card_uid), 'aes-128-cbc', hex2bin('31313131313131313131313131313131'), OPENSSL_RAW_DATA, hex2bin('32323232323232323232323232323232')) }}" readonly> --}}
                                {{-- <input type="text" class="form-control" value="{{ openssl_decrypt(hex2bin($userInfo->user_card_uid), 'aes-128-cbc', hex2bin('31313131313131313131313131313131'), OPENSSL_RAW_DATA, hex2bin('32323232323232323232323232323232')) ? substr(openssl_decrypt(hex2bin($userInfo->user_card_uid), 'aes-128-cbc', hex2bin('31313131313131313131313131313131'), OPENSSL_RAW_DATA, hex2bin('32323232323232323232323232323232')), 0, -1) : 'Gagal dekripsi' }}" readonly> --}}
                                @php
                                try {
                                    // Lakukan dekripsi
                                    $ascii_string = '';
                                            for ($i = 0; $i < strlen($userInfo->user_card_uid); $i += 8) {
                                                $ascii_string .= chr(bindec(substr($userInfo->user_card_uid, $i, 8)));
                                            }
                                    $x = openssl_decrypt($ascii_string, 'aes-128-cbc', hex2bin('31313131313131313131313131313131'), OPENSSL_RAW_DATA, hex2bin('32323232323232323232323232323232'));
                                    $decryptedUidx = substr($x, 0, -1);
                                } catch (\Exception $e) {
                                    // Tangani kesalahan jika terjadi
                                    $decryptedUidx = 'Gagal dekripsi';
                                }
                            @endphp
                                <input type="text" class="form-control" value="{{ $decryptedUidx }}" readonly>
                                {{-- <input type="text" class="form-control" value="{{ substr(openssl_decrypt(hex2bin($userInfo->user_card_uid), 'aes-128-cbc', hex2bin('31313131313131313131313131313131'), OPENSSL_RAW_DATA, hex2bin('32323232323232323232323232323232')), 0, -1) }}" readonly> --}}
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="idAddress" name="gender">Gender</label>
                                <input type="text" class="form-control" value="{{ $userInfo->gender }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="idAddress">Status Pengguna</label>
                                <input type="text" class="form-control" value="{{ $userInfo->status ? 'Aktif' : 'Pasif' }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="idAddress">Jabatan</label>
                                <input type="text" class="form-control" value="{{ $userInfo->role }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="idAddress">Alamat</label>
                                <textarea class="form-control" id="idAddress" rows="2" name="address" readonly>{{ $userInfo->address }}</textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Perangkat</th>
                                        <th>Nama Ruangan</th>
                                        <th>UID Kartu (Dekripsi)</th>
                                        <th>Status Kepemilikan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $userInfo->userCard ? $userInfo->userCard->device->device_name : 'Belum ditautkan' }}
                                        </td>
                                        <td>{{ $userInfo->userCard ? $userInfo->userCard->device->room : 'Belum ditautkan' }}
                                        </td>
                                        <td>
                                            @if ($userInfo->userCard)
                                                <?php
                                                
                                                $decryptedUid = '';
                                                try {
                                                    $ascii_string = '';
                                                    for ($i = 0; $i < strlen($userInfo->user_card_uid); $i += 8) {
                                                        $ascii_string .= chr(bindec(substr($userInfo->user_card_uid, $i, 8)));
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
                                            @else
                                                Belum ditautkan
                                            @endif
                                        </td>                                        
                                        <td>{{ $userInfo->userCard ? ($userInfo->userCard->card_status ? 'Telah Ada Kepemilikan' : 'Belum Ada Kepemilikan') : 'Belum ditautkan' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @can('isAdmin')
                    <div class="card-footer">
                        <div class="d-flex align-items-center">
                            <a class="btn btn-primary btn-round" href="/dashboard/user-info">Kembali</a>
                            <a class="btn btn-warning btn-round ml-auto"
                                href="/dashboard/user-info/{{ $userInfo->id }}/edit">Perbarui</a>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    </div>
@endsection

@push('title')
    <title>Informasi Pengguna Kartu RFID</title>
@endpush

