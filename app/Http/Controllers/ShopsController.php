<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Shops;
use App\Models\Tables;
use App\Models\User;
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

        //Verifica se o usuário não tem shop vinculado
        $showModal = is_null($user->id_shop);

        // Verifica se o usuário tem um shop associado
        if (!$user->shop) {
            return redirect()->route('login')->withErrors(['error' => 'Você não tem acesso a um Shop.']);
        }

        // Recupera o shop associado ao usuário logado
        $shop = $user->shop;

        // Recupera os produtos e categorias vinculados ao shop
        $products = $shop->products;
        $categories = $shop->productCategories;

        $type_sell = $shop->type_sell;
        // Consulta dinamicamente a tabela correta
        $items = ($type_sell === 'mesas')
            ? Tables::where('id_shop', $shop->id)->get()
            : Orders::where('id_shop', $shop->id)->get();


        return view('shop.dashboard', [
            'shop' => $shop,
            'products' => $products,
            'categories' => $categories,
            'showModal' => $showModal,
            'type_sell' => $type_sell,
            'items' => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        if (!$user->shop) {
            return redirect()->route('login')->withErrors(['error' => 'Você não tem acesso a um Shop.']);
        }

        return view('shop.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'cnpj' => 'required|string|max:18',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'number' => 'required|string|max:10',
            'city' => 'required|string|max:100',
            'website' => 'nullable|url',
            'type_sell' => 'required|in:mesas,comandas',
        ]);

        $modules = json_encode([
            'comandas',
            'quadras',
            'clientes',
            'reservas',
            'cardapio',
            'financeiro'
        ]);

        $cleanCnpj = preg_replace('/\D/', '', $request->cnpj);

        $shop = Shops::create([
            'name' => $request->name,
            'user' => $user->id,
            'cnpj' => $cleanCnpj,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'number' => $request->number,
            'city' => $request->city,
            'website' => $request->website,
            'type_sell' => $request->type_sell,
            'modules' => $modules,
        ]);


        $user->id_shop = $shop->id;
        $user->save();

        return redirect()->route('shop.dashboard')->with('success', 'Estabelecimento cadastrado com sucesso!');
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
