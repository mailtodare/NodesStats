<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\NodeController;
use App\Http\Controllers\Controller;
// use App\Http\Traits\AllRedirects;


class HomeController extends Controller
{
    // use AllRedirects;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return [NodeController::class, 'getNode'];
        $role = auth()->user()->user_role;
        error_log("------------- -----------------");

        switch($role){
            case 2:
                if(auth()->user()->node_id){ // open to node dashboard
                return redirect('/node'); 
                } else{ // return to add node
                    return redirect('node/new-node');
                }
                break;            
            case 10:
                return redirect('/admin');
                break;

        }
        return redirect('/home'); 
    }
}
