<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth:api');
  }

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
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    //
  }
  
  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show()
  {
    return auth('api')->user();
  }
  
  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request)
  {
    $user = auth('api')->user();

    $this->validate($request, [
      'id'        => 'required|numeric|unique:users,id,' . $user->id,
      'name' => ['required', 'string', 'min:3', 'max:60'],
      'email'     => 'required|email|unique:users,email,' . $user->id,
      'address' => ['required', 'string', 'min:3', 'max:80'],
      'birthdate' => ['required', 'date'],
      'city' => ['required', 'min:3', 'max:40']
    ]);

    $user->update([
      'name' => request('name'),
      'email' => request('email'),
      'address' => request('address'),
      'city' => request('city'),
    ]);
    
    return ['message' => 'Success'];
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
}
