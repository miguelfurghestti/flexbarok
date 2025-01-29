<?php

namespace App\Http\Controllers;

use App\Models\Shops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // Verifica se o usuário tem um shop associado
        if (!$user->shop) {
            return redirect()->route('login')->withErrors(['error' => 'Você não tem acesso a um Shop.']);
        }

        // Recupera o shop associado ao usuário logado
        $shop = $user->shop;

        // Recupera os produtos e categorias vinculados ao shop
        $products = $shop->products;
        $categories = $shop->productCategories;

        return view('shop.dashboard', [
            'shop' => $shop,
            'products' => $products,
            'categories' => $categories,
        ]);
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
    public function show(Shops $shops)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shops $shops)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shops $shops)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shops $shops)
    {
        //
    }
}
