<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jobs\TestJob;
use App\Jobs\BusinessJob;
use App\Models\Business;

class RegisterController extends Controller
{
    public function index(){

        $business = Business::find(12);
        dd(BusinessJob::dispatch($business->toJson()));
        
    }
}
