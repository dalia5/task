<?php

namespace App\Http\Controllers;

use App\Bloode;
use App\User;
use Illuminate\Http\Request;
use Mail;

use Validator; 
class BloodeController extends Controller
{
       public $successStatus = 200;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

   $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'phone' =>'required',
            'blood_type'=>'required',
            'country'=>'required',
            'description'=>'required',
           
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all(); 
        $blood = Bloode::create($input); 
       $users= User::where('blood_type' ,$request->blood_type)->get();
       $this->emailNotification($users);
       return response()->json(['success'=>$blood], $this-> successStatus); 


    }

     public function emailNotification($users)
    {

    foreach ($users as $one ) {
        # code...
        try{
      Mail::send('welcome', ['user' => $one], function ($m) use ($one) {
            $m->from('hello@app.com', 'Your Application');

            $m->to($one->email, $one->name)->subject('Your Reminder!');
        });            
        }catch(\Exception $e){

        }

        }
    }

        # code...
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Bloode  $bloode
     * @return \Illuminate\Http\Response
     */
    public function show(Bloode $bloode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bloode  $bloode
     * @return \Illuminate\Http\Response
     */
    public function edit(Bloode $bloode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bloode  $bloode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bloode $bloode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bloode  $bloode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bloode $bloode)
    {
        //
    }
}
