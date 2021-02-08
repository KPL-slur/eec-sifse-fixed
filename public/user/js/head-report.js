/*
 *   Bagian ini digunakan untuk halaman head report form
 */
window.onload = function () {
    /*
     *   METHOD MEMUNCULKAN INPUT FIELD BARU
     */
    var $i = 4;
    $("#add").on("click", function () {
        if ($i < 10) {
            $i++;
            $("#dynamicFields" + $i).removeClass("d-none");
        }
    });
    /*
     *   METHOD MENYEMBUNYIKAN INPUT FIELD  YANG BARU DITAMBAHKAN
     */
    $("#remove").on("click", function () {
        if (!($i <= 1)) {
            $("#dynamicFields" + $i).addClass("d-none");
            $i--;
        }
    });

    /*
     *   METHOD MENONAKTIFKAN TOMBOL
     *   Menonaktifkan tombol add dan remove untuk memunculkan input field
     *   baru sebelum user mengisikan form pertama
     */
    if (
        $("#inputExpertise4").val() === "" ||
        $("#inputExpertiseCompany4").val() === ""
    ) {
        $("#add").prop("disabled", true);
        $("#remove").prop("disabled", true);
    }
    $("#inputExpertise4").on("change", function () {
        $("#inputExpertiseCompany4").on("change", function () {
            $("#add").prop("disabled", false);
            $("#remove").prop("disabled", false);
        });
    });
    /*
     *    METHOD MEMUNCULKAN FIELD YANG SUDAH DIIISI
     *    Memunculkan field yang sudah diisi ketika halamn di reload
     *    atau pada halaman edit
     */
    for (let $j = 0; $j < 10; $j++) {
        if ($("#inputExpertise" + $j).val() !== "") {
            $("#dynamicFields" + $j).removeClass("d-none");
        }
    }
    /*
     *   METHOD MENONAKTIFKAN FIELD
     *   Menonaktifkan field sebelum user mengisikan form sebelumnya
     */
    if ($("#inputInternalExpertise1").val() === null) {
        $("#inputInternalExpertise2").prop("disabled", true);
    }
    if ($("#inputInternalExpertise2").val() === null) {
        $("#inputInternalExpertise3").prop("disabled", true);
    }
    $("#inputInternalExpertise1").on("change", function () {
        $("#inputInternalExpertise2").prop("disabled", false);
    });
    $("#inputInternalExpertise2").on("change", function () {
        $("#inputInternalExpertise3").prop("disabled", false);
    });
};
