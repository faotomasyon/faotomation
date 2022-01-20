import 'package:flutter/material.dart';

// Define Routes

import '/views/splash.dart';
import '/views/home.dart';
import '/views/login.dart';
import '/views/register.dart';
import '/views/forgot_password.dart';

// Route Names
const String splashPage = 'splash';
const String homePage = 'home';
const String loginPage = 'login';
const String registerPage = 'register';
const String forgotPage = 'forgot';

// Control our page route flow
Route<dynamic> controller(RouteSettings settings) {
  switch (settings.name) {
    case splashPage:
      return MaterialPageRoute(builder: (context) => SplashPage());
    case homePage:
      return MaterialPageRoute(builder: (context) => HomePage());
    case loginPage:
      return MaterialPageRoute(builder: (context) => LoginPage());
    case forgotPage:
      return MaterialPageRoute(builder: (context) => ForgotPage());
    case registerPage:
      return MaterialPageRoute(builder: (context) => RegisterPage());
    default:
      throw ('Böyle bir adres yok');
  }
}
