<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProductImageRequest;
use App\Http\Requests\SaveProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ProductController extends Controller {
    private function processImage($file, $product) {
        $fileName = $product->id . '.' . $file->getClientOriginalExtension();
        $file->storeAs('products', $fileName, 'public');
        $product->image = $fileName;
    }

    public function index(Request $request) {
        if(!is_null($request->query('id'))){
            return $this->show($request);
        }

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

    public function store(SaveProductRequest $request) {
        $product = Product::create($request->safe()->all());
        $product->image = '';
        $product->save();
        return $product;
    }

    public function update(SaveProductRequest $request, $id) {
        $product = Product::findOrFail($id);

        $product->fill($request->safe()->all());
        $product->save();
        return $product;
    }

    public function editImage(EditProductImageRequest $request, $id) {
        $product = Product::findOrFail($id);

        $file = $request->file('image');
        $this->processImage($file, $product);
        $product->save();

        return response(null, 201);
    }

    public function unavailable() {
        return Product::with('category')->where('amount', 0)->limit(5)->get();
    }
}
