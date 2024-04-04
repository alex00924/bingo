<div>
    @switch($processStatus)
        @case(1)
            <div class="flex justify-center">
                <div class="block w-full max-w-lg p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">
                        SHOW DE PRÉMIOS D'BILHAR
                    </h5>
                    <h5 class="mb-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white text-center">
                        COMPRAR CARTELA
                    </h5>
                    <p class="my-2 text-xl font-bold text-red-500 text-center">
                        VALOR DA CARTELA R$: 10,00
                    </P>
                    <form wire:submit="nextStep" class="text-xl">
                        <!-- Name -->
                        <div>
                            <div class="text-center"><x-input-label for="name" :value="__('NOME')" /></div>
                            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Phone Number -->
                        <div class="mt-4">
                            <div class="text-center"><x-input-label for="phone" :value="__('TELEFONE')" /></div>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
                                        <path d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z"/>
                                    </svg>
                                </div>
                                <x-text-input wire:model="phone" id="phone" class="block mt-1 w-full ps-10 p-2.5" name="phone" required placeholder="(__)_____-_____"/>
                            </div>
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <!-- City -->
                        <div class="mt-4">
                            <div class="text-center"><x-input-label for="city" :value="__('CIDADE')" /></div>
                            <x-text-input wire:model="city" id="city" class="block mt-1 w-full" type="text" name="city" required autocomplete="city" />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>

                        <!-- Quantity -->
                        <div class="mt-4">
                            <div class="text-center"><x-input-label :value="__('QUANTIDADE')" /></div>
                            <div class="relative px-2 py-1 mt-1 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <a class="absolute inset-y-0 start-0 flex items-center px-3.5 cursor-pointer hover:bg-gray-200"
                                    wire:click="changeQuantity(-1)">
                                    <svg stroke="#ef4444" fill="#ef4444" class="w-5 h-5" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 12L18 12" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                </a>
                                <p class="text-center text-2xl font-bold">
                                    {{$quantity}}
                                </p>
                                <a class="absolute inset-y-0 end-0 flex items-center px-3.5 cursor-pointer hover:bg-gray-200"
                                    wire:click="changeQuantity(1)">
                                    <svg fill="#ef4444" class="w-5 h-5" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 45.402 45.402" xml:space="preserve" stroke="#fff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141 c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27 c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435 c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"></path> </g> </g></svg>
                                </a>
                            </div>
                            <div class="mt-2 grid grid-cols-1 sm:grid-cols-3 gap-2 sm:gap-4">
                                <a class="flex justify-center items-center border border-gray-300 rounded-lg p-2 hover:bg-gray-200 cursor-pointer"
                                    wire:click="changeQuantity(5)">
                                    <svg fill="#111827" class="w-5 h-5" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 45.402 45.402" xml:space="preserve" stroke="#fff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141 c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27 c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435 c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"></path> </g> </g></svg>
                                    &nbsp; 5 un.
                                </a>
                                <a class="flex justify-center items-center border border-gray-300 rounded-lg p-2 hover:bg-gray-200 cursor-pointer"
                                    wire:click="changeQuantity(10)">
                                    <svg fill="#111827" class="w-5 h-5" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 45.402 45.402" xml:space="preserve" stroke="#fff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141 c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27 c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435 c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"></path> </g> </g></svg>
                                    &nbsp; 10 un.
                                </a>
                                <a class="flex justify-center items-center border border-gray-300 rounded-lg p-2 hover:bg-gray-200 cursor-pointer"
                                    wire:click="changeQuantity(15)">
                                    <svg fill="#111827" class="w-5 h-5" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 45.402 45.402" xml:space="preserve" stroke="#fff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141 c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27 c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435 c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"></path> </g> </g></svg>
                                    &nbsp; 15 un.
                                </a>
                            </div>
                            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                        </div>

                        <!-- Submit -->
                        <button class="w-full rounded-lg py-2 px-8 mt-4 flex justify-between bg-bright_yellow text-gray-900">
                            <span>COMPRAR</span>
                            <span>R$ {{$quantity * 10}}</span>
                        </button>
                    </form>
                    
                </div>
            </div>
            @break
        
        @case(2)
            <div class="flex justify-center">
                <div class="block w-full max-w-lg p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center underline">
                        SHOW DE PRÉMIOS D'BILHAR
                    </h5>
                    <p class="m5-4 text-xl font-bold text-gray-900 text-center">
                        TOTAL DE CARTELAS: {{$quantity}}
                    </P>
                    <p class="mt-2 text-xl font-bold text-gray-900 text-center">
                        VALOR TOTAL: R$ {{$quantity*10}}
                    </P>

                    <div class="bg-sky-100 border-l-4 border-l-sky-600 rounded-lg mt-8 p-2">
                        <h6 class="font-bold text-sky-600 text-center">
                            Clique no botão "Pagar" para gerar o PIX e concluir sua compra.
                        </h6>
                        <p class="text-sky-600 my-2 text-center">
                            Você pode verificar seu pedido em acessos futuros acessando "Meus Pedidos" no menu ou clicando no seu nome.
                        </p>
                        <div class="flex justify-center">
                            <button class="py-2 px-6 md:px-12 mx-auto text-white bg-sky-600 rounded-lg"
                                wire:click="nextStep">
                                PAGAR
                            </button>
                        </div>
                    </div>

                    <p class="mt-8 text-xl font-bold text-gray-900 text-center">
                        RESUMO DO PEDIDO
                    </P>
                    <div class="bg-yellow-100 border-l-4 border-l-yellow_border rounded-lg mt-4 p-2">
                        <h6 class="font-bold text-yellow_border text-center">
                            Pedido Gerado
                        </h6>
                        <p class="text-yellow_border my-2 text-center">
                            Aguardando confirmação de pagamento!
                        </p>
                    </div>
                </div>
            </div>        
            @break
        
        @case(2)
            @break
    @endswitch
</div>
