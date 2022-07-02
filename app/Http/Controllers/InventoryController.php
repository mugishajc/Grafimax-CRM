<?php

namespace App\Http\Controllers;

use App\Productunits;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    //
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
            $productunits = Productunits::where('created_by', '=', \Auth::user()->creatorId())->get();

            return view('Inventory.index', compact('productunits'));


    }


    public function create()
    {
        if(\Auth::user()->can('create product unit')) {
            return view('productunits.create');
        }else{
            return redirect()->back()->with('error','Permission denied.');
        }
    }
}
