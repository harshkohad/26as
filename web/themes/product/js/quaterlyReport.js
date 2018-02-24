/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(".feedback-report-quarterly").each(function (index) {

    var qtrCount = (index + 1);
    var deptData = $(".feedback-report-quarterlyData:eq(" + index + ")").val();
    deptData = JSON.parse(deptData);
    var dept = [];
    var group = [];
    var emp = [];
    var kra = [];

    $.each(deptData, function (deptName, deptVal) {

        var deptdata = [];
        var grpdata = [];
        var empData = [];
        var allKraData = [];
        var dr = 0;
        var drl = 0;

        var grpLeadRate = 0;
        var grpRateLimit = 0;
        deptdata.push(deptName);

        $.each(deptVal, function (groupName, groupVal) {

            var tempgrpdata = [];
            var empdata = [];
            var kraDatas = [];

            var gr = 0;
            var grl = 0;

            tempgrpdata.push(groupName);

            $.each(groupVal, function (empName, empval) {

                var tempempdata = [];
                var kradata = [];

                var er = 0;
                var erl = 0;

                tempempdata.push(empName);

                $.each(empval, function (kraName, kraVal) {
                    var tempKra = [];
                    er += parseInt(kraVal.team_lead_rate);
                    erl += parseInt(kraVal.rate_limit);
                    var percent = ((parseInt(kraVal.team_lead_rate) / parseInt(kraVal.rate_limit)) * 100).toFixed(2);
                    tempKra.push(kraName);
                    tempKra.push(parseFloat(percent));
                    kradata.push(tempKra);

                });

                gr += er;
                grl += erl;

                var emp_percent = ((parseInt(er) / parseInt(erl)) * 100).toFixed(2);
                tempempdata.push(parseFloat(emp_percent));
                empdata.push(tempempdata);
                kraDatas.push(kradata);
            });

            dr += gr;
            drl += grl;

            var grp_percent = ((parseInt(gr) / parseInt(grl)) * 100).toFixed(2);
            tempgrpdata.push(parseFloat(grp_percent));
            grpdata.push(tempgrpdata);
            empData.push(empdata);
            allKraData.push(kraDatas);

        });
        var dept_percent = ((parseInt(dr) / parseInt(drl)) * 100).toFixed(2);
        deptdata.push(parseFloat(dept_percent));
        dept.push(deptdata);
        group.push(grpdata);
        emp.push(empData);
        kra.push(allKraData);
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

    $('#jqChart_' + qtrCount).bind('tooltipFormat', function (e, data) {
        return addCommas(data.y) + '%';
    });
    $('#jqChart_' + qtrCount).bind('dataPointLabelCreating', function (event, data) {
        data.text = addCommas(data.text) + '%';
    });

    function initChart() {
        $('#jqChart_' + qtrCount).jqChart({
            title: 'Department Report (%)',
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
                    data: dept,
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
    var deptIndex = '';
    var grpIndex = '';
    var empIndex = '';

    $('#jqChart_' + qtrCount).bind('dataPointMouseDown', function (event, data) {
        var newData = '';
        var newTitle = '';

        var title = $('#jqChart_' + qtrCount).jqChart('option', 'title');

        if (title.text == 'Department Report (%)') {
            console.log("in dept");
            deptIndex = data.index;
            newData = group[data.index];
            newTitle = 'Group Report (%)';
        } else if (title.text == 'Group Report (%)') {
            console.log("in grp");
            grpIndex = data.index;
            newData = emp[deptIndex][data.index];
            newTitle = 'Employee Report (%)';
        } else if (title.text == 'Employee Report (%)') {
            console.log("in Emp");
            newData = kra[deptIndex][grpIndex][data.index];
            newTitle = 'KRA Report (%)';
        } else {
            console.log("No");
            return;
        }
        console.log(newData);
        console.log(newTitle);

        $('#jqChart_' + qtrCount).jqChart({
            title: newTitle,
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

    $('#jqChart_' + qtrCount).bind("contextmenu", function (e) {

        var title = $('#jqChart_' + qtrCount).jqChart('option', 'title');
        if (title.text == 'Group Report (%)') {
            return;
        }

        initChart();
        return false;
    });

});