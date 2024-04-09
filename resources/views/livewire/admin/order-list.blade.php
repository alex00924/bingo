<div>
    <div class="flex justify-end mt-5">
        <button type="button" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
            wire:click="clearData"
            wire:confirm="Você quer limpar os dados?">
            Apagar os dados
        </button>
        <a type="button" class="ml-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            href="{{route('admin.order.export')}}">
            Exportar CSV
        </a>
    </div>
    <table class="w-full mt-5 text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    {{__('IDVENDA')}}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{__('CARTELAS')}}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{__('NOMECILENTE')}}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{__('FONECLIENTE')}}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{__('VALOR')}}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{__('Situação')}}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{__('DATA')}}
                </th>
            </tr>
        </thead>
        <tbody>
            @if(empty($orders) || count($orders) < 1)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" colspan="6" class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Sem dados
                    </th>
                </tr>            
            @else
                @foreach ($orders as $item)
                    <tr class="cursor-pointer bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                            {{$item->id}}
                        </th>
                        <td class="px-6 py-4">
                            {{$item->cardNumbers()}}
                        </td>
                        <td class="px-6 py-4">
                            {{$item->user->name}}
                        </td>
                        <td class="px-6 py-4">
                            {{$item->user->phone}}
                        </td>
                        <td class="px-6 py-4">
                            {{$item->price}}
                        </td>
                        <td class="px-6 py-4">
                            <p class="border border-yellow_text rounded-lg p-1">
                                @switch($item->payment_status)
                                    @case(0)
                                        Aguardando Pagamento
                                        @break
                                    @case(1)
                                        Pago
                                        @break
                                    @case(2)
                                        Falha no pagamento
                                        @break
                                
                                    @default
                                        Aguardando Pagamento
                                @endswitch
                            </p>
                        </td>
                        <td class="px-6 py-4">
                            {{$item->created_at}}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    
    <div class="mt-3">
        {{ $orders->links() }}
    </div>
</div>
