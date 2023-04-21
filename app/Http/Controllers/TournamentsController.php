<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\TournamentParticipant;
use App\Models\Membership;
use App\Models\Tournament;
use App\Models\User;
use App\Models\Category;

class TournamentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function view()
    {
        $tournaments = Tournament::where('is_deleted', 0)->orderBy('id', 'DESC')->paginate(10);
        return view("dashboard.tournaments.view_tournaments", compact('tournaments'));
    }

    public function MyTournaments()
    {
        $participated = TournamentParticipant::where('user_id', Auth::user()->id)->orWhere('partner_id', Auth::user()->id)->distinct()->get();
        $tournaments = array();

        return view("dashboard.tournaments.myTournaments", compact('participated'));
    }

    public function transactions(){
        $transactions = TournamentParticipant::where([['payment_status', 'COMPLETED'], ['paymentMethod', 'online']])->orderBy('id', 'DESC')->get();
        $membertransactions = Membership::where([['payment_id', '!=','admin_added'], ['member_status','1']])->whereNotNull('membership_end_on')->orderBy('id', 'DESC')->get();

        return view('transactions', compact('transactions','membertransactions'));
    }

    public function cheques(){
        $transactions = TournamentParticipant::where([['payment_id', 'CHEQUE'], ['paymentMethod','cheque']])->orderBy('id', 'DESC')->get();

        return view('cheques', compact('transactions'));
    }

    public function chequesApprove($parti_id){
        $update_data = DB::table('tournament_participants')->where('id', $parti_id)->update([
            'payment_status' => 1,
            'chequeStatus' => 1,
            'payment_time' => date('Y-m-d H:i:s'),
            'tr_data'=>json_encode(['admin_approved'])
        ]);

        return redirect()
                ->back()
                ->with('success', 'Selected Cheque has been approved');

    }

    public function add()
    {
        return view('dashboard.tournaments.add_tournaments');
    }
    public function save(Request $req)
    {
        $validated = $req->validate([
            'tournament_name' => 'required',
            'date' => 'required',
            'image' => 'required',
            'description' => 'required',
            'boat_launch' => 'required',
            'time' => 'required',
            'host_hotels' => 'required',
            'end_date' => 'required',
            'pre_meeting_location' => 'required',
            'payment_due_date' => 'max:255'
        ]);
        if ($validated) {
            $name = $req->input('tournament_name');
            $lake_name = $req->input('lake_name');
            $date = $req->input('date');
            $limit = $req->input('team_limit');
            $descriptin = $req->input('description');
            $boat_launch = $req->input('boat_launch');
            $time = $req->input('time');
            $host_hotels = $req->input('host_hotels');
            $pre_meeting_location = $req->input('pre_meeting_location');
            $free_paid = $req->input('free_paid');
            $tournament_price = $req->input('tournament_price');

            $end_date = $req->input('end_date');
            $end_time = $req->input('end_time');
            $home_visible = $req->input('home_visible');
            $team_limit_type = $req->input('team_limit_type');
            $single_player = $req->input('single_player');
            $payment_deadline = $req->input('payment_due_date');


            if($limit > 400){
                $limit = 400;
            }
            
            if($req->team_limit_type == 1){
                $limit = 9999;
            }

            $latest = DB::table('tournaments')->insertGetId([
                'name' => $name,
                'lake_name' => $lake_name,
                'date' => date('Y-m-d', strtotime($date)),
                'participants_limit' => $limit,
                'description' => $descriptin,
                'time' => $time,
                'host_hotels' => $host_hotels,
                'boat_launch' => $boat_launch,
                'pre_meeting_location' => $pre_meeting_location,
                'end_date' => $end_date,
                'end_time' => $end_time,                
                'home_visible' => $home_visible,                
                'free_paid' => $free_paid,
                'tournament_price' => $tournament_price,
                'team_limit_type'=>$team_limit_type,
                'single_player'=>$single_player,
                'tournament_cat_id' => $req->tournament_cat_id,
                'payment_deadline' => $payment_deadline

                
            ]);
            if ($req->hasFile('image')) {
                $image = $req->file('image');
                $old_file = DB::table('tournaments')->select('image')->where('id', $latest)->first();
                if (File::exists(public_path('tournament_images/' . @$old_file->image))) {
                    File::delete(public_path('tournament_images/' . @$old_file->image));
                }
                $file =  'IM-' . time() . rand(0, 1000) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path() . '/tournament_images', $file);
                DB::table('tournaments')->where('id', $latest)->update([
                    'image' => $file
                ]);
            }
            return redirect()->back()->with('success', 'Tournament added');
        }
        return redirect()->back();
    }
    public function edit($id)
    {
        $tournament = DB::table('tournaments')->where('id', $id)->where('is_deleted', 0)->first();
        if (@$tournament) {
            return view("dashboard.tournaments.edit_tournaments", compact('tournament'));
        }
        return redirect()->back();
    }
    public function update(Request $req, $id)
    {
        if($id != 10){
        $validated = $req->validate([
            'tournament_name' => 'required',
            'date' => 'required',
            'description' => 'required',
            'boat_launch' => 'required',
            'time' => 'required',
            'host_hotels' => 'required',
            'end_date' => 'required',
            'pre_meeting_location' => 'required',
            'payment_due_date' => 'max:255'
        ]);
        }else{
            $validated=true;
        }

        if ($validated) {
            $name = $req->input('tournament_name');
            $lake_name = $req->input('lake_name');
            $date = $req->input('date');
            $limit = $req->input('team_limit');
            $descriptin = $req->input('description');
            $boat_launch = $req->input('boat_launch');
            $time = $req->input('time');
            $host_hotels = $req->input('host_hotels');
            $pre_meeting_location = $req->input('pre_meeting_location');
            $free_paid = $req->input('free_paid');
            $end_date = $req->input('end_date');
            $end_time = $req->input('end_time');
            $home_visible = $req->input('home_visible');
            $team_limit_type = $req->input('team_limit_type');
            $tournament_price = $req->input('tournament_price');
            $single_player = $req->input('single_player');
            $payment_deadline = $req->input('payment_due_date');


            if($limit > 400){
                $limit = 400;
            }
            if($req->team_limit_type == 1){
                $limit = 9999;
            }

            DB::table('tournaments')->where('id', $id)->update([
                'name' => $name,
                'lake_name' => $lake_name,
                'date' => date('Y-m-d', strtotime($date)),
                'participants_limit' => $limit,
                'description' => $descriptin,
                'time' => $time,
                'host_hotels' => $host_hotels,
                'boat_launch' => $boat_launch,
                'pre_meeting_location' => $pre_meeting_location,
                'free_paid' => $free_paid,
                'end_date' => $end_date,
                'end_time' => $end_time,
                'home_visible' => $home_visible,                
                'updated_at' => date('Y-m-d H:i:s'),
                'team_limit_type'=>$team_limit_type,
                'tournament_price' => $tournament_price,
                'single_player' => $single_player,
                'tournament_cat_id' => $req->tournament_cat_id,
                'payment_deadline' => $payment_deadline

                

            ]);
            if ($req->hasFile('image')) {
                $image = $req->file('image');
                $old_file = DB::table('tournaments')->select('image')->where('id', $id)->first();
                if (File::exists(public_path('tournament_images/' . @$old_file->image))) {
                    File::delete(public_path('tournament_images/' . @$old_file->image));
                }
                $file =  'IM-' . time() . rand(0, 1000) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path() . '/tournament_images', $file);
                DB::table('tournaments')->where('id', $id)->update([
                    'image' => $file
                ]);
            }
            return redirect()->back()->with('success', 'Tournament updated');
        }
        return redirect()->back();
    }
    public function delete($id)
    {
        DB::table('tournaments')->where('id', $id)->update([
            'deleted_at' => date('Y-m-d H:i:s'),
            'is_deleted' => 1
        ]);
        return redirect()->bacK()->with('success', 'tournament deleted');
    }
    public function available()
    {
       
        
        $participated = DB::table('tournament_participants')->where('user_id', Auth::user()->id)->orWhere('partner_id', Auth::user()->id)->distinct()->pluck('tournament_id')->toArray();
        $tournaments = array();
        if (count($participated) > 0) {

            $tournaments = Tournament::where([['is_deleted', 0], ['home_visible', 1]])->orderBy('date', 'ASC')->whereNotIn('id', $participated)->get()->filter(function ($item) {
              if (\Carbon\Carbon::now()->between(date('Y-m-d'), $item->end_date) || $item->end_date == '0001-01-01') {
                return $item;
              }
            });

        } else {

            $tournaments = Tournament::where([['is_deleted', 0], ['home_visible', 1]])->orderBy('date', 'ASC')->get()->filter(function ($item) {
              if (\Carbon\Carbon::now()->between(date('Y-m-d'), $item->end_date)  || $item->end_date == '0001-01-01') {
                return $item;
              }
            });
          
            

        }
        return view("dashboard.tournaments.available_tournaments", compact('tournaments'));
    }
    
    
    
    public function available_by_category($getcatid)
    {
   
        
        $participated = DB::table('tournament_participants')->where('user_id', Auth::user()->id)->orWhere('partner_id', Auth::user()->id)->distinct()->pluck('tournament_id')->toArray();
        $tournaments = array();
        if (count($participated) > 0) {

            $tournaments = Tournament::where([['is_deleted', 0], ['home_visible', 1], ['tournament_cat_id', $getcatid]])->orderBy('date', 'ASC')->whereNotIn('id', $participated)->get()->filter(function ($item) {
              if (\Carbon\Carbon::now()->between(date('Y-m-d'), $item->end_date) || $item->end_date == '0001-01-01') {
                return $item;
              }
            });

        } else {

            $tournaments = Tournament::where([['is_deleted', 0], ['home_visible', 1]])->orderBy('date', 'ASC')->get()->filter(function ($item) {
              if (\Carbon\Carbon::now()->between(date('Y-m-d'), $item->end_date)  || $item->end_date == '0001-01-01') {
                return $item;
              }
            });
            

        }
        
        $page = Category::where('cat_slug', $getcatid)->orWhere("cat_id", $getcatid)->first();
        $getcatid = $page->cat_id;
        $catevideo = $page->cat_video_link;        
        return view("dashboard.tournaments.available_tournaments_by_category", compact('tournaments','getcatid', 'catevideo','page'));
    }
    
    public function makeParticipation(Request $req, $id)
    {

//dd($req, $id, Auth::id());
        $tournament = DB::table('tournaments')->where('id', $id)->first();
        if($tournament->free_paid == 'paid'){
            
            if($tournament->single_player == 1){
                $validated = true;
            }else{
                $validated = $req->validate([
                    'team_members_id' => [
                        'required',
                        Rule::exists('users', 'username')->where(function ($query) {
                            $query->where('role', '!=', 'admin');
                            return $query->where('id', '!=', Auth::user()->id);
                        })
                    ],
                ]);
            }
        }else{
            $validated = true;
        }
        

        if($tournament->free_paid == 'paid' && $tournament->single_player == 1){
            $team_members_id = Auth::user();
        }else{
            $team_members_id = User::where('username', $req->input('team_members_id'))->first();
        }

            
        if ($validated) {
            $paymentMethod = $req->paymentMethod;

            $mcheck = Membership::where([['user_id', Auth::id()], ['member_status', 1]])->count();
            if($mcheck == 0 ){
               return redirect()->route('join')->with('error', 'To participate please subscribe to membership plan first.');
            }
            $check1 = DB::table('tournament_participants')
                ->where('tournament_id', $id)
                ->where('user_id', Auth::user()->id)
                ->count();
            $check2 = DB::table('tournament_participants')
                ->where('tournament_id', $id)
                ->where('partner_id', Auth::user()->id)
                ->count();
            $check3 = DB::table('tournaments')->find($id);
            if($check3->free_paid == 'paid' && empty($paymentMethod)){
                return redirect()->back()->with('error', 'Please select a payment method!');
            }

            if ($check1 == 0 && $check2 == 0) {

                $tournament = DB::table('tournaments')->where('id', $id)->first();
                $numberofparticipant = 2;
                if($tournament->single_player == 1){
                    $numberofparticipant = 1;
                }
                if (((@$tournament->participated + $numberofparticipant) <= @$tournament->participants_limit && $tournament->team_limit_type == 0) || $tournament->team_limit_type == 1) {
                    $TournamentParticipant = new TournamentParticipant; 
                        $TournamentParticipant->tournament_id        = $id;
                        $TournamentParticipant->user_id              = Auth::user()->id;
                        
                        if($tournament->free_paid == 'free'){
                            $TournamentParticipant->partner_id           = Auth::user()->id;
                        }else{
                            
                            $TournamentParticipant->partner_id           = $team_members_id->id;
                            $TournamentParticipant->team_name            = $req->input('team_name');
                            $TournamentParticipant->boat_mc              = $req->input('boat_mc');
                            $TournamentParticipant->boat_type            = $req->input('boat_type');
                            $TournamentParticipant->boat_length            = $req->input('boat_length');
                            $TournamentParticipant->trolling_motor_type  = $req->input('trolling_motor_type');
                            $TournamentParticipant->engine_size          = $req->input('engine_size');
                            $TournamentParticipant->engine_type          = $req->input('engine_type');
                            $TournamentParticipant->power_pole           = $req->input('power_pole');
                            $TournamentParticipant->talons               = $req->input('talons');
                            $TournamentParticipant->paymentMethod        = $req->input('paymentMethod');
                            $TournamentParticipant->insurance_company        = $req->input('insurance_company');
                            $TournamentParticipant->insurance_policy_number        = $req->input('insurance_policy_number');
                            
                        }
                        
                    $TournamentParticipant->save();


                  //  dd($TournamentParticipant->id);
             

                    if($paymentMethod == 'cheque'){

                        DB::table('tournament_participants')->where('id', $TournamentParticipant->id)->update([
                            'payment_id' => 'CHEQUE',
                            'payment_status' => '1',
                            'payment_amount' => $tournament->tournament_price,
                            'chequeStatus'=>0
                        ]);
                     
                        DB::table('tournaments')->where('id', $id)->update([
                            'participated' => @$tournament->participated + $numberofparticipant
                        ]);

                        return redirect('/tournaments/my')->with('success', 'Congratulations! Your participation has been confirmed!');
                    }

                    if($tournament->free_paid == 'free'){
                        $update_data = DB::table('tournament_participants')->where('id', $TournamentParticipant->id)->update([
                            'payment_status' => '1',
                            'payment_time' => date('Y-m-d H:i:s'),
                            'payment_id'=>'FREE',
                            'paymentMethod'=>'online',
                            'tr_data'=>json_encode(['free'])
                        ]);
                        
                            DB::table('tournaments')->where('id', $id)->update([
                                'participated' => @$tournament->participated + 2
                            ]);

                        return redirect('/tournaments/my')->with('success', 'Congratulations! Your participation has been confirmed!');
                    }else{
                        return redirect()->route('processTransaction', $TournamentParticipant->id)->with('success', 'You have participated in tournament! To confirm please make the payment first.');
                    }
                } else {
                    return redirect()->back()->with('error', 'Tournament participants limit reached!');
                }
            }
            return redirect('tournaments/my')->with('error', 'You have already participated for event!');
        }
        return redirect('tournaments/participation');
    }
    public function post_results($id)
    {
        $get_captains = DB::table('tournament_participants')->where('tournament_id', $id)->pluck('user_id')->toArray();
        $get_members = DB::table('tournament_participants')->where('tournament_id', $id)->pluck('partner_id')->toArray();
        $users_arr = array_merge($get_captains, $get_members);
        $users_arr = array_values(array_unique($users_arr, SORT_REGULAR));
        $users = DB::table('users as u')
            ->whereIn('u.id', $users_arr)
            ->select('u.*', 't.position as position')
            ->leftJoin('tournament_results as t',  function ($join) use ($id) {
                $join->on('u.id', '=', 't.user_id');
                $join->where('t.tournament_id', '=', $id);
            })
            ->get();
        $tournament = DB::table('tournaments')->where('id', $id)->first();
        return view("dashboard.tournaments.post_results", compact('users', 'tournament'));
    }
    public function save_results(Request $req)
    {
        $tournament = $req->post('tournament');
        $ranks = $req->post('ranks');
        DB::table('tournament_results')->where('tournament_id', $tournament)->delete();
        foreach ($ranks as $rank) {
            $r = explode('|', $rank);
            DB::table('tournament_results')->insert([
                'tournament_id' => $tournament,
                'user_id' => $r[1],
                'position' => $r[0]
            ]);
        }
        return response()->json($ranks);
    }
    public function view_results()
    {
        $results = DB::table('tournament_results as tr')
            ->where('tr.user_id', Auth::user()->id)
            ->select(
                't.name as tournament_name',
                't.date as tournament_date',
                't.participated as participated',
                'u.firstname as firstname',
                'u.lastname as lastname',
                'tr.position as tournament_position'
            )
            ->join('tournaments as t', 'tr.tournament_id', '=', 't.id')
            ->join('users as u', 'tr.user_id', '=', 'u.id')
            ->orderBy('t.date', 'DESC')
            ->paginate(18);
        return view("dashboard.tournaments.view_results", compact('results'));
    }
    public function teams($id)
    {
        $teams = DB::table('tournament_participants as tp')
            ->where([['tp.payment_status', 'COMPLETED'], ['tp.is_deleted', 0], ['tp.tournament_id', $id]])
            ->orWhere([['tp.payment_status', '1'], ['tp.is_deleted', 0], ['tp.tournament_id', $id]])
            ->select(
                'tp.*',
                'u1.email as email1',
                'u2.email as email2',
                'u1.phone_number as phone1',
                'u2.phone_number as phone2',
                'u1.firstname as firstname1',
                'u1.lastname as lastname1',
                'u2.firstname as firstname2',
                'u2.lastname as lastname2',
                't.name as tournament',
                'u1.id as user_id1',
                'u2.id as user_id2'
            )
            ->leftJoin('users as u1', 'tp.user_id', '=', 'u1.id')
            ->leftJoin('users as u2', 'tp.partner_id', '=', 'u2.id')
            ->leftJoin('tournaments as t', 'tp.tournament_id', '=', 't.id')
            ->get();
            

        if (count($teams) > 0) {
            return view("dashboard.tournaments.teams", compact('teams'));
        }
        return \redirect()->back()->with('error', 'No team Participated yet');
    }
    public function teams_export($id)
    {
        $teams = DB::table('tournament_participants as tp')
            ->where('tp.is_deleted', 0)
            ->where('tp.tournament_id', $id)
            ->select(
                'tp.*',
                'u1.email as email1',
                'u2.email as email2',
                'u1.phone_number as phone1',
                'u2.phone_number as phone2',
                'u1.firstname as firstname1',
                'u1.lastname as lastname1',
                'u2.firstname as firstname2',
                'u2.lastname as lastname2',
                't.name as tournament',
                'u1.id as user_id1',
                'u2.id as user_id2'
            )
            ->leftJoin('users as u1', 'tp.user_id', '=', 'u1.id')
            ->leftJoin('users as u2', 'tp.partner_id', '=', 'u2.id')
            ->leftJoin('tournaments as t', 'tp.tournament_id', '=', 't.id')
            ->get();
        if (count($teams) > 0) {
            $fileName = $teams[0]->tournament . '.csv';
            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );

            $columns = array(
                "Tournament",
                "Team Name",
                "Captain's Name",
                "Member's Name",
                "Captain's Email",
                "Member's Email",
                "Captain's Phone",
                "Member's Phone",
                "Boat MC",
                "Trolling Motor Type",
                "Engine Size",
                "Engine Type",
                "Power Pole",
                "Talons"
            );

            $callback = function () use ($teams, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
                foreach ($teams as $team) {
                    $row["Tournament"] = $team->tournament;
                    $row["Team Name"] = $team->team_name;
                    $row["Captain's Name"] = $team->firstname1 . ' ' . $team->lastname1;
                    $row["Member's Name"] = $team->firstname2 . ' ' . $team->lastname2;
                    $row["Captain's Email"] = $team->email1;
                    $row["Member's Email"] = $team->email2;
                    $row["Captain's Phone"] = $team->phone1;
                    $row["Member's Phone"] = $team->phone2;
                    $row["Boat MC"] = $team->boat_mc;
                    $row["Trolling Motor Type"] = $team->trolling_motor_type;
                    $row["Engine Size"] = $team->engine_size;
                    $row["Engine Type"] = $team->engine_type;
                    $row["Power Pole"] = ($team->power_pole == 1 ? 'Yes' : 'No');
                    $row["Talons"] = ($team->talons == 1 ? 'Yes' : 'No');
                    fputcsv($file, array(
                        $row["Tournament"],
                        $row["Team Name"],
                        $row["Captain's Name"],
                        $row["Member's Name"],
                        $row["Captain's Email"],
                        $row["Member's Email"],
                        $row["Captain's Phone"],
                        $row["Member's Phone"],
                        $row["Boat MC"],
                        $row["Trolling Motor Type"],
                        $row["Engine Size"],
                        $row["Engine Type"],
                        $row["Power Pole"],
                        $row["Talons"],
                    ));
                }
                fclose($file);
            };
            return response()->stream($callback, 200, $headers);
        }
        return \redirect()->back()->with('error', 'No team registered yet');
    }
    
    
    
    public function category_view()
    {
        $categories = Category::orderBy('cat_id', 'DESC')->get();
        return view("dashboard.categories.view", compact('categories'));
    }
    
    
    
    
    
    public function category_edit_view($catid)
    {
        $categories = Category::where('cat_id', $catid)->first();
        return view("dashboard.categories.edit_view", compact('categories'));
    }
    
    
    
    public function category_add_view()
    {
        return view("dashboard.categories.category_add");
    }
    
    public function category_add_store(Request $request){
        $category = new Category;
        $category->cat_title = $request->cat_title;
        $category->cat_slug = $request->cat_slug;
        $category->cat_video_link = $request->cat_video_link;
        // New Below
        $category->cat_rules_page = $request->cat_rules_page;
        $category->cat_payouts_page = $request->cat_payouts_page;
        $category->cat_championship_page = $request->cat_championship_page;
        $category->cat_angler_of_the_year = $request->cat_angler_of_the_year;
        // End New 
        $category->cat_published_at = date('Y-m-d H:i:s');
        $category->save();
        
        return redirect('/categories/view')->with('success', 'Category added successfully');
        
    }
    
    public function category_add_update(Request $request, $cat_id){

        $category = Category::where('cat_id', $cat_id)
                    ->update([
                        'cat_title' => $request->cat_title,
                        'cat_slug'  => $request->cat_slug,
                        'cat_video_link'  => $request->cat_video_link,
                        // Test
                        'cat_rules_page' => $request->cat_rules_page,
                        'cat_payouts_page' => $request->cat_payouts_page,
                        'cat_championship_page' => $request->cat_championship_page,
                        'cat_angler_of_the_year' => $request->cat_angler_of_the_year,
                        
                        // End Test
                        'cat_published_at'  => date('Y-m-d H:i:s'),
                       
                        
                    ]);
    
        
        return back()->with('success', 'Category updated successfully');
        
    }
    
    public function category_delete($cat_id){
        $category = Category::where('cat_id', $cat_id)->delete();
        return back()->with('success', 'Category deleted successfully');

    }

    
    
    
    
    
    
    
}
