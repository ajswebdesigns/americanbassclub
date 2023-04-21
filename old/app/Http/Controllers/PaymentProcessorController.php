<?php

namespace App\Http\Controllers;

use App\Models\PaymentProcessor;
use App\Models\TournamentParticipant;
use App\Models\Membership;

use Illuminate\Http\Request;

use Srmklive\PayPal\Services\PayPal as PayPalClient; 
use Auth;
use DB;
use App\Mail\MailOnJoin;
use App\Mail\MailOnParticipant;
use App\Mail\MailOnParticipantPartner;

use Mail;
class PaymentProcessorController extends Controller
{




    public function createTransaction()
    {
        return view('transaction');
    }

    public function cancelSubscription($subscription_id)
    {
        
        $membership = Membership::where([['user_id', Auth::user()->id], ['payment_id', $subscription_id], ['member_status', 1]])->first();

        if($membership){
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();

            $response = $provider->cancelSubscription($subscription_id, 'Cancelling');
            
            $membership = Membership::where('payment_id', $subscription_id)->first();
            $membership->member_status = 2;
            $membership->save();

            return back()->with('success', 'You have successfully cancelled your membership.');


        }



    }

    public function processSubscription(Request $request){

        $user = Auth::user();
        $validated = $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'emergency_contact_name' => ['required', 'string', 'max:255'],
            'emergency_contact_number' => ['required', 'string', 'max:255'],
            'email' => ['required'],
            'street_address' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'zip_code' => ['required'],

        ]);


        if ($validated) {
            $firstname = $request->input('firstname');
            $lastname = $request->input('lastname');
            $emergency_contact_name = $request->input('emergency_contact_name');
            $emergency_contact_number = $request->input('emergency_contact_number');
            $email = $request->input('email');
            $street_address = $request->input('street_address');
            $city = $request->input('city');
            $state = $request->input('state');
            $country = $request->input('country');
            $zip_code = $request->input('zip_code');
            DB::table('users')->where('id', $user->id)->update([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'emergency_contact_name' => $emergency_contact_name,
                'emergency_contact_number' => $emergency_contact_number,
                'email' => $email,
                'street_address' => $street_address,
                'state' => $state,
                'zip_code' => $zip_code,
                'country' => $country,
            ]);



            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();



/*

sandbox:

     "id" => "P-22N97538KT607500AMJ2BWDA"
      "product_id" => "PROD-10P70220BY774661C"
      "name" => "Yearly Membership Plan"
      "status" => "ACTIVE"
      "description" => "Yearly Membership Plan"
      
      Live 
      
      "id" => "P-2G9805324B910512VMJ2BXXQ"
      "product_id" => "PROD-0GW00334XG887733R"
      "name" => "Yearly Membership Plan"
      "status" => "ACTIVE"
      "description" => "Yearly Membership Plan"
      "usage_type" => "LICENSED"
      "create_time" => "2022-05-05T18:47:58Z"
      
      
      $1 live
      
      
      "id" => "P-8HJ39066M50340243MJ2B2TY"
      "product_id" => "PROD-4TW56953WX6324922"
      "name" => "Yearly Membership Plan"
      "status" => "ACTIVE"
      "description" => "Yearly Membership Plan"
      
      
*/
                                
            $response = $provider->addProductById('PROD-0GW00334XG887733R')
                ->addBillingPlanById('P-2G9805324B910512VMJ2BXXQ')
                ->setReturnAndCancelUrl(route('subscriptionSuccess'), route('cancelTransaction'))
                ->setupSubscription($user->firstname. ' '.$user->lastname, $user->email, \Carbon\Carbon::now()->addMinutes(5)->toIso8601String());




            if (isset($response['id']) && $response['id'] != null) {

                // redirect to approve href
                foreach ($response['links'] as $links) {
                    if ($links['rel'] == 'approve') {

                        //dd($response);
                        $membership = new Membership;
                        $membership->user_id = Auth::user()->id;
                        $membership->payment_id = $response['id'];
                        $membership->membership_started_on = date('Y-m-d H:i:s');
                        $membership->member_status = 0;
                        $membership->save();

                        return redirect()->away($links['href']);
                    }
                }

                return redirect()
                    ->route('join')
                    ->with('error', 'Something went wrong.');

            } else {
                return redirect()
                    ->route('join')
                    ->with('error', $response['message'] ?? 'Something went wrong.');
            }



            return \redirect()->back()->with('error', 'Something went wrong.');;
        }
        return redirect()->back();








    }

    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction(Request $request, $TournamentParticipantId)
    {

        $check = DB::table('tournament_participants')->where([['id', $TournamentParticipantId], ['payment_status', 'COMPLETED']])->first();

        if($check){
            return redirect()
                ->route('allTournaments')
                ->with('error', 'You are already a participant and paid for this tournament.');
        }

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

          $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('successTransaction'),
                    "cancel_url" => route('cancelTransaction'),
                ],
                "purchase_units" => [
                    0 => [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => "2060.00"
                        ]
                    ]
                ]
            ]);


        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {

                    DB::table('tournament_participants')->where('id', $TournamentParticipantId)->update([
                        'payment_id' => $response['id'],
                        'payment_status' => $response['status'],
                        'payment_amount' => 2060.00
                    ]);


                    return redirect()->away($links['href']);
                }
            }



            return redirect()
                ->route('createTransaction')
                ->with('error', 'Something went wrong.');

        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        $user = Auth::User();

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {


            $update_data = DB::table('tournament_participants')->where('payment_id', $response['id'])->update([
                'payment_status' => $response['status'],
                'payment_time' => date('Y-m-d H:i:s'),
                'tr_data'=>json_encode($response)
            ]);


            if($update_data){
                $tournamentRole = "Captain";
                $dataSet = TournamentParticipant::where('payment_id', $response['id'])->first();
                if($user->id == $dataSet->partner->user_id){
                    $tournamentRole = 'Partner';
                }

                $content = new \stdClass();
                $content->name =  $dataSet->user->firstname.' '.$dataSet->user->lastname;
                $content->tournamentname =  $dataSet->tournament->name;
                $content->email =  $dataSet->user->email;
                $content->loginurl = url('/login');
          
                Mail::to($dataSet->user->email)->send(new MailOnParticipant($content));



                $content2 = new \stdClass();
                $content2->name =  $dataSet->partner->firstname.' '.$dataSet->partner->lastname;
                $content2->tournamentname =  $dataSet->tournament->name;
                $content2->email =  $dataSet->partner->email;
                $content2->loginurl = url('/login');

                Mail::to($dataSet->partner->email)->send(new MailOnParticipantPartner($content2));

            }



            //dd($response);
            return redirect()
                ->route('MyTournaments')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('allTournaments')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }


    public function successSubscriptionTransaction(Request $request)
    {

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->showSubscriptionDetails($request->subscription_id);
        $user = Auth::User();


        if (isset($response['status']) && $response['status'] == 'ACTIVE') {

            $membership = Membership::where([['payment_id', $request->subscription_id], ['user_id', Auth::user()->id]])->first();
            $membership->user_id = Auth::user()->id;
            $membership->payment_id = $response['id'];
            $membership->membership_started_on = date("Y-m-d H:i:s");
            $membership->membership_end_on = \Carbon\Carbon::now()->addDays(365);
            $membership->member_status = 1;
            $membership->save();


            if($membership){
                $content = new \stdClass();
                $content->user_id =  $user->username;
                $content->name =  $user->firstname.' '.$user->lastname;
                $content->email =  $user->email;
                $content->loginurl = url('/login');
          
                Mail::to($user->email)->send(new MailOnJoin($content));
            }



            return redirect()
                ->route('home')
                ->with('success', 'Congratulations. you have successfully joined in our membership program. Now you can register in any tournament.');
        } else {
            return redirect()
                ->route('join')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }

        return redirect()
                ->route('join')
                ->with('error', $response['message'] ?? 'Something went wrong.');
    }

    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('createTransaction')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\PaymentProcessor  $paymentProcessor
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentProcessor $paymentProcessor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentProcessor  $paymentProcessor
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentProcessor $paymentProcessor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentProcessor  $paymentProcessor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentProcessor $paymentProcessor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentProcessor  $paymentProcessor
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentProcessor $paymentProcessor)
    {
        //
    }
}
