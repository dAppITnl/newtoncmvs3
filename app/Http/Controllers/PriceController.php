<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pricing;

class PriceController extends Controller
{
    public function index()
    {
      // initial page (form data)
      return view('pricing', [
        'carLicense' => '',
        'startDate' => now()->format('Y-m-d')
      ]);
    }

    public function retrievePricing(Request $request)
    {
      // Get input vars from user form (POST data)
      $carLicense = $request->carLicense ?: '';
      $startDate = $request->startDate ?: now()->format('Y-m-d');
      // if carLicense given -> retrieve pricing data
      if (!empty($carLicense)) {
        $pricingData = Pricing::getParts($carLicense, $startDate);
      } else {
        $pricingData['Error'] = 'No license given!';
      }

      return view('pricing', [
        'carLicense' => $carLicense,
        'startDate' => $startDate,
        ...$pricingData
      ]);
    }
}
