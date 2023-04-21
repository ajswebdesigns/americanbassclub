<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use App\Models\Membership;
use App\Models\Contactus;
use App\Models\User;
use App\Mail\ContactUsAdminMail;
use Mail;

use File;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['contactUsForm', 'contactUsFormPost', 'searchnamebyid', 'sitemap']);
    }
    
    
    
    
    public function page_management($page_slug){
        $page = DB::table('page_manager')->where('page_slug', $page_slug)->first();
        return view('dashboard/page-manager/edit', compact('page'));
    }
    
    public function page_management_post(Request $request, $slug){
        DB::table('page_manager')
              ->where('page_slug', $slug)
              ->update(['page_details' => $request->page_details]);
              
             return back()->with('success', 'Page details has been updated successfully');
    }
    
    public function sitemap() {
        return response()->view('sitemap')->header('Content-Type', 'text/xml');
      }
      
    public function searchnamebyid(Request $request){
        
       // return $request->team_members_id;
        if(User::where('username',$request->team_members_id)->exists()){
            $user = User::where('username',$request->team_members_id)->first();
            return '<span class="text-success"><b>Partner Name:</b> '.$user->firstname. ' ' .$user->lastname.'</span>';
        }else{
            return '<span class="text-danger">No data found</span>';
        }

    }

    public function contactUsForm(){
        return view('frontend.contact');
    }


    public function contactUsFormPost(Request $request){
      $validator = \Validator::make($request->all() , [
          'name' => 'required|max:255',
          'email' => 'required|email|max:255',
          'message' => 'required',
      ]);

      if($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        } else {
            // create our user data for the authentication

            $contact = new Contactus;
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->message = $request->message;
            $contact->ip_address = $request->ip();
            $contact->save();
            // attempt to do the login
            if ($contact) {

                $content = new \stdClass();
                $content->name = $request->name;
                $content->email = $request->email;
                $content->message = $request->message;
          
                Mail::to("info@americanbassclub.com")->send(new ContactUsAdminMail($content));

                return response()->json(['success' => true, 'errors' => ['Your message is sent successfully.']]);

            } else {
                return response()->json(['success' => false, 'errors' => ['Something went wrong, please refresh and try again.']]);
            }
        }


    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == 'member') {
            if (Auth::user()->is_subscribed == 1) {
                $memberCheck = Membership::where([['user_id', Auth::user()->id], ['member_status', 1]])->count();
                if($memberCheck == true && $memberCheck > 0 ){
                    return view('home');
                }else{
                    return view('join');
                }

            }else{
                return view('join');
            }
        } else {
            return view('home');
        }
    }
    public function headerSettings()
    {
        $carousels = DB::table('headers')->where('is_deleted', 0)->orderBy('id', 'DESC')->paginate(20);
        return view("dashboard.settings.carousels", compact('carousels'));
    }
    public function saveHeader(Request $req)
    {
        $validated = $req->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        if ($validated) {
            DB::table('headers')->insert([
                'name' => $req->input('title'),
                'description' => $req->input('description')
            ]);
            return redirect()->back()->with('success', 'New Header Added');
        }
        return redirect()->back();
    }
    public function deleteHeader($id)
    {
        DB::table('headers')->where('id', $id)->update([
            'deleted_at' => date('Y-m-d H:i:s'),
            'is_deleted' => 1
        ]);
        return \redirect()->back()->with('success', 'Header deleted');
    }
    public function sponserCarousel()
    {
        $carousels = DB::table('sponsers')->where('is_deleted', 0)->orderBy('id', 'DESC')->paginate(9);
        return view("dashboard.settings.sponsers", compact('carousels'));
    }
    public function sponser_save(Request $req)
    {
        $validated = $req->validate([
            'image' => 'required'
        ]);
        if ($validated) {
            if ($req->hasFile('image')) {
                $image = $req->file('image');
                $file =  'SP-' . time() . rand(0, 1000) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path() . '/sponser_images', $file);
                DB::table('sponsers')->insert([
                    'image' => $file
                ]);
                return redirect()->back()->with('success', 'Sponser added');
            }
        }
        return redirect()->back();
    }
    public function sponser_delete($id)
    {
        DB::table('sponsers')->where('id', $id)->update([
            'deleted_at' => date('Y-m-d H:i:s'),
            'is_deleted' => 1
        ]);
        $old_file = DB::table('sponsers')->select('image')->where('id', $id)->first();
        if (File::exists(public_path('sponser_images/' . @$old_file->image))) {
            File::delete(public_path('sponser_images/' . @$old_file->image));
        }
        return \redirect()->back()->with('success', 'Sponser deleted');
    }
}
