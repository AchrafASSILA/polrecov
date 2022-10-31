import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

$(document).ready(function () {
    $("#example1").dataTable({
        columnDefs: [{ searchable: false, targets: [1, 2, 3, 4] }],
    });
});
$("#sub").keyup(function () {
    $('input[type="checkbox"]').prop("checked", false);
    $("#example1").DataTable().search($(this).val()).draw();
});
