<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beverage;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Category;
use App\Models\Delivery;

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
    public function index(Request $request)
    {
        $suppliers = Supplier::all(); 

        $categories = Category::all();
        // $deliveries = Delivery::whereDate('date_expire', '>=', now())->get();
        // $all_products = Product::all();
        //get products from delivery
        $products = [];
        
        if (isset($request->category_id) || $request->category_id != '') {
            // $category = $request->category;
            if (isset($request->search) || $request->search != '') {
                $products = Product::where(['category_id' => $request->category_id])->where('beverage_name', 'like', "%".$request->search."%")->get();
            } else {
                $products = Product::where(['category_id' => $request->category_id])->get();
            }
            
        } else {
            // $category = $categories[0]->cat_name;
            if (isset($request->search) || $request->search != '') {
                $products = Product::where('beverage_name', 'like', "%".$request->search."%")->get();
            } else {
                $products = Product::all();
            }
        }

        /* foreach ($all_products as $product) {
            $products[$product->beverage_name] = [];
            $products[$product->beverage_name][$category] = [
                'id' => $product->id,
                'quantity' => 0,
                'price_case' => $product->price_case,
                'price_solo' => $product->price_solo
            ];
        } */
        /* foreach ($deliveries as $delivery) {
            if ($delivery->category->cat_name == $category) {
                $products[$delivery->product->beverage_name][$category]['quantity'] += $delivery->quantity;
            }
        } */
        return view('beverages.index')->with('suppliers', $suppliers)
       ->with('categories',$categories)->with('products', $products)->with('category_id', $request->category_id)->with('search', $request->search);

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
            'beverage_name'=> 'required',
            'price_case' => 'required',           
        ]);

        /* $product = new Product;
        $product->beverage_name = $request->input('beverage_name');
        $product->new_quantity = 0;
        $product->total_quantity = 0;
        $product->price_solo = 0;
        $product->price_case = $request->input('price_case'); $product->save();*/

        
        $product = Product::updateOrInsert(
            ['beverage_name' => $request->input('beverage_name'), 'category_id' => $request->input('category_id')],
            [
                'price_case' => $request->input('price_case'),
                'new_quantity' => 0,
                'total_quantity' => 0,
                'price_solo' => 0
            ]
        );

        return redirect()->back()->with('success', 'Inserted Successfully');
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
        $product = Product::find($id);
        return view('beverages.edit')->with('product', $product);
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
        /* $this->validate($request, 
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

        $products->save(); */

        $this->validate($request, [
            'beverage_name'=> 'required'       ,
            'price_case'=> 'required'     
        ]);
        $product = Product::find($id);
        $product->update([
            'beverage_name' => request('beverage_name'),
            'price_case' => request('price_case'),
        ]);

        return redirect('/beverages_list')->with('success', 'Updated Successfully');
    
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
