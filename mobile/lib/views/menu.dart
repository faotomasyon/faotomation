import 'package:flutter/material.dart';
import 'package:flutter/rendering.dart';
import '/route/route.dart' as route;

class Menu extends StatefulWidget {
  @override
  _MenuState createState() => _MenuState();
}

class _MenuState extends State<Menu> {
  @override
  Widget build(BuildContext context) {
    return Drawer(
      backgroundColor: Colors.white,
      child: Column(
        children: [
          SizedBox(
            height: 100,
            child: new DrawerHeader(
                child: new Text('FUTBOL AKADEMİSİ',
                    style: TextStyle(fontSize: 35)),
                decoration: new BoxDecoration(color: Colors.white),
                margin: EdgeInsets.zero,
                padding: EdgeInsets.only(top: 20, bottom: 20)),
          ),
          Expanded(
            child: ListView(
              children: [
                ListTile(
                  leading: Icon(
                    Icons.list,
                  ),
                  title: Text(
                    "ANASAYFA",
                    style: TextStyle(fontSize: 24),
                  ),
                  onTap: () {
                    Navigator.popAndPushNamed(context, route.homePage);
                  },
                ),
                ListTile(
                    leading: Icon(Icons.person),
                    title: Text(
                      "ANTRENÖR LİSTESİ",
                      style: TextStyle(fontSize: 24),
                    ),
                    onTap: () => Navigator.popAndPushNamed(
                        context, route.trainerListPage)),
                ListTile(
                    leading: Icon(Icons.person),
                    title: Text(
                      "FUTBOLCU LİSTESİ",
                      style: TextStyle(fontSize: 24),
                    ),
                    onTap: () => Navigator.popAndPushNamed(
                        context, route.footballerListPage)),
                ListTile(
                    leading: Icon(Icons.person),
                    title: Text(
                      "SINIF LİSTESİ",
                      style: TextStyle(fontSize: 24),
                    ),
                    onTap: () => {}),
                ListTile(
                    leading: Icon(Icons.star),
                    title: Text(
                      "JOB LİSTESİ",
                      style: TextStyle(fontSize: 24),
                    ),
                    onTap: () =>
                        Navigator.popAndPushNamed(context, route.jobListPage)),
              ],
            ),
          )
        ],
      ),
    );
  }
}
