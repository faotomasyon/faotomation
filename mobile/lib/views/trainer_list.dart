import 'package:flutter/material.dart';
import 'menu.dart';

import '../route/route.dart' as route;

class TrainerListPage extends StatefulWidget {
  const TrainerListPage({Key? key}) : super(key: key);

  @override
  State<StatefulWidget> createState() => TrainerListPageState();
}

class TrainerListPageState extends State {
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
            child: Text('Antrenör Listesi',
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
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Padding(
              padding: EdgeInsets.only(top: 100, left: 20, right: 20),
              child: DataTable(
                dividerThickness: 1,
                decoration: BoxDecoration(
                  border: Border(
                      bottom: Divider.createBorderSide(context, width: 1.0),
                      top: Divider.createBorderSide(context, width: 1.0),
                      right: Divider.createBorderSide(context, width: 1.0),
                      left: Divider.createBorderSide(context, width: 1.0)),
                ),
                columns: const <DataColumn>[
                  DataColumn(
                    label: Text(
                      'Adı',
                      style: TextStyle(fontSize: 25),
                    ),
                  ),
                  DataColumn(
                    label: Text(
                      'Soyadı',
                      style: TextStyle(fontSize: 25),
                    ),
                  ),
                  DataColumn(
                    label: Text(
                      'Yaşı',
                      style: TextStyle(fontSize: 25),
                    ),
                  ),
                ],
                rows: const <DataRow>[
                  DataRow(
                    cells: <DataCell>[
                      DataCell(Text('Adem', style: TextStyle(fontSize: 22))),
                      DataCell(Text('Polat', style: TextStyle(fontSize: 22))),
                      DataCell(Text('23', style: TextStyle(fontSize: 22))),
                    ],
                  ),
                  DataRow(
                    cells: <DataCell>[
                      DataCell(Text('Ahmet', style: TextStyle(fontSize: 22))),
                      DataCell(Text('Ak', style: TextStyle(fontSize: 22))),
                      DataCell(Text('22', style: TextStyle(fontSize: 22))),
                    ],
                  ),
                  DataRow(
                    cells: <DataCell>[
                      DataCell(Text('Ali', style: TextStyle(fontSize: 22))),
                      DataCell(Text('Aslan', style: TextStyle(fontSize: 22))),
                      DataCell(Text('25', style: TextStyle(fontSize: 22))),
                    ],
                  ),
                  DataRow(
                    cells: <DataCell>[
                      DataCell(Text('Mehmet', style: TextStyle(fontSize: 22))),
                      DataCell(Text('Yiğit', style: TextStyle(fontSize: 22))),
                      DataCell(Text('21', style: TextStyle(fontSize: 22))),
                    ],
                  ),
                  DataRow(
                    cells: <DataCell>[
                      DataCell(Text('Veli', style: TextStyle(fontSize: 22))),
                      DataCell(Text('Ay', style: TextStyle(fontSize: 22))),
                      DataCell(Text('18', style: TextStyle(fontSize: 22))),
                    ],
                  ),
                  DataRow(
                    cells: <DataCell>[
                      DataCell(Text('Hakan', style: TextStyle(fontSize: 22))),
                      DataCell(Text('Güven', style: TextStyle(fontSize: 22))),
                      DataCell(Text('22', style: TextStyle(fontSize: 22))),
                    ],
                  ),
                  DataRow(
                    cells: <DataCell>[
                      DataCell(Text('Atakan', style: TextStyle(fontSize: 22))),
                      DataCell(Text('Musa', style: TextStyle(fontSize: 22))),
                      DataCell(Text('19', style: TextStyle(fontSize: 22))),
                    ],
                  ),
                  DataRow(
                    cells: <DataCell>[
                      DataCell(Text('Armağan', style: TextStyle(fontSize: 22))),
                      DataCell(Text('Ocak', style: TextStyle(fontSize: 22))),
                      DataCell(Text('20', style: TextStyle(fontSize: 22))),
                    ],
                  )
                ],
              ),
            ),
            Padding(
                padding: EdgeInsets.only(top: 30),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: <Widget>[
                    RaisedButton(
                      color: Colors.blueAccent,
                      child: Text(
                        "Ekle",
                        style: TextStyle(color: Colors.white, fontSize: 25),
                      ),
                      onPressed: () {
                        Navigator.pushNamed(context, route.trainerAddPage);
                      },
                    ),
                    RaisedButton(
                      color: Colors.blueAccent,
                      child: Text(
                        "Sil",
                        style: TextStyle(color: Colors.white, fontSize: 25),
                      ),
                      onPressed: () {
                        debugPrint("Butona tıklandı");
                      },
                    ),
                    RaisedButton(
                      color: Colors.blueAccent,
                      child: Text(
                        "Güncelle",
                        style: TextStyle(color: Colors.white, fontSize: 25),
                      ),
                      onPressed: () {
                        Navigator.pushNamed(context, route.trainerUpdatePage);
                      },
                    )
                  ],
                ))
          ],
        ),
      ),
    );
  }
}
