<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Purchase;
use App\Models\Beverage;
use App\Models\Category;
use App\Models\Customer;
use App\Models\MOP;
use App\Models\CustomerSale;
use App\Models\Payable;
use App\Models\User;
class DashboardController extends Controller
{
    /**
     * Create a New Controller for instance
     * 
     *  @return void
     */

    public function __construct()
    {
           $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $supplier = Supplier::all();
        $purchased = Purchase::all();   
        $beverages = Beverage::all();
        $categories = Category::all();
        $customers = Customer::all();
        $m_o_p_s = MOP::all();
        $sales = CustomerSale::all();
        $payables = Payable::all();
        $users = User::all();
        
        return view("dashboards.dashboard")->with('suppliers', $supplier)->with('invoices', $purchased)->with('beverages', $beverages)->with('categories', $categories)->with('customers', $customers)->with('payables', $payables)->with('m_o_p_s', $m_o_p_s)->with('sales', $sales)->with('users', $users);
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
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
    }
}
