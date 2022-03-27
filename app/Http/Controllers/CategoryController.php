<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request) {
        if($request->query('with_exists')){
            return Category::withExists('products')->orderBy('id')->get();
        }
        return Category::orderBy('id')->get();
//        return view('categories.index', ['categories' => Category::withExists('products')->orderBy('id')->get()]);
    }

    public function update(SaveCategoryRequest $request, $id) {
        $category = Category::findOrFail($id);

        $category->name = $request->input('name');
        $category->save();

        return response()->json($category);
    }

    public function store(SaveCategoryRequest $request) {
        $name = $request->input('name');
        if(!is_null(Category::where('name', '=', $name)->first())){
            return response()->json([
                'message' => "Kategoria $name już istnieje."
            ], 422);
        }
        $category = Category::create($request->safe()->all());
        return $category;
    }

    public function destroy(Request $request, $id) {
        $category = Category::withExists('products')->findOrFail($id);

        if($category->products_exists){
            return response()->json([
                'message' => 'Nie można usunąć kategorii z przypisanymi produktami'
            ], 422);
        }

        $category->delete();

        return response(null, 204);
    }
}
