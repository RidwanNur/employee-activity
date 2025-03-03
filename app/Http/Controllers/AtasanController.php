<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AtasanController extends Controller
{
    public function index (){
        return view('atasan.dashboard');
    }
}
