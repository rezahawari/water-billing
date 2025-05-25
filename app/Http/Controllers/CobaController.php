<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Milon\Barcode\Facades\DNS2DFacade as DNS2D;

class CobaController extends Controller
{
    public function coba()
    {
        $customer = User::where('id', 1)->first();
        return view('coba', compact('customer'));
        // return DNS2D::getBarcodeHTML('32132131', 'QRCODE');
    }
}
