<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
class JobController extends Controller
{
    //
       public function index()
    {
            // $notes = Note::select(
            //     [
            //         '*'
            //     ]
            // )->where('created_by', '=', Auth::user()->id)->get();

            return view('jobs.index');
                }
               public function create()
                 {
                     return view('jobs.create');
                 }
            
                
}
