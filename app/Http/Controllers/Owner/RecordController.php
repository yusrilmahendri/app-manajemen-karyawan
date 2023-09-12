<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RecordController extends Controller
{
    public function index(){
        return view('owner.record.index');
    }
    
}
