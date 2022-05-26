<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Beverage;
use App\Models\Category;
use App\Models\Order;

class OrderController extends Controller
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
    //     if ($request->ajax()) {
    //         $data = Order::select('*');
    //         return Datatables::of($data)
    //                 ->addIndexColumn()
    //                 ->addColumn('action', function($row){
       
    //                         $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>
    //                         <a href="/orders/'.$row->id.'/edit" class="edit btn btn-primary btn-sm">Edit</a>
    //                         ';
      
    //                         return $btn;
    //                 })
    //                 ->rawColumns(['action'])
    //                 ->make(true);

    // }
    // return view('orders.index');
    $orders = Order::all();
    $beverages = Beverage::all();
    $suppliers = Supplier::all(); 
    $category = Category::all();

    return view('orders.index')->with('orders', $orders)->with('beverages.index')->with('beverages', $beverages)->with('suppliers', $suppliers)
   ->with('category',$category);

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
        //
        $this->validate($request, [
            'id'=> 'required',
            'orderNumber' => 'required',
            'supplier_id'=> 'required',
            'address' => 'required',
            'number'=> 'required',
            'product_name'=> 'required',
            'category' => 'required',
            'quantity'=> 'required']);

        $orders = new Order;

        $orders->id = $request->input('id');
        $orders->order_number = $request->input('orderNumber');
        $orders->supplier_id = $request->input('supplier_id');
        $orders->address = $request->input('address');
        $orders->number = $request->input('number');
        $orders->product_name = $request->input('product_name');
        $orders->category_id = $request->input('category_id');
        $orders->quantity = $request->input('quantity');
        

        $orders->save();

        return redirect('/orders')->with('success', 'Inserted Successfully');
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orders = Order::find($id);
        return view('orders.show')->with('order', $orders);
   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orders = Order::find($id);

          //Check for correct user
          if(auth()->user()->id !==$order->user_id){
            return redirect('/orders')->with('error', 'Unauthorized Page Access!');
        }
        return view('orders.edit')->with('order', $orders);
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
            'id'=> 'required',
            'orderNumber' => 'required',
            'supplier_id'=> 'required',
            'address' => 'required',
            'number'=> 'required',
            'product_name'=> 'required',
            'category' => 'required',
            'quantity'=> 'required']);

        $orders = new Order;

        $orders->id = $request->input('id');
        $orders->order_number = $request->input('orderNumber');
        $orders->supplier_id = $request->input('supplier_id');
        $orders->address = $request->input('address');
        $orders->number = $request->input('number');
        $orders->product_name = $request->input('product_name');
        $orders->category_id = $request->input('category_id');
        $orders->quantity = $request->input('quantity');
        

        $orders->save();

        return redirect('/orders')->with('success', 'Inserted Successfully');
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orders = Order::find($id);

         //Check for correct user
         if(auth()->user()->id !==$order->user_id){
            return redirect('/orders')->with('error', 'Unauthorized Page Access!');
        }

        $orders->delete();

        return redirect('/orders')->with('success', 'Deleted Successfully!');
    
    }
}
