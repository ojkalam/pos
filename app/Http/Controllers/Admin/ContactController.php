<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = [];
        $contact_type = '';
        $auto_cont_id = '';

        $contact_type = request('type');

        $contacts = Contact::where('type', $contact_type)->orderBy('id','desc')->get();

        if ($contact_type == 'customer') {
            $prefix = 'CUS';  
        }else{
            $prefix = 'SUP';
        }

        $last_cont_id = Contact::orderBy('id','desc')->take(1)->get();
        $ref_count    =  $last_cont_id[0]['id']+1;

        $auto_cont_id = $this->generateContactId($ref_count, $prefix);

        return view('backend.contact.index', compact(['contacts', 'contact_type','auto_cont_id']));

    }

    //generate contact id
    //
    public function generateContactId ($ref_count, $prefix)
    {

        $ref_digits =  str_pad($ref_count, 4, 0, STR_PAD_LEFT);

        $cont_id = $prefix ."-". $ref_digits;

        return $cont_id;
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
                'type'          => 'required',
                'contact_name'          => 'required',
                'contact_id'    => 'required'
            ]);

        $ct = Contact::where('contact_id', $request->contact_id)->get();

        if (count($ct) > 0) {
            return redirect()->action('Admin\ContactController@index',['type' => $request->type])->withErrors($request->type.' ID is already exists!');
        }

        $contact = new Contact;
        $contact->type         = $request->type;
        $contact->name         = $request->contact_name;
        $contact->contact_id   = $request->contact_id;
        
        if ($request->email){
           $contact->email  = $request->email;
        }
        if ($request->phone){
           $contact->phone  = $request->phone;
        }
        if ($request->country){
           $contact->country  = $request->country;
        }
        if($request->city)
            $contact->city                   = $request->city;
        if ($request->notes){
           $contact->notes  = $request->notes;
        }
       
        $contact->save();

        return redirect()->action('Admin\ContactController@index',['type' => $request->type])->with('successMsg','Contact Successfully Saved');
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
        $contact = Contact::find($id);

        return view('backend.contact.edit', compact('contact'));
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
            ]);

        $contact = Contact::find($id);
        $contact->name         = $request->contact_name;
        
        if ($request->email){
           $contact->email  = $request->email;
        }
        if ($request->phone){
           $contact->phone  = $request->phone;
        }
        if ($request->country){
           $contact->country  = $request->country;
        }
        if($request->city)
            $contact->city                   = $request->city;

        $contact->save();

        return redirect()->action('Admin\ContactController@index',['type' => 'customer'])->with('successMsg','Contact Successfully Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);

        $contact->delete();

        return redirect()->back()->with('successMsg','Contact Successfully Delete');
    }
}
