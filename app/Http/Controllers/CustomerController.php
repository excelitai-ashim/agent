<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        return view('layouts.back-end.customer.customer-view');
    }

    public function create(){
        return view('layouts.back-end.customer.customer');
    }
}
