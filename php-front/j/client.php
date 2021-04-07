<?php
$query_editorial="SELECT sno,headline,paper from editorial LIMIT 5";
$result_editorial=mysqli_query($conn,$query_editorial);
$query_followsports="SELECT sno,headline,sport from followsports LIMIT 5";
$result_followsports=mysqli_query($conn,$query_followsports);
$query_technology="SELECT sno,headline,category from technology LIMIT 5";
$result_technology=mysqli_query($conn,$query_technology);
$query_trailer="SELECT sno,title,language from trailer LIMIT 5";
$result_trailer=mysqli_query($conn,$query_trailer);
?>
<?php
extract($_SESSION);
?>
<div class="panel panel-info">
	<div class="panel-heading text-center" data-toggle="collapse" data-target="#clients" style="font-size:150%;"><b>Players</b><span class="btn btn-info pull-right glyphicon glyphicon-chevron-up"></span></div>
	<div  class="panel-body collapse in one" id="clients">
        <div id="client-template" class="panel panel-danger col-sm-2 hidden">
            <div class="panel-heading text-center"></div>
            <div class="panel-body text-center"></div>
        </div>
    </div>
</div>
<div class="panel panel-info">
	<div class="panel-heading text-center" data-toggle="collapse" data-target="#headlines" style="font-size:150%;"><b>Select Question</b><span class="btn btn-info pull-right glyphicon glyphicon-chevron-up"></span></div>
	<div  class="panel-body collapse in one" id="headlines">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Editorial</th>
                    <th>Sports</th>
                    <th>Technology</th>
                    <th>Trailer</th>
                </tr>
            </thead>
            <tbody>
<?php
$question_sno=0;
while($question_sno<5)
{
    $question_sno++; 
    if($row_editorial = $result_editorial->fetch_assoc())
        $ques_editorial=$row_editorial['headline'];
    else
        break;
    
    if($row_followsports = $result_followsports->fetch_assoc())
        $ques_followsports=$row_followsports['headline'];
    else
        break;
    
    if($row_technology = $result_technology->fetch_assoc())
        $ques_technology=$row_technology['headline'];
    else
        break;
    
    if($row_trailer = $result_trailer->fetch_assoc())
        $ques_trailer=$row_trailer['title'];
    else
        break;
?>
                <tr>
                    <td>
                        <form role="form" action="javascript:void(0)" onsubmit="return false;" class="form-horizontal ajaxsubmitform" >
                            <input class="hidden" type="text" name="table" value="editorial">
                            <input class="hidden" type="text" name="sno" value="<?php echo $row_editorial['sno']; ?>">
                            <button class="btn btn-lg btn-warning btn-select-q">
					            <span class="hidden-sm"><?php echo $question_sno*100;?></span>
					            <br class="hidden-lg hidden-sm hidden-xs">
					            <span class="glyphicon glyphicon-star"></span>
				            </button>
                        </form>
                    </td>
                    <td>
                        <form role="form" action="javascript:void(0)" onsubmit="return false;" class="form-horizontal ajaxsubmitform" >
                            <input class="hidden" type="text" name="table" value="followsports">
                            <input class="hidden" type="text" name="sno" value="<?php echo $row_followsports['sno']; ?>">
                            <button class="btn btn-lg btn-warning btn-select-q">
					            <span class="hidden-sm"><?php echo $question_sno*100;?></span>
					            <br class="hidden-lg hidden-sm hidden-xs">
					            <span class="glyphicon glyphicon-star"></span>
				            </button>
                        </form>
                    </td>
                    <td>
                        <form role="form" action="javascript:void(0)" onsubmit="return false;" class="form-horizontal ajaxsubmitform" >
                            <input class="hidden" type="text" name="table" value="technology">
                            <input class="hidden" type="text" name="sno" value="<?php echo $row_technology['sno']; ?>">
                            <button class="btn btn-lg btn-warning btn-select-q">
					            <span class="hidden-sm"><?php echo $question_sno*100;?></span>
					            <br class="hidden-lg hidden-sm hidden-xs">
					            <span class="glyphicon glyphicon-star"></span>
				            </button>
                        </form>
                    </td>
                    <td>
                        <form role="form" action="javascript:void(0)" onsubmit="return false;" class="form-horizontal ajaxsubmitform" >
                            <input class="hidden" type="text" name="table" value="trailer">
                            <input class="hidden" type="text" name="sno" value="<?php echo $row_trailer['sno']; ?>">
                            <button class="btn btn-lg btn-warning btn-select-q">
					            <span class="hidden-sm"><?php echo $question_sno*100;?></span>
					            <br class="hidden-lg hidden-sm hidden-xs">
					            <span class="glyphicon glyphicon-star"></span>
				            </button>
                        </form>
                    </td>
                </tr>
<?php
}
?>
            </tbody>
        </table>
    </div>
</div>


<div class="panel panel-info">
	<div class="panel-heading text-center" data-toggle="collapse" data-target="#question" style="font-size:150%;"><b>Select Answer</b><span class="btn btn-info pull-right glyphicon glyphicon-chevron-up"></span></div>
	<div  class="panel-body collapse in one" id="question">
        Answer
    </div>
</div>

<script>
    $('.btn-select-q').attr('disabled','disabled');
    $('.btn-select-q').addClass('available');


    //Initial connect
    var ws=new WebSocket("ws://localhost:9090")//connecting to the server
    //console.log(payload);
    ws.onmessage = (message) => {
        //message coming from the server
        const response=JSON.parse(message.data); //extracting data from JSON message
        console.log(response);
        if(response.result=="joined"){
            $('.btn-select-q').addClass('available');
            var client=$('#client-template').clone();
            console.log(client);
            client.removeClass('hidden');
            client.find('.panel-heading').append(response.username);
            client.find('.panel-body').append(0);
            $('#clients').append(client);
        }
        else if(response.result=="turn"){
            document.getElementById("headlines").scrollIntoView();
            $('.available').removeAttr('disabled');//activate available questions
        }
        else if(response.result=="question"){
            let data="table="+response.table+"&sno="+response.sno;
            let button=$('input[value='+response.table+']').siblings('input[value='+response.sno+']').siblings('.btn');
            button.attr('disabled','disabled');
            button.addClass('btn-default');
            button.removeClass('btn-warning');
            button.removeClass('available');
            $('#question').ajaxReload("get","question",data);//load question
        }
        else if(response.result=="points"){
            
            if(response.username!="<?php echo $username;?>"){
                $('.available').attr('disabled','disabled');//disabling questions
                document.getElementById("clients").scrollIntoView();
            }

            let option_buttons=$('.btn-select-ans');
            option_buttons.attr('disabled','disabled');
            option_buttons.addClass('btn-default');
            option_buttons.removeClass('btn-info');
            
            let clients=$("#clients").find('.panel-heading');
            for(var i=0;i<clients.length;i++){
                if($(clients[i]).html()==response.username){
                    var points=parseInt($(clients[i]).siblings('.panel-body').html());//get current points
                    points+=parseInt(response.points);
                    $(clients[i]).siblings('.panel-body').html(points);
                    // console.log(clientnames[i]);
                }
            }
            // console.log(option_buttons);
            //$('#question').ajaxReload("get","question",data);//load question
        }
    };
    ws.onopen = () =>{
        <?php if(isset($_SESSION['newgame']) && $_SESSION['newgame']==true){?>
        var create_payload={         
            "action" :"create",
            "gamecode": "<?php echo $gamecode;?>"
        };
        ws.send(JSON.stringify(create_payload));
        <?php } ?>
        setTimeout(() => {
            var join_payload={         
                "action" :"join",
                "gamecode": "<?php echo $gamecode;?>",
                "username": "<?php echo $username;?>"
            };
            ws.send(JSON.stringify(join_payload));
        }, 50);
    }

    $(".ajaxsubmitform").validator();
    $(".ajaxsubmitform").on('submit',function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        
        var form=$(this);//get this form
        var inputs=form.find('input');

        var choose_payload={         
            "action" :"choose",
            "username" :"<?php echo $username?>",
            "table": $(inputs[0]).attr('value'),
            "sno": $(inputs[1]).attr('value')
        };
        ws.send(JSON.stringify(choose_payload));
    });
</script>