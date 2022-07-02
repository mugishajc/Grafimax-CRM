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
}
