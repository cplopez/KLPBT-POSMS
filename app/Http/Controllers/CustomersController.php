<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use DataTables;
class CustomersController extends Controller
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
    public function index()
    {
        $customers = Customer::all();

        return view('customers.index')->with('customers', $customers);

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
            'name'=> 'required',
            'address' => 'required',
            'contact' => 'required'
                                 ]);

        $customer = new Customer;

        $customer->name = $request->input('name');
        $customer->address = $request->input('address');
        $customer->contact = $request->input('contact');

        $customer->save();

        return redirect('/customers')->with('success', 'Inserted Successfully');
  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        return view('customers.show')->with('customer', $customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);

        // //Check for correct user
        // if(auth()->user()->id !==$customer->user_id){
        //     return redirect('/customers')->with('error', 'Unauthorized Page Access!');
        // }
        
        return view('customers.edit')->with('customer', $customer);
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
        $this->validate($request, [
            'name'=> 'required',
            'address' => 'required',
            'contact' => 'required'
        ]);

        $customer = Customer::find($id);

        $customer->name = $request->input('name');
        $customer->address = $request->input('address');
        $customer->contact = $request->input('contact');

        $customer->save();

        return redirect('/customers')->with('success', 'Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);

        //   //Check for correct user
        //   if(auth()->user()->id !==$customer->user_id){
        //     return redirect('/customers')->with('error', 'Unauthorized Page Access!');

        // }
        $customer->delete();
        return redirect('/customers')->with('success', 'Deleted Successfully!');
 
    }
}
