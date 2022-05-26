<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Beverage;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Order;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\Supplier;


class PurchasesController extends Controller
{

    
     /**
     * Create a New Controller for instance
     * 
     *  @return void
     */

    public function __construct()
    {
           $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        $this->validate($request, [
            'beverage' => 'required',
            'category' => 'required',
            'case' =>'required'
        ]);


        $beverage = Beverage::find($request->input('beverage'));
        $total =  $beverage->product->price_case * $request->input('case');

        $purchases = new Purchase;

        $purchases->order_id = 0;
        $purchases->beverage_id = $request->input('beverage');
        $purchases->quantity = $request->input('case');
        $purchases->category_id = $request->input('category');
        
        $current_date = date('Y-m-d H:i:s');
        $purchases->date_purchase = $current_date;
        $purchases->total = $total;
        $purchases->save();

        $result = Beverage::find((int)$request->input('beverage'));
        
        // return 

        $quantity =  $result->product->total_quantity - (int)$request->input('case');

        $inventory = new Inventory;
        $inventory->supplier_id = $result->supplier_id;
        $inventory->beverage_name = $result->product->beverage_name;
        $inventory->category_id = $result->category_id;
        $inventory->product_id = $result->product->id;
        $inventory->quantity = $quantity;
        $inventory->price_case = $result->product->price_case;
        $inventory->price_solo = $result->product->price_solo;
        $inventory->date_expiry = $result->product->date_expire;
        $inventory->badorder = $result->product->badorder;
        $inventory->save();

        
        $product = Product::find($result->product->id);
        $product->total_quantity = $quantity;
        $product->save();

        

        return redirect('/purchase')->with('success', 'Inserted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
