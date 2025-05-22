<?php

namespace App\Http\Controllers\Backend\Dashboard;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   public function vistaDashboard()
   {
           $user = Auth::user();
           $name = $user-> nombre;
       return view('backend.admin.dashboard.vistadashboard', ['usuario' => $name]);
   }
}
