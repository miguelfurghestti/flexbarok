<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Reservations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationsController extends Controller
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

        return view('shop.reservations', [
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
    public function show(Reservation $reservations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservations)
    {
        //
    }
}
