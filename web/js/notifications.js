$(function () {	
    var socket = io.connect('http://159.89.166.45:3000');
    socket.on('connect', function() {
		//var sessionid = socket.id;
		socket.emit('authentication', {userId: userId});
      });	
	socket.on('showrows', function(rows) {
		$('.inbox').empty();
		$(".inbox").append("<li><p>Notifications</p></li>");
		var j = 0;
		//append notifications
        for (var i=0; i<rows.length; i++) {
			$(".inbox").append("<li><a href='#'><span class='subject'><span class='from'>"+rows[i].field_agent_name+"</span><span class='time'>"+time_elapsed_string(rows[i].notification_created_at)+"</span></span><span class='message'>"+rows[i].message+"</span></a></li>"); 
			j++;
		}
		//Badge counter
		$(".badge").html(j);
	});	 
});	  