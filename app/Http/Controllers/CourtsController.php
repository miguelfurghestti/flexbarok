<?php

namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourtsController extends Controller
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

        return view('shop.courts', [
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
    public function show(Court $court)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Court $court)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Court $court)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Court $court)
    {
        //
    }
}
