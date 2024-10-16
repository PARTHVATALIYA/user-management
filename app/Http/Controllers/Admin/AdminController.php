<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Hobby;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function showDashboard(Request $request)
    {
        if ($request->session()->has('user')) {
            $userName = $request->session()->get('user');
            $admin = User::where('email', $userName)->orWhere('user_name', $userName)
                    ->select('profile_picture', 'user_name')->first();
            return view('admin.dashboard', compact('admin'));
        }
    }

    public function getUser()
    {
        $users = DB::table('users as u')
                ->join('grades as g', 'u.grade_id', '=', 'g.id')
                ->join('hobbies as h', 'u.id', '=', 'h.user_id')
                ->where('email', '!=', 'admin@gmail.com')
                ->select([
                    'u.id',
                    'u.first_name',
                    'u.last_name',
                    'u.email',
                    'u.phone_number',
                    'u.gender',
                    'g.name as grade',
                    'h.name as hobby',
                    'u.status',
                    'u.is_verified',
                    'u.is_approved'])
                ->orderBy('u.created_at', 'desc')
                ->get();

        return view('admin.user.user', compact('users'));
    }

    public function editUserForm(string $id)
    {
        $user = DB::table('users as u')
                ->join('grades as g', 'u.grade_id', '=', 'g.id')
                ->join('hobbies as h', 'u.id', '=', 'h.user_id')
                ->where('u.id', $id)
                ->select([
                    'u.id',
                    'u.first_name',
                    'u.last_name',
                    'u.email',
                    'g.name as grade',
                    'u.phone_number',
                    'u.gender',
                    'h.name as hobby',
                    'u.message'
                ])
                ->get();
        $userData = array();
        foreach ($user as $u) {
            $userData['id'] = $id;
            $userData['first_name'] = $u->first_name;
            $userData['last_name'] = $u->last_name;
            $userData['email'] = $u->email;
            $userData['grade'] = $u->grade;
            $userData['phone_number'] = $u->phone_number;
            $userData['gender'] = $u->gender;
            $userData['hobby'][] = $u->hobby;
            $userData['message'] = $u->message;
        }
        $grade = Grade::all();
        if (! empty($userData) || ! empty($grade)) {
            return view('admin.user.edit', ['user' => $userData, 'grades' => $grade]);
        }
        return redirect()->back()->withErrors('Something went wrong');
    }

    public function editUser(Request $request, string $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'grades' => 'required',
            'phone_number' => 'required',
            'gender' => 'required',
            'hobby' => 'required',
            'message' => 'required',
        ]);

        $gradeId = DB::table('grades')->select('id')->where('id', $request->input('grades'))->first();
        $gradeId = $gradeId->id;
        $updateUser = DB::table('users')
                        ->where('id', $id)
                        ->update([
                            'first_name' => $request->input('first_name'),
                            'last_name' => $request->input('last_name'),
                            'gender' => $request->input('gender'),
                            'phone_number' => $request->input('phone_number'),
                            'grade_id' => $gradeId
                        ]);
        $updateHobby = DB::table('hobbies')
                        ->where('user_id', $id)
                        ->delete();
        $hobbies = $request->input('hobby');
        foreach ($hobbies as $value) {
            $hobby = new Hobby();
            $hobby->name = $value;
            $hobby->user_id = $id;
            $hobby->save();
        }
        return redirect()->route('users')->with('Success', 'User updated');
    }

    public function approveUser(string $id)
    {
        DB::table('users')
        ->where('id', '=', $id)
        ->update(array(
            'is_approved' => 1,
        ));

        return redirect()->route('users')->with('sucess', 'User appoved for login to the system.');
    }

    public function userStatus(string $id)
    {
        $userStatus = DB::table('users')
                        ->where('id', '=', $id)
                        ->first('status');

        if (!is_null($userStatus)) {
            if ('active' === $userStatus->status) {
                DB::table('users')
                ->where('id', '=', $id)
                ->update(array(
                    'status' => 'de-active',
                ));
            } else {
                DB::table('users')
                ->where('id', '=', $id)
                ->update(array(
                    'status' => 'active',
                ));
            }
        }

        return redirect()->route('users')->with('sucess', 'User status updated');
    }
}
