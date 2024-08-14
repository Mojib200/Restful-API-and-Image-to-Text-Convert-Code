<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Symfony\Contracts\Service\Attribute\Required;

class ApiController extends Controller
{
    
    public function userAll()
    {
        $user=User::all();
        return response()->json($user);
    }
    public function userById($id)
    {
        $user=User::find($id);
        return response()->json($user);
    }
    public function deleteById(Request $request, $id)
    {
        $user_id=User::find($id);
        $user_id->delete();
        return response()->json($user_id);
    }
    public function editById(Request $request, $id)
    {
       $validator= Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|unique:users',

        ]);
        $user_id_edit=User::find($id);
        if(  $user_id_edit){
        $user_id_edit->name=$request->name;
        $user_id_edit->email=$request->email;
        $user_id_edit->update();
        return response()->json(['success'=>'User Added Successfully']);
        }
        else{
            return  response()->json( ['NO Data Update']);
        }
     
    
    }
    public function addUser(Request $request){
       $validator= Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required'

        ]);
        if( $validator->fails()){
            return  response()->json( ['data' => $validator->errors()]);
        }
     $user=User::create($request->all());
     return response()->json(['success'=>'User Added Successfully']);
    }
}
