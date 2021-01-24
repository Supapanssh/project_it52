var map = {};

function restChart(table, chartType, condition, chartName, groupBy, unit, value, theme, tagId, label) {
    var mapParams = {
        "tableName": table,
        "label": label,
        "chartType": chartType == null ? 'column' : chartType,
        "condition": condition,
        "chartName": chartName,
        "groupBy": groupBy,
        "unit": unit,
        "y": value,
        "hide": null
    };
    $.ajax({
        type: "get",
        url: url,
        data: mapParams,
        dataType: "json",
        success: function (response) {
            var chartOptions = {
                axisY: {
                    title: chartName + " (" + unit + ")",
                    titleFontSize: 16,
                },
                exportEnabled: true,
                animationDuration: 500,
                zoomEnabled: true,
                animationEnabled: true,
                theme: theme,
                title: {
                    text: chartName,
                    fontFamily: "k2d",
                    fontSize: 25,
                    padding: 10,
                    margin: 15,
                    backgroundColor: "#FFFFE0",
                    borderThickness: 1,
                    cornerRadius: 5,
                },
                subtitles: [{
                    text: ""
                }],
                data: []
            };
            chartOptions.title.text = chartName;
            response[0][0]['cursor'] = "default";
            console.log(response);
            chartOptions.data = response[0];
            var chart = new CanvasJS.Chart(tagId, chartOptions);
            chart.render();
        }
    });
}

function loadChart(tagId, obj, condition, chartName, mapVar, theme, unit, hide) {
    if (map[mapVar] == null) {
        map[mapVar] = {
            header: null,
            stckcols: [],
            queries: [],
            historyParams: [],
            dataTable: null
        };
    }
    if (map[mapVar].header == null) {
        map[mapVar].header = chartName;
    }
    if (theme == null) {
        theme = 'light1';
    }
    var template = $("#template").html().replaceAll("%key%", mapVar).replace("%header%", map[mapVar].header);
    $("#" + tagId).html(template);
    var mapParams = {
        "tableName": obj.table,
        "label": obj.label,
        "chartType": obj.chartType == null ? 'column' : obj.chartType,
        "condition": condition,
        "chartName": chartName,
        "groupBy": obj.groupBy,
        "unit": unit,
        "y": obj.value,
        "hide": hide
    };
    $.ajax({
        type: "get",
        url: obj.url,
        data: mapParams,
        dataType: "json",
        success: function (response) {
            console.log(response[0][0]['cursor']);
            if (response[1] != null) {
                var cols = "";
                response[1]['comments'].forEach(comment => {
                    cols += "<th class='text-center'><br>" + comment + "</th>";
                });
                var body = "";
                response[1]['data'].forEach(data => {
                    body += "<tr>";
                    response[1]['fields'].forEach(field => {
                        body += "<td>" + data[field] + "</td>"
                    });
                    body += "</tr>";
                });
                var tableHtml =
                    '<thead class="thead bg-primary">' +
                    '<tr>' +
                    cols +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>' +
                    body +
                    '</tbody>' +
                    '<tfoot>' +
                    '<tr>' +
                    cols +
                    '</tr>' +
                    '</tfoot>';
                $("#" + mapVar + "_tb").html(tableHtml);
                if (map[mapVar].dataTable != null) {
                    map[mapVar].dataTable.destroy();
                }
                map[mapVar].dataTable = initDataTable("#" + mapVar + "_tb", chartName);
            }
            var chartOptions = {
                axisY: {
                    title: chartName + " (" + unit + ")",
                    titleFontSize: 16,

                },
                exportEnabled: true,
                animationDuration: 500,
                zoomEnabled: true,
                animationEnabled: true,
                theme: theme,
                title: {
                    text: chartName,
                    fontFamily: "k2d",
                    fontSize: 25,
                    padding: 10,
                    margin: 15,
                    backgroundColor: "#FFFFE0",
                    borderThickness: 1,
                    cornerRadius: 5,
                },
                subtitles: [{
                    text: ""
                }],
                data: []
            };
            chartOptions.title.text = chartName;
            var chart = new CanvasJS.Chart(mapVar + "-chart", chartOptions);
            response[0][0].click = function (e) {
                if (obj.next != null) {
                    map[mapVar].historyParams.push({ tagId: tagId, obj: obj, condition: condition, chartName: chartName, mapVar: mapVar, theme: theme, unit: unit, hide: hide });
                    var nextCondition = condition;
                    if (obj.groupBy != null) {
                        map[mapVar].stckcols.push(obj.groupBy);
                        if (map[mapVar].stckcols.length == 1) {
                            nextCondition = "" + map[mapVar].stckcols[0] + " = '" + e.dataPoint.label +
                                "'";
                        } else {
                            nextCondition = "";
                            for (let index = 0; index < map[mapVar].stckcols.length; index++) {
                                const element = map[mapVar].stckcols[index];
                                if (index < map[mapVar].stckcols.length - 1) {
                                    if (index == 0) {
                                        nextCondition += "" + element + " = '" + map[mapVar].queries[index] +
                                            "'";
                                    } else {
                                        nextCondition += " and " + element + " = '" + map[mapVar].queries[index] + "'";
                                    }
                                } else {
                                    nextCondition
                                        += "and " + element + " = '" + e.dataPoint.label + "'";
                                }
                            }
                        }
                        map[mapVar].queries.push(e.dataPoint.label);
                        chartName = map[mapVar].queries.join();
                    }
                    console.log(nextCondition);
                    loadChart(tagId, eval(mapVar)[obj.next], nextCondition, chartName, mapVar, theme, unit, hide);
                } else {
                    // alert("คุณอยู่ในระดับลึกสุดแล้วค่ะ");
                    // $("#" + mapVar + "_contents").collapse('show');
                }
            };
            if (obj.next == null) {
                response[0][0]['cursor'] = "default";
            }
            chart.options.data = response[0];
            chart.render();
        }
    });
}

function initDataTable(tagId, header) {
    $(tagId + ' >tfoot th').each(function () {
        var title = $(this).text();
        if (title.length > 0) {
            $(this).html('<input type="text" class="form-control" placeholder="' + title + '" />');
        }
    });

    return $(tagId).DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel',
            { // กำหนดพิเศษเฉพาะปุ่ม pdf
                "extend": 'pdf', // ปุ่มสร้าง pdf ไฟล์
                "text": 'บันทึกเป็น PDF', // ข้อความที่แสดง
                "pageSize": 'A4', // ขนาดหน้ากระดาษเป็น A4            
                "customize": function (doc) { // ส่วนกำหนดเพิ่มเติม ส่วนนี้จะใช้จัดการกับ pdfmake
                    // กำหนด style หลัก
                    doc.defaultStyle = {
                        font: 'THSarabun',
                        fontSize: 16
                    };
                    doc.content[0].text = header;
                    // กำหนดความกว้างของ header แต่ละคอลัมน์หัวข้อ
                    doc.styles.tableHeader.fontSize = 16; // กำหนดขนาด font ของ header
                    // วนลูปเพื่อกำหนดค่าแต่ละคอลัมน์ เช่นการจัดตำแหน่ง
                    for (var i = 1; i < doc.content[1].table.body.length; i++) { // i เริ่มที่ 1 เพราะ i แรกเป็นแถวของหัวข้อ
                        doc.content[1].table.body[i][0].alignment = 'center'; // คอลัมน์แรกเริ่มที่ 0
                        doc.content[1].table.body[i][1].alignment = 'center';
                        doc.content[1].table.body[i][2].alignment = 'left';
                        doc.content[1].table.body[i][3].alignment = 'right';
                    };
                    console.log(doc); // เอาไว้ debug ดู doc object proptery เพื่ออ้างอิงเพิ่มเติม
                }
            }, // สิ้นสุดกำหนดพิเศษปุ่ม pdf
        ],
        language: {
            "sSearch": "ค้นหา",
            "infoFiltered": "",
            "info": "แสดงรายการ _START_ ถึง _END_ จากทั้งหมด _TOTAL_ (หน้าที่ _PAGE_ จาก _PAGES_)",
            "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
            "paginate": {
                "first": "หน้าแรก",
                "last": "หน้าสุดท้าย",
                "next": "หน้าต่อไป",
                "previous": "หน้าก่อนหน้า"
            },
            "loadingRecords": "โหลด...",
            "processing": "โหลด...",
        },
        initComplete: function () {
            this.api().columns().every(function () {
                var that = this;
                $('input', this.footer()).on('keyup change clear', function () {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });
        }
    });
}

function popStack(mapVar) {
    if (map[mapVar].queries.length > 0) {
        var topData = map[mapVar].historyParams[map[mapVar].historyParams.length - 1];
        loadChart(topData.tagId, topData.obj, topData.condition, topData.chartName, topData.mapVar, topData.theme, topData.unit, topData.hide);
        map[mapVar].historyParams.pop();
        map[mapVar].stckcols.pop();
        map[mapVar].queries.pop();
    }
}
