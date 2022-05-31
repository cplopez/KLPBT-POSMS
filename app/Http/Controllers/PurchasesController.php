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
            'product_id' => 'required',
            // 'category_id' => 'required',
            /* 'mop_id' => 'required',
            'customer_id' => 'required', */
            'quantity' =>'required'
        ]);

        if (!isset($request->order_number) && $request->order_number == '') {
            $order = Order::create([
                'order_number' => rand(10, 40)
            ]);
        } else {
            $order = Order::find($request->order_number);
        }
        
        $request->merge(['order_id' => $order->id]);

        $product = Product::find($request->product_id);
        if ($product->total_quantity < request('quantity')) {
            return back()->with('error', 'Not Enough Quantity');
        }

        $purchase = Purchase::where(['order_id' => $order->id, 'product_id' => request('product_id')])->first();
        if ($purchase != null) {
            $new_quantity = $purchase->quantity + request('quantity');
            $purchase->update( [
                // 'category_id' => request('category_id'),
                /* 'mop_id' => request('mop_id'),
                'customer_id' => request('customer_id'), */
                'quantity' => $new_quantity,
                'total' => $new_quantity * $product->price_case,
                // 'date_purchase' => now()
            ]);
        } else {
            $purchase = Purchase::create([
                'order_id' => $order->id,
                'product_id' => request('product_id'),
                'quantity' =>request('quantity'),
                'total' =>request('quantity') * $product->price_case
            ]);
        }
        

        /* $purchases = Purchase::where(['order_id', $order->id])->get();

        $total =  $purchase->sum('total'); */
        
        // return 

        /* $quantity =  $result->product->total_quantity - (int)$request->input('case');

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
        $inventory->save(); */
  
        return redirect('/purchase?order_number='.$order->id.'&customer_id='.request('customer_id'))->with('success', 'Inserted Successfully');
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
        $purchase = Purchase::find($id);
        $purchase->delete();

        return redirect()->back();
    }
}
