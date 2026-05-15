<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Produk Toko') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ 
        showDeleteModal: false, 
        deleteUrl: '',
        editProduct: { id: '', name: '', description: '', price: '', stock: '' },
        editUrl: ''
    }" x-init="
        @if($errors->any())
            @if(old('_method') === 'PATCH')
                $dispatch('open-modal', 'edit-product');
                editProduct = { 
                    id: '{{ old('id') }}', 
                    name: @js(old('name')), 
                    description: @js(old('description')), 
                    price: '{{ old('price') }}', 
                    stock: '{{ old('stock') }}' 
                };
                editUrl = '{{ route('products.update', old('id', '0')) }}';
            @else
                $dispatch('open-modal', 'create-product');
            @endif
        @endif
    ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Inventaris Produk</h3>
                        <x-primary-button x-on:click.prevent="$dispatch('open-modal', 'create-product')" type="button">
                            + Tambah Produk
                        </x-primary-button>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto bg-white rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                            <thead class="bg-gray-50 text-gray-700 uppercase">
                                <tr>
                                    <th scope="col" class="px-6 py-3 font-medium tracking-wider">Nama Produk</th>
                                    <th scope="col" class="px-6 py-3 font-medium tracking-wider">Deskripsi</th>
                                    <th scope="col" class="px-6 py-3 font-medium tracking-wider">Harga</th>
                                    <th scope="col" class="px-6 py-3 font-medium tracking-wider text-center">Stok</th>
                                    <th scope="col" class="px-6 py-3 font-medium tracking-wider text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($products as $product)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 font-medium">{{ $product->name }}</td>
                                        <td class="px-6 py-4 text-gray-500">{{ \Illuminate\Support\Str::limit($product->description, 50) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-900">Rp {{ number_format($product->price, 2, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-900">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $product->stock > 10 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $product->stock }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <div class="flex justify-center space-x-2">
                                                <button 
                                                    x-on:click.prevent="
                                                        editProduct = { 
                                                            id: '{{ $product->id }}', 
                                                            name: @js($product->name), 
                                                            description: @js($product->description), 
                                                            price: '{{ $product->price }}', 
                                                            stock: '{{ $product->stock }}' 
                                                        };
                                                        editUrl = '{{ route('products.update', $product->id) }}';
                                                        $dispatch('open-modal', 'edit-product');
                                                    "
                                                    class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 px-3 py-1 rounded transition"
                                                >
                                                    Edit
                                                </button>
                                                <button @click="showDeleteModal = true; deleteUrl = '{{ route('products.destroy', $product->id) }}'" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1 rounded transition">
                                                    Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada data produk.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Product Modal -->
        <x-modal name="create-product" focusable>
            <form action="{{ route('products.store') }}" method="POST" class="p-6">
                @csrf
                <h2 class="text-lg font-medium text-gray-900 mb-4">
                    {{ __('Tambah Produk Baru') }}
                </h2>

                <div class="mb-4">
                    <x-input-label for="create_name" value="Nama Produk" />
                    <x-text-input id="create_name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="create_description" value="Deskripsi" />
                    <textarea id="create_description" name="description" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4">
                        <x-input-label for="create_price" value="Harga (Rp)" />
                        <x-text-input id="create_price" name="price" type="number" step="0.01" class="mt-1 block w-full" :value="old('price')" required />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="create_stock" value="Stok" />
                        <x-text-input id="create_stock" name="stock" type="number" class="mt-1 block w-full" :value="old('stock', 0)" required />
                        <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Batal') }}
                    </x-secondary-button>

                    <x-primary-button class="ms-3">
                        {{ __('Simpan Produk') }}
                    </x-primary-button>
                </div>
            </form>
        </x-modal>

        <!-- Edit Product Modal -->
        <x-modal name="edit-product" focusable>
            <form :action="editUrl" method="POST" class="p-6">
                @csrf
                @method('PATCH')
                
                <input type="hidden" name="id" x-model="editProduct.id">

                <h2 class="text-lg font-medium text-gray-900 mb-4">
                    {{ __('Ubah Produk') }}
                </h2>

                <div class="mb-4">
                    <x-input-label for="edit_name" value="Nama Produk" />
                    <x-text-input id="edit_name" name="name" type="text" class="mt-1 block w-full" x-model="editProduct.name" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="edit_description" value="Deskripsi" />
                    <textarea id="edit_description" name="description" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3" x-model="editProduct.description"></textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4">
                        <x-input-label for="edit_price" value="Harga (Rp)" />
                        <x-text-input id="edit_price" name="price" type="number" step="0.01" class="mt-1 block w-full" x-model="editProduct.price" required />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="edit_stock" value="Stok" />
                        <x-text-input id="edit_stock" name="stock" type="number" class="mt-1 block w-full" x-model="editProduct.stock" required />
                        <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Batal') }}
                    </x-secondary-button>

                    <x-primary-button class="ms-3">
                        {{ __('Update Produk') }}
                    </x-primary-button>
                </div>
            </form>
        </x-modal>

        <!-- Delete Confirmation Modal (Reusing existing logic but clean) -->
        <x-modal name="confirm-product-deletion" :show="false">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Apakah Anda yakin ingin menghapus produk ini?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Data yang dihapus tidak dapat dikembalikan.') }}
                </p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Batal') }}
                    </x-secondary-button>

                    <form :action="deleteUrl" method="POST" class="ms-3">
                        @csrf
                        @method('DELETE')
                        <x-danger-button>
                            {{ __('Hapus Data') }}
                        </x-danger-button>
                    </form>
                </div>
            </div>
        </x-modal>

        <!-- Custom Delete Modal State Compatibility -->
        <div x-show="showDeleteModal" x-init="$watch('showDeleteModal', value => value && $dispatch('open-modal', 'confirm-product-deletion'))" style="display:none;"></div>
        <div x-on:close-modal.window="if($event.detail == 'confirm-product-deletion') showDeleteModal = false"></div>

    </div>
</x-app-layout>

