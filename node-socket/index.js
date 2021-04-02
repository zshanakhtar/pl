//index.js file

const http= require("http");//hhtp is also a library of node Js

const websocketServer = require("websocket").server // websocket is a library.This creates a websocket object
const httpServer = http.createServer();
httpServer.listen(9090,()=> console.log("Listening .. on 9090")) //

var clients={};//hashmap of clienid and connection
const games={};//hashmap which contains game id and no. of balls ,state of game
var turn;
var q_available;

const wsServer  = new websocketServer({        //the http socket is added to the websocket object
    "httpServer":httpServer
});

//we are not listening to change the request
wsServer.on("request",request=>{
    connection=request.accept(null,request.origin);//get TCP connection for each client ,connect function for client
    connection.on("open",()=> console.log("opened"));
    connection.on("close",()=> console.log("closed"));

    connection.on("message",message=>{
        //I have received a messsage from client
        const req=JSON.parse(message.utf8Data)
        if(req.action === 'create')
        {
            gamecode=req.gamecode;
            games[gamecode]={
                "id":gamecode,
                "clients":[] //currently there are no clients that are joined
            };
            res_payload={
                "result": "created"
            };//response payload
            connection.send(JSON.stringify(res_payload));
            res_payload={
                "result": "turn"
            };//response payload
            connection.send(JSON.stringify(res_payload));
        }
        else if(req.action === 'join')
        {
            gamecode=req.gamecode;
            if(games[gamecode].clients.length==0){
                turn={
                    "username":req.username,
                    "connection":connection
                }
            }
            if(games[gamecode].clients.length<6){

                //console.log(games);
                const client={
                    'username':req.username,
                    'connection':connection
                };
                clients=games[gamecode].clients;
                clients.push(client);
                console.log(clients);
                res_payload={
                    "result": "joined",
                    "username": client.username
                };//response payload
                for(var i=0;i<clients.length;i++){
                    var existing_client={
                        "result":"joined",
                        "username":clients[i].username
                    };
                    client.connection.send(JSON.stringify(existing_client));//send existing client username to new client
                    if(clients[i].username!==client.username)
                    clients[i].connection.send(JSON.stringify(res_payload));//send new client details to existing clients
                }
            }
        }
        else if(req.action=='choose'){
            console.log(req);
            if(turn.username==req.username){
                q_available=true;
                for(var i=0;i<clients.length;i++){
                    var res_payload={
                        "result":"question",
                        "table":req.table,
                        "sno":req.sno
                    };
                    clients[i].connection.send(JSON.stringify(res_payload));//send question id to all clients
                }
            }
        }
        else if(req.action=='answer' && q_available){
            console.log(req);
            const mysql = require('mysql');

            var con =mysql.createConnection({
                host:"localhost",
                user:"root",
                password:"",
                database:"labassignment"
            });
            con.connect(function(err){
                if(err) throw err;
                // console.log("connected");
                var field="headline";
                if(req.table=="editorial")
                    field="paper";
                else if(req.table=="followsports")
                    field="sport";
                else if(req.table=="technology")
                    field="category";
                else if(req.table=="trailer")
                    field="language";
                sql="SELECT "+field+" FROM "+req.table+" WHERE sno='"+req.sno+"'";
                // console.log(sql);
                con.query(sql,function(err,result,fields){
                    if (err) throw err;
                    answer=result[0][field];
                    // console.log(answer);
                    turn_payload={
                        "result": "turn"
                    };//response payload
                    if(answer==req.answer){
                        turn={
                            "username":req.username,
                            "connection":connection
                        }
                        // console.log(turn);
                        q_available=false;
                        for(var i=0;i<clients.length;i++){
                            var points_payload={
                                "result":"points",
                                "username":req.username,
                                "points":"100"
                            };
                            if(turn.username==clients[i].username)
                                clients[i].connection.send(JSON.stringify(turn_payload));//send question id to all clients
                            clients[i].connection.send(JSON.stringify(points_payload));//send question id to all clients
                        }
                    }
                });
            });
        }
    });
});