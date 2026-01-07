import 'dart:convert';
import 'dart:io';
import 'package:flutter/foundation.dart' hide Category;
import 'package:http/http.dart' as http;
import '../models/book.dart';
import '../models/category.dart';

class ApiService {
  static String get baseUrl {
    if (kIsWeb) {
      return 'http://127.0.0.1:8000/api';
    } else if (Platform.isAndroid) {
      return 'http://10.0.2.2:8000/api';
    } else if (Platform.isIOS) {
      return 'http://localhost:8000/api';
    } else {
      return 'http://127.0.0.1:8000/api';
    }
  }

  static String get serverBaseUrl {
    if (kIsWeb) {
      return 'http://127.0.0.1:8000';
    } else if (Platform.isAndroid) {
      return 'http://10.0.2.2:8000';
    } else if (Platform.isIOS) {
      return 'http://localhost:8000';
    } else {
      return 'http://127.0.0.1:8000';
    }
  }

  /// Converts localhost URLs to the correct server base URL for the platform
  static String fixImageUrl(String? imageUrl) {
    if (imageUrl == null || imageUrl.isEmpty) {
      return '';
    }
    
    // For web, URLs should work as-is (localhost:8000)
    if (kIsWeb) {
      return imageUrl;
    }
    
    // For Android, replace localhost with 10.0.2.2 (Android emulator host address)
    if (Platform.isAndroid) {
      String fixedUrl = imageUrl;
      if (fixedUrl.contains('localhost')) {
        fixedUrl = fixedUrl.replaceFirst('localhost', '10.0.2.2');
      } else if (fixedUrl.contains('127.0.0.1')) {
        fixedUrl = fixedUrl.replaceFirst('127.0.0.1', '10.0.2.2');
      }

      // If the URL is pointing to our local server (10.0.2.2) and is missing the port 8000, add it.
      // This happens if the backend generates URLs without the port (e.g. based on APP_URL=http://localhost).
      if (fixedUrl.contains('10.0.2.2') && !fixedUrl.contains(':8000')) {
        fixedUrl = fixedUrl.replaceFirst('10.0.2.2', '10.0.2.2:8000');
      }
      return fixedUrl;
    }
    
    return imageUrl;
  }

  Future<List<Book>> getBooks() async {
    try {
      final response = await http.get(Uri.parse('$baseUrl/books'));

      if (response.statusCode == 200) {
        List<dynamic> body = jsonDecode(response.body);
        return body.map((dynamic item) => Book.fromJson(item)).toList();
      } else {
        throw Exception('Failed to load books: ${response.statusCode}');
      }
    } catch (e) {
      throw Exception('Failed to connect to API: $e');
    }
  }

  Future<Book> getBookDetails(int id) async {
    try {
      final response = await http.get(Uri.parse('$baseUrl/books/$id'));

      if (response.statusCode == 200) {
        return Book.fromJson(jsonDecode(response.body));
      } else {
        throw Exception('Failed to load book details: ${response.statusCode}');
      }
    } catch (e) {
      throw Exception('Failed to connect to API: $e');
    }
  }

  Future<List<Category>> getCategories() async {
    try {
      final response = await http.get(Uri.parse('$baseUrl/categories'));

      if (response.statusCode == 200) {
        List<dynamic> body = jsonDecode(response.body);
        return body.map((dynamic item) => Category.fromJson(item)).toList();
      } else {
        throw Exception('Failed to load categories: ${response.statusCode}');
      }
    } catch (e) {
      throw Exception('Failed to connect to API: $e');
    }
  }
}
