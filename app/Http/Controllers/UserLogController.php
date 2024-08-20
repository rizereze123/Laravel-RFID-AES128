<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserLog;
use App\Models\Device;

use Carbon\Carbon;
use App\Exports\UserLogView;
use Maatwebsite\Excel\Facades\Excel;

// use Illuminate\Database\Eloquent\Builder;

class UserLogController extends Controller
{
    public function dashboard()
    {
        $dt = Carbon::now();
        $dt->setTimezone('Asia/Jakarta');

        return view('/dashboard/index', [
            'userlogs' => UserLog::where('check_in_date', $dt->toDateString())->get(),
        ]);
    }

    public function index(Request $request)
    {
        return view('/dashboard/userlog/index', [
            'userlogs' => UserLog::latest()
                ->FilterByDept($request->room)
                ->FilterByUID($request->user_card_uid)
                ->FilterByDate($request->start_date, $request->end_date)
                ->FilterByTime($request->time_in, $request->time_out)
                ->get(),
            'devices' => Device::all(),
        ]);
    }

    public function clearRecord()
    {
        if (request('confirmation')) {
            userLog::query()->delete();
            return redirect('/dashboard/userlog');
        }
        return redirect('/dashboard/userlog');
    }

    public function export()
    {
        return Excel::download(new UserLogView, 'UserLog.xlsx');
    }
}
