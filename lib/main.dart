import 'package:flutter/material.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Flutter UI Widgets',
      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(seedColor: Colors.blue),
        useMaterial3: true,
      ),
      home: const MyHomePage(title: 'Flutter UI Showcase'),
    );
  }
}

class MyHomePage extends StatefulWidget {
  const MyHomePage({super.key, required this.title});

  final String title;

  @override
  State<MyHomePage> createState() => _MyHomePageState();
}

class _MyHomePageState extends State<MyHomePage> {
  // Data for ListView.builder
  final List<String> items = [
    'Item 1 from Array',
    'Item 2 from Array',
    'Item 3 from Array',
    'Item 4 from Array',
    'Item 5 from Array',
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Theme.of(context).colorScheme.inversePrimary,
        title: Text(widget.title),
      ),
      body: SingleChildScrollView(
        child: Padding(
          padding: const EdgeInsets.all(16.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              // 1. Container -> kotak berwarna
              const Text('1. Container', style: TextStyle(fontWeight: FontWeight.bold)),
              const SizedBox(height: 8),
              Container(
                width: 100,
                height: 100,
                color: Colors.blue,
                child: const Center(
                  child: Text('Kotak', style: TextStyle(color: Colors.white)),
                ),
              ),
              const Divider(height: 32),

              // 2. GridView -> minimal 6 item (grid)
              const Text('2. GridView (6 Items)', style: TextStyle(fontWeight: FontWeight.bold)),
              const SizedBox(height: 8),
              GridView.count(
                shrinkWrap: true,
                physics: const NeverScrollableScrollPhysics(),
                crossAxisCount: 3,
                crossAxisSpacing: 10,
                mainAxisSpacing: 10,
                children: List.generate(6, (index) {
                  return Container(
                    color: Colors.teal[(index + 1) * 100],
                    child: Center(child: Text('Grid $index')),
                  );
                }),
              ),
              const Divider(height: 32),

              // 3. ListView -> 3 item (A, B, C)
              const Text('3. ListView (Static)', style: TextStyle(fontWeight: FontWeight.bold)),
              ListView(
                shrinkWrap: true,
                physics: const NeverScrollableScrollPhysics(),
                children: const [
                  ListTile(title: Text('Item A')),
                  ListTile(title: Text('Item B')),
                  ListTile(title: Text('Item C')),
                ],
              ),
              const Divider(height: 32),

              // 4. ListView.builder -> list dari data array
              const Text('4. ListView.builder', style: TextStyle(fontWeight: FontWeight.bold)),
              ListView.builder(
                shrinkWrap: true,
                physics: const NeverScrollableScrollPhysics(),
                itemCount: items.length,
                itemBuilder: (context, index) {
                  return ListTile(
                    leading: const Icon(Icons.list),
                    title: Text(items[index]),
                  );
                },
              ),
              const Divider(height: 32),

              // 5. ListView.separated -> list + garis pembatas
              const Text('5. ListView.separated', style: TextStyle(fontWeight: FontWeight.bold)),
              ListView.separated(
                shrinkWrap: true,
                physics: const NeverScrollableScrollPhysics(),
                itemCount: 3,
                separatorBuilder: (context, index) => const Divider(color: Colors.grey),
                itemBuilder: (context, index) {
                  return ListTile(
                    title: Text('Separated Item $index'),
                  );
                },
              ),
              const Divider(height: 32),

              // 6. Stack -> tampilan bertumpuk (kotak / text)
              const Text('6. Stack', style: TextStyle(fontWeight: FontWeight.bold)),
              const SizedBox(height: 8),
              Stack(
                alignment: Alignment.center,
                children: [
                  Container(
                    width: 150,
                    height: 150,
                    color: Colors.red,
                  ),
                  Container(
                    width: 100,
                    height: 100,
                    color: Colors.green,
                  ),
                  const Text(
                    'Teks di Atas',
                    style: TextStyle(
                      color: Colors.white,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                ],
              ),
              const SizedBox(height: 20),
            ],
          ),
        ),
      ),
    );
  }
}
