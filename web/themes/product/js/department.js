var Dept = Dept || {};

Dept.DragDrop = function () {
    var view = {
        init: function () {
            controls.init();
            view.bind();
        },
        bind: function () {
            $(".jsSaveDeptTree").click(helpers.saveDepartmentEmp);
            $(".userlist").sortable({
                connectWith: ".userlist",
            });
            $(".userlist").droppable({
                drop: function (event, ui) {
                    accept: ".userlist",
                            setTimeout(function () {
                                $("#userlist").promise().done(function () {
                                    //helpers.dropevent(event, ui);
                                });
                            }, 500);

                },
            });
        }
    };

    var controls = {
        init: function () {
            this.listdata = $(".jsDeptListData ul");
            this.userbool = true;
        }
    };

    var helpers = {
        dropevent: function (event, ui) {
            var ele = ui.draggable[0];
            var user_id = $(ele).data('user_id');
            var dept_id;
            $('.dept_wrapper li').each(function (i, e) {
                $el = $(e);
                if ($el.data('user_id') == user_id) {
                    var parent = $el.closest('ul').closest('li')[0];
                    dept_id = $(parent).data('dept_id');
                    return false;
                }
            });
            helpers.updateUserDeptId(user_id, dept_id);
        },
        updateUserDeptId: function (user_id, dept_id) {
            $.ajax({
                url: window.deptajaxurl,
                type: 'post',
                data: {'user_id': user_id, 'dept_id': dept_id},
                success: function (res) {
                    console.log(res);
                },
                error: function (err) {
                    console.log(err);
                }
            })
        },
        saveDepartmentEmp: function (list) {
            var data = [];
            $(".jsSaveDeptTree").button('loading');
            var bool = true;
            $.each(controls.listdata, function (i, e) {
                $el = $(e);
                var users = $el.find(">li .userlist");
                var checkusers = users.find('>li');
                if (users.find('[data-dsgn="Team Lead"]').length > 1 || users.find('[data-dsgn="Team Manager"]').length > 1) {
                    var parent = checkusers.closest('.dept');
                    var dept = $(".deptname", parent).text();
                    alert('2 users are added in ' + dept);
                    bool = false;
                    return false;
                } else {
                    if ($el.hasClass('userlist')) {
                        var userdeptdata = {};
                        var user = $('li', $el);
                        var parent = user.closest('.dept');
                        var dept_id = parent.data('dept_id');
                        var user_id = user.data('user_id');
                        if (dept_id && user_id) {
                            userdeptdata.user_id = user_id;
                            userdeptdata.dept_id = dept_id;
                            data.push(userdeptdata);
                        }
                    }
                }
            });
            if(bool) {
                $.ajax({
                url: window.deptajaxurl,
                type: 'post',
                data: {data: JSON.stringify(data)},
                success: function (res) {
                    console.log(res);
                },
                error: function (err) {
                    console.log(err);
                }
            });
            }
            
            $(".jsSaveDeptTree").button('reset');
        }
    }
    view.init();
}
Dept.DragDrop();