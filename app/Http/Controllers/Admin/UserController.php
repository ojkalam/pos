<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = User::where('role', 'cashier')->get();

        return view('backend.user.index', compact('categories'));    }

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
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:4',
            ]);
         $users = User::all();
         foreach ($users as $user) {
             $user = User::find($user->id);
             if ($user->email == $request->email) {
                 return redirect()->route('users.index')->withErrors('E-mail is already exists!');
             }

         }

        $category = new User;
        $category->name     = $request->name;
        $category->email    = $request->email;
        $category->password = bcrypt($request->password);
        $category->role = 'cashier';
        $category->save();

        return redirect()->route('users.index')->with('successMsg','Cashier Successfully Added !');
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
    public function edit($id)
    {
        //
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
       User::find($id)->delete();
       return redirect()->back()->with('successMsg','Cashier Successfully Deleted');
    }
}
