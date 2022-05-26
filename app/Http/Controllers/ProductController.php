<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Beverage;
// use App\Models\Category;
use Datatables;

class ProductController extends Controller
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
       $products = Product::all();
       $suppliers = Supplier::all();
       $beverages = Beverage::all();
    //    $categories =Category::all();
        return view('products.index')->with('products', $products)->with('suppliers', $suppliers)->with('beverages', $beverages);

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
        $this->validate($request, 
        [
            'id' => 'required',
            'beverage_name'=> 'required',
            // 'category_id'=> 'required',
            'new_quantity' => 'required',
            'total_quantity' => 'required',
            'price_case' => 'required',
            'price_solo' => 'required',
            'date_expire' => 'required',
            'badorder' => 'required'
            
           
        ]);

        $products = new Product;
        $total_quantity =  $beverage->price_case * $request->input('case') + $new_quantity;

        $category = \App\Category::findOrFail($data['category_id']); 
        $products->id = $request->input('id');
        $products->beverage_name = $request->input('beverage_name');
        // $products->category_id = $request->input('cat_name');
        $products->new_quantity = $request->input('new_quantity');
        $products->total_quantity = $request->input('total_quantity');
        $products->price_case = $request->input('price_case');
        $products->price_solo = $request->input('price_solo');
        $products->date_expire = $request->input('date_expire');
        $products->badorder = $request->input('badorder');

        $products->save();

        return redirect('/products')->with('success', 'Inserted Successfully');
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
        $products = Product::find($id);
        return view('products.show')->with('product', $products);
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
        $products = Product::find($id);
          
        //Check for correct user
        if(auth()->user()->id !==$product->user_id){
            return redirect('/products')->with('error', 'Unauthorized Page Access!');
        }


        return view('products.edit')->with('product', $products);
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
        $this->validate($request, 
        [
            'id' => 'required',
            'beverage_name'=> 'required',
            // 'category_id'=> 'required',
            'new_quantity' => 'required',
            'total_quantity' => 'required',
            'price_case' => 'required',
            'price_solo' => 'required',
            'date_expire' => 'required',
            'badorder' => 'required'
            
           
        ]);

        $products = new Product;
        $total_quantity =  $beverage->price_case * $request->input('case') + $new_quantity;

        $products->id = $request->input('id');
        $products->beverage_name = $request->input('beverage_name');
        // $products->category_id = $request->input('cat_name');
        $products->new_quantity = $request->input('new_quantity');
        $products->total_quantity = $request->input('total_quantity');
        $products->price_case = $request->input('price_case');
        $products->price_solo = $request->input('price_solo');
        $products->date_expire = $request->input('date_expire');
        $products->badorder = $request->input('badorder');

        $products->save();

        return redirect('/products')->with('success', 'Inserted Successfully');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        
        //Check for correct user
    if(auth()->user()->id !==$product->user_id){
    return redirect('/products')->with('error', 'Unauthorized Page Access!');
        }

        $product->delete();

        return redirect('/products')->with('success', 'Deleted Successfully!');
    
    }
}
