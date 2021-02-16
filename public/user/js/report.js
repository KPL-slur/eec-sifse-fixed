/*
 *   Bagian ini digunakan untuk halaman head report form
 */
window.onload = function () {
    /*
     *   METHOD MEMUNCULKAN INPUT FIELD BARU
     */
    for (let index = 2; index <= 10; index++) {
        $("#dynamicFields" + index).addClass("hidden");
    }
    var $i = 1;
    $("#add").on("click", function () {
        if ($i < 10) {
            $i++;
            $("#dynamicFields" + $i).removeClass("hidden");
        }
    });
    /*
     *   METHOD MENYEMBUNYIKAN INPUT FIELD  YANG BARU DITAMBAHKAN
     */
    $("#remove").on("click", function () {
        if (!($i <= 1)) {
            $("#dynamicFields" + $i).addClass("hidden");
            $("#expertForms"+$i).val(null).trigger('change');
            $i--;
        }
    });
    
    /*
     *   METHOD MENONAKTIFKAN FIELD
     *   Menonaktifkan field sebelum user mengisikan form sebelumnya
     */
    function disableInternalExpertise() {
        if ($("#inputInternalExpertise1").val() === "") {
            $("#inputInternalExpertise2").prop("disabled", true);
        }
        if ($("#inputInternalExpertise2").val() === "") {
            $("#inputInternalExpertise3").prop("disabled", true);
        }
    }
    disableInternalExpertise();
    $("#inputInternalExpertise1").on("change", function () {
        $("#inputInternalExpertise2").prop("disabled", false);
        disableInternalExpertise();
    });
    $("#inputInternalExpertise2").on("change", function () {
        $("#inputInternalExpertise3").prop("disabled", false);
        disableInternalExpertise();
    });

    /*
     *   FUNGSI MEMANGGIL CKEDITOR
     */
    ClassicEditor.create(document.querySelector("#editor")).catch((error) => {
        console.error(error);
    });

    /*
     *  Select2 init
     */
    $(".inputExpert").select2({
        tags: true,
    });
};
