<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModeController extends Controller
{
    public function index($id){
        session(['mode' => $id]);
    }
}
