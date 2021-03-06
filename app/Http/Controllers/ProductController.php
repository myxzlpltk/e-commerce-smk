<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller{

    /**
     * Search products
     *
     * @param Request $request
     */
    public function search(Request $request){
        if($request->min && $request->min < 0){
            return redirect()->route('search', [
                'q' => $request->q,
                'min' => 0,
                'max' => $request->max,
            ]);
        }
        if($request->max && $request->max < $request->min){
            return redirect()->route('search', [
                'q' => $request->q,
                'min' => $request->min,
                'max' => 0,
            ]);
        }



        try{
            $query = Product::search($request->q);
        } catch (Exception $exception){
            $query = Product::query()->where('name', 'like', "%{$request->q}%");
        }
        if ($request->min) $query->where('price_after_discount', '>=', $request->min);
        if ($request->max) $query->where('price_after_discount', '<=', $request->max);
        $products = $query->paginate(24);

        return view('products.search', [
            'products' => !empty($products) ? $products : collect(),
            'q' => $request->q,
            'min' => $request->input('min', ''),
            'max' => $request->input('max', ''),
        ]);
    }
}
