<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\UserCard;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard/device/index', [
            'devices' => Device::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $x = hex2bin(Uuid::uuid4()->getHex());
        $uuid = $this->hexToBinary($x);
        $rules = [
            'device_name' => 'required|max:60',
            'room' => 'required|max:60',
        ];

        $validatedData = $request->validate($rules);
        $validatedData["uid"] = $uuid;

        // dd($request->all());

        $result = Device::create($validatedData);

        if (!$result) {
            return 'error';
        }

        return redirect('/dashboard/device');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        // dd(Device::find($device->uid)->UserCard);
        return view('/dashboard/device/show', [
            'device' => $device,
            'userCards' => $device->userCard,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function edit(Device $device)
    {
        return view('dashboard/device/edit', [
            'device' => $device,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Device $device)
    {
        $rules = [
            'device_name' => 'required|max:32',
            'room' => 'required|max:32',
            'device_mode' => 'required',
        ];

        $validatedData = $request->validate($rules);

        $result = Device::where('uid', $device->uid)->update($validatedData);

        if (!$result) {
            return 'error';
        }
        return redirect('/dashboard/device');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        $device->UserCard()->delete();
        $device->delete();
        return redirect('/dashboard/device');
    }

    private function hexToBinary($hexString)
    {
        $binaryString = '';
        $hexLength = strlen($hexString);
        for ($i = 0; $i < $hexLength; $i++) {
            $binaryString .= str_pad(base_convert($hexString[$i], 16, 2), 4, '0', STR_PAD_LEFT);
        }
        return $binaryString;
    }
}
