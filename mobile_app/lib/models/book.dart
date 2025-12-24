import 'category.dart';

class Book {
  final int id;
  final String title;
  final String author;
  final String description;
  final double price;
  final String? imageUrl;
  final Category? category;

  Book({
    required this.id,
    required this.title,
    required this.author,
    required this.description,
    required this.price,
    this.imageUrl,
    this.category,
  });

  factory Book.fromJson(Map<String, dynamic> json) {
    return Book(
      id: json['id'],
      title: json['title'],
      author: json['author'],
      description: json['description'] ?? '',
      price: double.parse(json['price'].toString()),
      imageUrl: json['image_url'],
      category: json['category'] != null ? Category.fromJson(json['category']) : null,
    );
  }
}
