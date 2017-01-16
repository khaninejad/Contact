<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Contact;
use App\Notifications\MessageReceived;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact');
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
     'telephone' => 'required|integer',
     'email' => 'required|email',
     'enquiry_details' => 'required',
      ]);
      if ($validator->fails()) {
          return redirect()
          ->back()
                          ->withErrors($validator)
                          ->withInput();
          }
    $contact=Contact::firstOrCreate([
            'name'=>$request->name,
            'telephone'=>$request->telephone,
            'email'=>$request->email,
            'enquiry_details'=>$request->enquiry_details,
            ]);
    $contact->notify((new MessageReceived($contact)));
    return redirect('contact')->with('status', 'Thank you for contacting us. You are very important to us.');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contact::destroy($id);
          return redirect('home')->with('status', 'Successfully deleted!');
    }
}
