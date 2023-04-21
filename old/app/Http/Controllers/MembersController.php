<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Membership;


class MembersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function view()
    {
        $members = User::where('role', '!=', 'admin')->orderBy('id', 'DESC')->paginate(20);
        return view("dashboard.members.view_members", compact('members'));
    }
    public function add()
    {
        return view("dashboard.members.add_members");
    }
    public function save(Request $req)
    {
        $validated = $req->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => 'required | email | unique:users',
            'password' =>
            [
                'required',
                'min:6',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                //'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit

            ],
            'confirm_password' => 'required | same:password',
            'street_address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'zip_code' => ['required'],
            'phone_number' => ['required'],
            'dob' => ['required'],
            'social_security_number' => ['required'],
            't_shirt_size' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'veteran' => ['required'],
            
            
        ]);
        if ($validated) {
            $firstname = $req->input('firstname');
            $lastname = $req->input('lastname');
            $email = $req->input('email');
            $password = $req->input('password');
            $street_address = $req->input('street_address');
            $city = $req->input('city');
            $state = $req->input('state');
            $country = $req->input('country');
            $zip_code = $req->input('zip_code');
            $phone_number = $req->input('phone_number');
            $dob = $req->input('dob');
            $social_security_number = $req->input('social_security_number');
            $t_shirt_size = $req->input('t_shirt_size');
            $veteran = $req->input('veteran');
            $gender = $req->input('gender');
            
            DB::table('users')->insert([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'password' => Hash::make($password),
                'street_address' => $street_address,
                'city' => $city,
                'state' => $state,
                'zip_code' => $zip_code,
                'country' => $country,
                'phone_number' => $phone_number,
                'dob' => $dob,
                'social_security_number' => $social_security_number,
                't_shirt_size' => $t_shirt_size,
                'gender' => $gender,
                'veteran' => $veteran
            ]);
            
            return \redirect()->back()->with('success', 'Members Registered!');
        }
        return redirect()->back();
    }
    public function edit($id)
    {
        if (Auth::user()->role == 'admin') {
            $member = DB::table('users')->where('id', $id)->first();
            if (@$member) {
                return view("dashboard.members.edit_members", compact('member'));
            }
        } else {
            if (Auth::user()->id == $id) {
                $member = DB::table('users')->where('id', $id)->where('role', '!=', 'admin')->first();
                if (@$member) {
                    return view("dashboard.members.edit_members", compact('member'));
                }
            }
            return redirect()->back();
        }
        return redirect()->back();
    }
    public function update(Request $req, $id)
    {
        $validated = $req->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($id)
            ],
            'street_address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'zip_code' => ['required'],
            'phone_number' => ['required'],
            'dob' => ['required'],
            'social_security_number' => ['required'],
            't_shirt_size' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'veteran' => ['required'],
            
        ]);
        if ($validated) {
            $firstname = $req->input('firstname');
            $lastname = $req->input('lastname');
            $email = $req->input('email');
            $street_address = $req->input('street_address');
            $city = $req->input('city');
            $state = $req->input('state');
            $country = $req->input('country');
            $zip_code = $req->input('zip_code');
            $phone_number = $req->input('phone_number');
            $dob = $req->input('dob');
            $social_security_number = $req->input('social_security_number');
            $t_shirt_size = $req->input('t_shirt_size');
            $gender = $req->input('gender');
            $veteran = $req->input('veteran');
            
            DB::table('users')->where('id', $id)->update([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'street_address' => $street_address,
                'city' => $city,
                'state' => $state,
                'zip_code' => $zip_code,
                'country' => $country,
                'phone_number' => $phone_number,
                'dob' => $dob,
                'social_security_number' => $social_security_number,
                't_shirt_size' => $t_shirt_size,
                'gender' => $gender,
                'veteran' => $veteran
            ]);
            return \redirect()->back()->with('success', 'Member Updated!');
        }
        return redirect()->back();
    }
    public function changePassword(Request $req, $id)
    {
        $validated = $req->validate([
            'password' =>
            [
                'required',
                'min:6',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                //'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit

            ],
            'confirm_password' => 'required | same:password'
        ]);
        if ($validated) {
            DB::table('users')->where('id', $id)->update([
                'password' => Hash::make($req->input('password'))
            ]);
            return redirect()->back()->with('success', 'Password Updated!');
        }
        return \redirect()->back();
    }
    public function delete($id)
    {
        if (Auth::user()->role == 'admin') {
            DB::table('users')->where('id', $id)->where('role', '!=', 'admin')->delete();
            return \redirect()->back()->with('success', 'Member Deleted Permanently');
        }
        return redirect()->back();
    }
    


    public function membership_status_change($member_id){
        if (Auth::user()->role == 'admin') {
            $user = User::find($member_id);
            $membership = Membership::where('user_id', $member_id);
            if($membership->count() == 0){
                
                $membershipInsert = new Membership;
                $membershipInsert->user_id = $user->id;
                $membershipInsert->payment_id = 'admin_added';
                $membershipInsert->membership_started_on = date('Y-m-d H:i:s');
                $membershipInsert->member_status = 1;
                $membershipInsert->save();                
                
                return \redirect()->back()->with('success', 'Member Status Changed Successfully');

            }else{
                //if(!empty($membership->payment_id) && $membership->payment_id!='admin_added'){
                    $mem_st_chk = $membership->orderBy('id', 'DESC')->first()->member_status;
                    if($mem_st_chk == 1){
                        $mem_st_chk = 2;
                    }else{
                        $mem_st_chk = 1;
                    }
                    Membership::where('user_id', $member_id)
                      ->update(['member_status' => $mem_st_chk]);
                //}else{
                    
               // }
             return \redirect()->back()->with('success', 'Member Status Changed Successfully');

            }
            return \redirect()->back()->with('success', 'Member Status Changed Successfully');
        }
        return redirect()->back()->with('error', 'Something went wrong!');
    }  
    
    public function document_sign()
    {
        return view("signature");
    }
    public function document_save(Request $req)
    {
        $imgData = base64_decode($req->post('imageData'));
        $image_name = 'Signature-' . time() . rand(0, 1000);

        // Path where the image is going to be saved
        $filePath = public_path('signatures/' .  $image_name . '.jpg');

        // Delete previously uploaded image
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Write $imgData into the image file
        $file = fopen($filePath, 'w');
        fwrite($file, $imgData);
        fclose($file);
        DB::table('signatures')->insert([
            'user_id' => Auth::user()->id,
            'image' => $image_name . '.jpg'
        ]);
        DB::table('users')->where('id', Auth::user()->id)->update([
            'agreement' => 1
        ]);
        return response()->json($req);
    }
    public function view_details($id)
    {
        $member = User::where('id', $id)->first();
        if(@$member){
            return view("dashboard.members.view_details", compact('member'));
        }
        return \redirect()->back()->with('error', "User doesn't exist!");
    }
}
