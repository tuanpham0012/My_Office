/**
 * Created by DoanPV on 18/02/2020.
 */

var http = require('http');
var socketIO = require('socket.io');
const db = require('./db');
const moment = require('moment');

var port = process.env.PORT || 9000;
var ip = process.env.IP || '0.0.0.0';
var server = http.createServer().listen(port, ip, function () {
    console.log('Socket.IO server started at %s:%s!', ip, port);
});

var number = 0;

io = socketIO.listen(server);

var run = function (socket) {

    number += 1;
    console.log('so nguoi truy cap : ' + socket.id);
    io.sockets.emit("server-sent-user", number);

    // send gif - live stream
    socket.on("send-message", function (data) {
        console.log('Send-message at: ' + getTimeNow());
        socket.broadcast.emit('response-message', data);
        console.log('Response-message at: ' + getTimeNow());
    });

    socket.on("typing-message", function (data) {
        console.log('Typing-message at: ' + getTimeNow());
        socket.broadcast.emit('response-typing-message', data);
        console.log('Response typing-message at: ' + getTimeNow());
    });

    socket.on("stop-typing", function (data) {
        console.log('stop-typing at: ' + getTimeNow());
        socket.broadcast.emit('response-stop-typing', data);
        console.log('response-stop-typing at: ' + getTimeNow());
    });

    socket.on("send-booking-room", function (data) {
        console.log('send-booking at: ' + getTimeNow());

        db.query(
            'INSERT INTO ' + 'bookings' + ' SET ?',
            {
                user_id: data.user_id,
                time_from: data.time_from,
                time_to : data.time_to,
                //time_from: moment().format('YYYY-MM-DD HH:mm:ss'),
                //time_to: moment().add(2, 'days').format('YYYY-MM-DD HH:mm:ss'),
                content: data.content,
                quantity: getRandomInt(1, 10),
                room_name: 'PH01',
                notes: data.notes,
                status: data.status,
                created_at: moment().format('YYYY-MM-DD HH:mm:ss'),
                updated_at: moment().format('YYYY-MM-DD HH:mm:ss'),
            },
            function (err, results, fields) {
                if (err) console.log('Insert into db error');
            }
        );

        io.sockets.emit('response-booking', data);

        socket.emit('response-booking-room');

        console.log('response-booking at: ' + getTimeNow());
    });
    socket.on('send-room-error',function () {
        socket.emit('response-room-error');
    })

    socket.on('disconnect', function() {
        number -= 1;
        console.log('co nguoi thoat : 1 ' + socket.id);
        io.sockets.emit("server-sent-user", number);
    });
    

}

io.sockets.on('connection', run);

function getTimeNow() {
    var date = new Date();
    var h = date.getHours();
    var i = date.getMinutes();
    var s = date.getSeconds();
    var d = date.getDate();
    var m = date.getMonth() + 1;
    var y = date.getFullYear();
    if (h < 10) { h = '0' + h; }
    if (i < 10) { i = '0' + i; }
    if (s < 10) { s = '0' + s; }
    if (d < 10) { d = '0' + d; }
    if (m < 10) { m = '0' + m; }
    var time = d + '/' + m + '/' + y + ' ' + h + ':' + i + ':' + s;
    return time;
}

function getRandomInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min)) + min;
}