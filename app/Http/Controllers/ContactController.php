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

      if(count($request->files) != 0){
        $file = $request->file('vCardFile');
        $file->content = file_get_contents($file->getRealPath());
        $parser = new VCardParser($file->content);
        $vCard = $parser->getCardAtIndex(0);
        $contact->firstname = $vCard->firstname;

        if($vCard->lastname) {
          $contact->lastname = $vCard->lastname;
        }
        if(isset($vCard->organization)) {
          $contact->organization = $vCard->organization;
        }
        if(isset($vCard->home_phone)) {
          $contact->phone = current(current($vCard->home_phone));
        }
        if(isset($vCard->cell_phone)) {
          $contact->phone = current(current($vCard->cell_phone));
        }
        if(isset($vCard->work_phone)) {
          $contact->phone = current(current($vCard->work_phone));
        }
        if(isset($vCard->address)) {
          $contact->address = current(current($vCard->address));
        }
        if(isset($vCard->personal_email)) {
          $contact->email = current(current($vCard->personal_email));
        }
        if(isset($vCard->work_email)) {
          $contact->email = current(current($vCard->work_email));
        }
      }
      else {
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
    $contact->save();

    $contacts = \App\Contact::where('user_id', \Auth::user()->id)->get();
    return view('home', compact('contacts'));
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

          // add data
          if ($contact->organization) $vcard->addOrganization('organization');
          if ($contact->personal_email) $vcard->addEmail('personal_email');
          if ($contact->work_email) $vcard->addEmail('work_email');
          if ($contact->home_email) $vcard->addPhoneNumber('home_phone', 'PREF;HOME');
          if ($contact->cell_phone) $vcard->addPhoneNumber('cell_phone', 'PREF;CELL');
          if ($contact->work_phone) $vcard->addPhoneNumber('work_phone', 'PREF;WORK');
          if ($contact->address) $vcard->addAddress('address');

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
