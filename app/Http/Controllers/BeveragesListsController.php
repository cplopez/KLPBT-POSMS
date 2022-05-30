<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beverage;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Category;
use App\Models\Delivery;

class BeveragesListsController extends Controller
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
        
        $beverages = Beverage::all();
        $suppliers = Supplier::all(); 

        $categories = Category::all();
        // $deliveries = Delivery::whereDate('date_expire', '>=', now())->get();
        $deliveries = Delivery::all();

        //get products from delivery
        $products = [];
        foreach ($deliveries as $delivery) {
            if (!isset($products[$delivery->product->beverage_name])) {
                $products[$delivery->product->beverage_name] = [];
            }
            if (!isset($products[$delivery->product->beverage_name][$delivery->category->cat_name])) {
                $products[$delivery->product->beverage_name][$delivery->category->cat_name] = [
                    'id' => $delivery->product->id,
                    'quantity' => 0,
                    'price_case' => $delivery->product->price_case,
                    'price_solo' => $delivery->product->price_solo
                ];
            }
            $products[$delivery->product->beverage_name][$delivery->category->cat_name]['quantity'] += $delivery->quantity;
        }
        
        return view('beverages.index')->with('suppliers', $suppliers)
       ->with('category',$categories)->with('products', $products);

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
            'supplier_id' => 'required',
            'product_id' =>'required',
            'quantity' => 'required',
            'price_case' => 'required',
            'price_solo' => 'required',
            'category_id' => 'required',
            'date_expiry' => 'required',
            'badorder' => 'required'
        ]);
 
            

       if($request->input('yesno') == "isExisting") {

           $product = Product::orderByDesc('id')->where('beverage_name', $request->input('product_id'))->get()[0];
           $beverage_name = $product->beverage_name;
           $total_quantity = $product->total_quantity + ((double)$request->input('quantity'));

           $newProduct = new Product;
           $newProduct->beverage_name = $beverage_name;
           $newProduct->new_quantity = $request->input('quantity');
           $newProduct->total_quantity = $total_quantity;
           $newProduct->price_case = $request->input('price_case');
           $newProduct->price_solo = $request->input('price_solo');
           $newProduct->date_expire = $request->input('date_expiry');
           $newProduct->badorder = $request->input('badorder');
           $newProduct->save();

           $recentProduct = Product::all();
           $num = count($recentProduct) - 1;
           $product_id = $recentProduct[$num]->id;
           
           $beverage = new Beverage;
           $beverage->supplier_id = $request->input('supplier_id');
           $beverage->category_id = $request->input('category_id');
           $beverage->product_id = $product_id;
           $beverage->save();

           return redirect('/beverages_list')->with('success', 'Inserted Successfully');
       }
       else {
           $this->validate($request, [
               'newBeverageName' => 'required'
           ]);
           
           $product = new Product;
           $product->beverage_name = $request->input('newBeverageName');
           
           $product->new_quantity = $request->input('quantity');
           $product->total_quantity = $request->input('quantity');
           $product->price_case = $request->input('price_case');
           $product->price_solo = $request->input('price_solo');
           $product->date_expire = $request->input('date_expiry');
           $product->badorder = $request->input('badorder');

           $product->save();

           $recentProduct = Product::all();
           $num = count($recentProduct) - 1;
           $product_id = $recentProduct[$num]->id;
           
           $beverage = new Beverage;
           $beverage->supplier_id = $request->input('supplier_id');
           $beverage->category_id = $request->input('category_id');
           $beverage->product_id = $product_id;
           $beverage->save();

           return redirect('/beverages_list')->with('success', 'Inserted Successfully');
       }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $beverages = Beverage::find($id);
        $suppliers = Supplier::all(); 
        $category = Category::all();

        return view('beverages.show')->with('beverages', $beverages)->with('suppliers', $suppliers)
        ->with('category',$category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $beverages = Beverage::find($id);
        $suppliers = Supplier::all(); 
        $category = Category::all();

        //   //Check for correct user
        //   if(auth()->user()->id !==$beverages->user_id){
        //     return redirect('/beverages')->with('error', 'Unauthorized Page Access!');
        // }

        return view('beverages.edit')->with('beverages', $beverages)->with('suppliers', $suppliers)
        ->with('category',$category);
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
            'beverage_name'=> 'required',
            'supplier_id' => 'required',
            'quantity' => 'required',
            'price_case' => 'required',
            'price_solo' => 'required',
            'category_id' => 'required',
            'date_expire' => 'required',
            'badorder' => 'required']);

            $beverages_ids = Beverage::find($id);

           $product = Product::orderByDesc('id')->where('beverage_name', $request->input('beverage_name'))->get()[0];

           $beverage_name = $product->beverage_name;
           $total_quantity = $product->total_quantity + ((double)$request->input('quantity'));

           $newProduct = Product::find($beverages_ids->product_id);
           $newProduct->beverage_name = $beverage_name;
           $newProduct->new_quantity = $request->input('quantity');
           $newProduct->total_quantity = $total_quantity;
           $newProduct->price_case = $request->input('price_case');
           $newProduct->price_solo = $request->input('price_solo');
           $newProduct->date_expire = $request->input('date_expire');
           $newProduct->badorder = $request->input('badorder');
           $newProduct->save();

           $recentProduct = Product::all();
           $num = count($recentProduct) - 1;
           $product_id = $recentProduct[$num]->id;
           
           $beverage = Beverage::find($id);
           $beverage->supplier_id = $request->input('supplier_id');
           $beverage->category_id = $request->input('category_id');
           $beverage->product_id = $product_id;
           $beverage->save();

           return redirect('/beverages_list')->with('success', 'Inserted Successfully');
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $beverage = Beverage::find($id);

         //Check for correct user
         if(auth()->user()->id !==$beverage->user_id){
            return redirect('/beverages_list')->with('error', 'Unauthorized Page Access!');
        }

        $beverage->delete();

        return redirect('/beverages_list')->with("success","Deleted Successfuly!");
  
    }
}
