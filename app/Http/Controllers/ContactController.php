<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkadmin');
    }

    public function contacts()
    {
        $contacts = Contact::orderBy('created_at','desc')->get();
        return view('backend.contact.index',compact('contacts'));
    }

    public function contacts_destroy ($id)
    {
        Contact::find($id)->delete();
        Toastr::error('Contact Deleted Successfully','Deleted');
        return back();
    }
}
