import 'package:flutter/material.dart';
import 'route/route.dart' as route;

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Futbol Akademisi',
      theme: ThemeData(
        fontFamily: 'Dongle',
        primaryColor: Colors.blue,
      ),
      onGenerateRoute: route.controller,
      initialRoute: route.splashPage,
    );
  }
}
