<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    // profile edit page
    public function editProfilePage(){
        return view('admin.profile.edit');
    }

    // profile edit
    public function editProfile(Request $request){

        $this->checkProfileValidation($request);
        $profileData = $this->getProfileData($request);

        if( $request->hasFile('image') ){

            if(Auth::user()->profile_image != null){
                if(file_exists( public_path('/profileImages/'.Auth::user()->profile_image) )){
                    unlink(public_path('/profileImages/'.Auth::user()->profile_image));
                }
            }

            $imgName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('/profileImages/'),$imgName);
            $profileData['profile_image'] = $imgName;

        }

        User::where('id',Auth::user()->id)->update($profileData);
        Alert::success('Success Title', 'Profile Updated Successfully!');
        return back();
    }

    // change password page
    public function changePasswordPage(){
        return view('admin.profile.changePassword');
    }

    // change password
    public function changePassword(Request $request){
        if(Hash::check($request->oldPassword, Auth::user()->password)){

            $this->checkPasswordValidation($request);

            User::where('id',Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword)
            ]);

            return to_route('dashboard');

        }else{
            Alert::error('Incorrect Password', 'It does not match with our records. Please try again!');
            return back();
        }
    }

    // get profile data
    public function getProfileData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ];
    }

    // check profile validation
    public function checkProfileValidation($request){
        $request->validate([
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:users,email,'.Auth::user()->id,
        ]);
    }

    // check password validatiion
    public function checkPasswordValidation($request){
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8',
            'confirmPassword' => 'required|same:newPassword',
        ]);
    }
}
