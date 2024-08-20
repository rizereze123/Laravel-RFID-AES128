<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Device;
use App\Models\UserCard;
use App\Models\UserLog;
use App\Models\UserInfo;

class DoorLockController extends Controller
{
	public function doorlock()
	{
		$dt = Carbon::now();
		$dt->setTimezone('Asia/Jakarta');

		// Cek apakah kedua request terpenuhi/tidak
		if (request('card_uid') && request('device_token')) {
			// Cek apakah device_uid tersebut terdaftar/tidak
			if (!Device::where('uid', request('device_token'))->exists()) {
				//return "[Server] : UID Perangkat DoorLock RFID tidak terdaftar";
				abort(403, 'DoorLock Not Reg');
			} else {
				$dataDevice = Device::firstWhere('uid', request('device_token'));
				// Cek apakah device_mode berada pada attandance (1)/enrollment (0)
				if ($dataDevice->device_mode) {
					if (!UserCard::where('uid', request('card_uid'))->exists()) {
						//return '[Server] : Kartu RFID tidak dikenal';
						abort(403, 'Unrecognize Card');
					} else {
						$dataUserCard = UserCard::firstWhere('uid', request('card_uid'));
						$userInfo = UserInfo::where('user_card_uid', $dataUserCard->uid)->first();
						// Cek apakah card_status sudah aktif atau belum
						if ($dataUserCard->card_status && $userInfo->status == 1) {
							// Cek apakah data card_uid sama dengan yang ada pada DB atau 0
							if ($dataUserCard->uid == request('card_uid') || $dataUserCard->uid == 0) {
								// Cek apakah sudah melakukan absen sudah absen hari ini
								// if (UserLog::firstWhere(['user_card_uid' => $dataUserCard->uid, 'check_in_date' => $dt->toDateString(), 'card_out' => 1])) {
								// 	return '[Server] : Anda sudah melakukan absen hari ini!';
								// } else {
								// Cek apakah sudah melakukan time in/sudah
								if (!UserLog::firstWhere(['user_card_uid' => $dataUserCard->uid, 'check_in_date' => $dt->toDateString(), 'card_out' => 0])) {
									// Melakukan Time in
									$result = UserLog::create([
										'user_card_uid' => $dataUserCard->uid,
										'check_in_date' => $dt->toDateString(),
										'time_in' => $dt->toTimeString(),
										'time_out' => "00:00:00",
									]);
									if (!$result) {
										abort(403, 'Gagal Buka Pintu');
									}
									return 'Pintu Terbuka-IN';
								} else {
									// Melakukan Time out
									$result = UserLog::where([
										'user_card_uid' => $dataUserCard->uid,
										'card_out' => 0,
										'check_in_date' => $dt->toDateString(),
									])->update([
										'time_out' => $dt->toTimeString(),
										'card_out' => true
									]);
									if (!$result) {
										abort(403, 'Gagal Buka Pintu');
									}
									return 'Pintu TerbukaOUT';
								}
								// }
							} else {
								// return '[Server] : Not Allowed!';
								abort(403, 'Not Allowed!');
							}
						} else {
							//return '[Server] : Kartu RFID belum aktif';
							abort(403, 'Card Not Active!');
						}
					}
				} else {
					// Cek apakah user_card_uid sudah pernah ditambahkan/tidak
					if (UserCard::where('uid', request('card_uid'))->exists()) {
						//return '[Server] : Kartu RFID sudah pernah ditambahkan';
						abort(403, 'Kartu Sudah Ada!');
					} else {
						$newCard = [
							'uid' => request('card_uid'),
							'device_uid' => request('device_token'),
						];

						$result = UserCard::create($newCard);
						if (!$result) {
							abort(403, 'Failed Add Card!');
						}
						return 'New Card Added!!';
					}
				}
			}
		} else {
			return;
			// return redirect('/');
		}
	}
}
