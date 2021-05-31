<?php

namespace App\Http\Controllers;

use App\Models\StripeHelper;
use Illuminate\Http\Request;
use App\Models\ResponseModel;

class StripeHelperController extends Controller
{
    public $stripeHelper;

    public function __construct(){
        $this->stripeHelper = new StripeHelper();
    }

    public function OneTimePayment(){
        return response()->json(new ResponseModel($this->stripeHelper->OneTimePayment(),"SessionId created successfully",200));
    }

    public function Subscription(){
        return response()->json(new ResponseModel($this->stripeHelper->Subscription(),"SessionId created successfully",200));
    }
}