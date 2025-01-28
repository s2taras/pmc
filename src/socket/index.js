const express = require('express');
const app = express();
const http = require('http').Server(app);
const io = require('socket.io')(http);

const subscribe = require('redis').createClient({
    'host': 'pmc_redis',
    'port': 6379
});

subscribe.on('message', function (channel, message) {
    io.emit('testroom', message);
})

io.on('connection', function (socket) {
    subscribe.subscribe('testchannel');
})

const port = process.env.PORT || 5000;
http.listen(
    port,
    function () {
        console.log('Listen at ' + port);
    }
);

app.get(
    '/',
    function (req, res, next) {
        res.send('success');
    }
);
