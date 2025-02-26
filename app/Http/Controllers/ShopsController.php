<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Shop;
use App\Models\Tables;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

        $shop = $user->shop;

        if ($shop) {
            // Recupera os produtos e categorias vinculados ao shop
            $products = $shop->products;
            $categories = $shop->productCategories;
            $type_sell = $shop->type_sell;

            // Consulta dinamicamente a tabela correta
            $items = ($type_sell === 'mesas')
                ? Tables::where('id_shop', $shop->id)->get()
                : Orders::where('id_shop', $shop->id)->get();
        } else {
            // Define valores padrão quando o shop é null
            $products = collect(); // Coleção vazia
            $categories = collect(); // Coleção vazia
            $type_sell = null;
            $items = collect(); // Coleção vazia
        }

        return view('shop.dashboard', [
            'shop' => $shop,
            'products' => $products,
            'categories' => $categories,
            'showModal' => $showModal,
            'type_sell' => $type_sell,
            'items' => $items,
        ]);

        // Recupera o shop associado ao usuário logado

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->id_shop != NULL) {
            return redirect()->route('shop.dashboard');
        }

        //Redirecionar para a página de entrada se a pessoa já possuir um shop vinculado.
        return view('shop.create');
    }


    public function store(Request $request)
    {
        //Log::info('Início do método store', $request->all());

        $user = Auth::user();
        //Log::info('Usuário autenticado', ['user_id' => $user->id]);

        try {
            //Log::info('Validando dados...');
            $request->validate([
                'name' => 'required|string|max:255',
                'cnpj' => 'required|string|max:18',
                'phone' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'address' => 'required|string|max:255',
                'number' => 'required|string|max:10',
                'city' => 'required|string|max:100',
                'website' => 'nullable|string|max:100',
                'type_sell' => 'required|in:mesas,comandas',
            ]);
            //Log::info('Dados validados com sucesso');

            $modules = json_encode([
                'comandas',
                'quadras',
                'clientes',
                'reservas',
                'cardapio',
                'financeiro'
            ]);

            $cleanCnpj = preg_replace('/\D/', '', $request->cnpj);
            //Log::info('CNPJ limpo', ['cnpj' => $cleanCnpj]);

            //Log::info('Criando shop...');
            $shop = Shop::create([
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
            //Log::info('Shop criado', ['shop_id' => $shop->id]);

            $user->id_shop = $shop->id;
            $user->save();

            //Log::info('Usuário atualizado', ['id_shop' => $user->id_shop]);

            //Log::info('Redirecionando para dashboard');
            return redirect()->route('shop.dashboard')->with('success', 'Estabelecimento cadastrado com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao cadastrar shop', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withErrors(['error' => 'Erro ao cadastrar: ' . $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Shop $shop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shop $shop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shop $shop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        //
    }
}