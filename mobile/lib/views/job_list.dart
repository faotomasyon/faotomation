import 'package:flutter/material.dart';
import 'menu.dart';

import '../route/route.dart' as route;

class JobListPage extends StatefulWidget {
  const JobListPage({Key? key}) : super(key: key);

  @override
  State<StatefulWidget> createState() => JobListPageState();
}

class JobListPageState extends State {
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
        title: Center(
            child: Text('Job Listesi',
                style: TextStyle(fontSize: 30, color: Color(0xFF666666)))),
        leading: IconButton(
          onPressed: () {
            Navigator.pop(context);
          },
          icon: Icon(Icons.arrow_back, color: Color(0xFF666666)),
        ),
        actions: [
          RaisedButton(
            color: Colors.blueAccent,
            onPressed: () {},
            child: Text(
              'Ekle',
              style: TextStyle(color: Colors.white, fontSize: 25),
            ),
          )
        ],
      ),
      body: SingleChildScrollView(
        child: ListBody(
          children: [
            Padding(
              padding: EdgeInsets.only(top: 100, left: 20, right: 20),
              child: DataTable(
                dividerThickness: 1,
                columnSpacing: 0,
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
                      'Tarih',
                      style: TextStyle(fontSize: 25),
                    ),
                  ),
                  DataColumn(
                    label: Text(
                      'Job Liste',
                      style: TextStyle(fontSize: 25),
                    ),
                  ),
                  DataColumn(
                    label: Text(
                      'Durum',
                      style: TextStyle(fontSize: 25),
                    ),
                  ),
                  DataColumn(
                    label: Text(
                      'Antrenör',
                      style: TextStyle(fontSize: 25),
                    ),
                  ),
                ],
                rows: const <DataRow>[
                  DataRow(
                    cells: <DataCell>[
                      DataCell(
                          Text('12.03.2022', style: TextStyle(fontSize: 22))),
                      DataCell(
                          Text('Yoklamalar', style: TextStyle(fontSize: 22))),
                      DataCell(Text('Alındı', style: TextStyle(fontSize: 22))),
                      DataCell(Text('Ali K.', style: TextStyle(fontSize: 22)))
                    ],
                  ),
                  DataRow(
                    cells: <DataCell>[
                      DataCell(
                          Text('21.09.2022', style: TextStyle(fontSize: 22))),
                      DataCell(Text('Haftalık Liste',
                          style: TextStyle(fontSize: 22))),
                      DataCell(
                          Text('Alınmadı', style: TextStyle(fontSize: 22))),
                      DataCell(Text('Ahmet B.', style: TextStyle(fontSize: 22)))
                    ],
                  ),
                  DataRow(
                    cells: <DataCell>[
                      DataCell(
                          Text('29.03.2022', style: TextStyle(fontSize: 22))),
                      DataCell(Text('Aylık İstatistik',
                          style: TextStyle(fontSize: 22))),
                      DataCell(Text('Alındı', style: TextStyle(fontSize: 22))),
                      DataCell(Text('Buğra T.', style: TextStyle(fontSize: 22)))
                    ],
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}
