<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Beverage;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Order;
use App\Models\Product;
use App\Models\CustomerSale;
use App\Models\Delivery;

class InventoryController extends Controller
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
        // $getOrderRecentOrderNumber = DB::select('SELECT * FROM orders ORDER BY id DESC');
        
        // $orderID = $getOrderRecentOrderNumber[0]->id;


        // $orderNumber = $getOrderRecentOrderNumber[0]->order_number + 1;

        $inventories = Inventory::all();
        $all_products = Product::all();

       $customer_sales = CustomerSale::all();
        $order_ids = $customer_sales->pluck('order_id');
        
        $purchases = Purchase::whereIn('order_id', $order_ids)->get();
        
        $categories = Category::all();
        $deliveries = Delivery::all();

        //initialized
        foreach ($all_products as $product) {
            $products[$product->beverage_name] = [];
            foreach ($categories as $category) {
                $products[$product->beverage_name][$category->cat_name] = [
                    'id' => $product->id,
                    'quantity' => 0,
                    'price_case' => $product->price_case,
                    'price_solo' => $product->price_solo
                ];
            }
        }
        foreach ($deliveries as $delivery) {
            $products[$delivery->product->beverage_name][$delivery->category->cat_name]['quantity'] += $delivery->quantity;
        }
        
        //remove some quantity from purchase
        foreach ($purchases as $purchase) {
            $products[$purchase->product->beverage_name][$purchase->category->cat_name]['quantity'] -= $purchase->quantity;
        }
        
        return view('inventories.index')->with('inventories', $inventories)->with('products', $products)->with('categories',$categories);
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
    //     $this->validate($request, [
    //         'supplier_id' => 'required',
    //         'product_id' =>'required',
    //         'quantity' => 'required',
    //         'price_case' => 'required',
    //         'price_solo' => 'required',
    //         'category_id' => 'required',
    //         'date_expiry' => 'required',
    //         'badorder' => 'required']);


    //    if($request->input('yesno') == "isExisting") {

    //        $product = Product::orderByDesc('id')->where('beverage_name', $request->input('product_id'))->get()[0];
    //        $beverage_name = $product->beverage_name;
    //        $total_quantity = $product->total_quantity + ((double)$request->input('quantity'));

    //        $inventories = new Inventory;
    //        $inventories->beverage_name = $beverage_name;
    //        $inventories->new_quantity = $request->input('quantity');
    //        $inventories->total_quantity = $total_quantity;
    //        $inventories->price_case = $request->input('price_case');
    //        $inventories->price_solo = $request->input('price_solo');
    //        $inventories->date_expire = $request->input('date_expiry');
    //        $inventories->badorder = $request->input('badorder');
    //        $inventories->save();

    //        $recentProduct = Product::all();
    //        $num = count($recentProduct) - 1;
    //        $product_id = $recentProduct[$num]->id;
           
    //        $beverage = new Beverage;
    //        $beverage->supplier_id = $request->input('supplier_id');
    //        $beverage->beverage_id = $request->input('beverage_id');
    //        $beverage->category_id = $request->input('category_id');
    //        $beverage->product_id = $product_id;
    //        $beverage->save();

    //        return redirect('/inventories')->with('success', 'Inserted Successfully');
    //    }
    //    else {
    //        $this->validate($request, [
    //            'newBeverageName' => 'required'
    //        ]);
           
    //        $product = new Product;
    //        $product->beverage_name = $request->input('newBeverageName');
           
    //        $product->new_quantity = $request->input('quantity');
    //        $product->total_quantity = $request->input('quantity');
    //        $product->price_case = $request->input('price_case');
    //        $product->price_solo = $request->input('price_solo');
    //        $product->date_expire = $request->input('date_expiry');
    //        $product->badorder = $request->input('badorder');

    //        $product->save();

    //        $recentProduct = Product::all();
    //        $num = count($recentProduct) - 1;
    //        $product_id = $recentProduct[$num]->id;
           
    //        $beverage = new Beverage;
    //        $beverage->supplier_id = $request->input('supplier_id');
    //        $beverage->category_id = $request->input('category_id');
    //        $beverage->product_id = $product_id;
    //        $beverage->save();

    //        return redirect('/inventories')->with('success', 'Inserted Successfully');
    //    }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $inventories = Inventory::find($id);
        // $beverages = Beverage::all();
        // $suppliers = Supplier::all(); 
        // $category = Category::all();

        // return view('inventories.show')->with('inventories', $inventories)->with('suppliers', $suppliers)
        // ->with('category',$category);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $inventories = Inventory::find($id);
        // $beverages = Beverage::all();
        // $suppliers = Supplier::all(); 
        // $category = Category::all();

        // return view('inventories.edit')->with('inventories', $inventories)->with('suppliers', $suppliers)
        // ->with('category',$category);
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
        // $this->validate($request, [
        //     'beverage_name'=> 'required',
        //     'supplier_id' => 'required',
        //     'quantity' => 'required',
        //     'price_case' => 'required',
        //     'price_solo' => 'required',
        //     'category_id' => 'required',
        //     'date_expiry' => 'required',
        //     'badorder' => 'required']);

        //     $beverages = Beverage::find($id);

        // $beverages->beverage_name = $request->input('beverage_name');
        // $beverages->supplier_id = $request->input('supplier_id');
        // $beverages->category_id = $request->input('category_id');
        // $beverages->quantity = $request->input('quantity');
        // $beverages->price_case = $request->input('price_case');
        // $beverages->price_solo = $request->input('price_solo');
        // $beverages->date_expiry = $request->input('date_expiry');
        // $beverages->barorder = $request->input('badorder');
      

        // $beverages->save();

        // return redirect('/inventories')->with('success', 'Updated Successfully');
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $customer = Customer::find($id);
        // $customer->delete();

        // return redirect('/customers')->with('success', 'Deleted Successfully!');
  
    }
}
