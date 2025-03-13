<?php

namespace App\Http\Controllers;

use App\Models\ProductsCategorys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsCategorysController extends Controller
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

        return view('shop.productCategories', [
            'shop' => $shop,
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
    public function show(ProductsCategorys $productsCategorys)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductsCategorys $productsCategorys)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductsCategorys $productsCategorys)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductsCategorys $productsCategorys)
    {
        //
    }
}
