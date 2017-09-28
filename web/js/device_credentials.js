$(document).ready(function () {
    $('#protocol').on('change', function (e) {
        updateDisplay($(this), $('#snmp_version')); 
    })
    $('#snmp_version').on('change', function (e) {
        updateDisplay($('#protocol'), $(this)); 
    })
    updateDisplay($('#protocol'),$('#snmp_version'));
});

function updateDisplay(protocol, snmp_version) {
//    console.log(snmp_version.val());
    $('.hidables').hide();
    switch(protocol.val()) {
        case 'snmp' :
            $('#div_snmp_ver').show();
            switch (snmp_version.val()) {
                case 'v3': 
                    $('#div_snmp_v3').show();
                    $('#div_access_dets').show();
                    break;
                default:
                    $('#div_snmp_common').show();
                    break;
            }
            break;
        default :
            $('#div_access_dets').show();
            break;
    }
}