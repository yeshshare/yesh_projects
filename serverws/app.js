/*
Comandos
join-group: 
group-online-users: Tras todos usuários online da room solicitada
group-message: recebe mensagem do grupo
single-message: recebe mensagem individual
send-group-message: envia mensagem para a room
single-user-message: envia mensagem para usuário especifico

*/
'use strict'
/* Imports Controllers */
import JoinGroup from './Controller/Joingroup.js';
import Grouponlineusers from './Controller/Grouponlineusers.js';
import Sendgroupmessage from './Controller/Sendgroupmessage.js';
//const JoinGroup = require('./Controller/Joingroup');
/* Imports Controllers */
const dev = true;

import express from 'express';
import WebSocket from 'ws';
import mysql from 'mysql';
import simple_http from 'http';
import secure_https from 'https';
import fs from 'fs';

const http = dev ? simple_http : secure_https;

//const express = require('express');
//const WebSocket = require('ws');
//const mysql = require('mysql');
const app = express();
app.use(express.static('public'));

const con = mysql.createConnection({
    host: "127.0.0.1",
    database: "yesh",
    user: "root",
    password: ""
});
con.connect(function(err) {
    if (err) throw err;
    console.log('Web socket start in: ws://127.0.0.1:' + webPort);
});
var bserver = null;
if (dev) {

    //const http = require('http');
    bserver = http.createServer(app);
} else {
    //const http = require('https');
    //const fs = require('fs');
    const options = {
        key: fs.readFileSync('/www/server/panel/vhost/cert/ruandevspace.com.br/privkey.pem'),
        cert: fs.readFileSync('/www/server/panel/vhost/cert/ruandevspace.com.br/fullchain.pem')
    };
    const bserver = http.createServer(options, app);
}



const webPort = 8002;
var clients = [];

bserver.listen(webPort, function() {
    console.log('Web server start in: http://127.0.0.1/:' + webPort);
});
const wss = new WebSocket.Server({
    server: bserver,
    clientTracking: true

});
var onlineUsers = [];
//var id = 0;
//var single = [];


wss.on('connection', ws => {
    ws.room = [];
    ws.user_id = [];
    ws.projetc_id = [];
    ws.company_id = [];
    ws.wsid = [];
    //ws.users = [];

    ws.wsid.push(ws._socket._handle.fd);

    //single.push(ws);

    //console.log(ws.clients);
    ws.send(JSON.stringify({

        msg: "user joined",
        ws_id: ws._socket._handle.fd,

    }));

    //console.log(ws);
    ws.on('message', message => {

        // console.log('message: ', message);
        //try{
        var messag = JSON.parse(message);
        console.log(messag.command);
        //}catch(e){console.log(e)}
        if (messag.command) {
            switch (messag.command) {
                case 'join-group':
                    JoinGroup(messag, ws, onlineUsers);
                    ws.send(JSON.stringify(Grouponlineusers(messag.data.room, onlineUsers, wss)));
                    break;
                case 'group-online-users':
                    ws.send(JSON.stringify(Grouponlineusers(messag.data.room, onlineUsers, wss)));
                    break;
                case 'send-group-message':
                    //console.log(messag.command + " case");
                    Sendgroupmessage(messag, wss);
                    break;
                case 'single-user-message':
                    // code block chama função
                    break;
                    /* 
                    case 'group-message':
                        // code block chama função
                        break;
                    case 'single-message':
                        // code block chama função
                        break;
                    */
                default:
                    // code block chama função
            };
        };
        /*
        if (messag.join) {
            ws.room.push(messag.join.room);
            ws.user_id.push(messag.join.user.id);
            onlineUsers.push(messag.join.user);
            ws.projetc_id.push(messag.join.projetc_id);
            ws.company_id.push(messag.join.company_id);
            //console.log(ws);
        }
        if (messag.room) {
            broadcast(message);
        }
        if (messag.msg) {

        }
        //	console.log(messag.sendto !== null || messag.sendto !== undefined);
        if (messag.sendto !== undefined) {
            //console.log('message: ', message);
            //console.log(messag.sendto);
            broadcastsingle(messag);
            //ws.clients[messag.sendto].send(messag.msg);
            //console.log(ws.clients[0]);
        }*/

    })

    ws.on('error', e => console.log(e));
    ws.on('close', e => {

        //console.log(ws.user_id[0]);
        //console.log(ws.room[0]);

        onlineUsers = onlineUsers.filter(u => u.id != ws.user_id[0]);
        let clientData = {};
        clientData.room = ws.room[0];
        //console.log(clientData);
        wss.clients.forEach(client => {
                //console.log(client.room);
                //console.log(ws.room);
                if (client.room[0] == ws.room[0]) {
                    client.send(JSON.stringify(Grouponlineusers(ws.room[0], onlineUsers, wss)));
                }

                /*
                if (client.room.indexOf(JSON.parse(ws).room) > -1) {
                    client.send(JSON.stringify(getuserlist(e.room)));
                }*/
            })
            //console.log(ws);
            //console.log('websocket closed' + e);
            //delPresenceroom();
    });

})

async function senddb(obj) {
    let object = JSON.parse(obj);
    var sql = " INSERT INTO probes (user_id, room,sensors,value) VALUES (1, '" + object.room + "','" + object.sensors + "','" + object.value + "' )";
    con.query(sql, function(err, result) {
        if (err) throw err;
        //console.log("1 record inserted");
    });
}

function broadcastsingle(message) {
    wss.clients.forEach(client => {
        if (client.wsid == message.sendto) {
            client.send(JSON.stringify(message));


        }
    })
}
/*
function getuserlist(message) {
    //console.log(message);
    var userlist = {
        command: 'online-users',
    };
    var users = [];
    wss.clients.forEach(client => {
        //console.log(client);
        if (client.room.indexOf(JSON.parse(message).room) > -1) {
            //console.log(onlineUsers.filter(u => u.id == client.user_id));
            users.push(onlineUsers.filter(u => u.id == client.user_id));
            //console.log(onlineUsers);
            //users.push(client.users[0]);
        }
    })
    userlist.data = users;
    //onlineUsers = userlist;
    //console.log(userlist);
    return userlist;
}
*/


function broadcast(message) {
    //console.log(message);
    wss.clients.forEach(client => {
        //console.log(client);
        if (client.room.indexOf(JSON.parse(message).room) > -1) {
            //senddb(message);
            client.send(message)
            client.send(JSON.stringify(getuserlist(message)));
            //console.log(wss.clients[ws._socket._handle.fd]);
        }
    })
}