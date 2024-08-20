@extends('dashboard/layouts/main')

@section('container')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Tambah Pengguna Kartu RFID</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form id="userInfoForm" action="/dashboard/user-info" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="idName">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                        id="idName" aria-describedby="emailHelp" placeholder="Name...">
                                    @error('name')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Sidik Jari</label>
                                    <input type="text" name="unique_identity"
                                        class="form-control @error('unique_identity') is-invalid @enderror"
                                        id="exampleInputsidikjari" placeholder="No. Unik...">
                                    @error('unique_identity')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tanggal Lahir</label>
                                    <input type="date" name="DOB" class="form-control @error('DOB') is-invalid @enderror"
                                        id="exampleInputPassword1" placeholder="No. Unik...">
                                    @error('DOB')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-6">
                                <div class="form-group">
                                    <label for="idAddress">UID Kartu (Enkripsi)</label>
                                    <select class="custom-select selectpicker" name="user_card_uid" data-show-subtext="true"
                                        data-live-search="true">
                                        @if (!$userCards->count())
                                            <option value="null" selected>Tidak ada kartu UID yang terdaftar</option>
                                        @else
                                            @foreach ($userCards as $userCard)
                                                <option value="{{ $userCard->uid }}">{{ $userCard->uid }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="idAddress" name="gender">Gender</label>
                                    <select class="custom-select" name="gender">
                                        <option value="L">L</option>
                                        <option value="P">P</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="idAddress">Status Pengguna</label>
                                    <select class="custom-select" name="status">
                                        <option value="1">Aktif</option>
                                        <option value="0">Pasif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="idAddress">Jabatan</label>
                                    <select class="custom-select" name="role">
                                        <option value="Operator">Operator</option>
                                        <option value="Teknisi-Server">Teknisi-Server</option>
                                        <option value="Teknisi-Jaringan">Teknisi-Jaringan</option>
                                        <option value="Supervisor">Supervisor</option>
                                        <option value="Manager">Manager</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="idAddress">Alamat</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="idAddress" rows="2" name="address"></textarea>
                                    @error('address')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex align-items-center">
                        <a class="btn btn-primary btn-round" href="/dashboard/user-info">Kembali</a>
                        <button type="button" class="btn btn-success btn-round ml-auto" id="submitButton">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('title')
    <title>Tambah Pengguna Kartu RFID</title>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#submitButton").click(function() {
                // Mengambil nilai sidik jari dari input
                var sidikJari = $("#exampleInputsidikjari").val();

                // Ubah key dan iv dari hex menjadi binary
                var key = CryptoJS.enc.Hex.parse('31313131313131313131313131313131');
                var iv = CryptoJS.enc.Hex.parse('32323232323232323232323232323232');

                // Enkripsi sidik jari menggunakan AES
                var encryptedUid = CryptoJS.AES.encrypt(sidikJari, key, { iv: iv });

                // Ubah hasil enkripsi ke dalam format HEX
                var encryptedUidHex = encryptedUid.ciphertext.toString(CryptoJS.enc.Hex);
                var x = hexToBinary(encryptedUidHex);
                // Masukkan nilai yang dienkripsi ke dalam input tersembunyi
                $("input[name='unique_identity']").val(x);

                // Kirim formulir
                $("#userInfoForm").submit();
            });
        });
        function hexToBinary(hex) {
    var binary = "";
    var remainingSize = hex.length;
    for (var p = 0; p < hex.length/8; p++) {
        //In case remaining hex length (or initial) is not multiple of 8
        var blockSize = remainingSize < 8 ? remainingSize  : 8;

        binary += parseInt(hex.substr(p * 8, blockSize), 16).toString(2).padStart(blockSize*4,"0");

        remainingSize -= blockSize;
    }
    return binary;
}
    </script>
@endpush


@push('scripts')
    <!-- Menyertakan CryptoJS melalui CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
@endpush
