<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Models\Pages;

class PageController extends Controller
{
   
    
    public function getSinglePage (Pages $page){
        return view('single-page', ['page' => $page]);
    }
    
    public function view()
    {
        
        $pages = Pages::orderBy('id', 'DESC')->get();
        return view('dashboard.pages.view',compact('pages'));
        
    }
    
    // Add View
     public function page_add_view()
    {
        return view("dashboard.pages.page_add");
    }
 
//  Add
  public function page_add_store(Request $request){
        $page = new Pages;
        $page->page_name = $request->page_name;
        $page->page_slug = $request->page_slug;
        $page->page_content = $request->page_content;
        $page->page_name_alignment = $request->page_name_alignment;
        $page->save();
        return redirect('/pages/view')->with('success', 'Page added successfully');
        
    }
    
    // Edit
      public function page_edit_view($id)
    {
        $page = Pages::where('id', $id)->first();
        return view("dashboard.pages.edit_view", compact('page'));
    }
    // Update
      public function page_add_update(Request $request, $id){

        $page = Pages::where('id', $id)
                    ->update([
                        'page_name' => $request->page_name,
                        'page_name_alignment' => $request->page_name_alignment,
                        'page_slug'  => $request->page_slug,
                        'page_content' => $request->page_content,
                    ]);
        return redirect('/pages/view')->with('success', 'Page Updated successfully');
        
    }
    
  
    
}
