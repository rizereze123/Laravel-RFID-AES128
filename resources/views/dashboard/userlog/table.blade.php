<table id="add-row" class="display table table-striped table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Peran</th>
            <th>UID Kartu (Enkripsi)</th>
            <th>Sidik Jari (Enkripsi)</th>
            <th>Tanggal</th>
            <th>Waktu Masuk</th>
            <th>Waktu Keluar</th>
            <th>Nama Ruangan</th>
            <th>Nama Perangkat</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($userlogs as $userlog)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $userlog->user_card_uid? ($userlog->userCard->userInfo? $userlog->userCard->userInfo->name: 'Tidak terkait'): 'Tidak terkait' }}
                </td>
                <td>{{ $userlog->user_card_uid? ($userlog->userCard->userInfo? $userlog->userCard->userInfo->role: 'Tidak terkait'): 'Tidak terkait' }}
                </td>
                <td>{{ $userlog->user_card_uid }}</td>
                <td>{{ $userlog->user_card_uid? ($userlog->userCard->userInfo? $userlog->UserCard->userInfo->unique_identity: 'Tidak terkait'): 'Tidak terkait' }}
                </td>
                <td>{{ $userlog->check_in_date }}</td>
                <td>{{ $userlog->time_in }}</td>
                <td>{{ $userlog->time_out }}</td>
                <td>{{ $userlog->user_card_uid? ($userlog->userCard->userInfo? $userlog->userCard->device->room: 'Tidak terkait'): 'Tidak terkait' }}
                </td>
                <td>{{ $userlog->user_card_uid? ($userlog->userCard->userInfo? $userlog->userCard->device->device_name: 'Tidak terkait'): 'Tidak terkait' }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
