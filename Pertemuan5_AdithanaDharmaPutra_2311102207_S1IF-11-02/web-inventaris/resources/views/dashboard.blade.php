<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kasir Pesanan') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ 
        products: @js($products),
        cart: [],
        search: '',
        get filteredProducts() {
            return this.products.filter(p => p.name.toLowerCase().includes(this.search.toLowerCase()));
        },
        addToCart(product) {
            let item = this.cart.find(i => i.id === product.id);
            if (item) {
                item.quantity++;
            } else {
                this.cart.push({ ...product, quantity: 1 });
            }
        },
        removeFromCart(index) {
            this.cart.splice(index, 1);
        },
        get total() {
            return this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        },
        formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);
        },
        checkout() {
            if (this.cart.length === 0) return;
            alert('Pesanan berhasil dibuat!\nTotal: ' + this.formatRupiah(this.total));
            this.cart = [];
        }
    }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-6 items-start">
                
                <!-- Product List -->
                <div class="w-full md:w-2/3">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                        <div class="p-6">
                            <div class="mb-4">
                                <input type="text" x-model="search" placeholder="Cari produk mie instan..." class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <template x-for="product in filteredProducts" :key="product.id">
                                    <div class="border rounded-lg p-4 hover:shadow-md transition-shadow flex flex-col justify-between">
                                        <div>
                                            <h4 class="font-bold text-gray-900" x-text="product.name"></h4>
                                            <p class="text-sm text-gray-500 mb-2" x-text="product.description"></p>
                                            <p class="text-indigo-600 font-semibold" x-text="formatRupiah(product.price)"></p>
                                            <p class="text-xs text-gray-400 mt-1">Stok: <span x-text="product.stock"></span></p>
                                        </div>
                                        <button @click="addToCart(product)" class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition text-sm">
                                            + Tambah
                                        </button>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shopping Cart -->
                <div class="w-full md:w-1/3 sticky top-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Daftar Pesanan</h3>
                            
                            <div class="space-y-4 max-h-[50vh] overflow-y-auto mb-6">
                                <template x-if="cart.length === 0">
                                    <p class="text-center text-gray-500 py-4">Belum ada pesanan.</p>
                                </template>
                                
                                <template x-for="(item, index) in cart" :key="item.id">
                                    <div class="flex justify-between items-start border-b pb-2">
                                        <div class="flex-1">
                                            <p class="font-medium text-gray-900 text-sm" x-text="item.name"></p>
                                            <div class="flex items-center mt-1">
                                                <button @click="if(item.quantity > 1) item.quantity--" class="text-gray-500 hover:text-indigo-600">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                                                </button>
                                                <span class="mx-2 text-sm" x-text="item.quantity"></span>
                                                <button @click="item.quantity++" class="text-gray-500 hover:text-indigo-600">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="text-right ml-2">
                                            <p class="text-sm font-semibold" x-text="formatRupiah(item.price * item.quantity)"></p>
                                            <button @click="removeFromCart(index)" class="text-xs text-red-500 hover:underline mt-1">Hapus</button>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <div class="border-t pt-4">
                                <div class="flex justify-between items-center mb-6">
                                    <span class="text-lg font-bold">Total:</span>
                                    <span class="text-xl font-extrabold text-indigo-600" x-text="formatRupiah(total)"></span>
                                </div>
                                
                                <button @click="checkout" :disabled="cart.length === 0" 
                                    :class="cart.length === 0 ? 'bg-gray-300 cursor-not-allowed' : 'bg-green-600 hover:bg-green-700'"
                                    class="w-full text-white font-bold py-3 rounded-lg transition shadow-lg">
                                    Selesaikan Pesanan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
