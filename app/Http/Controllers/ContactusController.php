<?php

namespace App\Http\Controllers;

use App\Models\Contactus;
use Illuminate\Http\Request;

class ContactusController extends Controller
{
   
   
    public function all_contactus_inbox(){
    	$messages = Contactus::orderBy('id','DESC')->get();
    	return view('dashboard.inbox.all', compact('messages'));


    }


    public function single_contactus_inbox($id){
    	$message = Contactus::find($id);
    	if($message == true){
    		$message->read_status = 1;
    		$message->save();
    		return view('dashboard.inbox.single', compact('message'));
    	}else{
			return view('error');
		}

    }

    public function single_contactus_delete($id){
    	$message = Contactus::find($id);
    	if($message == true){
    		$message->delete();
    		return redirect()->route('backend.admin.all.inbox')->with('success', 'Message has been deleted successfully.' );
    	}else{
    		return redirect()->route('backend.admin.all.inbox')->with('error', 'Message has been deleted successfully.' );			
		}

    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contactus  $contactus
     * @return \Illuminate\Http\Response
     */
    public function show(Contactus $contactus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contactus  $contactus
     * @return \Illuminate\Http\Response
     */
    public function edit(Contactus $contactus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contactus  $contactus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contactus $contactus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contactus  $contactus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contactus $contactus)
    {
        //
    }
}
