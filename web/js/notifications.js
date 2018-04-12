$(function () {
    if (typeof (io) == 'function' && typeof (io) != 'undefined') {
        var socket = io.connect(NOTIFICATIONS_ADDRESS);
        socket.on('connect', function () {
            //var sessionid = socket.id;
            socket.emit('authentication', {userId: userId});
        });
        socket.on('notifications', function (rows) {
            var j = 0;
            //Get current badge count
            var not_count = $('.badge.bg-warning').html();            
            //append notifications
            for (var i = 0; i < rows.length; i++) {
                $("ul.dropdown-menu.extended.inbox.notifications li:nth-child(1)").append("<li><a href='#'><span class='subject'><span class='from'>" + rows[i].field_agent_name + "</span><span class='time'>" + time_elapsed_string(rows[i].notification_created_at) + "</span></span><span class='message'>" + rows[i].message + "</span></a></li>");
                j++;
            }
            //Add new count to existing count
            var final_count = parseInt(j) + parseInt(not_count);
            //Badge counter
            $(".badge.bg-warning").html(final_count);
        });

        socket.on('alerts', function (rows) {
            var j = 0;
            //Get current badge count
            var not_count = $('.badge.bg-success').html();            
            //append notifications
            for (var i = 0; i < rows.length; i++) {
                $("ul.dropdown-menu.extended.inbox.alerts li:nth-child(1)").append("<li><a href='#'><span class='subject'><span class='from'>" + rows[i].field_agent_name + "</span><span class='time'>" + time_elapsed_string(rows[i].notification_created_at) + "</span></span><span class='message'>" + rows[i].message + "</span></a></li>");
                j++;
            }
            //Add new count to existing count
            var final_count = parseInt(j) + parseInt(not_count);
            //Badge counter
            $(".badge.bg-success").html(final_count);
//            $('.alerts').empty();
//            $(".alerts").append("<li><p>Alerts</p></li>");
//            var j = 0;
//            //append alerts
//            for (var i = 0; i < rows.length; i++) {
//                $(".alerts").append("<li><a href='#'><span class='subject'><span class='from'>" + rows[i].field_agent_name + "</span><span class='time'>" + time_elapsed_string(rows[i].notification_created_at) + "</span></span><span class='message'>" + rows[i].message + "</span></a></li>");
//                j++;
//            }
//            $(".alerts").append("<li><a href='#'>See all alerts</a></li>");
//            //Badge counter
//            $(".badge").html(j);
        });
    }
});	  