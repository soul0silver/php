<?php

namespace App\Http\Controllers\Api;



use App\Models\Absent;
use App\Models\Employee;
use App\Models\User;
use App\Models\Worksday;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


class AbsentController extends Controller
{

    public function login(Request $request):JsonResponse
    {
        $user=User::query()->where('name')->get();
        return response()->json($user->id);
    }
    public function index($eid): JsonResponse
    {
        $absent = Absent::query()->where('eid',(int)$eid)->orderBy('id')->paginate(10);
        return response()->json([
            "data", $absent
        ]);
    }


    public function edit(Request $request)
    {
        if (Absent::query()->where('id', $request->input('id'))->exists()) {
            $absent = new Absent();
            $absent->setAttribute('from_hour', $request->input('from_hour'));
            $absent->setAttribute('from_date', $request->input('from_date'));
            $absent->setAttribute('to_date', $request->input('to_date'));
            $absent->setAttribute('to_hour', $request->input('to_hour'));
            $absent->save();
        }
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $uid= $request->input('uid');

        if (Gate::allows('add-absent',$uid))
        Absent::query()->create(
            [
                'eid'=>$request->input('eid'),
                'from_date'=>$request->input('from_date'),
                'from_hour'=>$request->input('from_hour'),
                'to_date'=>$request->input('to_date'),
                'to_hour'=>$request->input('to_hour'),
                'type'=>1
            ]);
        $worksday = Worksday::query()->where('eid', request('eid'))->where('year', \date('Y'))->first();
        $from_hour = (int) request('from_hour');
        $from_date = \Carbon\Carbon::parse(request('from_date'));
        $to_date = \Carbon\Carbon::parse(request('to_date'));
        $to_hour = (int) request('to_hour');
        $day = (double)$from_date->diffInDays($to_date);
        if ($day > 0) {
            if ($to_hour - $from_hour < 0) {
                $day =(double)($day - 0.5);
            } else if ($to_hour - $from_hour > 0) {
                $day += 0.5;
            }

        }
        if ($day==0) {
            if ($to_hour - $from_hour > 0) {
                $day = 0.5;
            }
        }

        $absent=(double)$worksday->absent;
        $day=$day+$absent;
        $worksday->setAttribute('absent',$day);
        $worksday->save();
        return response()->json(['message' => "success"], 201);
    }

    public function summary(Request $request,int $year): JsonResponse
    {
        $workday = DB::table('worksdays')
            ->join('employees','employees.id','=','worksdays.eid')
            ->select('worksdays.id','worksdays.absent','employees.name','employees.id')
            ->where('worksdays.year',$year)
            ->orderBy('eid')->get();
        return response()->json($workday);
    }
    public function getEmp():JsonResponse{
        $emp=Employee::query()->orderBy('id')->get();
        return response()->json($emp);
    }
    public function getDashBoard():JsonResponse{
        $count=DB::table('employees')->count('employees.id');
        $workday = DB::table('worksdays')
            ->join('employees','employees.id','=','worksdays.eid')
            ->select('worksdays.absent','employees.name','employees.id')
            ->where('worksdays.year',\date("Y"))
            ->orderBy('eid')->get();
        return response()->json(['count'=>$count,
            'data'=>$workday]);
    }

    public function read($uid):JsonResponse
    {
        $res='not';
        if(Gate::check('read-role',1))
           $res="read";
        return response()->json($res);
    }
    public function canedit($uid):JsonResponse
    {
        $res='';
        if(Gate::allows('edit',$uid))
            $res="edit";
        else $res='not';
        return response()->json($res);
    }
    public function create($uid):JsonResponse
    {
        $res='';
        if(Gate::allows('create',$uid))
            $res="read";
        else $res='not';
        return response()->json($res);
    }
}
