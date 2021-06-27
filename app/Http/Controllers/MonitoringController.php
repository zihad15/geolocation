<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class MonitoringController extends Controller
{
    public function index()
    {
        $uLoct = [];
        $a = User::find(Auth::user()->id);
        $u = User::whereIn('id', json_decode($a->u_id))->get();

        for ($i=0; $i < count($u); $i++) { 
            array_push($uLoct, [$u[$i]->name, $u[$i]->lat, $u[$i]->lng]);
        }

        return view('monitoring.index', ['uLoct' => json_encode($uLoct)]);
    }
}
