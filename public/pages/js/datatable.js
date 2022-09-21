$(function () {
    $(document).ready(function() {
        $('#table').removeAttr('width').DataTable({
            "pagingType": "input",
            paging: false,
            info: false,
            "searching": false,
            columnDefs: [
                { targets: "_all", className: 'dt-center', },
                // { targets: [0, 1], width: 50%, },
                // { targets: [1, 2, 3, 4, 5, 6, 7, 8, 9], width: 5, },
            ],
            fixedColumns: true,
        });
    });
})