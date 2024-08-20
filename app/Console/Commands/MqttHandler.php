<?php

namespace App\Console\Commands;

use App\Models\Device;
use App\Models\UserCard;
use App\Models\UserInfo;
use App\Models\UserLog;
use Carbon\Carbon;
use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;

class MqttHandler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mqtt:handle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Handle MQTT messages';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //return 0;
        /** @var \PhpMqtt\Client\Contracts\MqttClient $mqtt ini tuh variabel buat mqtt loh */
        $mqtt = MQTT::connection();
        $mqtt->subscribe('hanari/feeds/doorlock', function (string $topic, string $message) {
            $this->info("Received QoS level 0 message on topic [{$topic}]: {$message}");
            $data = json_decode($message, true);

            $card_uid = $data['card_uid'];
            $device_token = $data['device_token'];
            $dt = Carbon::now()->setTimezone('Asia/Jakarta');

            // Cek apakah kedua request terpenuhi/tidak
            if (($card_uid && $device_token)) {
                // Cek apakah device_uid tersebut terdaftar/tidak
                if (!Device::where('uid', $device_token)->exists()) {
                    return $this->publishResponse('DoorLock Not Reg');
                } else {
                    $dataDevice = Device::firstWhere('uid', $device_token);
                    // Cek apakah device_mode berada pada attandance (1)/enrollment (0)
                    if ($dataDevice->device_mode) {
                        if (!UserCard::where('uid', $card_uid)->exists()) {
                            return $this->publishResponse('Unrecognize Card');
                        } else {
                            $dataUserCard = UserCard::firstWhere('uid', $card_uid);
                            $userInfo = UserInfo::where('user_card_uid', $dataUserCard->uid)->first();
                            // Cek apakah card_status sudah aktif atau belum
                            if ($dataUserCard->card_status && $userInfo->status == 1) {
                                // Cek apakah data card_uid sama dengan yang ada pada DB atau 0
                                if ($dataUserCard->uid == $card_uid || $dataUserCard->uid == 0) {
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
                                            return $this->publishResponse('Gagal Buka Pintu');
                                        }
                                        return $this->publishResponse('Pintu Terbuka-IN');
                                        // return $this->publishResponse("{\"code\":\"200\", \"messages\":\"Pintu Terbuka-IN\"}");
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
                                            return $this->publishResponse('Gagal Buka Pintu');
                                        }
                                        return $this->publishResponse('Pintu TerbukaOUT');
                                    }
                                } else {
                                    return $this->publishResponse('Not Allowed!');
                                }
                            } else {
                                return $this->publishResponse('Card Not Active!');
                            }
                        }
                    } else {
                        // Cek apakah user_card_uid sudah pernah ditambahkan/tidak
                        if (UserCard::where('uid', $card_uid)->exists()) {
                            return $this->publishResponse('Kartu Sudah Ada!');
                        } else {
                            $newCard = [
                                'uid' => $card_uid,
                                'device_uid' => $device_token,
                            ];
                            $result = UserCard::create($newCard);
                            if (!$result) {
                                return $this->publishResponse('Failed Add Card!');
                            }
                            return $this->publishResponse('New Card Added!!');
                        }
                    }
                }
            } else {
                return $this->publishResponse('Incomplete Data');
            }
        }, 0);
        $mqtt->loop(true);
    }

    private function publishResponse($response)
    {
        // Publish respons ke broker
        MQTT::publish('hanari/feeds/confirmation-messages', $response);
    }
}
