/*
 *   Bagian ini digunakan untuk halaman head report form
 */
window.onload = function () {
    /*
     *  disabel add manual expert button in head report livewire
     */
    if (window.location.href.indexOf("create") > -1) {
        $("#btnManualExpert").prop("disabled", true);
    }
    $("#experts\\[0\\]\\[expert_id\\]").on("change", function () {
        // console.log($("#experts\\[0\\]\\[expert_id\\]").val());
        if ($("#experts[0][expert_id]").val() != "") {
            $("#btnManualExpert").prop("disabled", true);
        }
    });
};
