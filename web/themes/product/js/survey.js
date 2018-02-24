/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//$(".input_fields_wrap").attr("disabled", true);
var max_fields = 5; //maximum input boxes allowed
var wrapper = $(".input_fields_wrap"); //Fields wrapper
var x = 1; //initlal text box count
var row = 0;
$(".add_option").click(function (e) { //on add input button click
    e.preventDefault();
    var row_number = $(this).parent().parent().find(".row_count").val();
    if (x < max_fields) { //max input box allowed
        x++; //text box increment input_btn
        $(this).parent().parent().find(".input_fields_wrap").append('<br/><br/><div><input type="text" class="form-control custom_input" name="options_' + row_number + '[' + x + ']" required />&nbsp;&nbsp;&nbsp;<a href="#" class="glyphicon glyphicon-remove remove_field btn btn-danger"></a>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="answer_' + row_number + '[' + x + ']" />&nbsp;&nbsp;&nbsp;&nbsp;<label>Is Answer ?</label></div>'); //add input box
    }
});

$(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
    e.preventDefault();
    $(this).parent('div').remove();
    x--;
    row--;
});
var a = 1;
$(".add_row").click(function () {
    row++;
    a = 1;
    var rowHtml = '<div class="row"><input type="hidden" class="row_count" value="' + row + '"/>';
    rowHtml += '<div class="col-md-3"><div class="form-group field-trainningsurveymaster-question required"><label class="control-label" for="trainningsurveymaster-question">Question</label><textarea id="trainningsurveymaster-question" class="form-control" name="question[]" maxlength="255" aria-required="true"></textarea><div class="help-block"></div></div></div>';
    rowHtml += '<div class="col-md-5 input_fields_wrap"><label class="">Options Answer</label><br><input type="text" class="form-control custom_input" name="options_' + row + '[1]" required="">&nbsp;&nbsp;';
    rowHtml += '<a href="#" class="glyphicon glyphicon-plus add_option btn btn-success" onClick="add_opt($(this));" title="Add Option"></a>&nbsp;&nbsp;<input type="checkbox" name="answer_' + row + '[1]" class="custom_checkbox" title="Is Answer">&nbsp;&nbsp;&nbsp;&nbsp;<label>Is Answer ?</label>';
    rowHtml += '</div>';
    rowHtml += '';
    var removeRowHtml = '<br/><br/><div class="col-md-2"><label class = "" ></label><br/><a href="#" class="remove_row btn btn-danger">Remove Question </a></div></div>';
    $(".fields_wrapper").append('<div>' + rowHtml + removeRowHtml + ' </div>');
});
$(".fields_wrapper").on("click", ".remove_row", function (e) {
    e.preventDefault();
    $(this).parent().parent().parent('div').remove();
});

function add_opt(z) {
    var row_number = z.parent().parent().find(".row_count").val();
    a++;
    z.parent().append('<br/><br/><div><input type="text" class="form-control custom_input" name="options_' + row_number + '[' + a + ']" required/>&nbsp;&nbsp;&nbsp;<a href="#" onClick="remove_opt($(this));" class="glyphicon glyphicon-remove remove_field btn btn-danger"></a>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="answer_' + row_number + '[' + a + ']" />&nbsp;&nbsp;&nbsp;&nbsp;<label>Is Answer ?</label></div>');
}

function remove_opt(y) {
    y.parent('div').remove();
    a--;
}

$(".submit").click(function () {
    flag = 1;
    $(".input_fields_wrap").each(function (index) {
        if ($(".input_fields_wrap:eq(" + index + ")  :checkbox:checked").length > 0) {
        } else {
            alert("Please check correct answer for question No " + (index + 1));
            flag = 0;
        }
    });
    if (flag == 0) {
        return false;
    }
});

//$(".trainning-survey-master-view").on("click", ".chk_ans", function () {
//    var surveyanswers = [];
//    $(this).parent().parent().find(":hidden").each(function (x) {
//        surveyanswers.push($(this).val());
//    });
//    if ($(this).is(':checked')) {
//        if (jQuery.inArray($(this).parent().find("label").text(), surveyanswers) != -1) {
////            alert("The answer is Correct");
//        } else {
////            alert("The answer is Incorrect");
////            $(this).attr("checked", false);
//        }
//    }
//});

//$(".survey_submit").hide();
//$(".check-answer").on("click", function () {
//    var answers = [];
//    $(this).parent().parent().find(".optional_answer").find(":hidden").each(function (x) {
//        answers.push($(this).val());
//    });
////    alert(answers);
//    $(this).parent().parent().find(".optional_answer").find(":checkbox").each(function (ind) {
//        if ($(this).is(':checked')) {
//            if (jQuery.inArray($(this).parent().find("label").text(), answers)) {
//                alert("is in array");
//            } else {
//                alert("is NOT in array");
//            }
//        }
//    });
//});
$(".survey_submit").click(function () {
    flag = 1;
    $(".optional_answer").each(function (index) {
        if ($(".optional_answer:eq(" + index + ")  :checkbox:checked").length > 0) {
        } else {
            if ($(".optional_answer:eq(" + index + ")  :radio:checked").length > 0) {

            } else {
                alert("Please check correct answer for question No " + (index + 1));
                flag = 0;
            }
        }
    });
    if (flag == 0) {
        return false;
    }
});
$(".feedback-report-month").each(function (index) {

    var monthDept = $(this).val();
    var deptData = $(".feedback-report-deptData:eq(" + index + ")").val();
    deptData = JSON.parse(deptData);
    var arr_deptData = [];
    var counter = 0;
    $.each(deptData, function (index, element) {
        var dept = [];
        dept.push(index);
        dept.push(element);
        arr_deptData.push(dept);
    });
    $('#jqChart_' + monthDept).jqChart({
        title: {text: 'Department Report (%)'},
        border: {
            cornerRadius: 0,
            lineWidth: 1,
            strokeStyle: '#DDD'
        },
        animation: {duration: 1},
        shadows: {
            enabled: true
        },
        background: 'whitesmoke',
        axes: [
            {
                type: 'category',
                location: 'bottom',
                labels: {
                    font: '12px sans-serif',
                    angle: 45
                }
            }
        ],
        series: [
            {
                type: 'column',
                title: 'Average Rating',
                fillStyles: ['#418CF0', '#FCB441', '#E0400A', '#056492', '#BFBFBF', '#1A3B69', '#FFE382'],
                data: arr_deptData,
                labels: {
                    font: '11px sans-serif',
                    angle: -45
                }
            },
        ]
    });
});
$(".feedback-report-dept").each(function (index) {

    var monthDept = $(this).val();
    var deptData = $(".feedback-report-deptData:eq(" + index + ")").val();
    deptData = JSON.parse(deptData);

    var arr_deptData = [];
    var subData = [];

    $.each(deptData, function (month, monthlyData) {

        var deptdata = [];
        var kraRate = 0;
        var kraRateLimit = 0;
        var kraDatas = [];
        deptdata.push(month);

        $.each(monthlyData, function (kra, kraData) {
            var tempKra = [];
            kraRate += parseInt(kraData.rating);
            kraRateLimit += parseInt(kraData.rating_limit);
            var percent = ((parseInt(kraData.rating) / parseInt(kraData.rating_limit)) * 100).toFixed(2);
            tempKra.push(kra);
            tempKra.push(parseFloat(percent));
            kraDatas.push(tempKra);
        });

        var month_percent = ((parseInt(kraRate) / parseInt(kraRateLimit)) * 100).toFixed(2);
        deptdata.push(parseFloat(month_percent));
        subData.push(kraDatas);
        arr_deptData.push(deptdata);
    });

    function addCommas(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '1%' + ',' + '2%');
        }
        return x1 + x2;
    }

    $('#jqChart_' + monthDept).bind('tooltipFormat', function (e, data) {
        return addCommas(data.y) + '%';
    });
    $('#jqChart_' + monthDept).bind('dataPointLabelCreating', function (event, data) {
        data.text = addCommas(data.text) + '%';
    });
    var data = arr_deptData;
    function initChart() {
        $('#jqChart_' + monthDept).jqChart({
            title: 'Monthly Data (%)',
            background: 'whitesmoke',
            border: {
                cornerRadius: 0,
                lineWidth: 1,
                strokeStyle: '#DDD'
            },
            animation: {duration: 1},
            shadows: {
                enabled: true
            },
            axes: [
                {
                    type: 'category',
                    location: 'bottom',
                    labels: {
                        font: '11px sans-serif',
                        angle: 45
                    }
                }
            ],
            series: [
                {
                    type: 'column',
                    title: 'Average Rating',
                    fillStyles: ['#418CF0', '#FCB441', '#E0400A', '#056492', '#BFBFBF', '#1A3B69', '#FFE382'],
                    data: data,
                    cursor: 'pointer',
                    labels: {
                        fillStyles: ['#418CF0', '#FCB441', '#E0400A', '#056492', '#BFBFBF', '#1A3B69', '#FFE382'],
                        font: '11px sans-serif'
                    }
                },
            ]
        });
    }

    initChart();
    $('#jqChart_' + monthDept).bind('dataPointMouseDown', function (event, data) {

        var title = $('#jqChart_' + monthDept).jqChart('option', 'title');
        if (title.text != 'Monthly Data (%)') {
            return;
        }

        var newData = subData[data.index];
        $('#jqChart_' + monthDept).jqChart({
            title: 'Monthly KRA Data (%)',
            background: 'whitesmoke',
            animation: {duration: 1},
            shadows: {
                enabled: true
            },
            border: {
                cornerRadius: 0,
                lineWidth: 1,
                strokeStyle: '#DDD'
            },
            axes: [
                {
                    type: 'category',
                    location: 'bottom',
                    labels: {
                        font: '12px sans-serif',
                        angle: 45
                    }
                }
            ],
            series: [
                {
                    type: 'column',
                    title: 'Individual, KRA, Rate (%)',
                    fillStyles: ['#418CF0', '#FCB441', '#E0400A', '#056492', '#BFBFBF', '#1A3B69', '#FFE382'],
                    data: newData,
                    cursor: 'pointer',
                    labels: {
                        font: '11px sans-serif'
                    }
                },
            ]

        });
    });
    $('#jqChart_' + monthDept).bind("contextmenu", function (e) {

        var title = $('#jqChart_' + monthDept).jqChart('option', 'title');
        if (title.text == 'Monthly Data (%)') {
            return;
        }

        initChart();
        return false;
    });
});