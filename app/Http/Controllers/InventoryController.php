<?php

namespace App\Http\Controllers;

use App\Productunits;
use App\Products;
use App\StockIn;
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


    public function create(Request $request)
    {
        $validator = \Validator::make(
            $request->all(), [
                               'ProdName' => 'required|max:25',
                               'QTY' => 'required',
                               'PU' => 'required',
                               'CV' => 'required',
                           ]
        );
        if($validator->fails())
        {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $stock              = new StockIn;
        $stock->product_name       = $request->ProdName;
        $stock->quantity = $request->QTY;
        $stock->product_unit = $request->PU;
        $stock->cost_value = $request->CV;
        $stock->total_amount = ($request->QTY*$request->CV);
        $stock->note = "$request->note";
        $stock->status = "active";
        $stock->done_by  = \Auth::user()->creatorId();
        $stock->save();

   // dd($stock);

         return redirect()->back()->with('success', __('Stockin successfully created.'));

    }
}
