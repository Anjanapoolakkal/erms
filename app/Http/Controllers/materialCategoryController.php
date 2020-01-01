<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Faceades\Storage;
use App\materialCategory;
use DB;

class materialCategoryController extends Controller
{
   public function material_category(Request $request){
   	$id_exists = materialCategory::where('categoryId', $request-> input('categoryId'))->orWhere('categoryName',$request->input('categoryName'))->first();
   	if ($id_exists === null) {
   		$category = new materialCategory();
   	 	$category-> categoryId = $request->input('categoryId');
		$category-> categoryName = $request->input('categoryName');
		$category-> userID = $request->input('userID');
		$category->save();
		if ($category -> id > 0) {
				$response = [
					"status" => 1,
					"msg" => "new category created"
				];
				return response()->json($response);
			} else {
				$response = [
					"status" => 0,
					"msg" => "failed to create new category"
				];
				return response()->json($response);
			}

		} else {
			$response = [
				"status" => 0,
				"msg" => "Category already exists"
			];
			return response()->json($response);
		}
   } 
}