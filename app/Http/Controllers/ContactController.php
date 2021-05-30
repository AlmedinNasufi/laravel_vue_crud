<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function getContacts() 
    {
        $contacts = Contact::all();

        return $contacts;
    }
    public function save_contact(Request $request)
    {
        $contact = new Contact();
        
        if($request->has('image') && !empty($request->image))
        {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/gallery'), $imageName);
            $path = ("images/gallery/".$imageName);
            $contact->image = $path;
        }
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->bio = $request->bio;
        $contact->contact_no = $request->contact_no;
        $contact->designation = $request->designation;

        if($contact->save())
        {
            return response()->json([
                'status' => true,
                'message' => "Contact Added Succesfully"
            ]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => "Contact Failed To Add"
            ]);
        }
    }

    public function deleteContact($id)
    {
        $contact = Contact::findOrFail($id);

        if($contact->delete())
        {
            return response()->json([
                'status' => true,
                'message' => "Contact Deleted Succesfully"
            ]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => "Contact Failed To Delete. Please Try Again!"
            ]);
        }
    }
    public function get_contact($id)
    {
        $contact = Contact::findOrFail($id);
        return response()->json($contact);
    }
    public function update_contact(Request $request, $id)
    {
        $contact = Contact::where('id', $id)->first();
        
        if($request->has('image') && !empty($request->image))
        {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/gallery'), $imageName);
            $path = ("images/gallery/".$imageName);
            $contact->image = $path;
        }
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->bio = $request->bio;
        $contact->contact_no = $request->contact_no;
        $contact->designation = $request->designation;

        if($contact->save())
        {
            return response()->json([
                'status' => true,
                'message' => "Contact Updated Succesfully"
            ]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => "Contact Failed To Update! Try Again"
            ]);
        }
    }
}
