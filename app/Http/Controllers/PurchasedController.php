<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Purchased;
use App\Models\Purchase;
use App\Models\MOP;

class PurchasedController extends Controller
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
        //
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

        return $request;
        $this->validate($request, [
            'total_quantity' => 'required',
            'customer_name' => 'required',
            'amount_due' => 'required',
            'discount'=> 'required',
            'cash' => 'required',
            'change' => 'required'
        ]);


        $purchased = new Purchased;
        $purchased->customer_name = $request->input('customer_name');
        $purchased->amount_due = $request->input('amount_due');
        $purchased->discount = $request->input('discount');
        $purchased->total_cash = $request->input('cash');
        $purchased->total_quantity = $request->input('total_quantity');
        $current_date = date('Y-m-d H:i:s');
        $purchased->date_purchased = $current_date;

        $purchased->save();

        Purchase::query()->truncate();

        return redirect('/purchase')->with('Cash Payment Method Inserted Successfully!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        // return $request;

        $this->validate($request, [
            'customer'=>'required',
            'mop'=>'required',
            'gtotal'=>'required'
        ]);

        $customer = $request->input('customer');
        $purchases = Purchase::all();
        $total_quantity = 0;

        foreach($purchases as $purchase) {
            $total_quantity += $purchase->quantity;
        }

        $customerName = Customer::find($customer);
        $mop = Mop::find($request->input('mop'));

        // return $mop;

        return view('invoices.show')->with('customerName', $customerName->name)
        ->with('grandTotal', $request->input('gtotal'))->with('total_quantity', $total_quantity)
        ->with('mop', $mop)->with('customer_id', $request->input('customer'))
        ->with('mop_id', $request->input('mop'));
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
