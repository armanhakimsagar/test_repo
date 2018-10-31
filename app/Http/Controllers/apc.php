<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ap;
use Validator;
use DB;
use App\Http\Resourse\CustomResourse as newCustomResourse;

class apc extends Controller
{
    public function get($id){

    	if(is_null(ap::find($id))){
    		$feedback = [
	           'status'     => "error",
	           'message'    => "data not found",
	           'data'       => null
	        ]; 
	        return $feedback;
		}else{
			$feedback = [
	           'status'     => "success",
	           'message'    => "data found",
	           'data'       => new newCustomResourse(ap::findOrFail($id))
	        ]; 
	        return $feedback;
		}
    }

    public function post(Request $request){

	    $validator = Validator::make($request->all(), [
	        
	        'name'           => 'required'
	        
	    ]);
	    if ($validator->fails()) {
	    	return response()->json($validator->errors()->toArray(),400);
	    } else {
	    		$data = $request->all();
		        return ap::create([
		            'name' => $data['name']
		        ]);
    
			    if(count($data) == 0){
			       $feedback = [
			           'status'     => "error",
			           'message'    => "insert error"
			        ]; 
			       
			    }else{
			        $feedback = [
			           'status'     => "success",
			           'message'    => "inserted successfully"
			        ]; 
			}
	    }
    }


    public function update(Request $request,$id) {

	   $poll = DB::table('aps')
	   					->where('id',$id)
	   					->update(array(
                        	'name'=>$request->name,
                        ));
	   
	   if($poll == null){
	       $feedback = [
	           'status'     => "error",
	           'message'    => "update error"
	        ]; 
	       
	    }else{
	        $feedback = [
	           'status'     => "success",
	           'message'    => "update successfully"
	        ]; 
	    }
	    
	    return $feedback;

	}


	public function delete(Request $request,$id) {

	   $poll = DB::table('aps')
	   					->where('id',$id)
	   					->delete();
	   
	   if($poll == null){
	       $feedback = [
	           'status'     => "error",
	           'message'    => "delete error"
	        ]; 
	       
	    }else{
	        $feedback = [
	           'status'     => "success",
	           'message'    => "delete successfully"
	        ]; 
	    }
	    
	    return $feedback;

	}
}
