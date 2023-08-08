<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deals;
use Illuminate\Http\Request;

class AdminInvoiceController extends Controller
{
    public function index(){

        $invoices = Deals::all();
        return view('admin.invoice.index',compact('invoices'));

    }
}
