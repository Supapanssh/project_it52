var pageMargins = [35, 35, 35, 35];

var defaultStyle = {
  font: "THSarabun",
  fontSize: 16,
  margin: [0, 5, 0, 5], //left,top,right,bottom
};

var header = {
  fontSize: 18,
  bold: true,
  margin: [0, 5, 0, 5], //left,top,right,bottom
};

var bigHeader = {
  fontSize: 20,
  bold: true,
  alignment: "justify",
};

var subheader = {
  fontSize: 16,
  bold: true,
  margin: [0, 5, 0, 5], //left,top,right,bottom
};

var dotUnderLine = {
  fontSize: 16,
  // decoration: 'underline',
  // decorationStyle: 'dashed',
  decorationColor: "black",
};

var subheaderNoMargin = {
  fontSize: 16,
  bold: true,
  margin: [0, 0, 0, 0], //left,top,right,bottom
};

pdfMake.fonts = {
  THSarabun: {
    normal: "THSarabun.ttf",
    bold: "THSarabun-Bold.ttf",
    italics: "THSarabun-Italic.ttf",
    bolditalics: "THSarabun-BoldItalic.ttf",
  },
};

$(document).ready(function () {
  $(".data-table tfoot th").each(function () {
    var title = $(this).text();
    $(this).html(
      '<input type="text" class="form-control" placeholder="' + title + '" />'
    );
  });

  $(".data-table").DataTable({
    dom: "Bfrtip",
    buttons: ["excel"],
    language: {
      sSearch: "ค้นหา",
      infoFiltered: "",
      info:
        "แสดงรายการ _START_ ถึง _END_ จากทั้งหมด _TOTAL_ (หน้าที่ _PAGE_ จาก _PAGES_)",
      lengthMenu: "แสดง _MENU_ แถวต่อหน้า",
      paginate: {
        first: "หน้าแรก",
        last: "หน้าสุดท้าย",
        next: "หน้าต่อไป",
        previous: "หน้าก่อนหน้า",
      },

      loadingRecords: "โหลด...",
      processing: "โหลด...",
    },
  });
});
