<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Business;
use App\Http\Controllers\Controller;

class BusinessController extends Controller
{

    public function showAll()
    {
        $business = Business::all(); // $business = Business::find($id);
        return dd($business->toArray());
    }

    public function show($id)
    {
        $business = Business::find($id);
        return dd($business->toArray());
    }

    public function valid($string)
    {
        if (!empty($string)) {
            if (strpos($string, ')') > strpos($string, '(')) {
                if (strrpos($string, '(') < strrpos($string, ')')) {
                    $countBrackets = array_count_values(str_split($string));
                    if ($countBrackets['('] === $countBrackets[')']) {
                        return /*echo*/ "true";
                    }
                }
            }
        }
        return /*echo*/ "false";
    }

}
