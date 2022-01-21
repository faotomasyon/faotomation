import 'package:flutter/material.dart';

// Define Routes

import '/views/splash.dart';
import '/views/home.dart';
import '/views/login.dart';
import '/views/register.dart';
import '/views/forgot_password.dart';
import '/views/trainer_list.dart';
import '/views/footballer_list.dart';
import '/views/job_list.dart';
import '/views/footballer_add.dart';
import '/views/footballer_update.dart';
import '/views/trainer_add.dart';
import '/views/trainer_update.dart';

// Route Names
const String splashPage = 'splash';
const String homePage = 'home';
const String loginPage = 'login';
const String registerPage = 'register';
const String forgotPage = 'forgot';
const String trainerListPage = 'trainer_list';
const String footballerListPage = 'footballer_list';
const String jobListPage = 'job_list';
const String footballerAddPage = 'footballer_add';
const String footballerUpdatePage = 'footballer_update';
const String trainerAddPage = 'trainer_add';
const String trainerUpdatePage = 'trainer_update';

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
    case trainerListPage:
      return MaterialPageRoute(builder: (context) => TrainerListPage());
    case registerPage:
      return MaterialPageRoute(builder: (context) => RegisterPage());
    case footballerListPage:
      return MaterialPageRoute(builder: (context) => FootballerListPage());
    case jobListPage:
      return MaterialPageRoute(builder: (context) => JobListPage());
    case footballerAddPage:
      return MaterialPageRoute(builder: (context) => FootballerAddPage());
    case footballerUpdatePage:
      return MaterialPageRoute(builder: (context) => FootballerUpdatePage());
    case trainerAddPage:
      return MaterialPageRoute(builder: (context) => TrainerAddPage());
    case trainerUpdatePage:
      return MaterialPageRoute(builder: (context) => TrainerUpdatePage());
    default:
      throw ('Böyle bir adres yok');
  }
}
