/*
 *   Bagian ini digunakan untuk halaman head report form
 */
window.onload = function () {
    const ALPHA = /[^A-Za-z ](?=[A-Za-z ])/g;
    const WHITESPACE = /\s/g;

    /*
     *  Formating the quantity inputs
     *  by adding space before units
     */
    function addSpaceBeforeChar(className) {
        $("."+className).each(function () {
            $(this).on("keyup", function(){
                var str = $(this).val(); // retrive the inputs
                str = str.replace(WHITESPACE, ""); //remove whitespace from input first
                var result = str.replace(ALPHA, "$& "); //add space before char or string
                $(this).val(result); // return back the inputs
            });
        });
    }
    /*
     *  Memanggil method addSpaceBeforeChar
     */
    window.addEventListener('list-added', event => {
        addSpaceBeforeChar('recommends-qty');
    });
    // $('#recommends-qty').on('keyup', addSpaceBeforeChar('recommendsQty'));
    // $('#manualRecommendsQty').on('keyup', addSpaceBeforeChar('manualRecommendsQty'));
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
