<?php

namespace App\Http\Controllers;

use JeroenDesloovere\VCard\VCard;
use JeroenDesloovere\VCard\VCardParser;
use Illuminate\Http\Request;


class ContactController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact = \App\Contact::orderBy('last_name')->where('creator_id', '=', auth()->user()->id)->get();
        return view('home', compact('contact'));
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
      $validatedData = $request->validate([
          'last_name' => 'required',
          'first_name' => 'required',
      ]);

      $contact->first_name = $request->input('firstName');
      $contact->last_name = $request->input('lastName');
      $contact->name = $request->input('name');
      $contact->organization = $request->input('organization');
      $contact->personal_email = $request->input('personalEmail');
      $contact->work_email = $request->input('workEmail');
      $contact->home_phone = $request->input('homePhone');
      $contact->work_phone = $request->input('workPhone');
      $contact->cell_phone = $request->input('cellPhone');
      $contact->birth_date = $request->input('birthDate');
      // $contact->image = $request->input('image');
      $contact->creator_id = \Auth::user()->id;
      $contact->save();
      // $request->session()->flash('status', 'Contact created!');
      return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $contact = \App\Contact::where('id', '=', $id)->first();

          // define vcard
          $vcard = new VCard();

          // define variables
          $lastname = 'last_name';
          $firstname = 'first_name';

          // add personal data
          $vcard->addName($lastname, $firstname);

          // add work data
          $vcard->addOrganization('organization');
          $vcard->addEmail('personal_email');
          $vcard->addEmail('work_email');
          $vcard->addPhoneNumber('home_phone', 'PREF;HOME');
          $vcard->addPhoneNumber('cell_phone', 'PREF;CELL');
          $vcard->addPhoneNumber('work_phone', 'PREF;WORK');
          $vcard->addAddress('address');

          // $vcard->addPhoto(__DIR__ . '/landscape.jpeg');

          // return vcard as a string
          // return $vcard->getOutput();

          // return vcard as a download
          return $vcard->download();

          // save vcard on disk
          // $vcard->setSavePath('/path/to/directory');
          // $vcard->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $settings = \App\SiteSettings::first();
          $contact = \App\Group::find($id);

          if ( old('_token') ) {
            $contact->first_name = old('firstName');
            $contact->last_name = old('lastName');
            $contact->name = old('name');
            $contact->organization = old('organization');
            $contact->personal_email = old('personalEmail');
            $contact->work_email = old('workEmail');
            $contact->home_phone = old('homePhone');
            $contact->work_phone = old('workPhone');
            $contact->cell_phone = old('cellPhone');
            $contact->birth_date = old('birthDate');
            // $contact->image = old('image');
      }

          $contact = \App\Contacts::find($id);
          return view('home', compact('contact'));
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
      $validatedData = $request->validate([
          'name' => 'required',
      ]);
      $contact = \App\Contacts::find($id);
      $contact->first_name = $request->input('firstName');
      $contact->last_name = $request->input('lastName');
      $contact->name = $request->input('name');
      $contact->organization = $request->input('organization');
      $contact->personal_email = $request->input('personalEmail');
      $contact->work_email = $request->input('workEmail');
      $contact->home_phone = $request->input('homePhone');
      $contact->work_phone = $request->input('workPhone');
      $contact->cell_phone = $request->input('cellPhone');
      $contact->birth_date = $request->input('birthDate');
      // $contact->image = $request->input('image');
      $contact->save();
      // $request->session()->flash('status', 'Contact created!');
      return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $contact=\App\Contact::find($id);
          $contact->delete();
          $request->session()->flash('status', 'Contact deleted!');
          return redirect()->route('/');
    }
}
