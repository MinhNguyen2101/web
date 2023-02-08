"use strict";

var KTPostSerie = function () {
    // Define shared variables
    var table = document.getElementById('kt_datatable_post_serie');
    var datatable;

    // Private functions
    var initPostSerie = function () {
        // Set date data order
        // Init datatable --- more info on datatables: https://datatables.net/manual/
        datatable = $(table).DataTable({
            "info": true,
            'order': [],
            "pageLength": 5,
            "lengthChange": false,
            'columnDefs': [
                { width: "10%", targets: 0 },
                { orderable: true, targets: -1 }, // Disable ordering on column 6 (actions)
            ],
            "fnDrawCallback": function(oSettings) {
                if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
                    $(oSettings.nTableWrapper).find('.dataTables_paginate').hide();
                } else {
                    $(oSettings.nTableWrapper).find('.dataTables_paginate').show();
                }
            }
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-user-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }

    return {
        // Public functions
        init: function () {
            if (!table) {
                return;
            }

            initPostSerie();
            handleSearchDatatable();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTPostSerie.init();
});
