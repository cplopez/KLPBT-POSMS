<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Product;
use App\Models\Inventory;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

use App\Exports\ExlExport;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $suppliers = Supplier::all();
        $products = Product::all();
        $categories = Category::all();
        if ((isset($request->date_start) && $request->date_start != '') && (isset($request->date_end) && $request->date_end != '')) {
            $date_end = new Carbon($request->date_end);
            $deliveries = Delivery::whereBetween('created_at', [$request->date_start, $date_end->addDays(1)])->get();
        } else {
            $deliveries = Delivery::all();
        }

        return view('deliveries.index')->with([
            'deliveries' => $deliveries , 
            'suppliers' => $suppliers, 
            'categories' => $categories, 
            'products' => $products, 
            'request' => $request,
            'delivery_ids' => $deliveries->pluck('id')
        ]);
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
            'or_number' => 'required',
            'supplier_id' => 'required',
            'product_id' =>'required',
            'quantity' => 'required',
            'price' => 'required',
            // 'category_id' => 'required',
            'date_expire' => 'required'
        ]);
        $delivery = Delivery::create([
            'or_number' => request('or_number'),
            'supplier_id' => request('supplier_id'),
            'product_id' =>request('product_id'),
            'quantity' => request('quantity'),
            'price' => request('price'),
            // 'category_id' => request('category_id'),
            'date_expire' => request('date_expire')
        ]);

        $product = $delivery->product;

        $old_quantity = $product->total_quantity;
        $product->total_quantity += request('quantity');
        $product->save();

        Inventory::create([
            'order_id' => 0,
            'old_quantity' => $old_quantity,
            'new_quantity' => $product->total_quantity,
            'product_id' => $product->id,
            'quantity' => request('quantity'),
            'badorder' => 0,
        ]);
        
        return redirect()->back();

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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Delivery $delivery)
    {
        $suppliers = Supplier::all(); 
        $categories = Category::all();
        $products = Product::all();

        return view('deliveries.edit')->with('delivery', $delivery)->with('suppliers', $suppliers)
        ->with('categories',$categories)->with('products', $products);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Delivery $delivery)
    {
        $this->validate($request, [
            'or_number' => 'required',
            'supplier_id' => 'required',
            'product_id' =>'required',
            'quantity' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'date_expire' => 'required'
        ]);
        
        $delivery->update([
            'or_number' => request('or_number'),
            'supplier_id' => request('supplier_id'),
            'product_id' =>request('product_id'),
            'quantity' => request('quantity'),
            'price' => request('price'),
            'category_id' => request('category_id'),
            'date_expire' => request('date_expire')
        ]);

        return redirect(route('deliveries.index'));
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

    public function export(Request $request) {

        $deliveries = Delivery::whereIn('id', json_decode($request->delivery_ids))->get();
        $results = [];
        $results[] = ['Deliveries', 'Date From', 'Date To', 'Total Delivery', 'Total Cost'];
        // $results[] = ['Deliveries', 'Date From', 'Date To', 'Key Search'];
        $results[] = [' ', ($request->date_start ?? '-'), ($request->date_end ?? '_'), $deliveries->count(), $deliveries->sum('price')];
        $results[] = ['OR Number', 'Beverage Name', 'Supplier', 'Quantity', 'Price', 'Category', 'Date Added', 'Expiry Date'];
        foreach ($deliveries as $delivery) {
            $results[] = [
                $delivery->or_number,
                $delivery->product->beverage_name,
                $delivery->supplier->name,
                $delivery->quantity,
                $delivery->price,
                $delivery->product->category->cat_name,
                $delivery->created_at,
                $delivery->date_expire
            ];
        }

        return Excel::download(ExlExport::new($results), "Deliveries-" . ($request->date_start ?? '-').'to'.($request->date_end ?? '_') . '.xlsx');
    }
}
