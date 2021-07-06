// Tooltip.js
var tooltips = $('[data-toggle="tooltip"]');
if(tooltips.length > 0){
    tooltips.tooltip();
}

if(typeof Chart !== "undefined"){
    Chart.defaults.global.defaultFontFamily = 'Nunito, -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';
}

$('.custom-file-input').change(function(e){
    var fileName = this.files[0].name;
    var nextSibling = e.target.nextElementSibling;
    nextSibling.innerText = fileName;
})

if ($(window).width() < 768) {
    $('.sidebar').addClass('toggled')
}

$(document).ready(function (){
    var dataTables = $("table.data-table");
    if (dataTables.length > 0){
        dataTables.each(function(){
            let t = $(this).DataTable({
                "language": {
                    "sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
                    "sProcessing": "Sedang memproses...",
                    "sLengthMenu": "Tampilkan _MENU_ entri",
                    "sZeroRecords": "Tidak ditemukan data yang sesuai",
                    "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                    "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                    "sInfoPostFix": "",
                    "sSearch": "Cari:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "Pertama",
                        "sPrevious": "Sebelumnya",
                        "sNext": "Selanjutnya",
                        "sLast": "Terakhir"
                    }
                },
                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [[1, 'asc']]
            });

            if($(this).data('autonumber') == true){
                t.on('order.dt search.dt', function(){
                    t.column(0, {search:'applied', order:'applied'}).nodes().each(function(cell, i){
                        cell.innerHTML = i+1;
                    });
                }).draw();
            }
        });
    }
});
