import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'models/product.dart';
import 'cubit/cart_cubit.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return BlocProvider(
      create: (context) => CartCubit(),
      child: MaterialApp(
        title: 'Product Cart BLoC',
        theme: ThemeData(
          colorScheme: ColorScheme.fromSeed(seedColor: Colors.blue),
          useMaterial3: true,
        ),
        home: const ProductListScreen(),
      ),
    );
  }
}

class ProductListScreen extends StatelessWidget {
  const ProductListScreen({super.key});

  final List<Product> products = const [
    Product(id: 1, name: 'Indomie Goreng', price: 3500),
    Product(id: 2, name: 'Susu UHT', price: 6000),
    Product(id: 3, name: 'Roti Tawar', price: 15000),
    Product(id: 4, name: 'Kopi Kapal Api', price: 1500),
    Product(id: 5, name: 'Teh Pucuk', price: 4000),
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Daftar Produk'),
        backgroundColor: Theme.of(context).colorScheme.primaryContainer,
        actions: [
          Stack(
            children: [
              IconButton(
                onPressed: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => const CartScreen()),
                  );
                },
                icon: const Icon(Icons.shopping_cart),
              ),
              Positioned(
                right: 8,
                top: 8,
                child: BlocBuilder<CartCubit, List<Product>>(
                  builder: (context, cartItems) {
                    return cartItems.isEmpty
                        ? const SizedBox.shrink()
                        : Container(
                            padding: const EdgeInsets.all(2),
                            decoration: BoxDecoration(
                              color: Colors.red,
                              borderRadius: BorderRadius.circular(10),
                            ),
                            constraints: const BoxConstraints(
                              minWidth: 16,
                              minHeight: 16,
                            ),
                            child: Text(
                              '${cartItems.length}',
                              style: const TextStyle(
                                color: Colors.white,
                                fontSize: 10,
                              ),
                              textAlign: TextAlign.center,
                            ),
                          );
                  },
                ),
              ),
            ],
          ),
        ],
      ),
      body: ListView.builder(
        itemCount: products.length,
        itemBuilder: (context, index) {
          final product = products[index];
          return ListTile(
            title: Text(product.name),
            subtitle: Text('Rp ${product.price}'),
            trailing: BlocBuilder<CartCubit, List<Product>>(
              builder: (context, cartItems) {
                final isInCart = cartItems.contains(product);
                return IconButton(
                  icon: Icon(
                    isInCart ? Icons.remove_shopping_cart : Icons.add_shopping_cart,
                    color: isInCart ? Colors.red : Colors.green,
                  ),
                  onPressed: () {
                    if (isInCart) {
                      context.read<CartCubit>().removeFromCart(product);
                    } else {
                      context.read<CartCubit>().addToCart(product);
                    }
                  },
                );
              },
            ),
          );
        },
      ),
    );
  }
}

class CartScreen extends StatelessWidget {
  const CartScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Keranjang Belanja'),
        backgroundColor: Theme.of(context).colorScheme.secondaryContainer,
      ),
      body: BlocBuilder<CartCubit, List<Product>>(
        builder: (context, cartItems) {
          if (cartItems.isEmpty) {
            return const Center(
              child: Text('Keranjang Anda kosong.'),
            );
          }
          return Column(
            children: [
              Expanded(
                child: ListView.builder(
                  itemCount: cartItems.length,
                  itemBuilder: (context, index) {
                    final product = cartItems[index];
                    return ListTile(
                      title: Text(product.name),
                      subtitle: Text('Rp ${product.price}'),
                      trailing: IconButton(
                        icon: const Icon(Icons.delete, color: Colors.red),
                        onPressed: () {
                          context.read<CartCubit>().removeFromCart(product);
                        },
                      ),
                    );
                  },
                ),
              ),
              Padding(
                padding: const EdgeInsets.all(16.0),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    const Text(
                      'Total Item:',
                      style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
                    ),
                    Text(
                      '${cartItems.length}',
                      style: const TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
                    ),
                  ],
                ),
              ),
            ],
          );
        },
      ),
    );
  }
}
