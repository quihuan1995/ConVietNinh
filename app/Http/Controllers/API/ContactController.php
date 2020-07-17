<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use App\Contact;
class ContactController extends Controller
{
    public $successStatus = 200;

    public $errorStatus = 401;

    /**
     * tao danh sach lien he
     *
     * @return data
    */
    public function createContact(Request $request){
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
            'name' => 'required',
            'phone' => 'required',
            'comment' => 'required',
            'type' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], $this->errorStatus);
        }
        if ($request['type'] == 'edit'){
            $item = Contact::find($request["id"]);
        }else{
            $item = new Contact();
        }
        $item->name = $request["name"];
        $item->phone = $request["phone"];
        $item->comment = $request["comment"];

        $item->save();
        return response()->json(['success' => $item], $this->successStatus);
    }

    /**
     * xoa lien he theo id
     *
     * @return success || fail
    */
    public function deleteContact($idcontact)
    {
        $item = Contact::find($idcontact)->delete();
        if (!$item){
            return response()->json(['error' => "id khong ton tai"], $this->errorStatus);
        }
        return response()->json(['success' => "xoa thanh cong"], $this->successStatus);
    }

    /**
     * get all contact
     *
     * @return data
    */
    public function getContact(){
        $item = Contact::orderBy('updated_at', 'asc')->get();

        return response()->json(['success' => $item], $this->successStatus);
    }
}
