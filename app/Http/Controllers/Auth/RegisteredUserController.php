<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['required'],
            'department_name' => ['required'],
            'blood_group' => ['required'],
            'phone' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

            // *IMAGE CUTTING AND STORING 
            $image_extension = $request->image->extension();
            $imageName = 'user-'. uniqid() . '.'. $image_extension;
            $imagePath = $request->image->storeAs('UserImage/', $imageName ,'public');
            $imageURL = env('APP_URL') . 'storage/' . $imagePath;

        $user = User::create([
            'name' => $request->name,
            'image' => $imageURL,
            'email' => $request->email,
            'department_name' => $request->department_name,
            'blood_group' => $request->blood_group,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}