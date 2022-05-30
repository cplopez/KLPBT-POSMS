<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\MOP;
use App\Models\Beverage;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Order;
use App\Models\Product;


class SalesInvoicesController extends Controller
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
    public function index(Request $request)
    { 
       
        if (isset($request->customer) || $request->customer != '') {
            $customers = Customer::where('name', 'like', "%".$request->customer."%")->get();
        } else {
            $customers = Customer::all();
        }
        
        if (isset($request->beverage) || $request->beverage != '') {
            $products = Product::where('beverage_name', 'like', "%".$request->beverage."%")->get();
        } else {
            $products = Product::all();
        }

        $mops = MOP::all();
        $categories = Category::all();

        if (isset($request->order_number) || $request->order_number != '') {
            $order = Order::find($request->order_number);
            // $order = Order::where(['order_number' => $request->order_number ?? ''])->first();
            $order_number = $order->id;
        } else {
            $order_number = 0;
        }
        
        $purchases = Purchase::where(['order_id' => $order_number])->orderByDesc("id")->get();

        /* $totals = 0;
        foreach($purchases as $purchase) {
            $totals += $purchase->total;
        } */
        
        $totals = $purchases->sum('total');
        return view('invoices.index')->with('customers', $customers)->with('m_o_p_s', $mops)->with('categories', $categories)
        ->with('purchases',$purchases)->with('totals', $totals)->with('products', $products)->with('request', $request);

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
            'product_name'=> 'required',
            'category' => 'required',
            'mop' => 'required',
            'case' =>'required'
                       ]);

            $salesinvoices = new Beverage;

        $beverages->product_name = $request->input('p_name');
        $beverages->supplier_id = $request->input('supplier_id');
        $beverages->quantity = $request->input('quantity');
        $beverages->price_case = $request->input('price_case');
        $beverages->price_solo = $request->input('price_solo');
        $beverages->date_expire = $request->input('date_expire');
        $beverages->badorder = $request->input('badorder');
      

        $beverages->save();

        $order = Order::find();

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
        $post = posts::find($id);
          //Check for correct user
          if(auth()->user()->id !==$beverage->user_id){
            return redirect('/')->with('error', 'Unauthorized Page Access!');
        }
        $post->delete();
        return redirect('/');
    }
}
