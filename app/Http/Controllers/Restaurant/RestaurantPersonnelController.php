<?php

namespace App\Http\Controllers\Restaurant;

use App\Helpers\UploadsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\PersonnelRequest;
use App\Jobs\Personnel\SendEmailPersonnelStore;
use App\Models\Bank;
use App\Models\Commune;
use App\Models\District;
use App\Models\Personnel;
use App\Models\Position;
use App\Models\Province;
use App\Models\Shift;
use App\Models\SiteSetting;
use App\Models\TimeKeeping;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class RestaurantPersonnelController extends Controller
{
    protected $pathView = 'restaurant.admin.personnel.';

    const PART_TIME = 0;
    const FULL_TIME = 1;
    const INTERN = 2;

    public $morning_start;
    public $morning_end;
    public $afternoon_start;
    public $afternoon_end;
    public function __construct()
    {
        $this->morning_start = strtotime(SiteSetting::morningStart()) + 300;
        $this->morning_end = strtotime(SiteSetting::morningEnd());
        $this->afternoon_start = strtotime(SiteSetting::afternoonStart()) + 300;
        $this->afternoon_end = strtotime(SiteSetting::afternoonEnd());

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Personnel::query()
            ->leftJoin('positions', 'positions.id', 'personnels.position_id')
            ->leftJoin('communes', 'communes.id', 'personnels.commune_id')
            ->leftJoin('districts', 'districts.id', 'personnels.district_id')
            ->leftJoin('provinces', 'provinces.id', 'personnels.province_id')
            ->leftJoin('shifts', 'shifts.id', 'personnels.shift_id')
            ->select(
                'personnels.*',
                'positions.name as position_name',
                'communes.name as commune_name',
                'districts.name as district_name',
                'provinces.name as province_name',
                'shifts.name as shift_name',
                'shifts.start',
                'shifts.end',
            )
            ->where('personnels.restaurant_id', Auth::guard('restaurant')->user()->id)
            ->get();
        $shifts = Personnel::SHIFTS;
        return view($this->pathView.'index', compact('datas', 'shifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genders = Personnel::GENDER;
        $shifts = Personnel::SHIFTS;
        $positions = Position::select('id', 'name')->get();
        $provinces = Province::select('id', 'name')->get();
        $banks = Bank::select('id', 'name', 'shortName')->get();
        return view($this->pathView.'create', compact('genders', 'shifts', 'positions', 'provinces', 'banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonnelRequest $request)
    {
        try {
            DB::beginTransaction();
            $params = $request->only([
                'name',
                'email',
                'phone',
                'birthday',
                'gender',
                'bank_id',
                'account_number',
                'position_id',
                'shift_id',
                'work_type',
                'province_id',
                'district_id',
                'commune_id',
                'address',
                'started_at',
                'signed_at',
                'ended_at'
            ]);
            $params['restaurant_id'] = Auth::guard('restaurant')->user()->id;
            if ($request->hasFile('avatar')) {
                $params['avatar'] = UploadsHelper::handleUploadFile('img/personnel/','avatar', $request);
            }
            $data = Personnel::create($params);
            DB::commit();
            return redirect()->route('restaurant.personnel.index')->with(['success' => trans('messages.common.success')]);
        } catch (Exception $e) {
            Log::error('[RestaurantPersonnelController][store] error ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->with(['error' => trans('messages.common.error')]);
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Personnel::find($id);
        if($data) {
            $genders = Personnel::GENDER;
            $shifts = Personnel::SHIFTS;
            $positions = Position::select('id', 'name')->get();
            $provinces = Province::select('id', 'name')->get();
            $banks = Bank::select('id', 'name', 'shortName')->get();
            return view($this->pathView.'edit', compact('data', 'genders', 'shifts', 'positions', 'provinces', 'banks'));
        }
        return redirect()->back()->with(['error' => trans('messages.common.error')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonnelRequest $request, $id)
    {
        try {
            $data = Personnel::find($id);
            if (!$data) {
                abort(404);
            }
            DB::beginTransaction();
            $params = $request->only([
                'name',
                'email',
                'phone',
                'birthday',
                'gender',
                'bank_id',
                'account_number',
                'position_id',
                'shift_id',
                'work_type',
                'province_id',
                'district_id',
                'commune_id',
                'address',
                'started_at',
                'signed_at',
                'ended_at'
            ]);
            if ($request->hasFile('avatar')) {
                Storage::delete($data->logo);
                $params['avatar'] = UploadsHelper::handleUploadFile('img/personnel/','avatar', $request);
            }
            $data->update($params);
            DB::commit();
            return redirect()->route('restaurant.personnel.index')->with(['success' => trans('messages.common.success')]);
        } catch (Exception $e) {
            Log::error('[RestaurantPersonnelController][update] error ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->with(['error' => trans('messages.common.error')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function givePassword($id)
    {
        try {
            $data = Personnel::find($id);
            if (!$data) {
                abort(404);
            }
            DB::beginTransaction();
            $random = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(1,10))),1,10);
            $params['password'] = Hash::make($random);
            dispatch(new SendEmailPersonnelStore($data->email, $random));
            $data->update($params);
            DB::commit();
            return redirect()->route('restaurant.personnel.index')->with(['success' => trans('messages.common.success')]);
        } catch (Exception $e) {
            Log::error('[RestaurantPersonnelController][update] error ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->with(['error' => trans('messages.common.error')]);
        }
    }

    /**
     * @param ChangePasswordRequest $request
     * @return json
     * @throws Exception
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $data = Auth::guard('personnel')->user();
            if (!Hash::check($request->input('password_old'), $data->password)) {
                $data = null;
            } else {
                DB::beginTransaction();
                $data->password = Hash::make($request->input('password'));
                $data->update();
                DB::commit();
            }
            if (empty($data)) {
                return response()->json(['status' => 400]);
            }
            return response()->json(['status' => 200]);
        } catch (Exception $e) {
            Log::error('[RestaurantPersonnelController][changePassword] error ' . $e->getMessage());
            DB::rollBack();
            throw new Exception('[RestaurantPersonnelController][changePassword] error ' . $e->getMessage());
        }
    }

    /**
     * show district.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
    public function showDistrict(Request $request)
    {
        if ($request->ajax()) {
            $districts = District::where('province_id', $request->province_id)->select('id', 'name')->get();
            $communes = Commune::where('district_id', $districts[0]->id)->select('id', 'name')->get();
            return response()->json([
                'districts' => $districts,
                'communes' => $communes,
            ]);
        }
    }

    /**
     * show commune.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
    public function showCommune(Request $request)
    {
        if ($request->ajax()) {
            $communes = Commune::where('district_id', $request->district_id)->select('id', 'name')->get();
            return response()->json($communes);
        }
    }

    /**
     * show commune.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
    public function showPosition(Request $request)
    {
        if ($request->ajax()) {
            $position = Position::where('id', $request->position_id)->select('id', 'name', 'work_type')->first();
            $shifts = Shift::where('work_type', $position->work_type[0])->where('restaurant_id', Auth::guard('restaurant')->user()->id)->get();
            return response()->json([
                'work_types' => $position->work_type,
                'shifts' => $shifts
            ]);
        }
    }

    /**
     * show commune.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
    public function showShift(Request $request)
    {
        if ($request->ajax()) {
            $shifts = Shift::where('work_type', $request->work_type)->where('restaurant_id', Auth::guard('restaurant')->user()->id)->get();
            return response()->json($shifts);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function timeKeeping($id)
    {
        $datas = TimeKeeping::select(DB::raw('
            personnel_id,
            name,
            shift,
            avatar,
            DATE(checked_at) date,
            TIME(MIN(checked_at)) checked_in,
            TIME(MAX(checked_at)) checked_out',
        ))
        ->leftJoin('personnels', 'personnels.id', 'time_keepings.personnel_id')
        ->where('personnel_id', $id)
        ->groupBy(DB::raw('DATE(checked_at)'),'personnel_id')
        ->orderByRaw('date DESC, checked_in DESC')
        ->get();

        $personnel = Personnel::select('id', 'name')->find($id);
        $time_shift = SiteSetting::where('restaurant_id', Auth::guard('restaurant')->user()->id)->get()->toArray();
        $shifts = Personnel::SHIFTS;
        return view($this->pathView.'timekeeping.index', compact('datas', 'time_shift', 'shifts', 'personnel'));
    }

    /**
     * Calculate time between t1 and t2
     * @param $t1
     * @param $t2
     * @return float|int
     */
    private static function minusTime($t1, $t2)
    {
        if ($t2 < $t1)
            return 0;
        return round(($t2 - $t1 + 300) / 3600.0, 2);
    }

    /** Get work time in 1 days */
    public function getWorkTimeInOneDay($startTime,$endTime)
    {
        if ($startTime == 0 || $endTime == 0) {
            return 0;
        }
        $morningTime = 0;
        if ($this->morning_start  < $endTime) {
            if ($endTime < $this->afternoon_start)
                $morningTime = min(
                    self::minusTime($this->morning_start , $this->morning_end),
                    self::minusTime($startTime, $endTime),
                    self::minusTime($this->morning_start , $endTime)
                );
            else
                $morningTime = min(self::minusTime($this->morning_start , $this->morning_end), self::minusTime($startTime, $this->morning_end));
        }
        $afternoonTime = 0;
        if ($startTime < $this->afternoon_end) {
            if ($startTime < $this->morning_end)
                $afternoonTime = min(self::minusTime($this->afternoon_start, $endTime), 4.5);
            else
                $afternoonTime = min(
                    self::minusTime($this->afternoon_start, $this->afternoon_end),
                    self::minusTime($this->afternoon_start, $endTime),
                    self::minusTime($startTime, $endTime)
                );
        }
        return min(8, $morningTime + $afternoonTime);
    }

    /**
     * Calculate working duration in day
     * @param $time_keepings
     * @return array
     */
    public function calcWorkingDuration($time_keepings, $export = false) {
        $checkedIn = strtotime($time_keepings->checked_in);
        $checkedOut = strtotime($time_keepings->checked_out);
        if ($checkedIn == $checkedOut) {
            if ($checkedOut > $this->afternoon_end) {
                $checkedIn = 0;
            } else {
                $checkedOut = 0;
            }
        }

        $late_join = false;
        if ($checkedIn != null && (($this->morning_start < $checkedIn && $checkedIn < $this->morning_end)
            || ($this->afternoon_start < $checkedIn && $checkedIn < $this->afternoon_end)))
        {
            $late_join = true;
        }

        $checkedInImage = null;
        $checkedOutImage = null;
        $early_leave = true;
        $personnel = Personnel::find($time_keepings->personnel_id);
        if ($checkedOut == null || (($this->morning_end <= $checkedOut && $checkedOut <= $this->afternoon_start && $personnel->working_type != self::FULL_TIME ) || $checkedOut >= $this->afternoon_end))
            $early_leave = false;

        $duration = self::getWorkTimeInOneDay($checkedIn, $checkedOut);

        // Get checked image
        // $checkedInImage = $checkedOutImage = null;
        // if ($export == false) {
        //     $checkedInImage = $checkedIn ? Attendance::select('checked_image')
        //     ->where('checked_at', $attendance->date.' '.$attendance->checked_in)->first()['checked_image'] : null;
        //     $checkedOutImage = $checkedOut ? Attendance::select('checked_image')
        //     ->where('checked_at', $attendance->date.' '.$attendance->checked_out)->first()['checked_image'] : null;
        // }

        return [
            'date' => $time_keepings->date,
            'checked_in' => $checkedIn,
            'checked_in_image' => $checkedInImage,
            'checked_out' => $checkedOut,
            'checked_out_image' => $checkedOutImage,
            'duration' => $duration,
            'late_join' => $late_join,
            'early_leave' => $early_leave
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check($id, Request $request)
    {
        try {
            TimeKeeping::create([
                'personnel_id' => $id,
                'checked_at' => Carbon::createFromFormat('Y-m-d H:i', $request->choose_date." ".$request->choose_time),
                // 'checked_type' => TimeKeeping::MANUAL_CHECK
            ]);
            $preUrl = empty(URL ::previous())?route('admin.timekeeping.index'):(URL::previous());
            return redirect($preUrl);
        } catch (\Exception $e) {
            $preUrl = empty(URL::previous())?route('admin.timekeeping.index'):(URL::previous());
            return redirect($preUrl);
        }
    }
}
