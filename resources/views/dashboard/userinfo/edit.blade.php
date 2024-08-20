@extends('dashboard/layouts/main')

@section('container')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Ubah Pengguna Kartu RFID</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form id="userInfoForm" action="/dashboard/user-info/{{ $userInfo->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="idName">Name</label>
                                    <input type="text" name="name" value="{{ old('name', $userInfo->name) }}"
                                        class="form-control @error('name') is-invalid @enderror" id="idName"
                                        aria-describedby="emailHelp" placeholder="Name...">
                                    @error('name')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Sidik Jari (Enkripsi)</label>
                                    <input type="text" name="unique_identity"
                                        value="{{ old('unique_identity', $userInfo->unique_identity) }}"
                                        class="form-control @error('unique_identity') is-invalid @enderror"
                                        id="exampleInputPassword1" placeholder="No. Unik..." readonly>
                                    @error('unique_identity')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tanggal Lahir</label>
                                    <input type="date" name="DOB" class="form-control @error('DOB') is-invalid @enderror"
                                        value="{{ old('DOB', $userInfo->DOB) }}" id="exampleInputPassword1"
                                        placeholder="No. Unik...">
                                    @error('DOB')
                                        <div class="invalid-feedback"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- @dd($userInfo) --}}
                        <div class="row">
                            <div class="col-lg-8 col-md-6">
                                <div class="form-group">
                                    <label for="idAddress">UID Kartu (Enkripsi)</label>
                                    <select class="custom-select selectpicker" name="user_card_uid" data-show-subtext="true"
                                        data-live-search="true">
                                        {{-- @if (!$userCards->count())
                                            <option value="null" selected>Tidak ada kartu UID yang terdaftar</option>
                                        @else --}}
                                        @if (!$userCards->count())
                                            <option value="null" selected>Tidak ada kartu UID yang terdaftar</option>
                                        @else
                                            {{-- @foreach ($userCards as $userCard)
                                            <option value="{{ $userCard->uid }}" selected>{{ $userCard->uid }}</option> --}}
                                            @php
                                                $selectedUid = $userInfo->user_card_uid;
                                                $selectedUserCard = $userCards->where('uid', $selectedUid)->first();
                                            @endphp
                                            @if ($selectedUserCard)
                                                <option value="{{ $selectedUserCard->uid }}" selected>
                                                    {{ $selectedUserCard->uid }}
                                                </option>
                                            @endif
                                            {{-- <option value="{{ $userCard->uid }}" @if ($userCard->uid === $userInfo->user_card_uid) selected @endif>
                                                {{ $userCard->uid }}
                                            </option> --}}
                                            {{-- @endforeach --}}
                                        @endif
                                        {{-- @foreach ($userCards as $userCard)
                                        @if($userInfo->user_card_uid == $userCard->uid)
                                            <option value="{{ $userCard->uid }}">{{ $userCard->uid }}</option>
                                            @else
                                            <option value="{{ $userCard->uid }}">{{ $userCard->uid }}</option>
                                            @endif
                                        @endforeach --}}
                                        {{-- @endif --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label for="idAddress" name="gender">Gender</label>
                                    <select class="custom-select" name="gender">
                                        <option value="L" {{ $userInfo->gender == 'L' ? 'selected' : '' }}>L</option>
                                        <option value="P" {{ $userInfo->gender == 'P' ? 'selected' : '' }}>P</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="idAddress">Status Pengguna</label>
                                    <select class="custom-select" name="status">
                                        <option value="1" {{ $userInfo->status ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ !$userInfo->status ? 'selected' : '' }}>Pasif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="idAddress">Jabatan</label>
                                    <select class="custom-select" name="role">
                                        <option value="Operator" {{ $userInfo->role == 'Operator' ? 'selected' : '' }}>
                                            Operator
                                        </option>
                                        <option value="Teknisi-Server" {{ $userInfo->role == 'Teknisi-Server' ? 'selected' : '' }}>
                                            Teknisi-Server
                                        </option>
                                        <option value="Teknisi-Jaringan" {{ $userInfo->role == 'Teknisi-Jaringan' ? 'selected' : '' }}>
                                            Teknisi-Jaringan
                                        </option>
                                        <option value="Supervisor" {{ $userInfo->role == 'Supervisor' ? 'selected' : '' }}>
                                            Supervisor
                                        </option>
                                        <option value="Manager" {{ $userInfo->role == 'Manager' ? 'selected' : '' }}>
                                            Manager
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="idAddress">Alamat</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="idAddress" rows="2"
                                        name="address">{{ $userInfo->address }}</textarea>
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
                        <button type="button" class="btn btn-warning btn-round ml-auto" id="updateBtn">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('title')
    <title>Ubah Pengguna Kartu RFID</title>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#updateBtn").click(function() {
                $("#userInfoForm").submit();
            });
        });
    </script>
@endpush
