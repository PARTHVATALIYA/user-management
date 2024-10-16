<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendMailJob;
use App\Mail\ApproveUser;
use App\Mail\RegistrationMail;
use App\Models\Grade;
use App\Models\Hobby;
use App\Models\MailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthenticationController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->userName)
                ->orWhere('user_name', $request->userName)
                ->select('password', 'role')
                ->first();
        $userPassword = $user->password;
        $userRole = $user->role;

        if (Hash::check($request->password, $userPassword)) {
            $request->session()->put('role', $userRole);
            $request->session()->put('user', $request->userName);
            if ($userRole === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Login successfull');
            } else {
                return redirect()->route('user.dashboard')->with('success', 'Login successfull');
            }
        } else {
            return redirect()->route('loginForm')->with('failed', 'User name or password wrong.');
        }
    }

    public function registrationForm()
    {
        $grades = Grade::all();
        return view('auth.registration', compact('grades'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'grade' => 'required',
            'phone_number' => 'required',
            'gender' => 'required',
            'hobby' => 'required|array',
            'password' => 'required',
            'confirm_password' => 'required',
            'message' => 'required',
            'profile_picture' => 'required|image'
        ]);

        $userName = explode('@', $request->email)[0];
        $profilePicture = $request->file('profile_picture');
        $imageName = time();
        $profilePicture->storeAs('public/uploads', $imageName);

        $hashPassword = Hash::make($request->password);
        $grade = Grade::firstOrCreate(['name' => $request->grade]);
        $gradeId = $grade->id;

        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->gender = $request->input('gender');
        $user->password = $hashPassword;
        $user->message = $request->input('message');
        $user->grade_id = $gradeId;
        $user->profile_picture = $imageName;
        $user->user_name = $userName;

        $user->save();

        $user_id = User::where('email', $request->email)->value('id');
        $hobbies = $request->hobby;
        foreach ($hobbies as $hobbyValue) {
            $hobby = new Hobby();
            $hobby->name = $hobbyValue;
            $hobby->user_id = $user_id;
            $hobby->save();
        }

        $verificationToken = bin2hex(random_bytes(20));
        $mailVerification = new MailVerification();
        $mailVerification->token = $verificationToken;
        $mailVerification->user_id = $user_id;
        $mailVerification->save();
        $mailData = array(
            'userName' => $request->input('first_name') . ' ' . $request->input('last_name'),
            'url' => route('user.verified', $verificationToken)
        );

        SendMailJob::dispatch($mailData, $request->input('email'), 'registration')->afterResponse();
        return redirect()
                ->route('loginForm')
                ->with('success', 'User register successfully. Please verify your mail for login.');
    }

    public function logout()
    {
        session()->forget('role');
        session()->forget('user');
        return redirect('/');
    }

    public function mailVerfication(string $token)
    {
        $verificationData = DB::table('mail_verifications')
                            ->select(array('id', 'user_id'))
                            ->where('token', '=', $token)
                            ->first();

        if (! is_null($verificationData)) {
            DB::table('mail_verifications')
            ->delete($verificationData->id);

            DB::table('users')
            ->where('id', '=', $verificationData->user_id)
            ->update(array(
                'is_verified' => 1,
            ));
            $user = DB::table('users')
                    ->where('id', '=', $verificationData->user_id)
                    ->first(array('first_name', 'last_name', 'email'));
            $adminMailData = array(
                'userName' => $user->first_name . ' ' . $user->last_name,
                'email' => $user->email,
                'url' => route('users'),
            );

            SendMailJob::dispatch( $adminMailData, 'admin@usermanagement.com', 'userApprove');
            // Mail::to('admin@usermanagement.com')->send(new ApproveUser($adminMailData));
        }

        return redirect()
                ->route('loginForm')
                ->with('success', 'Your email verification done successfully. After admin approval you will be login.');
    }
}
