<div class="p-6">
    <!-- Header -->
    <div class="flex flex-row justify-between items-center mb-6">
        <div class="flex flex-row items-center gap-6">
            <h1 class="text-white text-2xl font-['Open Sans']">Comandas</h1>
            
            <!-- Filtros Rápidos -->
            <div class="flex flex-row gap-3">
                <button wire:click="filterByStatus('open')" 
                        class="px-3 py-1 rounded-full text-sm font-medium transition-all duration-200 
                               @if($quickStatusFilter === 'open') bg-pgreen text-black @else bg-zinc-800 text-zinc-300 hover:bg-zinc-700 @endif">
                    Abertas ({{ $openCount }})
                </button>
                <button wire:click="filterByStatus('closed')" 
                        class="px-3 py-1 rounded-full text-sm font-medium transition-all duration-200 
                               @if($quickStatusFilter === 'closed') bg-pgreen text-black @else bg-zinc-800 text-zinc-300 hover:bg-zinc-700 @endif">
                    Fechadas ({{ $closedCount }})
                </button>
                <button wire:click="filterByStatus('cancelled')" 
                        class="px-3 py-1 rounded-full text-sm font-medium transition-all duration-200 
                               @if($quickStatusFilter === 'cancelled') bg-pgreen text-black @else bg-zinc-800 text-zinc-300 hover:bg-zinc-700 @endif">
                    Canceladas ({{ $cancelledCount }})
                </button>
                @if($quickStatusFilter)
                    <button wire:click="clearQuickFilter" 
                            class="px-3 py-1 rounded-full text-sm font-medium bg-red-400 text-black hover:bg-red-300 transition-all duration-200">
                        Limpar Filtro
                    </button>
                @endif
            </div>
        </div>
        
        <button wire:click="openNewOrder" class="bg-pgreen flex flex-row gap-2 px-3 py-2 rounded-full items-center font-['Open Sans'] font-bold text-sm select-none">
            Nova Comanda
        </button>
    </div>

    <!-- Filtros -->
    <div class="bg-zinc-900 rounded-lg shadow-sm p-4 mb-6">
        <div class="flex flex-row items-center justify-between gap-4">
            <div class="text-white text-sm font-['Open Sans']">
                Buscar:
            </div>
            <div class="flex-1">
                <input wire:model.live="search" type="text" placeholder="Nome do cliente ou número da comanda" class="w-full px-3 py-2 border border-zinc-700 rounded-md focus:outline-none focus:ring-2 focus:ring-pgreen bg-zinc-800 text-white placeholder-zinc-400">
            </div>
            <div>
                <button wire:click="loadOrders" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                    Atualizar
                </button>
            </div>
        </div>
    </div>

    <!-- Grid de Comandas -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($orders as $order)
            <div class="bg-zinc-900 rounded-lg shadow-sm border border-zinc-700 p-4 hover:shadow-md transition-shadow duration-200">
                <div wire:click="openOrder({{ $order->id }})" class="cursor-pointer">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            <h3 class="font-semibold text-white text-lg">{{ $order->order_owner_name }}</h3>
                            <p class="text-sm text-zinc-400">{{ $order->order_number }}</p>
                        </div>
                        <span class="px-2 py-1 text-xs font-medium rounded-full 
                            @if($order->status === 'open') bg-pgreen text-black
                            @elseif($order->status === 'closed') bg-gray-500 text-white
                            @else bg-red-400 text-black @endif">
                            @if($order->status === 'open') Aberta
                            @elseif($order->status === 'closed') Fechada
                            @else Cancelada @endif
                        </span>
                    </div>
                    
                    <div class="space-y-2 text-sm text-zinc-400">
                        <p>Aberta em: {{ $order->opened_at ? $order->opened_at->format('d/m/Y H:i') : 'N/A' }}</p>
                        @if($order->closed_at)
                            <p>Fechada em: {{ $order->closed_at->format('d/m/Y H:i') }}</p>
                        @endif
                        <p class="font-medium text-white">Total: R$ {{ number_format($order->total_amount, 2, ',', '.') }}</p>
                    </div>
                </div>
                
                <!-- Botões de Ação -->
                <div class="mt-4 pt-3 border-t border-zinc-700">
                    @if($order->status === 'closed' || $order->status === 'cancelled')
                        <button wire:click="reopenOrderFromList({{ $order->id }})" 
                                class="w-full bg-pgreen text-black px-3 py-2 rounded-lg text-sm font-['Open Sans'] font-bold hover:bg-white transition">
                            Reabrir Comanda
                        </button>
                    @else
                        <button wire:click="openOrder({{ $order->id }})" 
                                class="w-full bg-gray-500 text-white px-3 py-2 rounded-lg text-sm font-['Open Sans'] hover:bg-gray-600 transition">
                            Abrir Comanda
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <svg class="mx-auto h-12 w-12 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-white">Nenhuma comanda encontrada</h3>
                <p class="mt-1 text-sm text-zinc-400">Comece criando uma nova comanda.</p>
            </div>
        @endforelse
    </div>

    <!-- Paginação -->
    @if($orders instanceof \Illuminate\Pagination\LengthAwarePaginator && $orders->hasPages())
        <div class="mt-6 flex justify-center">
            <div class="bg-zinc-900 rounded-lg p-4">
                {{ $orders->links() }}
            </div>
        </div>
    @endif

    <!-- Modal da Comanda -->
    @if($showOrderModal)
        <div class="fixed inset-0 bg-black bg-opacity-70 backdrop-blur-sm overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-4xl shadow-lg rounded-xl bg-zinc-900 border-zinc-700">
                <div class="mt-3">
                    <!-- Header do Modal -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-white font-['Open Sans']">
                                @if($currentOrder) Comanda: {{ $currentOrder->order_owner_name }} @else Nova Comanda @endif
                            </h3>
                            @if($currentOrder)
                                <p class="text-sm text-zinc-400">{{ $currentOrder->order_number }}</p>
                            @endif
                        </div>
                        <button wire:click="closeModal" class="text-zinc-400 hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    @if($currentOrder)
                        <!-- Informações da Comanda -->
                        <div class="bg-zinc-800 rounded-lg p-4 mb-6 border border-zinc-700">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                <div>
                                    <span class="font-medium text-zinc-300">Status:</span>
                                    <span class="ml-2 px-2 py-1 text-xs font-medium rounded-full 
                                        @if($currentOrder->status === 'open') bg-pgreen text-black
                                        @elseif($currentOrder->status === 'closed') bg-gray-500 text-white
                                        @else bg-red-400 text-black @endif">
                                        @if($currentOrder->status === 'open') Aberta
                                        @elseif($currentOrder->status === 'closed') Fechada
                                        @else Cancelada @endif
                                    </span>
                                </div>
                                <div>
                                    <span class="font-medium text-zinc-300">Aberta em:</span>
                                    <span class="ml-2 text-zinc-400">{{ $currentOrder->opened_at ? $currentOrder->opened_at->format('d/m/Y H:i') : 'N/A' }}</span>
                                </div>
                                @if($currentOrder->closed_at)
                                    <div>
                                        <span class="font-medium text-zinc-300">Fechada em:</span>
                                        <span class="ml-2 text-zinc-400">{{ $currentOrder->closed_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Lista de Produtos -->
                        <div class="mb-6">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="text-lg font-semibold text-white font-['Open Sans']">Produtos</h4>
                                @if($currentOrder->status === 'open')
                                    <button wire:click="openAddProductModal" class="bg-pgreen text-black px-3 py-2 rounded-lg text-sm font-['Open Sans'] font-bold hover:bg-white transition">
                                        + Adicionar Produto
                                    </button>
                                @endif
                            </div>

                            @if($currentOrder->products->count() > 0)
                                <div class="bg-zinc-800 border border-zinc-700 rounded-lg overflow-hidden">
                                    <table class="min-w-full divide-y divide-zinc-700">
                                        <thead class="bg-zinc-900">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-300 uppercase tracking-wider">Produto</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-300 uppercase tracking-wider">Qtd</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-300 uppercase tracking-wider">Preço Unit.</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-300 uppercase tracking-wider">Subtotal</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-300 uppercase tracking-wider">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-zinc-800 divide-y divide-zinc-700">
                                            @foreach($currentOrder->products as $orderProduct)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div>
                                                            <div class="text-sm font-medium text-white">{{ $orderProduct->product->name }}</div>
                                                            @if($orderProduct->notes)
                                                                <div class="text-sm text-zinc-400">{{ $orderProduct->notes }}</div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center space-x-2">
                                                            @if($currentOrder->status === 'open')
                                                                <button wire:click="updateProductQuantity({{ $orderProduct->id }}, 'decrease')" 
                                                                        class="w-6 h-6 bg-red-400 hover:bg-red-500 text-black rounded-full flex items-center justify-center text-sm font-bold transition">
                                                                    -
                                                                </button>
                                                            @endif
                                                            <span class="text-sm text-white min-w-[2rem] text-center">{{ $orderProduct->quantity }}</span>
                                                            @if($currentOrder->status === 'open')
                                                                <button wire:click="updateProductQuantity({{ $orderProduct->id }}, 'increase')" 
                                                                        class="w-6 h-6 bg-pgreen hover:bg-white text-black rounded-full flex items-center justify-center text-sm font-bold transition">
                                                                    +
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-400">R$ {{ number_format($orderProduct->unit_price, 2, ',', '.') }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-400">R$ {{ number_format($orderProduct->subtotal, 2, ',', '.') }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        @if($currentOrder->status === 'open')
                                                            <button wire:click="removeProductFromOrder({{ $orderProduct->id }})" 
                                                                    class="text-red-400 hover:text-red-300" title="Remover produto">
                                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                                </svg>
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-8 bg-zinc-800 rounded-lg border border-zinc-700">
                                    <svg class="mx-auto h-12 w-12 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-white">Nenhum produto adicionado</h3>
                                    <p class="mt-1 text-sm text-zinc-400">Adicione produtos para começar a comanda.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Total e Ações -->
                        <div class="bg-zinc-800 rounded-lg p-4 mb-6 border border-zinc-700">
                            <div class="flex justify-between items-center">
                                <div class="text-2xl font-bold text-white">
                                    Total: R$ {{ number_format($currentOrder->total_amount, 2, ',', '.') }}
                                </div>
                                <div class="flex gap-3">
                                    @if($currentOrder->status === 'open')
                                        <button wire:click="cancelOrder" class="bg-red-400 text-black px-4 py-2 rounded-lg hover:bg-white transition">
                                            Cancelar Comanda
                                        </button>
                                        <button wire:click="closeOrder" class="bg-pgreen text-black px-4 py-2 rounded-lg hover:bg-white transition">
                                            Fechar Comanda
                                        </button>
                                    @elseif($currentOrder->status === 'closed' || $currentOrder->status === 'cancelled')
                                        <button wire:click="reopenOrder" class="bg-pgreen text-black px-4 py-2 rounded-lg hover:bg-white transition">
                                            Reabrir Comanda
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Formulário para Nova Comanda -->
                        <form wire:submit.prevent="createOrder">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-zinc-300 mb-2">Nome do Cliente *</label>
                                    <input wire:model="newOrderName" type="text" required class="w-full px-3 py-2 border border-zinc-700 rounded-md focus:outline-none focus:ring-2 focus:ring-pgreen bg-zinc-800 text-white placeholder-zinc-400">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-zinc-300 mb-2">Número da Comanda (opcional)</label>
                                    <input wire:model="newOrderNumber" type="text" class="w-full px-3 py-2 border border-zinc-700 rounded-md focus:outline-none focus:ring-2 focus:ring-pgreen bg-zinc-800 text-white placeholder-zinc-400">
                                    <p class="text-sm text-zinc-400 mt-1">Deixe em branco para gerar automaticamente</p>
                                </div>
                            </div>
                            
                            <div class="flex justify-end gap-3 mt-6">
                                <button type="button" wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                                    Cancelar
                                </button>
                                <button type="submit" class="bg-pgreen text-black px-4 py-2 rounded-lg hover:bg-white transition font-['Open Sans'] font-bold">
                                    Criar Comanda
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <!-- Modal para Adicionar Produto -->
    @if($showAddProductModal)
        <div class="fixed inset-0 bg-black bg-opacity-70 backdrop-blur-sm overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-xl bg-zinc-900 border-zinc-700">
                <div class="mt-3">
                    <h3 class="text-lg font-medium text-white mb-4 font-['Open Sans']">Adicionar Produto</h3>
                    
                    <form wire:submit.prevent="addProductToOrder">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-zinc-300 mb-2">Categoria</label>
                                <select wire:model="selectedCategory" wire:change="onCategoryChange" class="w-full px-3 py-2 border border-zinc-700 rounded-md focus:outline-none focus:ring-2 focus:ring-pgreen bg-zinc-800 text-white">
                                    <option value="">Selecione uma categoria</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-zinc-300 mb-2">Produto</label>
                                <select wire:model="selectedProduct" class="w-full px-3 py-2 border border-zinc-700 rounded-md focus:outline-none focus:ring-2 focus:ring-pgreen bg-zinc-800 text-white">
                                    <option value="">Selecione um produto</option>
                                    @if($selectedCategory)
                                        @php
                                            $categoryProducts = \App\Models\Products::where('id_category', $selectedCategory)
                                                ->where('id_shop', auth()->user()->shop->id)
                                                ->get();
                                        @endphp
                                        @foreach($categoryProducts as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }} - R$ {{ number_format($product->price, 2, ',', '.') }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-zinc-300 mb-2">Quantidade</label>
                                <input wire:model="productQuantity" type="number" min="1" class="w-full px-3 py-2 border border-zinc-700 rounded-md focus:outline-none focus:ring-2 focus:ring-pgreen bg-zinc-800 text-white">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-zinc-300 mb-2">Observações (opcional)</label>
                                <textarea wire:model="productNotes" rows="2" class="w-full px-3 py-2 border border-zinc-700 rounded-md focus:outline-none focus:ring-2 focus:ring-pgreen bg-zinc-800 text-white placeholder-zinc-400"></textarea>
                            </div>
                        </div>
                        
                        <div class="flex justify-end gap-3 mt-6">
                            <button type="button" wire:click="closeAddProductModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                                Cancelar
                            </button>
                            <button type="submit" class="bg-pgreen text-black px-4 py-2 rounded-lg hover:bg-white transition font-['Open Sans'] font-bold">
                                Adicionar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Mensagens de Sucesso/Erro -->
    @if(session()->has('success'))
        <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('error') }}
        </div>
    @endif
</div>
