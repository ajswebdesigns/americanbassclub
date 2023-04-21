<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use App\Models\Membership;
use App\Models\Contactus;
use App\Models\User;
use App\Mail\ContactUsAdminMail;
use App\Mail\SendEmailToAllUser;

use App\Mail\EmailAllUser;
use Mail;
use ANet\Traits\ANetPayments;
  use net\authorize\api\contract\v1 as AnetAPI;
  use net\authorize\api\controller as AnetController;
use File;
use App\Models\Category;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['contactUsForm', 'contactUsFormPost', 'searchnamebyid', 'sitemap', 'categoryitem']);
    }
    
    public function page_management($page_slug){
        $page = DB::table('page_manager')->where('page_slug', $page_slug)->first();
        return view('dashboard/page-manager/edit', compact('page'));
    }
    
    
    public function categoryitem($slug){
        $page = Category::where('cat_slug', $slug)->orWhere("cat_id", $slug)->first();
        $getcatid = $page->cat_id;
        $catevideo = $page->cat_video_link;
        return view('categorybasedlisting', compact('getcatid', 'catevideo','page'));
    }
    
    public function page_management_post(Request $request, $slug){
        

            
        DB::table('page_manager')
              ->where('page_slug', $slug)
              ->update(['page_details' => $request->page_details]);
              
              if($slug == 'rules'){
               User::where('agreement', 1)
                  ->update(['agreement' => 0]);
                  
                  
                $emails = User::select('email')
                    ->pluck('email')->toArray();
                    
                if($emails){
                    $content = new \stdClass();
                    $content->loginurl = url('/login');
                    foreach ($emails as $recipient) {
                        Mail::to($recipient)->send(new EmailAllUser($content));
                    }          
                }

                 
              }
             return back()->with('success', 'Page details has been updated successfully');
    }
    
    
    
    public function post_outbox(Request $request){
        

            
                $emails = User::select('email')
                    ->pluck('email')->toArray();
                    
                if($emails){
                    $content = new \stdClass();
                    $content->subject = $request->subject;
                    $content->message = $request->message;
                    foreach ($emails as $recipient) {
                        Mail::to($recipient)->send(new SendEmailToAllUser($content));
                    }          
                }

             return back()->with('success', 'Email sent to all users');
    }
    
    public function view_outbox() {
        return view('dashboard/inbox/send_to_all');
    }
    
    public function authorizenetpost(Request $request){
        $user = Auth::user();
        
        
        $customerprofile_get = $user->anet()->getCustomerProfileId();
        $customerprofileID = 0;
        if($customerprofile_get == NULL){
            $createCusotmer = $user->anet()->createCustomerProfile();
            $customerprofileID = $createCusotmer->getCustomerProfileId();
        }else{
            $customerprofileID = $user->anet()->getCustomerProfileId();
        }
        
    
    
        
        $cardType = (substr($request->cardNumber, 0, 1));
        
        if($cardType == 4){
            $cardType = 'VISA';
        }elseif($cardType == 5){
            $cardType = "MASTER";
        }elseif($cardType== 3){
            $cardType = 'AMEX';
        }else{
            $cardType = 'VISA';
        }
        
        
        $data = $user->anet()->createPaymentProfile([
            'dataValue' => $request->opaqueDataValue,
            'dataDescriptor' => $request->opaqueDataDescriptor
        ], [
            'type'   => 'card',
            'last_4'=> substr($request->cardNumber, -4),
            'brand'=> $cardType
        ]);
        
        $paymentCards = $user->anet()->getPaymentCardProfiles();
        dd($customerprofileID, $paymentCards);


//$data = $user->anet()->charge(1200, '905975216'); // $12
$response = $user->anet()->subs()->get(8307346);
        dd($response);

$response = $user->anet()->subs()->create([
    'name'  => 'Sample Subscription',
    'startDate' => '2022-08-26',
    'totalOccurrences' => 12,
    'trialOccurrences' => 1,
    'intervalLength' => 365,
    'intervalLengthUnit' => 'days',
    'amountInDollars' => 10, // $10
    'trialAmountInDollars' => 0, // $0
    'cardNumber' => 4111111111111111,
    'cardExpiry' => '2028-12',
    'invoiceNumber' => 76,
    'subscriptionDescription' => 'Some services will be provided some how.',
    'customerFirstName' => 'john h',
    'customerLastName' => 'doe'
]);


    }
    
    public function authorizenet(){
        
        
        return view('authorize');
        $user = Auth::user();
        //$da = $user->anet()->createCustomerProfile();
        $da = $user->anet()->getCustomerProfileId();
        $da = $user->anet()->getPaymentProfiles();


       // dd($da);
         $response = $user
            ->anet()
            ->card()
            ->setNumbers(4111111111111111)
            ->setCVV(111)
            ->setNameOnCard('John Doe')
            ->setExpMonth(4)
            ->setExpYear(42)
            ->setAmountInCents(1000) // $10
            ->charge();
            
            dd($response);
        
        
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

public function getSubscriptionStatus($subscriptionId)
{
    /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName('5q8T7yeS4E');
    $merchantAuthentication->setTransactionKey('2Wx477M7yY7bwUMM');
    
    // Set the transaction's refId
    $refId = 'ref' . time();

    $request = new AnetAPI\ARBGetSubscriptionStatusRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setSubscriptionId($subscriptionId);

    $controller = new AnetController\ARBGetSubscriptionStatusController($request);

    $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);

    if (($response != null) && ($response->getMessages()->getResultCode() == "Ok"))
    {
        echo "SUCCESS: Subscription Status : " . $response->getStatus() . "\n";
     }
    else
    {
        echo "ERROR :  Invalid response\n";
        $errorMessages = $response->getMessages()->getMessage();
        echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
    }

    return $response;
  }
  
public   function getSubscription($subscriptionId)
  {
    /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName('5q8T7yeS4E');
    $merchantAuthentication->setTransactionKey('2Wx477M7yY7bwUMM');
    
    
    // Set the transaction's refId
    $refId = 'ref' . time();
		
    // Creating the API Request with required parameters
    $request = new AnetAPI\ARBGetSubscriptionRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setSubscriptionId($subscriptionId);
    $request->setIncludeTransactions(true);
	    
    // Controller
    $controller = new AnetController\ARBGetSubscriptionController($request);
		
    // Getting the response
    $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);
		
    if ($response != null) 
    {
        if($response->getMessages()->getResultCode() == "Ok")
        {
        	// Success
        	echo "SUCCESS: GetSubscription:" . "\n";
        	// Displaying the details
        	echo "Subscription Name: " . $response->getSubscription()->getName(). "\n";
        	echo "Subscription amount: " . $response->getSubscription()->getAmount(). "\n";
        	echo "Subscription status: " . $response->getSubscription()->getStatus(). "\n";
        	echo "Subscription Description: " . $response->getSubscription()->getProfile()->getDescription(). "\n";
        	echo "Customer Profile ID: " .  $response->getSubscription()->getProfile()->getCustomerProfileId() . "\n";
        	echo "Customer payment Profile ID: ". $response->getSubscription()->getProfile()->getPaymentProfile()->getCustomerPaymentProfileId() . "\n";
                $transactions = $response->getSubscription()->getArbTransactions();
                if($transactions != null){
			foreach ($transactions as $transaction) {
                    		echo "Transaction ID : ".$transaction->getTransId()." -- ".$transaction->getResponse()." -- Pay Number : ".$transaction->getPayNum()."\n";
                	}
		}
        }
        else
        {
        	// Error
        	echo "ERROR :  Invalid response\n";	
        	$errorMessages = $response->getMessages()->getMessage();
          echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
        }
	  }
    else
    {
        // Failed to get response
        echo "Null Response Error";
    }

    return $response;
	}


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::User();
       // $response = $user->anet()->subs()->getStatus(57831581);
      //  $response = $this->getSubscriptionStatus('57831581');

      //  dd($response);

        
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
