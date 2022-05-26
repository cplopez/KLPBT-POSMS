<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SuppliersController extends Controller
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
        $suppliers = Supplier::all();
        return view('suppliers.index')->with('suppliers', $suppliers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'number' => 'required'
        ]);


        $supplier = new Supplier;

        $supplier->name = $request->input('name');
        $supplier->address = $request->input('address');
        $supplier->number = $request->input('number');


        $supplier->save();

        return redirect('/suppliers')->with('success', 'Inserted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $suppliers = Supplier::find($id);
        return view('suppliers.show')->with('suppliers', $suppliers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::find($id);

        //  //Check for correct user
        //  if(auth()->user()->id !==$supplier->user_id){
        //     return redirect('/suppliers')->with('error', 'Unauthorized Page Access!');
        // }

        return view('suppliers.edit')->with('supplier', $supplier);
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
                'number' => 'required'
            ]);

    
            $supplier = Supplier::find($id);
    
            $supplier->name = $request->input('name');
            $supplier->address = $request->input('address');
            $supplier->number = $request->input('number');
            

    
            $supplier->save();
    
            return redirect('/suppliers')->with('success', 'Updated Successfully');
        
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);

          //Check for correct user
          if(auth()->user()->id !==$supplier->user_id){
            return redirect('/suppliers')->with('error', 'Unauthorized Page Access!');
        }
        $supplier->delete();

        return redirect('/suppliers')->with('success', 'Deleted Successfully!');
 
    }
}
