import 'package:flutter/material.dart';

// Define Routes

import '/views/splash.dart';
import '/views/login.dart';
import '/views/register.dart';

// Route Names
const String splashPage = 'splash';
const String homePage = 'home';
const String loginPage = 'login';
const String registerPage = 'register';

// Control our page route flow
Route<dynamic> controller(RouteSettings settings) {
  switch (settings.name) {
    case splashPage:
      return MaterialPageRoute(builder: (context) => SplashPage());
    case homePage:

    case loginPage:
      return MaterialPageRoute(builder: (context) => LoginPage());
    case registerPage:
      return MaterialPageRoute(builder: (context) => RegisterPage());
    default:
      throw ('Böyle bir adres yok');
  }
}
