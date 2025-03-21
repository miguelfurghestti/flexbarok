<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ProductsCategorys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{

    /**
     * Display a listing of the products by category filter.
     */
    public function showByCategory($slug)
    {
        $user = Auth::user();
        $shop = $user->shop;
        // Buscar a categoria pelo slug
        $category = ProductsCategorys::where('slug', $slug)
            ->where('id_shop', $shop->id)
            ->firstOrFail();

        // Buscar produtos relacionados à categoria
        $products = Products::where('id_category', $category->id)
            ->where('id_shop', $shop->id)
            ->get();

        // Retornar a view com os dados
        return view('shop.products', compact('category', 'products'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        //
    }
}