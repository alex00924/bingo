<div>
    <div class="p-5 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Preço do cartão</h5>
        </a>
        <div class="mt-5 hover:border border-gray-500">
            <x-input-label for="card-price" :value="__('TELEFONE')" />
            <x-text-input wire:model="price" id="card-price" class="block mt-1 w-full" name="card-price" required autofocus autocomplete="card-price" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>
        <div class="flex justify-end mt-5">
            <button type="button" class="ml-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                wire:click="setPriceValue">
                Atualizar preço
            </button>
        </div>
    </div>
</div>
