<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\Delivery;
use App\Models\Inventory;

use Illuminate\Http\Request;
class LoginController extends Controller

{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){

        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(auth()->attempt(array('email'=>$input['email'],'password'=>$input['password']))){
            if (auth()->user()->status == 0) {
                Session::flush();
                Auth::logout();
                return redirect()->route('login')->with('error','Input proper email or password.');
            }
            if(auth()->user()->is_admin ==1){
            //  return redirect()->route('admin.home');
                $exp_deliveries = Delivery::where('new_quantity', '>', 0)->whereDate('date_expire', '<=', now())->where('badorder', 0)->get();
                foreach ($exp_deliveries as $delivery) {
                    $product = $delivery->product;
                    $old_quantity = $product->total_quantity;
                    $product->total_quantity -= $delivery->new_quantity;
                    $new_quantity = $product->total_quantity;
                    $product->save();
                    Inventory::create([
                        'order_id' => 1,
                        'old_quantity' => $old_quantity,
                        'new_quantity' => $new_quantity,
                        'product_id' => $product->id,
                        'quantity' => $delivery->new_quantity,
                        'badorder' => 1,
                    ]);
                    $delivery->badorder = 1;
                    $delivery->save();
                }
                return redirect('dashboard');
            }else{
                $exp_deliveries = Delivery::where('new_quantity', '>', 0)->whereDate('date_expire', '<=', now())->where('badorder', 0)->get();
                foreach ($exp_deliveries as $delivery) {
                    $product = $delivery->product;
                    $old_quantity = $product->total_quantity;
                    $product->total_quantity -= $delivery->new_quantity;
                    $new_quantity = $product->total_quantity;
                    $product->save();
                    Inventory::create([
                        'order_id' => 1,
                        'old_quantity' => $old_quantity,
                        'new_quantity' => $new_quantity,
                        'product_id' => $product->id,
                        'quantity' => $delivery->new_quantity,
                        'badorder' => 1,
                    ]);
                    $delivery->badorder = 1;
                    $delivery->save();
                }
                return redirect('purchase');
            }
        }else{
                return redirect()->route('login')->with('error','Input proper email or password.');
        }
    }
}
