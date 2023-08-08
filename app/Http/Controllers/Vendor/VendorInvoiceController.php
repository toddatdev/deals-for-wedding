<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use App\Models\Deals;
use Illuminate\Http\Request;

class VendorInvoiceController extends Controller
{
    public function index(){

        $invoices = Deals::where('user_id',auth()->user()->id)->get();

        return view('vendor.invoice.index',compact('invoices'));
    }
}
