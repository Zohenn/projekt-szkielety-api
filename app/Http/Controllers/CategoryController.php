<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditCategoryRequest;
use App\Http\Requests\SaveCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CategoryController extends Controller
{
    public function index() {
        return view('categories.index', ['categories' => Category::withExists('products')->orderBy('id')->get()]);
    }

    public function edit(EditCategoryRequest $request, $id) {
        $category = Category::findOrFail($id);

        $category->name = $request->safe()->all()['edit-name'];
        $category->save();

        $request->session()->flash('edit-success', 'Zapisano zmiany');

        return redirect()->route('category.index');
    }

    public function save(SaveCategoryRequest $request) {
        Category::create($request->safe()->all());
        $request->session()->flash('success', 'Dodano kategorię');
        return view('categories.index', ['categories' => Category::withExists('products')->orderBy('id')->get()]);
    }

    public function remove(Request $request, $id) {
        $category = Category::withExists('products')->findOrFail($id);

        if($category->products_exists){
            throw new BadRequestHttpException;
        }

        $category->delete();

        $request->session()->flash('edit-success', 'Usunięto kategorię');

        return redirect()->route('category.index');
    }
}
