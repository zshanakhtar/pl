//index.js file

const http= require("http");//hhtp is also a library of node Js

const websocketServer = require("websocket").server // websocket is a library.This creates a websocket object
const httpServer = http.createServer();
httpServer.listen(9090,()=> console.log("Listening .. on 9090")) //

const mysql = require('mysql');

var dbcon =mysql.createConnection({
    host:"localhost",
    user:"root",
    password:"",
    database:"labassignment"
});

var clients=[];//hashmap of clienid and connection
const games={};//hashmap which contains game id and no. of balls ,state of game
var turn;
var q_available;
var questions={};

const wsServer  = new websocketServer({        //the http socket is added to the websocket object
    "httpServer":httpServer
});

//we are not listening to change the request
wsServer.on("request",request=>{
    connection=request.accept(null,request.origin);//get TCP connection for each client ,connect function for client
    connection.on("open",()=> console.log("opened"));
    
    connection.on("close",()=> {
        for(var i=0;i<clients.length;i++){
            if(!clients[i].connection.connected){
                // console.log(i);
                console.log(clients[i].username+" disconnected");
                clients.splice(i,1);
            }
        }
        console.log(clients);
    });

    connection.on("message",message=>{
        //I have received a messsage from client
        const req=JSON.parse(message.utf8Data)
        if(req.action === 'create')
        {



            dbcon.connect(function(err){
                if(err) throw err;
                // console.log("connected");
                
                sql_editorial="SELECT sno,paper as answer from editorial LIMIT 5";
                sql_followsports="SELECT sno,sport as answer from followsports LIMIT 5";
                sql_technology="SELECT sno,category as answer from technology LIMIT 5";
                sql_trailer="SELECT sno,language as answer from trailer LIMIT 5";
                // console.log(sql);
                dbcon.query(sql_editorial,function(err,result,fields){
                    if (err) throw err;
                    questions.editorial=result;
                });
                dbcon.query(sql_followsports,function(err,result,fields){
                    if (err) throw err;
                    questions.followsports=result;
                });
                dbcon.query(sql_technology,function(err,result,fields){
                    if (err) throw err;
                    questions.technology=result;
                });
                dbcon.query(sql_trailer,function(err,result,fields){
                    if (err) throw err;
                    questions.trailer=result;
                });
                // console.log(questions);
            });




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
            // console.log("before join");
            // console.log(clients);
            if(clients.length==0){
                turn={
                    "username":req.username,
                    "connection":connection
                }
            }
            if(clients.length<6){

                //console.log(games);
                const client={
                    'username':req.username,
                    'connection':connection
                };
                
                clients.push(client);
                console.log("after join");
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
            turn_payload={
                "result": "turn"
            };//response payload
            var questions_table=questions[req.table];
            // console.log(questions_table);
            var answer,points=0;
            for(var i=0;i<questions_table.length;i++){
                var question=questions_table[i];
                if(question.sno==req.sno){
                    answer=question.answer;
                    points=(i+1)*100;
                    break;
                }
            }

            // console.log(answer);
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
                        "points":points
                    };
                    if(turn.username==clients[i].username)
                        clients[i].connection.send(JSON.stringify(turn_payload));//send question id to all clients
                    clients[i].connection.send(JSON.stringify(points_payload));//send question id to all clients
                }
            }
        }
    });
});