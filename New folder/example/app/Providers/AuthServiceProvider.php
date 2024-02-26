<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */

    public function boot(): void
    {

        Gate::define('read-role',function ($user_id){
            echo "CALL";
            return true;
        });
//        $this->setGate();
//        Gate::define('read',function (User $user, int $uid){
////            $check=false;
////            $role=DB::table('role')->join('user_role','')
////                ->join('user_role','role.id','=','user_role.rid')
////                ->join('users','user_role.uid','=','users.id')
////                ->select('role.name')->where('users.id','=',$uid)->get()->toArray();
//
////            return in_array('read',$role);
//            return $uid==1;
//        });
//        Gate::define('edit',function (int $uid){
//            $check=false;
//            $role=DB::table('role')->join('user_role','')
//                ->join('user_role','role.id','=','user_role.rid')
//                ->join('users','user_role.uid','=','users.id')
//                ->select('role.name')->where('users.id',$uid)->get()->toArray();
//            return in_array('edit',$role);
//        });
    }

    public function setGate():void
    {
        Gate::define('create',function (int $uid){
            $check=false;
            $role=DB::table('role')->join('user_role','')
                ->join('user_role','role.id','=','user_role.rid')
                ->join('users','user_role.uid','=','users.id')
                ->select('role.name')->where('users.id',$uid)->get()->toArray();
            return in_array('creat',$role);
        });
    }
}
