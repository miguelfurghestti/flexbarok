<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        //Verifica se o usuário não tem shop vinculado
        $showModal = is_null($user->id_shop);

        // Verifica se o usuário tem um shop associado
        if (!$user->shop) {
            return redirect()->route('login')->withErrors(['error' => 'Você não tem acesso a um Shop.']);
        }

        // Recupera o shop associado ao usuário logado
        $shop = $user->shop;

        return view('shop.customers', [
            'shop' => $shop,
            'showModal' => $showModal,
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
    public function show(Customers $customers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customers $customers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customers $customers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customers $customers)
    {
        //
    }
}