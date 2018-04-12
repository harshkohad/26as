var express = require('express');
var app = express();
var server = require('http').createServer(app);
var io = require('socket.io').listen(server);
users = [];
connections = [];
var mysql = require('mysql');
var db_hostname = "localhost";
var db_name = "dvs";
var db_username = "root";
var db_password = "VeKOG7Wj(t)2k53*N1qR";
var user_ids = {};
var sql_cond_part = '';
var sql_cond = '';

var con = mysql.createConnection({
    host: db_hostname,
    user: db_username,
    password: db_password,
    database: db_name
});

server.listen(process.env.PORT || 3000);
console.log('Server running');

io.on('connection', function (socket) {
    //console.log('a user connected');
    console.log('Connected! ID: ' + socket.id);
    socket.on('disconnect', function () {
        console.log('user disconnected');
        console.log('user disconnected! ID: ' + socket.id);
        //find disconnected socket id in user_ids array
        for (var key in user_ids) {
            //if found delete socket id from user_ids array
            if (user_ids[key] === socket.id) {
                delete user_ids[key];
                break;
            }
        }
        console.log(JSON.stringify(user_ids));
    });

    socket.on('authentication', function (authentication) {
        var user_id = authentication.userId;
        console.log('authentication: ' + user_id + socket.id);
        if (user_id != null) {
            user_ids[user_id] = socket.id;
        }
        console.log('#############HERE#############');
        console.log(JSON.stringify(user_ids));
    });

    socket.on('chat message', function (msg) {
        console.log('message: ' + msg);
    });

    socket.on('chat message', function (msg) {
        io.emit('chat message', msg);
    });

    getNotifications();
});

function getNotifications() {
    //Prepare condition
    for (var key in user_ids) {
        sql_cond_part += "'" + key + "',";
    }
    if (sql_cond != '') {
        //remove last ',' from string
        sql_cond_part = sql_cond_part.substring(0, sql_cond_part.length - 1);
        //prepare condition		
        sql_cond = 'AND tn.user_id IN (' + sql_cond_part + ')';
    }
    console.log('*****' + sql_cond + '******');
    con.query('SELECT tn.id as id, tn.user_id as user_id, tn.message as message, tn.is_unread as is_unread, tn.notification_created_at as notification_created_at, tn.type as type, CONCAT(tud.first_name, " ", tud.last_name) as field_agent_name FROM tbl_notifications tn JOIN tbl_user_details tud ON tn.created_by = tud.user_id WHERE tn.is_unread = 1 AND tn.is_sent = 0' + sql_cond + ';', function (err, rows) {
        //empty condition variable
        sql_cond = '';
        if (err)
            throw err;
        console.log('Data received from Db:\n');
        console.log(rows);
        if (rows.length > 0) {
            for (var key in user_ids) {
                notification_rows = [];
                alert_rows = [];
                var sql_cond_part2 = '';
                var sql_cond_part3 = '';
                for (var i = 0, len = rows.length; i < len; i++) {
                    if (key == rows[i].user_id) {
                        var data = {
                            'id': rows[i].id,
                            'message': rows[i].message,
                            'notification_created_at': rows[i].notification_created_at,
                            'field_agent_name': rows[i].field_agent_name,
                        };
                        if (rows[i].type == 0) {
                            notification_rows.push(data);
                            sql_cond_part2 += "'" + rows[i].id + "',";
                        } else if (rows[i].type == 1) {
                            alert_rows.push(data);
                            sql_cond_part3 += "'" + rows[i].id + "',";
                        }
                    }
                }
                //If notifications are available
                if (notification_rows.length > 0) {
                    //if data length is not 0 emit to specific user using socket id
                    io.sockets.connected[user_ids[key]].emit("notifications", notification_rows);
                    if (sql_cond_part2 != '') {
                        sql_cond_part2 = sql_cond_part2.substring(0, sql_cond_part2.length - 1);
                        //Update notifications as read
                        updateNotifications(sql_cond_part2);
                    }
                }
                //If alerts are available
                if (alert_rows.length > 0) {
                    //if data length is not 0 emit to specific user using socket id
                    io.sockets.connected[user_ids[key]].emit("alerts", alert_rows);
                    if (sql_cond_part3 != '') {
                        sql_cond_part3 = sql_cond_part3.substring(0, sql_cond_part3.length - 1);
                        //Update notifications as read
                        updateNotifications(sql_cond_part3);
                    }
                }
                //console.log(JSON.stringify(rows_new));
            }
        }
        //io.emit('showrows', rows);
    });
    setTimeout(getNotifications, 1000);
}

function updateNotifications(ids) {
    var sql = "UPDATE tbl_notifications SET is_sent = 1 WHERE id IN (" + ids + ")";
    console.log('*****' + sql + '******');
    con.query(sql, function (err, result) {
        if (err)
            throw err;
        console.log(result.affectedRows + " record(s) updated");
    });
}
app.get('/', function (req, res) {
    res.sendFile(__dirname + '/index.html');
});
app.get('/index1', function (req, res) {
    res.sendFile(__dirname + '/index1.html');
});
