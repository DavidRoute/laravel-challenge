<?php

namespace App\Http\Controllers;

use App\Services\InternetServiceProvider\Mpt;
use App\Services\InternetServiceProvider\Ooredoo;
use Illuminate\Http\Request;

class InternetServiceProviderController extends Controller
{
    public function getMptInvoiceAmount(Request $request, Mpt $mpt)
    {
        $mpt->setMonth($request->month ?: 1);
        
        return response()->json([
            'data' => $mpt->calculateTotalAmount()
        ]);
    }
    
    public function getOoredooInvoiceAmount(Request $request, Ooredoo $ooredoo)
    {
        $ooredoo->setMonth($request->month ?: 1);
        
        return response()->json([
            'data' => $ooredoo->calculateTotalAmount()
        ]);
    }
}
