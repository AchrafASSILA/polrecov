var fields = [];
$(function () {
    $("#generate").click(function () {
        $("#example1 input[type=checkbox]:checked").each(function () {
            if (
                this.value !== "on" &&
                jQuery.inArray(this.value, fields) === -1
            ) {
                $("form[class='data'] div[id='data']").append(
                    '<div  class="form-group" id="div-data" style="display: flex;align-items: center;"><input readonly type="text" class="form-control" name="subs_id[]" id="subs" value="' +
                        this.value +
                        '" /><span style="font-size: 25px;color: #ff6161;cursor: pointer;margin-left: 5px;font-weight: bold;" onclick="removeField(this)">x</span></div>'
                );
                fields.push(this.value);
                $("#generate_btn").prop("disabled", false);
            } else {
                if (this.value !== "on") {
                    swal("cet élément existe déjà !!");
                }
            }
        });
        $('input[type="checkbox"]').prop("checked", false);
    });
});
$(function () {
    var checked_cells;
    $("#show_all").click(function () {
        $("#example1").DataTable().columns().visible(true);
    });
    $("#hide_all").click(function () {
        checked_cells = $('input[name="cells"]:checked');
        if (checked_cells.length > 0) {
            $("#example1").DataTable().columns().visible(false);
            checked_cells.each(function () {
                $("#example1").DataTable().column(this.value).visible(true);
            });
            $("#example1").DataTable().column(0).visible(true);
        } else {
            swal("vous devez sélectionner des champs premièrement !!");
        }
    });
});
function removeField(element) {
    var currentElementValue = element.parentElement.children[0].value;

    if (confirm("vous voulez vraiment supprimer cet élément ?")) {
        element.parentElement.remove();
        for (var i = 0; i < fields.length; i++) {
            if (fields[i] == currentElementValue) {
                fields.splice(i, 1);
            }
        }
        if (fields.length === 0) {
            $("#generate_btn").prop("disabled", true);
        }
    }
}
function toggle(source) {
    checkboxes = document.getElementsByName("quitance_id");
    checkboxAll = document.getElementById("all");

    for (var i = 0, n = checkboxes.length; i < n; i++) {
        checkboxes[i].checked = source.checked;
    }
    this.preventDefault();
}
$('select[name="subscribers"]').on("change", function () {
    $('input[type="checkbox"]').prop("checked", false);
    var subsVal = $(this).val();
    $("#example1").DataTable().search(subsVal).draw();
});
$('select[name="impayes"]').on("change", function () {
    var subsVal = $(this).val();
    $("#example1").DataTable().search(subsVal).draw();
});

// inisialize page config
$("#reset").click(function () {
    $("#example1").DataTable().search("").draw();
    fields = [];
    $("#sub").val("");
    $('form[class="data"] div[class="form-group"]').remove();
    $('input[type="checkbox"]').prop("checked", false);
    $('select[name="impayes"]').empty();
    $('select[name="subscribers"]').empty();
    $("#example1").DataTable().columns().visible(true);
    $("#generate_btn").prop("disabled", true);
    $("#subscribers").prop("disabled", true);
});
