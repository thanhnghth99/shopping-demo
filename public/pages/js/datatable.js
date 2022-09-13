$(function () {
    $(document).ready(function() {
        $('#table').removeAttr('width').DataTable({
            "pagingType": "input",
            paging: false,
            info: false,
            "searching": false,
            columnDefs: [
                { targets: "_all", className: 'dt-center', },
                { targets: 0, width: 100, },
                { targets: [1, 2, 3], width: 50, },
            ],
            fixedColumns: true,
        });
    });
})