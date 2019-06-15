<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Product;
use Auth;

class ProductController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {
        // $product = Auth::user()->product()->get();
        $product = Product::all(); 

        return response()->json([
            'status' => 'success', 
            'result' => $product
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'category' => 'required',
            'description' => 'required'
        ]);

        $product = Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description
        ]);

        return response()->json([
            'status' => 'success',
            'result' => $product
        ]);
    }

    public function show($id)
    {
        $product = Product::find($id);

        return response()->json([
            'status' => 'success',
            'result' => $product
        ]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'category' => 'required',
            'description' => 'required'
        ]);
        
        $product = Product::find($id);

        $product->update([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description
        ]);

        return response()->json([
            'status' => 'success',
            'result' => $product
        ]);
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }
}