import 'package:flutter/material.dart';
import 'dart:ui' as ui;
import '/route/route.dart' as route;

class ForgotPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      resizeToAvoidBottomInset: false,
      backgroundColor: Colors.white,
      body: Stack(
        overflow: Overflow.visible,
        children: <Widget>[
          Positioned(
            child: ClipPath(
              clipper: HeaderCustomClipper(),
              child: Container(
                color: Colors.blue,
                width: MediaQuery.of(context).size.width,
                height: 200.0,
              ),
            ),
          ),
          Align(
              child: Padding(
            padding: EdgeInsets.only(top: 0, left: 25, right: 25),
            child: Form(
                child: Center(
              child: ListView(
                shrinkWrap: true,
                children: [
                  Text(
                    'Şifremi Unuttum',
                    style: TextStyle(
                        fontSize: 65,
                        fontWeight: FontWeight.bold,
                        color: Colors.blue),
                  ),
                  TextFormField(
                    style: TextStyle(fontSize: 25),
                    decoration: InputDecoration(
                      contentPadding: EdgeInsets.all(10),
                      prefixIcon: Icon(Icons.person),
                      labelText: "Email",
                      hintText: "Email",
                      focusedBorder: OutlineInputBorder(
                        borderRadius: BorderRadius.circular(4),
                        borderSide: BorderSide(
                          color: Colors.blue,
                        ),
                      ),
                      enabledBorder: OutlineInputBorder(
                          borderRadius: BorderRadius.circular(4),
                          borderSide: BorderSide(
                            color: Colors.blue,
                            width: 1.0,
                          )),
                    ),
                  ),
                ],
              ),
            )),
          )),
          Positioned(
            bottom: 0,
            child: ClipPath(
              clipper: FooterCustomClipper(),
              child: Container(
                color: Colors.blue,
                width: MediaQuery.of(context).size.width,
                height: 200.0,
              ),
            ),
          ),
          Align(
              alignment: Alignment.bottomRight,
              child: Padding(
                padding: EdgeInsets.only(bottom: 15, right: 15),
                child: OutlinedButton(
                  onPressed: () =>
                      Navigator.pushReplacementNamed(context, route.homePage),
                  style: OutlinedButton.styleFrom(
                    side: BorderSide(width: 1.0, color: Colors.white),
                  ),
                  child: Padding(
                    padding: EdgeInsets.all(5),
                    child: const Text(
                      'Gönder',
                      style: TextStyle(color: Colors.white, fontSize: 34),
                    ),
                  ),
                ),
              )),
          Align(
            alignment: Alignment.bottomLeft,
            child: Padding(
              padding: EdgeInsets.only(bottom: 5, left: 15),
              child: GestureDetector(
                onTap: () => Navigator.pushNamed(context, route.loginPage),
                child: Text(
                  'Geri Dön',
                  style: TextStyle(color: Colors.white, fontSize: 30),
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }
}

class FooterCustomClipper extends CustomClipper<Path> {
  @override
  Path getClip(Size size) {
    final path0 = Path();

    path0.moveTo(0, size.height * 0.6092286);
    path0.moveTo(0, size.height * 0.5883286);
    path0.quadraticBezierTo(size.width * 0.0913500, size.height * 0.7370857,
        size.width * 0.2059583, size.height * 0.7626429);
    path0.cubicTo(
        size.width * 0.5886167,
        size.height * 0.8156857,
        size.width * 0.7524500,
        size.height * 0.1297857,
        size.width,
        size.height * 0.1526429);
    path0.quadraticBezierTo(size.width * 1.0147833, size.height * 0.6896000,
        size.width, size.height);
    path0.lineTo(0, size.height);
    path0.lineTo(0, size.height * 0.5883286);
    path0.close();

    return path0;
  }

  @override
  bool shouldReclip(FooterCustomClipper oldClipper) => false;
}

class HeaderCustomClipper extends CustomClipper<Path> {
  @override
  Path getClip(Size size) {
    final path0 = Path();

    path0.moveTo(0, size.height * 0.0014286);
    path0.lineTo(0, size.height * 0.6857143);
    path0.quadraticBezierTo(size.width * 0.1147917, size.height * 0.7821429,
        size.width * 0.2975000, size.height * 0.7357143);
    path0.cubicTo(
        size.width * 0.4329167,
        size.height * 0.6910714,
        size.width * 0.5266667,
        size.height * 0.4939286,
        size.width * 0.7925000,
        size.height * 0.5957143);
    path0.quadraticBezierTo(size.width * 0.8752083, size.height * 0.6442857,
        size.width, size.height * 0.8342857);
    path0.lineTo(size.width, 0);
    path0.lineTo(0, size.height * 0.0014286);
    path0.close();
    return path0;
  }

  @override
  bool shouldReclip(HeaderCustomClipper oldClipper) => false;
}
