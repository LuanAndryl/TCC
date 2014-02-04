//MASC PARA MUDAR COLOR DAS TABLE
$(function() {
    "use strict"; // jshint ;_;
    $(".changeColor").mousemove(function() {
        $(this).find("td").addClass('estiloTabela');
    });

    $(".changeColor").mouseout(function() {
        $(this).find("td").removeClass('estiloTabela');
    });

});
//FUNC PARA MUDAR COR DA TEXTBOX
$('form').validate({
    onBlur: true,
    eachValidField: function() {

        $(this).closest('div').removeClass('error').addClass('success');
    },
    eachInvalidField: function() {

        $(this).closest('div').removeClass('success').addClass('error');
    }
});

//FUNC PARA MASC DE DADOS

jQuery(function() {
    jQuery("#nascimento").mask("99/99/9999");
    jQuery("#rg").mask("99.999.999-*");
    jQuery("#tel").mask("(99) 9999-9999");
    jQuery("#inscrCentro").mask("9999-9");
});