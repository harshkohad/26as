$(function () {
    if (typeof (io) == 'function' && typeof (io) != 'undefined') {
        var socket = io.connect(NOTIFICATIONS_ADDRESS);
        socket.on('connect', function () {
            //var sessionid = socket.id;
            socket.emit('authentication', {userId: userId});
        });
        socket.on('notifications', function (rows) {
            $('.notifications').empty();
            $(".notifications").append("<li><p>Notifications</p></li>");
            var j = 0;
            //append notifications
            for (var i = 0; i < rows.length; i++) {
                $(".notifications").append("<li><a href='#'><span class='subject'><span class='from'>" + rows[i].field_agent_name + "</span><span class='time'>" + time_elapsed_string(rows[i].notification_created_at) + "</span></span><span class='message'>" + rows[i].message + "</span></a></li>");
                j++;
            }
            $(".notifications").append("<li><a href='#'>See all notifications</a></li>");
            //Badge counter
            $(".badge").html(j);
        });

        socket.on('alerts', function (rows) {
            $('.alerts').empty();
            $(".alerts").append("<li><p>Alerts</p></li>");
            var j = 0;
            //append alerts
            for (var i = 0; i < rows.length; i++) {
                $(".alerts").append("<li><a href='#'><span class='subject'><span class='from'>" + rows[i].field_agent_name + "</span><span class='time'>" + time_elapsed_string(rows[i].notification_created_at) + "</span></span><span class='message'>" + rows[i].message + "</span></a></li>");
                j++;
            }
            $(".alerts").append("<li><a href='#'>See all alerts</a></li>");
            //Badge counter
            $(".badge").html(j);
        });
    }
});	  