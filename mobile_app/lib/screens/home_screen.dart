import 'package:flutter/material.dart';
import '../globals.dart';
import '../models/book.dart';
import '../widgets/book_card.dart';
import '../widgets/loading_widget.dart';
import 'book_details_screen.dart';

class HomeScreen extends StatefulWidget {
  const HomeScreen({super.key});

  @override
  State<HomeScreen> createState() => _HomeScreenState();
}

class _HomeScreenState extends State<HomeScreen> {
  late Future<List<Book>> _booksFuture;

  @override
  void initState() {
    super.initState();
    _booksFuture = Globals.apiService.getBooks();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('BookStore'),
      ),
      body: FutureBuilder<List<Book>>(
        future: _booksFuture,
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return const LoadingWidget(message: 'Loading books...');
          } else if (snapshot.hasError) {
            return Center(
              child: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Text('Error: ${snapshot.error}'),
                  const SizedBox(height: 16),
                  ElevatedButton(
                    onPressed: () {
                      setState(() {
                        _booksFuture = Globals.apiService.getBooks();
                      });
                    },
                    child: const Text('Retry'),
                  ),
                ],
              ),
            );
          } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
            return const Center(child: Text('No books found.'));
          }

          final books = snapshot.data!;
          return ListView.builder(
            itemCount: books.length,
            itemBuilder: (context, index) {
              final book = books[index];
              return BookCard(
                book: book,
                onTap: () {
                  Navigator.pushNamed(
                    context,
                    '/details',
                    arguments: book,
                  );
                },
              );
            },
          );
        },
      ),
    );
  }
}
