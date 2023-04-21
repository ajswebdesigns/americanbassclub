<?php
use Illuminate\Cache\MemcachedLock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TournamentsController;
use App\Http\Controllers\PaymentProcessorController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\MembersBenifitController;
use App\Http\Controllers\PageController;


use App\Models\Membership;
use App\Models\Tournament;
use App\Models\Category;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/page/{page:page_slug}', [PageController::class, 'getSinglePage']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/authorize', [App\Http\Controllers\HomeController::class, 'authorizenet'])->name('authorizenet');
Route::post('/authorize', [App\Http\Controllers\HomeController::class, 'authorizenetpost'])->name('authorizenetpost');
Route::post('/authorize-membership', [App\Http\Controllers\PaymentProcessorController::class, 'authorizenetpost_membership'])->name('authorizenetpost.membership');
Route::get('/abc-check', [App\Http\Controllers\PaymentProcessorController::class, 'auth_chk_data'])->name('authorizenetpost.chk');


Route::get('nightly-rules', function () {
    return view('nightly-rules');
});

Route::get('results', function(){
    return view('results');
});

Route::get('connect-scale', function () {
    return view('connect-scale');
});
Route::get('payouts', function () {
    return view('payouts');
});
Route::get('pro-circuit-rules', function () {
    return view('pro-circuit-rules');
});
Route::get('payouts-pro-circuit', function () {
    return view('payouts-pro-circuit');
});
Route::get('payouts-pro-circuit-championship', function () {
    return view('payouts-pro-circuit-championship');
});
Route::get('pro-circuit-agreement', function () {
    return view('pro-circuit-agreement');
});

Route::get('big-bass-tournament-rules', function () {
    return view('big-bass-tournament-rules');
});
Route::get('/about', function(){
    return view('about');
});
Route::get('/live', function(){
    return view('live');
});
Route::get('/fishermans-central', function(){
    return view('fishermans-central');
});

Route::get('qualifiers-schedule', function () {
    return view('qualifiers-schedule');
});
Route::get('/northern-qualifier-results', function(){
    return view('results');
});

Route::get('member-benefits', function () {
    return view('member-benefits');
})->name('member.benifits');


Route::get('/privacy_policy', function(){
    return view('privacy_policy');
});

Route::get('/rules', function(){
    return view('rules');
});
Route::get('/refund', function(){
    return view('refund');
});
Route::get('/contact', function(){
    return view('contact');
});
Route::get('/join', function(){
    $memberCheck = Membership::where([['user_id', Auth::id()], ['member_status', 1]])->count();

    if($memberCheck == true && $memberCheck > 0 ){
        return redirect()->route('home');
    }else{
        return view('join');
    }

    return view('join');
})->name('join');


Route::post('/partner/search', [HomeController::class, 'searchnamebyid'])->name('searchnamebyid');

Route::get('/sitemap.xml', [HomeController::class, 'sitemap'])->name('sitemap');



Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/tournament/info/{id}', [MainController::class, 'tournamentInfo']);
Route::middleware(['auth' => 'AdminAuth'])->group(function () {
    //tournaments
    Route::get('/tournaments/view', [TournamentsController::class, 'view']);
    Route::get('/categories/view', [TournamentsController::class, 'category_view']);
    Route::get('/categories/edit/{id}', [TournamentsController::class, 'category_edit_view']);
    
    
    Route::get('/categories/add/', [TournamentsController::class, 'category_add_view']);
    Route::post('/categories/store/', [TournamentsController::class, 'category_add_store'])->name('categorystore');
    Route::post('/categories/update/{id}', [TournamentsController::class, 'category_add_update'])->name('categoryupdate');
    Route::get('/categories/delete/{id}', [TournamentsController::class, 'category_delete']);
    
 // Test
   Route::get('/pages/view/', [PageController::class, 'view']);
   Route::get('/pages/add', [PageController::class, 'page_add_view']);
   Route::post('pages/store', [PageController::class, 'page_add_store'])->name('pagestore');
   Route::get('/pages/edit/{id}', [PageController::class, 'page_edit_view']);
   Route::post('/pages/update/{id}', [PageController::class, 'page_add_update'])->name('pageupdate');
// End Test
    
    
    Route::get('/tournaments/add', [TournamentsController::class, 'add']);
    Route::post('/tournaments/save', [TournamentsController::class, 'save']);
    Route::get('/tournaments/edit/{id}', [TournamentsController::class, 'edit']);
    Route::post('/tournaments/update/{id}', [TournamentsController::class, 'update']);
    Route::get('/tournaments/delete/{id}', [TournamentsController::class, 'delete']);
    Route::get('/tournaments/post/results/{id}', [TournamentsController::class, 'post_results']);
    Route::post('/tournaments/results/save', [TournamentsController::class, 'save_results']);
    Route::get('/tournaments/teams/{id}', [TournamentsController::class, 'teams']);
    Route::get('/tournaments/teams/export/{id}', [TournamentsController::class, 'teams_export']);
    //customers
    Route::get('/members/view', [MembersController::class, 'view']);
    Route::get('/members/add', [MembersController::class, 'add']);
    Route::post('/members/save', [MembersController::class, 'save']);
    Route::get('/members/edit/{id}', [MembersController::class, 'edit']);
    Route::post('/members/update/{id}', [MembersController::class, 'update']);
    Route::post('/memebers/change/password/{id}', [MembersController::class, 'changePassword']);
    Route::get('/members/delete/{id}', [MembersController::class, 'delete']);
    Route::get('/members/view/details/{id}', [MembersController::class, 'view_details']);
    Route::get('/membership-status-change/{id}', [MembersController::class, 'membership_status_change'])->name('membership.membership.status.change');

    Route::get('/members-benifits-view', [MembersBenifitController::class, 'membersBenifitsView'])->name('members.benifits');
    Route::get('/members-benifits-new', [MembersBenifitController::class, 'membersBenifitsNew'])->name('members.benifits.new');
    Route::post('/members-benifits-store', [MembersBenifitController::class, 'membersBenifitsStore'])->name('members.benifits.store');
    Route::get('/members-benifit/single/{id}', [MembersBenifitController::class, 'membersBenifitsSingleUpdateView'])->name('members.benifits.update.view');
    Route::post('/members-benifits-store/single/{id}', [MembersBenifitController::class, 'membersBenifitsSingleUpdate'])->name('members.benifits.update');
    Route::get('/members-benifits/delete/{id}', [MembersBenifitController::class, 'membersBenifitsSingleDelete'])->name('members.benifits.delete');

    Route::get('/page-management/{page_slug}', [HomeController::class, 'page_management'])->name('page_management');
    Route::post('/page-management/{page_slug}', [HomeController::class, 'page_management_post'])->name('page_management.post');
    
    Route::get('/mail-to-all-users/', [HomeController::class, 'view_outbox'])->name('send_email_to_all_users');
    Route::post('/mail-to-all-users/', [HomeController::class, 'post_outbox'])->name('mail_to_all_users.post');



    //settings
    Route::get('/settings/header/carousels', [HomeController::class, 'headerSettings']);
    Route::post('/settings/header/carousels/save', [HomeController::class, 'saveHeader']);
    Route::get('/settings/header/carousels/delete/{id}', [HomeController::class, 'deleteHeader']);
    Route::get('/settings/sponser/carousels', [HomeController::class, 'sponserCarousel']);
    Route::post('/settings/sponser/carousels/save', [HomeController::class, 'sponser_save']);
    Route::get('/settings/sponser/carousels/delete/{id}', [HomeController::class, 'sponser_delete']);
    Route::get('/transactions', [TournamentsController::class, 'transactions'])->name('transactions');
    Route::get('/cheques', [TournamentsController::class, 'cheques'])->name('cheques');
    Route::get('/cheque-approve/{id}', [TournamentsController::class, 'chequesApprove'])->name('chequeApprove');

});
Route::get('/member/documents/signature', [MembersController::class, 'document_sign']);
Route::post('/member/documents/save', [MembersController::class, 'document_save']);
Route::get('/member/document/view', function () {
    if(Auth::user()->agreement == 1){
        return view('dashboard.members.documents');
    }else{
        return view('/home');
    }
})->middleware('auth');

Route::middleware(['auth' => 'MemberAuth'])->group(function(){

        
    Route::get('/member-benifits-dashboard', function(){
        return view('dashboard.benifits.memberbenifits');
    })->name('member.benifits.dashboard');
    
    Route::get('/tournaments/participation', [TournamentsController::class, 'available'])->name('allTournaments');
    Route::get('/tournaments/participate/{id}', [TournamentsController::class, 'available_by_category'])->name('allTournamentsbycate');
    Route::get('/tournaments/my', [TournamentsController::class, 'MyTournaments'])->name('MyTournaments');
    Route::POST('/tournament/participate/make-team/{id}', [TournamentsController::class, 'makeParticipation']);
    Route::get('/tournaments/results/view', [TournamentsController::class, 'view_results']);
    Route::get('/subscripton/plans', [SubscriptionController::class, 'subscription_plans']);
    Route::get('/member/profile/edit/{id}', [MembersController::class, 'edit']);
    Route::post('/member/profile/update/{id}', [MembersController::class, 'update']);
    Route::post('/member/profile/change-password/{id}', [MembersController::class, 'changePassword']);
    Route::get('/membership', [MembershipController::class, 'membershipIndex'])->name('user.membership');
    Route::get('/membership-cancel/{id}', [PaymentProcessorController::class, 'cancelSubscription'])->name('user.membership.cancel');

});


    Route::post('/join/process', [PaymentProcessorController::class, 'processSubscription'])->name('join.paypal');



Route::get('create-transaction', [PaymentProcessorController::class, 'createTransaction'])->name('createTransaction');
Route::get('process-transaction/{TournamentParticipantId}', [PaymentProcessorController::class, 'processTransaction'])->name('processTransaction');
Route::post('success-transaction/{trid}', [PaymentProcessorController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PaymentProcessorController::class, 'cancelTransaction'])->name('cancelTransaction');
Route::get('subscription-success', [PaymentProcessorController::class, 'successSubscriptionTransaction'])->name('subscriptionSuccess');


    Route::get('contact-us', [HomeController::class, 'contactUsForm'])->name('contactus');
    Route::post('contact-us', [HomeController::class, 'contactUsFormPost'])->name('contact.us.post');
    
// Here is the category, look this up in the homecontroler and see how category is being passes
    Route::get('/category/{slug}', [HomeController::class, 'categoryitem'])->name('categoryitem');


Route::get('/contact-us-inbox', [ContactusController::class, 'all_contactus_inbox'])->name('backend.admin.all.inbox');
Route::get('/contact-us-inbox/{id}', [ContactusController::class, 'single_contactus_inbox'])->name('backend.admin.single.inbox');
Route::get('/contact-us-inbox/{id}/delete', [ContactusController::class, 'single_contactus_delete'])->name('backend.admin.single.delete');


// Route::get('/testing/{tournament}', function(Tournament $tournament){
//     return dd($tournament->name);
// });


Route::get('/testing/{category:cat_id}', function(Category $category){
  dd($category->tournament);
});


