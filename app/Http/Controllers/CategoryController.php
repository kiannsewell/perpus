<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{

	public function search(Request $request, CategoryRepository $category): Object
	{
		return $category->search($request->name);
	}

}
