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
  use net\authorize\api\contract\v1 as AnetAPI;
  use net\authorize\api\controller as AnetController;
use Mail;
use DateTime;

class PaymentProcessorController extends Controller
{

    public $merchant_login_id = '5q8T7yeS4E';
    public $merchant_transaction_key = '7bXu9A95q5X6vj6g';
    public $authorize_net_mode = 'SANDBOX';
    



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

 
function createSubscription($intervalLength)
{
    /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName('5q8T7yeS4E');
    $merchantAuthentication->setTransactionKey('45Dh29szSeD2S6DY');
    
    // Set the transaction's refId
    $refId = 'ref' . time();

    // Subscription Type Info
    $subscription = new AnetAPI\ARBSubscriptionType();
    $subscription->setName("Sample Subscription");

    $interval = new AnetAPI\PaymentScheduleType\IntervalAType();
    $interval->setLength($intervalLength);
    $interval->setUnit("days");

    $paymentSchedule = new AnetAPI\PaymentScheduleType();
    $paymentSchedule->setInterval($interval);
    $paymentSchedule->setStartDate(new DateTime('2035-12-30'));
    $paymentSchedule->setTotalOccurrences("12");
    $paymentSchedule->setTrialOccurrences("1");

    $subscription->setPaymentSchedule($paymentSchedule);
    $subscription->setAmount(rand(1,99999)/12.0*12);
    $subscription->setTrialAmount("0.00");
    
    $creditCard = new AnetAPI\CreditCardType();
    $creditCard->setCardNumber("4111111111111111");
    $creditCard->setExpirationDate("2038-12");

    $payment = new AnetAPI\PaymentType();
    $payment->setCreditCard($creditCard);
    $subscription->setPayment($payment);

    $order = new AnetAPI\OrderType();
    $order->setInvoiceNumber("1234354");        
    $order->setDescription("Description of the subscription"); 
    $subscription->setOrder($order); 
    
    $billTo = new AnetAPI\NameAndAddressType();
    $billTo->setFirstName("John");
    $billTo->setLastName("Smith");

    $subscription->setBillTo($billTo);

    $request = new AnetAPI\ARBCreateSubscriptionRequest();
    $request->setmerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setSubscription($subscription);
    $controller = new AnetController\ARBCreateSubscriptionController($request);

    $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);
    
    if (($response != null) && ($response->getMessages()->getResultCode() == "Ok") )
    {
        echo "SUCCESS: Subscription ID : " . $response->getSubscriptionId() . "\n";
     }
    else
    {
        echo "ERROR :  Invalid response\n";
        $errorMessages = $response->getMessages()->getMessage();
        echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
    }

    return $response;
  }
  
  

    public function auth_chk_data(){
       // dd(Auth::User());
         $data = $this->createCustomerProfileFromTransaction('4111111111111111', '2023', '12', '123', 10, true);
         dd($data);

    }


    public function createCustomerProfileFromTransaction($cc_num, $cc_year, $cc_month, $cc_cvv, $charge_amount, $is_subscription = false){
        $user = Auth::User();
        /* Create a merchantAuthenticationType object with authentication details
           retrieved from the constants file */
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName($this->merchant_login_id);
        $merchantAuthentication->setTransactionKey($this->merchant_transaction_key);

         // Set the transaction's refId
        $refId = 'ref' . time();
        $tran_id = NULL;
        $subs_id = NULL;

    //dd($cc_year."-".$cc_month);
        // Create a Customer Profile Request
        //  1. (Optionally) create a Payment Profile
        //  2. (Optionally) create a Shipping Profile
        //  3. Create a Customer Profile (or specify an existing profile)
        //  4. Submit a CreateCustomerProfile Request
        //  5. Validate Profile ID returned
    
        // Set credit card information for payment profile
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($cc_num);
        $creditCard->setExpirationDate($cc_year."-".$cc_month);
        $creditCard->setCardCode($cc_cvv);
        $paymentCreditCard = new AnetAPI\PaymentType();
        $paymentCreditCard->setCreditCard($creditCard);
    
        // Create the Bill To info for new payment type
        $billTo = new AnetAPI\CustomerAddressType();
        $billTo->setFirstName($user->firstname);
        $billTo->setLastName($user->lastname);
        $billTo->setAddress($user->street_address);
        $billTo->setCity($user->city);
        $billTo->setState($user->state);
        $billTo->setZip($user->zip_code);
        $billTo->setCountry($user->country);
    
    
        // Create a new CustomerPaymentProfile object
        $paymentProfile = new AnetAPI\CustomerPaymentProfileType();
        $paymentProfile->setCustomerType('individual');
        $paymentProfile->setBillTo($billTo);
        $paymentProfile->setPayment($paymentCreditCard);
        $paymentProfiles[] = $paymentProfile;
    
    
        // Create a new CustomerProfileType and add the payment profile object
        $customerProfile = new AnetAPI\CustomerProfileType();
        $customerProfile->setDescription("Customer");
        $customerProfile->setMerchantCustomerId("M_" . time());
        $customerProfile->setEmail($user->email);
        $customerProfile->setpaymentProfiles($paymentProfiles);

    
        // Assemble the complete transaction request
        $request = new AnetAPI\CreateCustomerProfileRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setProfile($customerProfile);
    
        // Create the controller and get the response
        $controller = new AnetController\CreateCustomerProfileController($request);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
     // dd($response);
        if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
            $paymentProfiles = $response->getCustomerPaymentProfileIdList();
            
            $cardType = (substr($cc_num, 0, 1));
        
            if($cardType == 4){
                $cardType = 'VISA';
            }elseif($cardType == 5){
                $cardType = "MASTER";
            }elseif($cardType== 3){
                $cardType = 'AMEX';
            }else{
                $cardType = 'VISA';
            }
            
            //charge card 
            


                $profileToCharge = new AnetAPI\CustomerProfilePaymentType();
                $profileToCharge->setCustomerProfileId($response->getCustomerProfileId());
                $paymentProfile = new AnetAPI\PaymentProfileType();
                $paymentProfile->setPaymentProfileId($paymentProfiles[0]);
                $profileToCharge->setPaymentProfile($paymentProfile);
            
                $transactionRequestType = new AnetAPI\TransactionRequestType();
                $transactionRequestType->setTransactionType( "authCaptureTransaction"); 
                $transactionRequestType->setAmount($charge_amount);
                $transactionRequestType->setProfile($profileToCharge);
            
                $request = new AnetAPI\CreateTransactionRequest();
                $request->setMerchantAuthentication($merchantAuthentication);
                $request->setRefId( $refId);
                $request->setTransactionRequest( $transactionRequestType);
                $controller = new AnetController\CreateTransactionController($request);
                $response2 = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);
            
                if ($response2 != null)
                {
                  if($response2->getMessages()->getResultCode() == "Ok")
                  {
                    $tresponse = $response2->getTransactionResponse();
                    
            	      if ($tresponse != null && $tresponse->getMessages() != null)   
                    {
                        
                        DB::table('user_gateway_profiles')
                            ->updateOrInsert(
                                ['user_id' => $user->id],
                                ['profile_id' => $response->getCustomerProfileId()]
                            );
                        
                        DB::table('user_payment_profiles')
                            ->updateOrInsert(
                                ['user_id' => $user->id],
                                ['payment_profile_id' => $paymentProfiles[0], 'last_4'=>substr($cc_num, -4), 'type'=>'card', 'brand'=> $cardType]
                            );
                                    
                        
                        
                      $tran_id = $tresponse->getTransId();
                      
                      //if has to create subscription from charge in next year 
                      if($is_subscription == true){
                          
                        // Subscription Type Info
                        $subscription = new AnetAPI\ARBSubscriptionType();
                        $subscription->setName("Membership Subscription");
                    
                        $interval = new AnetAPI\PaymentScheduleType\IntervalAType();
                        $interval->setLength(365);
                        $interval->setUnit("days");
                    
                        $paymentSchedule = new AnetAPI\PaymentScheduleType();
                        $paymentSchedule->setInterval($interval);
                        $paymentSchedule->setStartDate(new DateTime( date('Y-m-d',strtotime('+365 day', time()))));
                        $paymentSchedule->setTotalOccurrences("12");
                        $paymentSchedule->setTrialOccurrences("1");
                    
                        $subscription->setPaymentSchedule($paymentSchedule);
                        $subscription->setAmount(69.99);
                        $subscription->setTrialAmount("0.00");
                        
                        $profile = new AnetAPI\CustomerProfileIdType();
                        $profile->setCustomerProfileId($response->getCustomerProfileId());
                        $profile->setCustomerPaymentProfileId($paymentProfiles[0]);

                        $subscription->setProfile($profile);
                    
                        $request = new AnetAPI\ARBCreateSubscriptionRequest();
                        $request->setmerchantAuthentication($merchantAuthentication);
                        $request->setRefId($refId);
                        $request->setSubscription($subscription);
                        $controller = new AnetController\ARBCreateSubscriptionController($request);
                    
                        $response_subs = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);
                        if (($response_subs != null) && ($response_subs->getMessages()->getResultCode() == "Ok") )
                        {
                            $subs_id = $response_subs->getSubscriptionId();
                        }
                         
     
     
                          
                          
                      }
                      
                      //dd($response2);
           
                        return [
                            'status'=> 'COMPLETED',
                            'cutomer_profile_id'=>$response->getCustomerProfileId(),
                            'customer_payment_profile_id'=>$paymentProfiles[0],
                            'message'=>'success',
                            'response'=>$response,
                            'tran_id'=>$tran_id,
                            'subs_id'=>$subs_id
                        ];                      
                    }
                    else
                    {
                      if($tresponse->getErrors() != null)
                      {
                          
                          
                        $errorMessages = $response->getMessages()->getMessage();
            
                        return [
                            'status'=> 'FAILED',
                            'cutomer_profile_id'=>NULL,
                            'customer_payment_profile_id'=>NULL,
                            'message'=>$tresponse->getErrors()[0]->getErrorText() ,
                            'response'=>$response,
                            'tran_id'=>$tran_id
                        ];                          
                                      
                      }
                    }
                  }
                  else
                  {
                        return [
                            'status'=> 'FAILED',
                            'cutomer_profile_id'=>NULL,
                            'customer_payment_profile_id'=>NULL,
                            'message'=>'Something went wrong' ,
                            'response'=>$response,
                            'tran_id'=>$tran_id
                        ]; 
                  }
                }
                else
                {
                        return [
                            'status'=> 'FAILED',
                            'cutomer_profile_id'=>NULL,
                            'customer_payment_profile_id'=>NULL,
                            'message'=>'Something went wrong' ,
                            'response'=>$response,
                            'tran_id'=>$tran_id
                        ]; 
                }
                
    
    
            //charge card end
            
            
            

            
            return [
                'status'=> 'COMPLETED',
                'cutomer_profile_id'=>$response->getCustomerProfileId(),
                'customer_payment_profile_id'=>$paymentProfiles[0],
                'message'=>'success',
                'response'=>$response,
                'tran_id'=>$tran_id
            ];


        } else {
            $errorMessages = $response->getMessages()->getMessage();

            return [
                'status'=> 'FAILED',
                'cutomer_profile_id'=>NULL,
                'customer_payment_profile_id'=>NULL,
                'message'=>$errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText(),
                'response'=>$response,
                'tran_id'=>$tran_id
            ];


        }
        return $response;
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


/*
        $response = $user->anet()->subscription()->create([
            'name'  => 'Membership Subscription',
            'startDate' => now(),
            'totalOccurrences' => 12,
            'trialOccurrences' => 1,
            'intervalLength' => 365,
            'intervalLengthUnit' => 'days',
            'amountInDollars' => 1, // $10
            'trialAmountInDollars' => 0, // $0
            'cardNumber' => $request->cardNumber,
            'cardExpiry' => $request->expMonth.'-'.$request->expYear,
            'invoiceNumber' => rand(1, 10000),
            'subscriptionDescription' => 'Yearly membership',
            'customerFirstName' => $user->firstname,
            'customerLastName' => $user->lastname
        ]);
        

                        
                        
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName('5q8T7yeS4E');
    $merchantAuthentication->setTransactionKey('2Wx477M7yY7bwUMM');
    
    // Set the transaction's refId
    $refId = 'ref' . time();

    // Subscription Type Info
    $subscription = new AnetAPI\ARBSubscriptionType();
    $subscription->setName("Membership Subscription");

    $interval = new AnetAPI\PaymentScheduleType\IntervalAType();
    $interval->setLength(365);
    $interval->setUnit("days");

    $paymentSchedule = new AnetAPI\PaymentScheduleType();
    $paymentSchedule->setInterval($interval);
    $paymentSchedule->setStartDate(new DateTime(date('Y-m-d')));
    $paymentSchedule->setTotalOccurrences("12");
    $paymentSchedule->setTrialOccurrences("1");

    $subscription->setPaymentSchedule($paymentSchedule);
    $subscription->setAmount(1);
    $subscription->setTrialAmount("0.00");
    
    $creditCard = new AnetAPI\CreditCardType();
    $creditCard->setCardNumber($request->cardNumber);
    $creditCard->setExpirationDate($request->expYear.'-'.$request->expMonth);

    $payment = new AnetAPI\PaymentType();
    $payment->setCreditCard($creditCard);
    $subscription->setPayment($payment);

    $order = new AnetAPI\OrderType();
    $order->setInvoiceNumber(rand(1, 10000));        
    $order->setDescription("Yearly Membership"); 
    $subscription->setOrder($order); 
    
    $billTo = new AnetAPI\NameAndAddressType();
    $billTo->setFirstName($user->firstname);
    $billTo->setLastName($user->lastname);

    $subscription->setBillTo($billTo);

    $request = new AnetAPI\ARBCreateSubscriptionRequest();
    $request->setmerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setSubscription($subscription);
    $controller = new AnetController\ARBCreateSubscriptionController($request);

    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);


                       return [
                            'status'=> 'COMPLETED',
                            'cutomer_profile_id'=>$response->getCustomerProfileId(),
                            'customer_payment_profile_id'=>$paymentProfiles[0],
                            'message'=>'success',
                            'response'=>$response,
                            'tran_id'=>$tran_id,
                            'subs_id'=>$subs_id
                        ];   
                        
                        
                        
*/
            $paymentInfo = $this->createCustomerProfileFromTransaction($request->cardNumber, $request->expYear, $request->expMonth, $request->cardCode, 69.99, true);

            if (($paymentInfo != null) && ($paymentInfo['status'] == "COMPLETED") )
            {
                $get_subs_id = $paymentInfo['subs_id'];
                if($paymentInfo['subs_id'] == NULL){
                    $get_subs_id = $paymentInfo['tran_id'];
                }
                
                $membership = new Membership;
                $membership->user_id = Auth::user()->id;
                $membership->payment_id = $get_subs_id;
                $membership->membership_started_on = date('Y-m-d H:i:s');
                $membership->membership_end_on = \Carbon\Carbon::now()->addDays(365);
                $membership->member_status = 1;
                $membership->save();      
                
                $user->is_subscribed  = 1;
                $user->save();
                
                
            
            if($membership){
                $content = new \stdClass();
                $content->user_id =  $user->username;
                $content->name =  $user->firstname.' '.$user->lastname;
                $content->email =  $user->email;
                $content->loginurl = url('/login');
                 $user = Auth::user();

                Mail::to($user->email)->send(new MailOnJoin($content));
            }



            return redirect()
                ->route('home')
                ->with('success', 'Congratulations. you have successfully joined in our membership program. Now you can register in any tournament.');
                
             }
            else
            {
              //  dd($paymentInfo);
                $errorMessages = $paymentInfo['message'];
                 return redirect()
                    ->route('join')
                    ->with('error', $errorMessages);
            }
            
            
            
        }
        
        
        
        return redirect()->back()->with('error',' Something went wrong, try again.');








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
        
        
        
                $tournament = NULL;
                $participant = DB::table('tournament_participants')->where([['id', $TournamentParticipantId]])->first();
                if($participant){
                    $tournament = DB::table('tournaments')->where([['id', $participant->tournament_id]])->first();
                }
        
                return view('authorize', compact('tournament', 'participant', 'TournamentParticipantId'));

        /*

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

*/
    }




    public function authorizenetpost_membership(Request $request){
       // dd($request);
      /*  $data = $user->anet()->createPaymentProfile([
            'dataValue' => $request->opaqueDataValue,
            'dataDescriptor' => $request->opaqueDataDescriptor
        ], [
            'type'   => 'card',
            'last_4'=>'1111',
            'brand'=> 'visa'
        ]);
        
        $paymentCards = $user->anet()->getPaymentCardProfiles();
*/

//$data = $user->anet()->charge(1200, '905975216'); // $12
        //$response = $user->anet()->subs()->get(8307346);
        $user = Auth::user();

        $response = $user->anet()->subs()->create([
            'name'  => 'Membership Subscription',
            'startDate' => date('Y-m-d'),
            'totalOccurrences' => 12,
            'trialOccurrences' => 1,
            'intervalLength' => 365,
            'intervalLengthUnit' => 'days',
            'amountInDollars' => 1, //69.99, // $10
            'trialAmountInDollars' => 0, // $0
            'cardNumber' => $request->cardNumber,
            'cardExpiry' => $request->expMonth.'-'.$request->expYear,
            'invoiceNumber' => rand(1, 10000),
            'subscriptionDescription' => 'Yearly membership',
            'customerFirstName' => $user->firstname,
            'customerLastName' => $user->lastname
        ]);
        
            if (($response != null) && ($response->getMessages()->getResultCode() == "Ok") )
            {
                echo "SUCCESS: Subscription ID : " . $response->getSubscriptionId() . "\n";
             }
            else
            {
                echo "ERROR :  Invalid response\n";
                $errorMessages = $response->getMessages()->getMessage();
                echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
            }
        
            //    dd(($response));

    }
    
    
    

    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request, $trid)
    {
        $dataSet = TournamentParticipant::where('id', $trid)->first();

        $tournament = DB::table('tournaments')->where('id', $dataSet->tournament_id)->first();

        $user = Auth::User();
        $charableamount = $tournament->tournament_price+round($tournament->tournament_price*.029);
        $paymentInfo = $this->createCustomerProfileFromTransaction($request->cardNumber, $request->expYear, $request->expMonth, $request->cardCode, $charableamount, false);

   /*

                       return [
                            'status'=> 'COMPLETED',
                            'cutomer_profile_id'=>$response->getCustomerProfileId(),
                            'customer_payment_profile_id'=>$paymentProfiles[0],
                            'message'=>'success',
                            'response'=>$response,
                            'tran_id'=>$tran_id,
                            'subs_id'=>$subs_id
                        ];      
   
   */
        if (($paymentInfo != null) && ($paymentInfo['status'] == "COMPLETED") ) {
                    

                    $update_data = DB::table('tournament_participants')->where('id', $trid)->update([
                        'payment_status' => 'COMPLETED',
                        'payment_time' => date('Y-m-d H:i:s'),
                        'payment_id'=>$paymentInfo['tran_id'],
                        'payment_amount'=>$tournament->tournament_price+round($tournament->tournament_price*.029),
                        'tr_data'=>json_encode($paymentInfo['response'])
                    ]);
                            
                        
        
                    if($update_data){
                        $tournamentRole = "Captain";
                        
                        $numberofparticipant = 2;
                        if($tournament->single_player == 1){
                            $numberofparticipant = 1;
                        }
                        
                        DB::table('tournaments')->where('id', $dataSet->tournament_id)->update([
                            'participated' => @$tournament->participated + $numberofparticipant
                        ]);
                                    
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

        
                        return redirect()
                            ->route('MyTournaments')
                            ->with('success', 'Transaction complete.');
                        
                    } else {
                  
                            return redirect()
                            ->route('MyTournaments')
                            ->with('error', $paymentInfo['message']);
                            
                        
                    }
                    // Or, print errors if the API request wasn't successful
    

            
    
                            return redirect()
                            ->route('MyTournaments')
                            ->with('error', 'Something went wrong.');
    
    

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
