import 'package:flutter/material.dart';
import '../models/book.dart';

class BookCard extends StatelessWidget {
  final Book book;
  final VoidCallback onTap;

  const BookCard({
    super.key,
    required this.book,
    required this.onTap,
  });

  @override
  Widget build(BuildContext context) {
    return Card(
      margin: const EdgeInsets.all(8.0),
      child: ListTile(
        leading: book.imageUrl != null
            ? Image.network(
                book.imageUrl!,
                width: 50,
                height: 50,
                fit: BoxFit.cover,
                errorBuilder: (context, error, stackTrace) =>
                    const Icon(Icons.book),
              )
            : const Icon(Icons.book),
        title: Text(book.title),
        subtitle: Text(book.author),
        trailing: Text('\$${book.price.toStringAsFixed(2)}'),
        onTap: onTap,
      ),
    );
  }
}
