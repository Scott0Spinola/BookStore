import 'package:flutter/material.dart';
import '../models/book.dart';

class BookDetailsBody extends StatelessWidget {
  final Book book;

  const BookDetailsBody({super.key, required this.book});

  @override
  Widget build(BuildContext context) {
    return SingleChildScrollView(
      padding: const EdgeInsets.all(16.0),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          if (book.imageUrl != null)
            Center(
              child: Image.network(
                book.imageUrl!,
                height: 200,
                fit: BoxFit.cover,
                errorBuilder: (context, error, stackTrace) =>
                    const Icon(Icons.book, size: 100),
              ),
            ),
          const SizedBox(height: 16),
          Text(
            book.title,
            style: Theme.of(context).textTheme.headlineSmall,
          ),
          const SizedBox(height: 8),
          Text(
            'by ${book.author}',
            style: Theme.of(context).textTheme.titleMedium?.copyWith(
                  color: Colors.grey[600],
                ),
          ),
          const SizedBox(height: 16),
          Row(
            children: [
              Chip(
                label: Text(book.category?.name ?? 'Uncategorized'),
                backgroundColor: Colors.blue[100],
              ),
              const Spacer(),
              Text(
                '\$${book.price.toStringAsFixed(2)}',
                style: Theme.of(context).textTheme.headlineSmall?.copyWith(
                      color: Colors.green,
                      fontWeight: FontWeight.bold,
                    ),
              ),
            ],
          ),
          const SizedBox(height: 16),
          const Text(
            'Description',
            style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
          ),
          const SizedBox(height: 8),
          Text(book.description),
        ],
      ),
    );
  }
}
