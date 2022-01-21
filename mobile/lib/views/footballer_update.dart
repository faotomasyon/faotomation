import 'package:flutter/material.dart';
import 'menu.dart';

import '../route/route.dart' as route;

class FootballerUpdatePage extends StatefulWidget {
  const FootballerUpdatePage({Key? key}) : super(key: key);

  @override
  State<StatefulWidget> createState() => FootballerUpdatePageState();
}

class FootballerUpdatePageState extends State {
  int touchedIndex = -1;
  final _scaffoldKey = GlobalKey<ScaffoldState>();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      key: _scaffoldKey,
      drawer: Menu(),
      backgroundColor: Colors.white,
      extendBodyBehindAppBar: true,
      appBar: AppBar(
        elevation: 0,
        backgroundColor: Colors.transparent,
        automaticallyImplyLeading: false,
        title: Align(
            alignment: Alignment.topLeft,
            child: Text('Futbolcu Güncelle',
                style: TextStyle(fontSize: 30, color: Color(0xFF666666)))),
        leading: IconButton(
          onPressed: () {
            Navigator.pop(context);
          },
          icon: Icon(Icons.arrow_back, color: Color(0xFF666666)),
        ),
        actions: [],
      ),
      body: SingleChildScrollView(
        child: Padding(
          padding: EdgeInsets.all(15),
          child: Form(
              child: Center(
            child: ListView(
              shrinkWrap: true,
              children: [
                TextFormField(
                  style: TextStyle(fontSize: 25),
                  decoration: InputDecoration(
                    contentPadding: EdgeInsets.all(10),
                    prefixIcon: Icon(Icons.person),
                    labelText: "Adı",
                    hintText: "Adı",
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
                SizedBox(
                  height: 10,
                ),
                TextFormField(
                  style: TextStyle(fontSize: 25),
                  decoration: InputDecoration(
                    contentPadding: EdgeInsets.all(10),
                    prefixIcon: Icon(Icons.person),
                    labelText: "Soyad",
                    hintText: "Soyadı",
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
                SizedBox(
                  height: 10,
                ),
                TextFormField(
                  style: TextStyle(fontSize: 25),
                  decoration: InputDecoration(
                    contentPadding: EdgeInsets.all(10),
                    prefixIcon: Icon(Icons.person),
                    labelText: "Yaşı",
                    hintText: "Yaşı",
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
                SizedBox(
                  height: 10,
                ),
                RaisedButton(
                  color: Colors.blueAccent,
                  child: Text(
                    "Güncelle",
                    style: TextStyle(color: Colors.white, fontSize: 25),
                  ),
                  onPressed: () {},
                )
              ],
            ),
          )),
        ),
      ),
    );
  }
}
