<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Contact;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ContactController extends Controller
{

    private function create_new_contact($request){
        $contact = new Contact;
        $contact->first_name = $request->first_name;
        $contact->last_name = $request->last_name;
        $contact->phone_number = $request->phone_number;
        $contact->email = $request->email;
        $contact->save();
    }

    public function add_contact (Request $request) {
        if(isset($request->first_name) && isset($request->phone_number)){
            $this->create_new_contact($request);
            return response()->json(["success"=>true],201);
        }else{
            return response()->json(["success"=>false],400);
        }
    }

    public function get_contacts (Request $request) {
        $contacts = Contact::all();
        return response()->json($contacts,200);
    }

    public function delete_contact (Request $request) {
        try{
            $contact = Contact::findOrFail($request->id);
            $contact->delete();
            return response()->json(["success"=>true,"message"=>"contact deleted"],200);
        }catch(ModelNotFoundException $err){
            return response()->json(["success"=>false,"message"=>"contact not found"],404);
        }
    }

    public function edit_contact (Request $request) {
        try{
            $contact = Contact::findOrFail($request->id);
            $input = $request->all();
            $contact->fill($input)->save();
            return response()->json(["success"=>true,"message"=>"updated"],200);
        }catch(ModelNotFoundException $err){
            return response()->json(["success"=>false,"message"=>"contact not found"],404);
        }
    }

}
