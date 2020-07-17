var io = require('socket.io')(6001)
console.log('Connected to port 6001')
io.on('error', function(socket) {
    console.log('error')
})

io.on('connection', function(socket) {
    console.log('sombody on' + socket.id)
})
var Redis = require('ioredis')
var redis = new Redis(1000)
redis.psubscribe("*", function(error, count) {
    //
})
redis.on('pmessage', function(partner, channel, contact) {
    console.log(channel)
    console.log(contact)
    console.log(partner)

    contact = JSON.parse(contact)
    io.emit(channel + ":" + contact.event, contact.data.contact)
    console.log('Sent')
})