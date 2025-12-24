import 'package:flutter/material.dart';
import 'models/book.dart';
import 'screens/book_details_screen.dart';
import 'screens/home_screen.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'BookStore App',
      theme: ThemeData(
        primarySwatch: Colors.blue,
        useMaterial3: true,
      ),
      initialRoute: '/',
      routes: {
        '/': (context) => const HomeScreen(),
      },
      onGenerateRoute: (settings) {
        if (settings.name == '/details') {
          final book = settings.arguments as Book;
          return MaterialPageRoute(
            builder: (context) => BookDetailsScreen(
              bookId: book.id,
              initialTitle: book.title,
            ),
          );
        }
        return null;
      },
    );
  }
}
