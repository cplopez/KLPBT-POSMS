<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\CustomerSale;
use App\Models\Purchase;
use App\Models\Inventory;
use App\Models\Delivery;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExlExport;

class CustomerSalesController extends Controller
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

        if ((isset($request->date_start) && $request->date_start != '') && (isset($request->date_end) && $request->date_end != '')) {
            $date_end = new Carbon($request->date_end);
            $customerSale = CustomerSale::whereBetween('created_at', [$request->date_start, $date_end->addDays(1)])->get();
        } else {
            $customerSale = CustomerSale::all();
        }
        return view('customersales.index')->with('customerSale', $customerSale)->with('request', $request)->with(['sales_ids' => $customerSale->pluck('id')]);
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
            'customer_id' => 'required',
            'mop_id' => 'required',
            'amount' => 'required',
            'discount'=> 'required',
            'total_cash' => 'required',
            'cash' => 'required',
            'change' => 'required'
        ]); 

        if (request('change') < 0) {
            return back()->with('error', 'Not Enough Cash');
        }

        $purchases = Purchase::where(['order_id' => $request->order_number])->get();
        $customer_sales = CustomerSale::create([
            'user_id' => Auth::user()->id,
            'customer_id' => request('customer_id'),
            'order_id' => $request->order_number,
            'm_o_p_id' => request('mop_id'),
            'amount' => request('amount'),
            'discount'=> request('discount'),
            'total_cash' => request('total_cash'),
            'check_num' => 'N/A',
            'bankname' => 'N/A',
            'check_amount' => 0,
            'check_date' => now(),
            'total_quantity' => $purchases->sum('quantity'),
        ]);

        
        foreach ($purchases as $purchase) {
            $product = $purchase->product;

            $old_quantity = $product->total_quantity;

            $product->total_quantity -= $purchase->quantity;

            $new_quantity = $product->total_quantity;

            $product->save();

            $deliveries = Delivery::where(['product_id' => $product->id])->where('new_quantity', '>', 0)->whereDate('date_expire', '>', now())->orderBy('date_expire', 'desc')->get();
            $quantity_purchase = $purchase->quantity;
            foreach ($deliveries as $delivery) {
                if ($delivery->new_quantity < $quantity_purchase) {
                    $quantity_purchase -= $delivery->new_quantity;
                    $delivery->new_quantity = 0;
                    $delivery->save();
                } else {
                    $delivery->new_quantity -= $quantity_purchase;
                    $delivery->save();
                    break;
                }
            }

            Inventory::create([
                'order_id' => $request->order_number,
                'old_quantity' => $old_quantity,
                'new_quantity' => $new_quantity,
                'product_id' => $product->id,
                'quantity' => $purchase->quantity,
                'badorder' => 0,
            ]);
        }
        /* if($request->input('mop') === 'Cash')
        {
            $this->validate($request, [
                'total_quantity' => 'required',
                'customer_name' => 'required',
                'amount_due' => 'required',
                'discount'=> 'required',
                'cash' => 'required',
                'change' => 'required'
            ]); 
        }
        else {
            $this->validate($request, [
                'total_quantity' => 'required',
                'customer_name' => 'required',
                'amount_due' => 'required',
                'postDate'=> 'required',
                'checkNumber' => 'required',
                'bankName' => 'required',
                'checkAmount' => 'required'
            ]); 
        } */

        // return $request->input('mop_id');

        /* $customerSale = new CustomerSale;
        $customerSale->customer_id = $request->input('customer_id');
        $customerSale->m_o_p_id = $request->input('m_o_p_id');
        $customerSale->amount = $request->input('amount_due');
        $customerSale->total_quantity = $request->input('total_quantity');
        $current_date = date('Y-m-d H:i:s'); */

        // return $current_date;

        /* if($request->input('mop') === 'Cash'){
            $customerSale->discount = $request->input('discount');
            $customerSale->total_cash = $request->input('cash');
            $customerSale->check_num ="N/A";
            $customerSale->check_date = $current_date;
            $customerSale->bankname = "N/A";
            $customerSale->check_amount = 0;
        }
        else {
            $customerSale->discount = 0;
            $customerSale->total_cash = 0;
            $customerSale->check_num = $request->input('checkNumber');
            $customerSale->check_date = $request->input('postDate');
            $customerSale->bankname = $request->input('bankName');
            $customerSale->check_amount = $request->input('checkAmount');
        } */

        // $customerSale->save();

        // Purchase::query()->truncate();
        // Purchase::where(['order_id' => $request->order_number])->delete();

        return redirect('/purchase')->with('Cash Payment Method Inserted Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customerSale = CustomerSale::find($id);
        return view('customersales.show')->with('customerSale', $customerSale);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customerSale = CustomerSale::find($id);

        //   //Check for correct user
        //   if(auth()->user()->id !==$customerSale->user_id){
        //     return redirect('/customersales')->with('error', 'Unauthorized Page Access!');
        // }
        return view('customersales.edit')->with('customerSale', $customerSale);
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
        $customer = Customer::find($id);

         //Check for correct user
         if(auth()->user()->id !==$customerSale->user_id){
            return redirect('/customersales')->with('error', 'Unauthorized Page Access!');
        }
        
        $customer->delete();

        return redirect('/customers')->with('success', 'Deleted Successfully!');
    }

    public function export(Request $request) {

        $sales = CustomerSale::whereIn('id', json_decode($request->sales_ids))->get();
        $results = [];
        $results[] = ['Customer Sales', 'Date From', 'Date To', 'Total Transactions', 'Grand Total Sales'];
        $results[] = [' ', ($request->date_start ?? '-'), ($request->date_end ?? '_'), $sales->count(),  $sales->sum('total_cash')];
        $results[] = ['Cashier Name', 'Customer Name', 'Mode of Payment', 'Ammount Due', 'Discount', 'Total Quantity', 'Total Cash', 'Date Sales'];
        foreach ($sales as $sale) {
            $results[] = [
                $sale->user->name,
                $sale->customer->name,
                $sale->m_o_p->mode,
                $sale->amount,
                $sale->discount,
                $sale->total_quantity,
                $sale->total_cash,
                $sale->created_at,
            ];
        }

        return Excel::download(ExlExport::new($results), "Deliveries-" . ($request->date_start ?? '-').'to'.($request->date_end ?? '_') . '.xlsx');
    }
}
