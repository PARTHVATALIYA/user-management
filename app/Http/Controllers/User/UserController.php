<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Hobby;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function showDashboard()
    {
        return view('user.dashboard');
    }

    public function getProfile(Request $request)
    {
        $userName = '';
        if ($request->session()->has('user')) {
            $userName = $request->session()->get('user');
        }
        $user = DB::table('users as u')
                ->join('grades as g', 'u.grade_id', '=', 'g.id')
                ->join('hobbies as h', 'u.id', '=', 'h.user_id')
                ->where('u.email', '=', $userName)
                ->orWhere('u.user_name', '=', $userName)
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
            $userData['id'] = $u->id;
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
            return view('user.profile', ['user' => $userData, 'grade' => $grade ]);
        }
        return redirect()->back()->withErrors('Something went wrong');
    }

    public function editProfile(Request $request, string $id)
    {
        var_dump($id);
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'gender' => 'required',
            'grades' => 'required',
            'hobby' => 'required',
            'message' => 'required'
        ]);
        $grade_id = DB::table('grades')
                    ->where('name', '=', $request->input('grades'))
                    ->select('id')
                    ->first();
        $user = DB::table('users')
                ->where('id', '=', $id)
                ->update([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'email' => $request->input('email'),
                    'phone_number' => $request->input('phone_number'),
                    'gender' => $request->input('gender'),
                    'message' => $request->input('message'),
                    'grade_id' => $grade_id->id,
                ]);
        $delete_hobby = DB::table('hobbies')
                        ->where('user_id', '=', $id)
                        ->delete();
        $hobbies = $request->input('hobby');
        foreach ($hobbies as $value) {
            $hobby = new Hobby();
            $hobby->name = $value;
            $hobby->user_id = $id;
            $hobby->save();
        }
        return redirect()->route('user.dashboard')->with('success', 'User profile updated');
    }
}
