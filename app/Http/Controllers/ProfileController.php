<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        // $request->user()->fill($request->validated());

        // if ($request->user()->isDirty('email')) {
        //     $request->user()->email_verified_at = null;
        // }

        // $request->user()->save();
        

            $user = User::where('email', $request->email)->first();
            
            
            // *IMAGE CUTTING AND STORING 
            if($request->hasFile('image')) {
                if($user->image){
                    $replacePath = str_replace('http://127.0.0.1:8000/','',$user->image);
                    if(File::exists($replacePath)){
                        unlink($replacePath);
                    }
                }
                
                $image_extension = $request->image->extension();
                $imageName = 'user-'. uniqid() . '.'. $image_extension;
                $imagePath = $request->image->storeAs('UserImage/', $imageName ,'public');
                $imageURL = env('APP_URL') . 'storage/' . $imagePath;
            }

            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->blood_group = $request->blood_group;
            $user->department_name = $request->department_name;
            $user->email = $request->email;
            if($request->hasFile('image')) {
                $user->image = $imageURL;
            }
            $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}