<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }
    public function subscription_plans()
    {
        return view("dashboard.subscription.plans");
    }
}
