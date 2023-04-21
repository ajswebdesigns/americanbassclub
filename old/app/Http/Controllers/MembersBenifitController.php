<?php

namespace App\Http\Controllers;

use App\Models\MembersBenifit;
use Illuminate\Http\Request;
use File;
use DB; 

class MembersBenifitController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function membersBenifitsView()
    {
        $benifits = MembersBenifit::orderBy('id', 'DESC')->get();
        return view('dashboard.benifits.home', compact('benifits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function membersBenifitsNew()
    {
        return view('dashboard.benifits.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function membersBenifitsStore(Request $request)
    {
        
        $validated = $request->validate([
            'title' => 'required',
            'image' => 'required',
        ]);

        if ($validated) {
            
            $newBenifit = new MembersBenifit;
            $newBenifit->title = $request->title;
            $newBenifit->website = $request->website;
            $newBenifit->discount_code = $request->discount_code;
            $newBenifit->save();
            
            
            
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $old_file = DB::table('members_benifits')->select('image')->where('id', $newBenifit->id)->first();
                if (File::exists(public_path('benifit_images/' . @$old_file->image))) {
                    File::delete(public_path('benifit_images/' . @$old_file->image));
                }
                $file =  'IM-' . time() . rand(0, 1000) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path() . '/benifit_images', $file);
                DB::table('members_benifits')->where('id', $newBenifit->id)->update([
                    'image' => $file
                ]);
            }
                    return redirect()->back()->with('success', 'Members benifit has been added');

            
        }
        
        return redirect()->back()->with('error', 'Something went wrong');

            
        
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MembersBenifit  $membersBenifit
     * @return \Illuminate\Http\Response
     */
    public function membersBenifitsSingleUpdateView(MembersBenifit $membersBenifit, $id)
    {
        $benifit = MembersBenifit::where('id', $id)->first();
        return view('dashboard.benifits.edit', compact('benifit'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MembersBenifit  $membersBenifit
     * @return \Illuminate\Http\Response
     */
    public function membersBenifitsSingleUpdate(Request $request, MembersBenifit $membersBenifit, $id)
    {


      $validated = $request->validate([
            'title' => 'required',
        ]);

        if ($validated) {
            $newBenifit = MembersBenifit::find($id);
            $newBenifit->title = $request->title;
            $newBenifit->website = $request->website;
            $newBenifit->discount_code = $request->discount_code;
            $newBenifit->save();
            
            
            
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $old_file = DB::table('members_benifits')->select('image')->where('id', $id)->first();
                if (File::exists(public_path('benifit_images/' . @$old_file->image))) {
                    File::delete(public_path('benifit_images/' . @$old_file->image));
                }
                $file =  'IM-' . time() . rand(0, 1000) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path() . '/benifit_images', $file);
                DB::table('members_benifits')->where('id', $id)->update([
                    'image' => $file
                ]);
            }
            
            
            return redirect()->back()->with('success', 'Tournament updated');

            
        }
        return redirect()->back()->with('error', 'Something went wrong');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MembersBenifit  $membersBenifit
     * @return \Illuminate\Http\Response
     */
    public function membersBenifitsSingleDelete(MembersBenifit $membersBenifit, $id)
    {
        $benifit = MembersBenifit::where('id', $id)->delete();
        return redirect()->route('members.benifits')->with('success', 'Successfully Deleted.');
    }
}
