import 'package:flutter/material.dart';
import '../globals.dart';
import '../models/book.dart';
import '../widgets/book_details_body.dart';
import '../widgets/loading_widget.dart';

class BookDetailsScreen extends StatefulWidget {
  final int bookId;
  final String? initialTitle;

  const BookDetailsScreen({
    super.key,
    required this.bookId,
    this.initialTitle,
  });

  @override
  State<BookDetailsScreen> createState() => _BookDetailsScreenState();
}

class _BookDetailsScreenState extends State<BookDetailsScreen> {
  late Future<Book> _bookFuture;

  @override
  void initState() {
    super.initState();
    _bookFuture = Globals.apiService.getBookDetails(widget.bookId);
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(widget.initialTitle ?? 'Book Details'),
      ),
      body: FutureBuilder<Book>(
        future: _bookFuture,
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return const LoadingWidget(message: 'Loading details...');
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
                        _bookFuture = Globals.apiService.getBookDetails(widget.bookId);
                      });
                    },
                    child: const Text('Retry'),
                  ),
                ],
              ),
            );
          } else if (!snapshot.hasData) {
            return const Center(child: Text('Book not found.'));
          }

          final book = snapshot.data!;
          return BookDetailsBody(book: book);
        },
      ),
    );
  }
}
