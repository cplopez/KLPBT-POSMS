<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MOP;

class ModeofPaymentController extends Controller
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
       $mops = MOP::all();

        return view('m_o_p_s.index')->with('mops', $mops);

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
            'mode' => 'required']);

        $mop = new MOP;
        $mop->mode = $request->input('mode');
        $mop->save();

        return redirect('/mops')->with('success', 'Inserted Successfully');
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $mop = MOP::find($id);
        return view('m_o_p_s.show')->with('mop', $mop);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mop = MOP::find($id);
        
             
        // //Check for correct user
        // if(auth()->user()->id !==$mop->user_id){
        //     return redirect('/m_o_p_s')->with('error', 'Unauthorized Page Access!');
        // }

        return view('m_o_p_s.edit')->with('mop', $mop);
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
            'mode' => 'required'
                                 ]);

        $mop = MOP::find($id);
        $mop->mode = $request->input('mode');
       

        $mop->save();

        return redirect('/mops')->with('success', 'Updated Successfully');
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mop = MOP::find($id);

         //Check for correct user
         if(auth()->user()->id !==$mop->user_id){
            return redirect('/m_o_p_s')->with('error', 'Unauthorized Page Access!');
        }

        $mop->delete();

        return redirect('/mops')->with('success', 'Deleted Successfully!');
    
    }
}
