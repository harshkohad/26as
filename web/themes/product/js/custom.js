/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//document.getElementById('pdf').style.pointerEvents = 'none';
var deptName = $(".employee-appraisal-create-group").find("h2").text();
deptName = deptName.replace("Department", "");
$(".employee-appraisal-create-group").find("#groupmaster-group_name").val(deptName);

$(".employee-appraisal-create-group").on("click", ".btn-success", function () {
    var deptName = $("#accordion").find("h2").text();
    var groupName = $("#groupmaster-group_name").val();
    deptName = deptName.replace("Department", "");
    if (deptName == groupName) {
        alert("The group Name should contain it's Department Name and {{GROUP NAME}}");
        return false;
    }
    if (groupName.indexOf(deptName) !== -1) {
        return true;
    } else {
        alert("The group Name should contain it's Department Name");
        return false;
    }
});

// display Dept and dest dept on load 
var dept = $("#tblteamkpi-department").val();
if (dept !== undefined && dept !== null && dept !== '') {
    $("#tblteamkpi-dest_department").attr("disabled", false);
    $("#tblteamkpi-dest_department option[value=" + dept + "]").hide();
} else {
    $("#tblteamkpi-dest_department").attr("disabled", true);
}

// display destination dept on change on dept
$("#tblteamkpi-department").on("change", function () {
    var dropDown = $(this).html();
    var dept = $(this).val();
    if (dept !== undefined && dept !== null && dept !== '') {
        $("#tblteamkpi-dest_department").html(dropDown);
        $("#tblteamkpi-dest_department").attr("disabled", false);
        $("#tblteamkpi-dest_department option[value=" + dept + "]").hide();
    } else {
        $("#tblteamkpi-dest_department").attr("disabled", true);
    }
});
function getParameterByName(name, url) {
    if (!url)
        url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
    if (!results)
        return null;
    if (!results[2])
        return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

var year = getParameterByName('year');
var month = getParameterByName('month');
//$(".tbl-team-kpi-create").find("#tblteamkpi-department").val();
//$(".tbl-team-kpi-create").find("#tblteamkpi-dest_department").val();
if (month !== null)
    $(".tbl-team-kpi-create").find("#tblteamkpi-month").val(month);
if (year !== null)
    $(".tbl-team-kpi-create").find("#tblteamkpi-year").val(year);
$(".copy").click(function () {
    if ($(".to_year").val() === '') {
        alert("Please select To Year");
        return false;
    }
    if ($(".to_month").val() === '') {
        alert("Please select To Month");
        return false;
    }
});
// display to year dept on change of from year
$(".from_month").on("change", function () {
    var month = $(this).val();
    if (month !== undefined && month !== null && month !== '') {
        var dropDownMonth = $(this).html();
        $(".to_month").html(dropDownMonth);
        $('.to_month option[value=' + month + ']').remove();
    }
});
//$("tbody tr:even").css("background-color", "#eeeeee");
//$("tbody tr:odd").css("background-color", "#ffffff");

$(".remove_trainnee").click(function () {
    var msz = confirm("The selected entry will be deleted. Please confirm !!");
    if (msz == false) {
        return false;
    }
});
$(".del_variable").click(function () {
    var msz = confirm("The selected entry will be deleted. Please confirm !!");
    if (msz == false) {
        return false;
    }
});
$(".remove_gct_request").click(function () {
    var msz = confirm("The selected entry will be deleted. Please confirm !!");
    if (msz == false) {
        return false;
    }
});
$(".gct-device-template-master-index").on("click", ".remove_gct", function () {
    var msz = confirm("The selected entry will be deleted. Please confirm !!");
    if (msz == false) {
        return false;
    }
});
$(".tbl-team-kpi-index").on("click", ".remove_kpi", function () {
    var msz = confirm("The selected entry will be deleted. Please confirm !!");
    if (msz == false) {
        return false;
    }
});

//$(".box-body:eq(1)").hide();
$(".unmap-grp-emp").click(function () {
    var del_id = $(this).attr("data");
    var msz = confirm("The selected mapping will be deleted. Please confirm !!");
    if (msz == false) {
        return false;
    }
    var callUrl = '../../employeeAppraisal/group-kra/unmapemployeegroup';
    $.ajax({
        type: "POST",
        url: callUrl,
        data: {"id": del_id},
        success: function (result) {
            window.location.reload();
        }
    }
    );
});
$(".panel-heading").click(function () {
    $(this).find("i:eq(0)").toggleClass("glyphicon-minus glyphicon-plus");
});
$(".team_lead_rate").on("blur", function () {
    validateLimit($(this));
});
$(".self_rate").on("blur", function (e) {
    validateLimit($(this));
});
function validateLimit(this_) {
    var self_rate = this_.val();
    var limit = this_.parent().parent().parent().find(".rate_limt").val();
//    console.log(limit)
    if (parseInt(self_rate) > parseInt(limit)) {
        this_.attr("style", "border:1px solid red;");
        this_.parent().find("span").html("");
        this_.parent().append('<span style="color:red">Limit Exceeded</span>');
        return false;
    } else {
        this_.attr("style", "border:1px solid #ccc;");
        this_.parent().find("span").html("");
    }
//    console.log(self_rate);
}

$(".feedback_id").each(function (i) {
    var feedback_id = $(this).val();
    if (feedback_id != 0) {
        var feedback_lead = $(this).parent().find(".feedback_lead").val();
//        console.log(feedback_lead);
        if (feedback_lead != 0) {
            $(this).parent().parent().parent().parent().parent().find(".panel-heading").attr("style", "background-color:#00c0ef;")
        } else {
            $(this).parent().parent().parent().parent().parent().find(".panel-heading").attr("style", "background-color:#C0EECF")
        }
    } else {
        $(this).parent().parent().parent().parent().parent().find(".panel-heading").attr("style", "background-color:#f39c12")
    }
});
if (jsonData != '') {
    var selfRating = [];
    var leadRating = [];
    $.each(jsonData, function (index, element) {
        $.each(element, function (x, y) {
            var selfie = [];
            if (index == 'self_rate') {
                selfie.push(x);
                selfie.push(y);
                selfRating.push(selfie);
            } else if (index == 'team_lead_rate') {
                var leadie = [];
                leadie.push(x);
                leadie.push(y);
                leadRating.push(leadie);
            }

        });
    });
    var background = {
        type: 'linearGradient',
        x0: 0,
        y0: 0,
        x1: 0,
        y1: 1,
        colorStops: [{offset: 0, color: '#d2e6c9'},
            {offset: 1, color: 'white'}]
    };
    $('#jqChart').jqChart({
        title: {text: 'Column Chart'},
        background: 'whitesmoke',
        border: {
            cornerRadius: 0,
            lineWidth: 1,
            strokeStyle: '#ddd'
        },
        animation: {duration: 1},
        watermark: {
//            text: 'STC',
            fillStyle: 'blue',
            font: '16px sans-serif',
            hAlign: 'right',
            vAlign: 'bottom'
        },
        shadows: {
            enabled: true
        },
        series: [
            {
                type: 'column',
                title: 'Self Rate',
                fillStyle: '#418CF0',
                data: selfRating,
                labels: {
                    fillStyle: '#418CF0',
                    font: '11px sans-serif'
                }
            },
            {
                type: 'column',
                title: 'Team lead Rate',
                fillStyle: '#FCB441',
                data: leadRating,
                labels: {
                    fillStyle: '#FCB441',
                    font: '11px sans-serif'
                }
            }
        ]
    });
} else {

}
// JS FOR trainning staff START
$(".trainning-master-form").find("#w1-kvdate").hide();
$(".trainning-master-form").find(".field-trainningmaster-url").hide();
$(".trainning-master-form").find(".field-trainningmaster-trainning_document").hide();
$(".trainning-master-form").on("click", ".doc-file", function () {
    $(".trainning-master-form").find(".field-trainningmaster-url").hide();
    $(".trainning-master-form").find(".field-trainningmaster-trainning_document").show();
    $(".trainning-master-form").find(".field-trainningmaster-trainning_document").find("label").hide();
});
$(".trainning-master-form").on("click", ".doc-url", function () {
    $(".trainning-master-form").find(".field-trainningmaster-trainning_document").hide();
    $(".trainning-master-form").find(".field-trainningmaster-url").show();
    $(".trainning-master-form").find(".field-trainningmaster-url").find("label").hide();
});
$(".trainning-master-form").on("click", "#trainningmaster-is_outsourced", function () {
    if ($(this).is(':checked')) {
        $(".trainning-master-form").find("#w1-kvdate").show();
    } else {
        $(".trainning-master-form").find("#w1-kvdate").hide();
    }
});
$("#trainneemaster-department_id").on("change", function () {
    $('#ajaxLoading').show();
    var dept_id = $(this).val();
    actionUrl = '../trainnee-master/get-dept-users';
    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: {"dept_id": dept_id},
        dataType: 'json',
        success: function (result) {
            $("#trainneemaster-trainnee_id").html('');
            $.each(result, function (index, element) {
                console.log("index  " + index + "element  " + element);
                $("#trainneemaster-trainnee_id").append('<option value=' + index + '>' + element + '</option>');
            });
        },
        complete: function () {
            $('#ajaxLoading').hide();
        }
    });
});
// JS FOR trainning staff END
$("#chart-filter").on("change", "#groupkra-year", function () {
    $("#groupkra-quarter").parent().parent().remove();
    $("#groupkra-group_id").parent().parent().remove();
    $("#groupkra-emp_id").parent().parent().remove();
});
$("#chart-filter").on("change", "#groupkra-quarter", function () {
    $("#groupkra-group_id").parent().parent().remove();
    $("#groupkra-emp_id").parent().parent().remove();
});
$("#chart-filter").on("change", "#groupkra-group_id", function () {
    $("#groupkra-emp_id").parent().parent().remove();
});
var device_id = '';
var subtype_div_id = '';
var actionUrl = '';
$(".field-gctdevicevariablemaster-device_type").on("change", "#gctdevicevariablemaster-device_type", function () {
    $('#ajaxLoading').show();
    device_id = $(this).val();
    subtype_div_id = '#gctdevicevariablemaster-sub_type';
    url = '../gct-device-template-master/get-subtype';
    $(".gct-template-variable-master-form").find(".device-variables").html('');
    getSubType(device_id, subtype_div_id, url);
});

$(".compliance-show-run-form").on("change", "#complianceshowrun-device_id", function () {
    $('#ajaxLoading').show();
    device_id = $(this).val();
    subtype_div_id = '#complianceshowrun-device_subtype_id';
    url = '../../gctManagement/gct-device-template-master/get-subtype';
    getSubType(device_id, subtype_div_id, url);
});

$(".gct-device-template-master-form").on("change", "#gctdevicetemplatemaster-device_type", function () {
    $('#ajaxLoading').show();
    device_id = $(this).val();
    subtype_div_id = '#gctdevicetemplatemaster-sub_type';
    url = '../gct-device-template-master/get-subtype';
    getSubType(device_id, subtype_div_id, url);
});
$(".gct-template-master-form").on("change", '#gcttemplatemaster-device_id', function () {
    $('#ajaxLoading').show();
    device_id = $(this).val();
    subtype_div_id = '#gcttemplatemaster-device_subtype_id';
    url = '../gct-device-template-master/get-subtype';
    getSubType(device_id, subtype_div_id, url);
});
$(".gct-template-master-form").on("change", "#gcttemplatemaster-device_subtype_id", function () {
    subtype_div_id = $(this).val();
    $('#ajaxLoading').show();
    $("#gcttemplatemaster_device_subtype_id").text('');
    $.ajax({
        url: '../gct-device-template-master/get-template',
        type: 'POST',
        data: {"device_id": subtype_div_id},
        dataType: 'json',
        success: function (result) {
            if (result != "") {
                var templateLines = result.split("\n");
                var preview_template = '<ol>';
                templateLines.forEach(function (i) {
                    preview_template += "<li>" + i + "</li>";
                });
                preview_template += '</ol>';
                $("#gcttemplatemaster_device_subtype").html(preview_template);
                $("#gcttemplatemaster_device_subtype").attr("style", "height:600px");
            } else {
                $("#gcttemplatemaster_device_subtype").html("");
                $("#gcttemplatemaster_device_subtype").attr("style", "height:50px");
            }
            $(".gct-template-master-form .suggestion-label").show(200);
            $(".gct_action").show(200);
        },
        complete: function () {
            $('#ajaxLoading').hide();
        }
    });
});
function getSubType(device_id, subtype_div_id, actionUrl) {
    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: {"device_id": device_id},
        dataType: 'json',
        success: function (result) {
//            console.log(result)
            $(subtype_div_id).html('');
            $(subtype_div_id).append("<option value >Select Subtype</option>");
            $.each(result, function (index, element) {
                $(subtype_div_id).attr("disabled", false);
                $(subtype_div_id).append("<option value=" + index + " >" + element + "</option>");
            });
        },
        complete: function () {
            $('#ajaxLoading').hide();
        }
    });
}
//

$(".gct-device-template-master-index table thead tr:eq(1)").hide();
$(".gct-device-template-master-index table thead tr").each(function () {
    $(this).find("th:eq(3)").hide();
});
$(".gct-device-template-master-index table tbody tr").each(function () {
    $(this).find("td:eq(3)").hide();
});
$(".view_template").click(function () {
    var deviceType = $(this).parent().parent().find("td:eq(1)").text();
    var deviceSubtype = $(this).parent().parent().find("td:eq(2)").text();
    var templatedata = $(this).parent().parent().find("td:eq(3)").text();
    $("div#previousConfigModel").find("h4.modal-title").html("Base Template for " + deviceType + " (" + deviceSubtype + ")");
    var templateLines = templatedata.split("\n");
    var preview_template = '<ol>';
    templateLines.forEach(function (i) {
        preview_template += "<li>" + i + "</li>";
    });
    preview_template += '</ol>';
    $("div#previousConfigModel div.modal-body").html(preview_template);
    $("div#previousConfigModel").modal("show");
});
var rowCount = 1;
$(".add_request").click(function () {
    $(".gct_action").append('<div class="row"><div class="col-sm-2"><div class="form-group field-gcttemplatemaster-action"><label class="control-label" for="gcttemplatemaster-action">Action</label><select id="gcttemplatemaster-action" class="form-control" name="action[' + rowCount + ']" required><option value="">Select Action</option><option value="add">Add</option><option value="remove">Remove</option></select><div class="help-block"></div></div></div><div class="col-sm-2"><div class="form-group field-gcttemplatemaster-gct_type"><label class="control-label" for="gcttemplatemaster-gct_type">Gct Type</label><select id="gcttemplatemaster-gct_type" class="form-control" name="gct_type[' + rowCount + ']" required><option value="">Select Type</option><option value="Static">Static</option><option value="Dynamic">Dynamic</option></select><div class="help-block"></div></div></div><div class="col-sm-5"><div class="form-group field-gcttemplatemaster-template"><label class="control-label" for="gcttemplatemaster-template_content">Template Content</label><textarea id="gcttemplatemaster-template_content" class="form-control" name="template_content[' + rowCount + ']" required></textarea></div></div><div class="col-sm-1"><div class="form-group field-gcttemplatemaster-line_number"><label class="control-label" for="gcttemplatemaster-line_number">Line Number</label><input type="number" id="gcttemplatemaster-line_number" class="form-control" name="line_number[' + rowCount + ']" placeholder="Line No." required></div></div><div class="col-sm-2"><label class=""></label><br><span class="glyphicon glyphicon-minus remove_request btn btn-danger" title="Remove Option"></span></div></div>');
    rowCount++;
});
$(".template-label").click(function () {
    $(this).parent().find("#gcttemplatemaster_device_subtype").toggle(200);
    $(this).parent().find(".base_templae_sample").toggle(200);
});
$(".gct_action").on("click", ".remove_request", function (e) {
    e.preventDefault();
    $(this).parent().parent('div').remove();
    rowCount--;
});
$(".gct_action").on("change", "#gcttemplatemaster-action", function () {
    var action = $(this).val();
    var row_count = $(this).parent().parent().parent().index();
    if (action === "remove") {
        $(this).parent().parent().parent().find("#gcttemplatemaster-gct_type").attr("disabled", true);
        $(this).parent().parent().parent().find("#gcttemplatemaster-template_content").attr("disabled", true);
        $(this).parent().parent().parent().find(".field-gcttemplatemaster-line_number #gcttemplatemaster-line_number").before("<span>From-</span>");
        $(this).parent().parent().parent().find(".field-gcttemplatemaster-line_number").append('<div>To-<input type="number" id="gcttemplatemaster-line_number_to" class="form-control" name="line_number_to[' + row_count + ']" placeholder="Line No. To" aria-required="true" aria-invalid="true" required></div>');
    } else {
        $(this).parent().parent().parent().find("#gcttemplatemaster-gct_type").attr("disabled", false);
        $(this).parent().parent().parent().find("#gcttemplatemaster-template_content").attr("disabled", false);
        $(this).parent().parent().parent().find(".field-gcttemplatemaster-line_number").find("span").remove();
        $(this).parent().parent().parent().find(".field-gcttemplatemaster-line_number").find("div").remove();
    }
});
$(".gct-template-master-form").on("blur", "#gcttemplatemaster-line_number_to", function () {

    var from_line = $(this).parent().find("#gcttemplatemaster-line_number").val();
    if (parseInt(from_line) > parseInt($(this).val())) {
        alert("To line cannot be Less then From line");
        $(this).val("");
        return false;
    }
});
// Logic for preview gct base template as per suggestion start
$(".gct-suggestion-action-form").on("click", ".preview", function () {

    var line_number = '';
    var template_content = '';
    var action_type = '';
    var line_number_from = '';
    var line_number_to = '';
    line_number = $(this).parent().parent().find("td:eq(3)").text();
    template_content = $(this).parent().parent().find("td:eq(2)").text();
    action_type = $(this).parent().parent().find("td:eq(0)").text();
    var split_template_content = template_content.split("\n");
    var base_template = $(".modal-body").find("#gcttemplatemaster_device_subtype_id").text();
    var splittedlines = base_template.split("\n");
    $(".modal-body").find("ol").remove();
    line_number = parseInt(line_number - 1);
//    console.log(line_number);
    if (isNaN(line_number)) {
        line_number = $(this).parent().parent().find("td:eq(3)").text();
        var splitLN = line_number.split("-");
        line_number_from = ($.trim(splitLN[0]) - 1);
        line_number_to = ($.trim(splitLN[1]) - 1);
    }

    if (action_type == "ADD") {

        var counter = 0;
        split_template_content.forEach(function (x) {
            splittedlines.splice(parseInt(line_number + counter), 0, '<span style="color:green;background:#D0FEE1">' + x + '</span>');
            counter++;
        });
        var preview_template = '<ol>';
        splittedlines.forEach(function (i) {
            preview_template += "<li>" + i + "</li>";
        });
        preview_template += "</ol>";
        $(".modal-body").append(preview_template);
        $(".modal-body").find("#gcttemplatemaster_device_subtype_id").hide();
    }
    if (action_type == "REMOVE") {
        for (var i = line_number_from; i <= line_number_to; i++) {
            splittedlines[parseInt(i)] = '<span style="color:red;"><strike>' + splittedlines[parseInt(i)] + '</strike></span>';
        }
        var preview_template = '<ol>';
        splittedlines.forEach(function (i) {
            preview_template += "<li>" + i + "</li>";
        });
        preview_template += "</ol>";
        $(".modal-body").append(preview_template);
        $(".modal-body").find("#gcttemplatemaster_device_subtype_id").hide();
    }
    $("div#previousConfigModel").modal("show");
});
// Logic for preview gct base template as per suggestion End

// Logic to approve gct Template suggestion START
$(".gct-suggestion-action-form").on("click", ".approve", function () {
    $('#ajaxLoading').show();
    var id = $(this).parent().parent().find(".hidden_gct_template_id").val();
    $.ajax({
        url: '../gct-template-master/approve',
        type: 'POST',
        data: {"id": id},
        dataType: 'json',
        success: function (result) {
            console.log(result)
            $('#ajaxLoading').hide();
            if (result == 1) {
                location.reload();
            }
        },
        complete: function () {

        }
    });
});
// Logic to approve gct Template suggestion END

// Logic to reject gct Template suggestion START
$(".gct-suggestion-action-form").on("click", ".reject", function () {
    $('#ajaxLoading').show();
    var id = $(this).parent().parent().find(".hidden_gct_template_id").val();
    $.ajax({
        url: '../gct-template-master/rejected',
        type: 'POST',
        data: {"id": id},
        dataType: 'json',
        success: function (result) {
            console.log(result)
            $('#ajaxLoading').hide();
            if (result == 1) {
                location.reload();
            }
        },
        complete: function () {

        }
    });
});
// Logic to reject gct Template suggestion END

$(".gct-download-version-base-template").on("click", ".preview", function () {
    var templateData = $(this).parent().find("#base_template").html();
    splittedlines = templateData.split("\n");
    var preview_template = '<ol>';
    splittedlines.forEach(function (i) {
        preview_template += "<li>" + i + "</li>";
    });
    preview_template += "</ol>";
    $("#previousConfigModel").find(".modal-body").html(preview_template);
    $("div#previousConfigModel").modal("show");
});
$("#gctdevicevariablemaster-sub_type").on("change", function () {

    var dev_id = $(this).parent().parent().parent().find("#gctdevicevariablemaster-device_type").val();
    var subtype_div = $(this).val();
    $('#ajaxLoading').show();
    $.ajax({
        url: '../gct-device-variable-master/getvariable',
        type: 'POST',
        data: {"device_id": dev_id, "subtype_div_id": subtype_div},
        dataType: 'json',
        async: true,
        success: function (result) {
            var variables = "<ol>";
            $.each(result, function (index, element) {
                variables += '<li><input type="hidden" value="' + index + '" /><a class="glyphicon glyphicon-remove del_variable" style="color:red;" href="#"></a>{{' + element + '}}</li>';
            });
            variables += "</ol>";
            $(".device-variables").html(variables);
        },
        complete: function () {
            $('#ajaxLoading').hide();
        }
    });
});
$(".device-variables").on("click", ".del_variable", function () {

    var msz = confirm("The selected entry will be deleted. Please confirm !!");
    if (msz == false) {
        return false;
    }
    var variable_id = $(this).parent().find("input").val();
    $('#ajaxLoading').show();
    $.ajax({
        url: '../gct-device-variable-master/remove',
        type: 'POST',
        data: {"id": variable_id},
        dataType: 'json',
        async: true,
        success: function (result) {
            var dev_id = $("#gctdevicevariablemaster-sub_type").parent().parent().parent().find("#gctdevicevariablemaster-device_type").val();
            var subtype_div = $("#gctdevicevariablemaster-sub_type").val();
//            $('#ajaxLoading').show();
            $.ajax({
                url: '../gct-device-variable-master/getvariable',
                type: 'POST',
                data: {"device_id": dev_id, "subtype_div_id": subtype_div},
                dataType: 'json',
                async: true,
                success: function (result) {
                    var variables = "<ol>";
                    $.each(result, function (index, element) {
                        variables += '<li><input type="hidden" value="' + index + '" /><a class="glyphicon glyphicon-remove remove_gct_request del_variable" style="color:red;" href="#"></a>{{' + element + '}}</li>';
                    });
                    variables += "</ol>";
                    $(".device-variables").html(variables);
                },
                complete: function () {
//                    $('#ajaxLoading').hide();
                }
            });
        },
        complete: function (data) {
            $('#ajaxLoading').hide();
        }
    });
});
$("#gcttemplatemaster-device_subtype_id").on("change", function () {

    var dev_id = $(this).parent().parent().parent().find("#gcttemplatemaster-device_id").val();
    var subtype_div = $(this).val();
    $('#ajaxLoading').show();
    var msz = '';
    $.ajax({
        url: '../gct-device-variable-master/getvariable',
        type: 'POST',
        data: {"device_id": dev_id, "subtype_div_id": subtype_div},
        dataType: 'json',
        async: true,
        success: function (result) {
            var variables = "<ol>";
            $.each(result, function (index, element) {
                variables += '<li><a onClick="copyToClipboard($(this));" href="#" >{{' + element + '}}</a></li>';
            });
            variables += "</ol>";
            $(".variables-list .variable").html(variables);
        },
        complete: function (data) {
            $('#ajaxLoading').hide();
        }
    });
});
var text = '';
function copyToClipboard(text) {

    document.getElementById("message").innerHTML = text.html();
    $("#message").show();
    var aux = document.createElement("input");
    aux.setAttribute("value", document.getElementById("message").innerHTML);
    document.body.appendChild(aux);
    aux.select();
    document.execCommand("copy"); //
    document.body.removeChild(aux);
    $("#message").fadeOut(2000);
}

$(".gct-template-master-create").on("change", "#gcttemplatemaster-gct_type", function () {
    if ($(this).val() == "Dynamic") {
        $(".variables-list").show();
    }
});

/// Problem Management
$(".problem-management-monthly-problem-list").on("click", ".select_all_ticket", function () {
    if (this.checked) {
// Iterate each checkbox
        $(".problem-management-monthly-problem-list").find('.select_ticket').each(function () {
            this.checked = true;
        });
    } else {
        $(".problem-management-monthly-problem-list").find('.select_ticket').each(function () {
            this.checked = false;
        });
    }
});
$(".problem-management-monthly-problem-list").on("click", ".select_ticket", function () {
    if (!this.checked) {
        $(".problem-management-monthly-problem-list").find('.select_all_ticket').attr("checked", false);
    }
});
$(".problem-management-monthly-problem-list").on("click", ".create_report", function () {
    var rootCause = $(this).parent().parent().find("td:eq(0)").text();
    $("div#previousConfigModel").find("#problemmanagement-problem_record").val(rootCause);
    $("div#previousConfigModel").modal("show");
});

// Show run compliance
$(".compliance-show-run-index").on("click", ".view_difference", function () {
//    var ipAddress = $(this).parent().parent().find("td:eq(3)").text();
//    var createdAt = $(this).parent().parent().find("td:eq(5)").text();
    var diff = 'test';
    var complianceId = $(this).attr("data-id");

    $.ajax({
        url: '../compliance-show-run/getdiff',
        type: 'POST',
//        data: {"id": complianceId, "ip_address": ipAddress, "created_at": createdAt},
        data: {"id": complianceId},
        dataType: 'json',
        async: true,
        success: function (result) {
            diff = result;
        },
        complete: function (data) {
            diff = data.responseText;
            console.log(diff);
            $("div#configDiffModel").find(".modal-body").html(diff);
            $("div#configDiffModel").modal("show");
        }
    });
});

//$(".compliance-show-run-form").on("click", ".execute-showrun", function () {
//    $("#complianceshowrun-ip_address").attr("disabled", true);
//    $(".field-complianceshowrun-device_subtype_id").attr("disabled", true);
//    $(".field-complianceshowrun-device_id").attr("disabled", true);
//    
//    window.open('../compliance-show-run/logshowruncompliance');
//});