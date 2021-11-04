<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard (){
        $userCount = User::count();
        $jobCount = Job::count();
        $deptCount = Department::count();

        return view('dashboard',[
            'userCount' => $userCount,
            'jobCount' => $jobCount,
            'deptCount' => $deptCount
        ]);
    }

    public function displayUsers (){
        return view('dashboard.users', [
           'users' => User::paginate(10)
        ]);
    }

    public function editUsers (Request $request){
        $user = User::whereId($request->id)->first();
        $status = "";

        if(isset($request->name) || isset($request->email)){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            $status = "Record $user->id updated";
            return redirect('admin/dashboard/user/edit/' . $user->id)
                ->with('status', $status);
        }

        return view('dashboard.edit', [
                "user" => $user
            ]
        )->with("status", $status);
    }

    public function delete (Request $request){
        $user = User::whereId($request->id)->first();
        $status = "";

        if(isset($request->id)){
            $user->delete();
            $status = "Record $user->id deleted";
            return redirect('admin/dashboard/users')
                ->with('status', $status);
        }
    }
}
