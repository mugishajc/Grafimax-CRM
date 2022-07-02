<?php

namespace App\Http\Controllers;

use App\Productunits;
use App\Products;
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
        $productunits = Productunits::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');

        $productnames=Products::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        //    dd($productunits);
             return view('Inventory.index', compact(['productunits','productnames']));


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
