<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProductRequest;
use App\Http\Requests\SaveProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ProductController extends Controller {
    private function processImage($file, $product) {
        $fileName = $product->id . '.' . $file->getClientOriginalExtension();
        $file->storeAs('products', $fileName, 'public');
        $product->image = $fileName;
    }

    public function index(Request $request) {
        $categoryIds = $request->query('category');
        $availability = $request->query('availability');
        $products = Product::with('category');
        if(!empty($categoryIds)){
            $products = $products->whereIn('category_id', $categoryIds);
        }
        if(!empty($availability)){
            if($availability === 'available'){
                $products = $products->where('amount', '>', 0);
            } else if($availability === 'unavailable'){
                $products = $products->where('amount',0);
            }
        }

        $sortOptions = ['price', 'amount'];
        $sort = $request->query('sort');
        $sortDir = $request->query('sort_dir') === 'desc' ? 'desc' : 'asc';
        if(in_array($sort, $sortOptions)){
            $products = $products->orderBy($sort, $sortDir);
        }

        $products = $products->paginate(10);
//        if (Auth::user() && Auth::user()->admin) {
//            return view('products.admin', ['products' => $products, 'categories' => Category::all()]);
//        }
        return $products;
    }

    public function show(Request $request, ?int $id = null) {
        if($id){
            return Product::findOrFail($id);
        }

        $ids = $request->query('id');
        if(!is_array($ids)){
            throw new BadRequestHttpException();
        }

        return Product::whereIn('id', $ids)->get();
    }

    public function add() {
        $categories = Category::all();
        return view('products.add', ['categories' => $categories]);
    }

    public function save(SaveProductRequest $request) {
        $categories = Category::all();

        $file = $request->file('image');

        $product = Product::create($request->safe()->all());
        $this->processImage($file, $product);
        $product->save();
        $request->session()->flash('success', 'Dodano produkt do bazy');
        return view('products.add', ['categories' => $categories]);
    }

    public function edit(Request $request, $id) {
        $product = Product::findOrFail($id);

        $categories = Category::all();
        return view('products.add', ['categories' => $categories, 'product' => $product]);
    }

    public function saveEdit(EditProductRequest $request, $id) {
        $product = Product::findOrFail($id);

        $product->fill($request->safe()->all());
        if($file = $request->file('image')){
            $this->processImage($file, $product);
        }
        $product->save();
        $request->session()->flash('success', 'Zapisano zmiany');

        $categories = Category::all();
        return view('products.add', ['categories' => $categories, 'product' => $product]);
    }

    public function unavailable() {
        return Product::with('category')->where('amount', 0)->limit(5)->get();
    }
}
