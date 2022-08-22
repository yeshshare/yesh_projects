function Sendgroupmessage(messag, wss) {
    //console.log(messag.command + " Controller");
    wss.clients.forEach(client => {
        //console.log(messag.data.room);
        //console.log(client.room.indexOf(messag.data.room));
        if (client.room.indexOf(messag.data.room) > -1) {
            //senddb(messag);
            //console.log(messag.data);
            client.send(JSON.stringify(messag))
                //client.send(command);
                //console.log(wss.clients[ws._socket._handle.fd]);
        }
    })
}
export default Sendgroupmessage;