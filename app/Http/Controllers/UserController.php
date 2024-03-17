<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\View\View;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'image' => 'required|file|mimes:jpg,png,jpeg,gif',
            'password' => [
                'required','confirmed',
                \Illuminate\Validation\Rules\Password::min(6)
                    ->numbers()
                    ->letters()
                    ->mixedCase()
                    ->symbols()
            ]
        ]);
        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->profile = $validated['image'];
        $user->password = Hash::make($validated['password']);
        $user->email_verification_token = Str::random(64);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = "users";
            // $fileName = time().$file->getClientOriginalName();
            $file->store($path);

            $url = $path . '/' . $file->hashName();
            $user->profile = $url;
        }
        $user->save();

        // event(new Registered($user));

        $user_id = $user->id;
        $email_verification_token = $user->email_verification_token;
        // $url = route('verification.verify',[$user_id,$email_verification_token]);
        Mail::send('verification.email', ['user_id' => $user_id, 'email_verification_token' => $email_verification_token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Email Verification');
        });
        //return redirect("/products")   
        // View::make('verification.email',compact('user_id','email_verification_token'));
        // return view('verification.show', compact('user_id'));
        return back()->with([
            'success' => 'Verification link sent to your email , verify it and log in !',
        ]);
        // return (new MailMessage)
        //     ->subject('Verify Email Address')
        //     ->line('Click the button given below to verity your email address !')
        //     ->action('Verity Email Address',$url);
    }

    public function check(Request $request)
    {
        $check = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        dd($check);
        if (Auth::attempt($check)) {
            $user = Auth::user();
            $verified = $user->email_verified;
            if ($verified == 1) {
                // dd($verified);
                if ($user->role == 'admin') {
                    // dd($user->role);
                    return redirect()->route('admin.index');
                }
                // dd($user->role);
                return redirect()->route('products.index');
            }
            // dd('unverified');
            return redirect('/login')->with('error', 'Registered but unverified email, verify and try again !',);
        }
        return back()->withErrors([
            'email' => 'Incorrect Email or Password !',
        ])->withInput($request->all());
    }

    public function show()
    {
        $user = User::where('email', Auth::user()->email)->first();
        $id = $user->id;
        return view('users.show', compact('id'));
    }

    public function logout()
    {
        Auth::logout();
        // return redirect()->back();
        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($user->email == $request->email) {
            $validated = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'profile' => 'required|mimes:jpg,jpeg,png,gif',
            ]);
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->profile = $validated['profile'];

            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $path = "users";
                // $fileName = time() . '_' . $file->getClientOriginalName();
                $file->store($path);
                $url = $path . '/' . $file->hashName();

                $user->profile = $url;
            }
            $user->update();
            return redirect()->route('users.show')->with('success', 'Profile Updated Successfully !');
        } else {
            $validated = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'profile' => 'required|mimes:jpg,jpeg,png,gif',
            ]);
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->profile = $validated['profile'];

            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $path = "users";
                // $fileName = time() . '_' . $file->getClientOriginalName();
                $file->store($path);
                $url = $path . '/' . $file->hashName();

                $user->profile = $url;
            }
            $user->update();
            return redirect()->route('users.show')->with('success', 'Profile Updated Successfully !');
        }
    }

    public function changePassword()
    {
        return view('users.changePassword');
    }

    public function updatePassword(Request $request, $id)
    {
        $validated = $request->validate([
            'oldPassword' => 'required',
            'newPassword' => [
                'required','confirmed',
                \Illuminate\Validation\Rules\Password::min(6)
                    ->numbers()
                    ->letters()
                    ->mixedCase()
                    ->symbols()

            ],
        ]);
        $user = User::where('id', $id)->first();
        if (!Hash::check($validated['oldPassword'], Auth::user()->password)) {
            return back()->withErrors(["oldPassword" => "Old Password Doesn't match!"])->withInput($request->input());
        }
        $user->password = Hash::make($validated['newPassword']);
        $user->update();
        return redirect()->route('users.show')->with("success", "Password changed successfully!");
    }
    public function cancel()
    {
        return redirect()->route('users.show');
    }

    public function forgot_password()
    {
        return view('users.forgot_password');
    }

    public function check_email(Request $request)
    {
        $email = $request->email;
        $validate = Validator::make(
            $request->all(),
            ['email' => 'required|email|exists:users'],
            [
                'email.exists' => 'This email is not registered !',
                'email.required' => 'Please enter your email address !',
                'email.email' => 'Please enter a valid email address !',
            ],
        );
        if ($validate->fails()) {
            return back()->withInput($request->input())->withErrors($validate);
        }
        $token = random_int(100000, 999999);
        $forgot_pass = new PasswordReset();
        $forgot_pass->email = $request->email;
        $forgot_pass->token = $token;

        $userExist = PasswordReset::where('email', $request->email)->where('token', '!=', null)->first();
        if ($userExist) {
            $userExist->update([
                'token' => $token,
            ]);
            Mail::send('verification.reset_pass', ['email' => $request->email, 'token' => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Password Reset');
            });
            return redirect()->route('users.enter-token')->with('email',$request->email);
        }
        $forgot_pass->save();

        Mail::send('verification.reset_pass', ['email' => $request->email, 'token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Password Reset');
        });

        return redirect()->route('users.enter-token')->with('email',$request->email);
    }

    public function enter_token()
    {
        $email=Session::get('email');
        return view('users.check_token',compact('email'));
    }
    public function check_token(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'email' => 'required|exists:users',
                'token' => 'required|numeric',
            ],
            [
                'email.required' => 'Please enter your email !',
                'token.required' => 'Please enter the token !',
            ],
        );
        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate)->withInput($request->input());
        }
        $emailExist = PasswordReset::where('email', $request->email)->where('token', $request->token)->first();
        if (!$emailExist) {
            return Redirect::back()->withErrors(['token'=>'Token didn\'t match, Please enter correct token'])->withInput($request->input());
        }
        return Redirect::route('users.enter-password')->with('email',$request->email);
    }

    public function enter_password()
    {
        $email=Session::get('email');
        return view('users.reset_password',compact('email'));
    }

    public function reset_password(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'email' => 'required|exists:users',
            'password' => [
                'required',
                \Illuminate\Validation\Rules\Password::min(6)
                    ->numbers()
                    ->letters()
                    ->mixedCase()
                    ->symbols()

            ],
            'confirm_password' => 'required|same:password',
        ]);
        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate)->withInput($request->input());
        }

        $reset_pass = PasswordReset::where('email', $request->email)->where('token', '!=', null)->first();
        if (!$reset_pass) {
            return Redirect::back()->with('error','Password Already Reseted !');
        }
        $user = User::where('email', '=', $request->email)->first();
        $user->password = $request->password;
        $user->update();
        $reset_pass->token = null;
        $reset_pass->update();
        return Redirect::route('users.index')->with('success','Your Password Reseted Successfully, Please Try Logging In');
    }
}
