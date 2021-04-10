<?php
$query="SELECT * from $table WHERE sno='$sno'";
$result=mysqli_query($conn,$query);
    if($row = $result->fetch_assoc()){
        extract($row);
        $option=array("a","b","c","d");
        $i=rand(0,2);
        if($table=='trailer'){
            $ques=$title;
            $option[$i]=$language;
            $field='language';
            }
        else if($table=='editorial'){
            $ques=$headline;
            $option[$i]=$paper;
            $field='paper';
        }
        else if($table=='followsports'){
            $ques=$headline;
            $option[$i]=$sport;
            $field='sport';
        }
        else if($table=='technology'){
            $ques=$headline;
            $option[$i]=$category;
            $field='category';
        }

        $query="SELECT DISTINCT $field from $table WHERE $field!='$option[$i]' LIMIT 3";
        $result=mysqli_query($conn,$query);
        $j=0;
        while($row = $result->fetch_assoc()){
            if($j!=$i){
                $option[$j]=$row[$field];
            }
            else{
                $option[++$j]=$row[$field];
            }
            $j++;
        }
?>

    <div class="panel panel-danger">
        <div class="panel-heading text-center">
            <?php echo $ques;?>
        </div>
        <div class="panel-body" data-table="<?php echo $table;?>" data-sno="<?php echo $sno;?>">
            <?php
                for($i=0;$i<4;$i++){
            ?>
                    
                    <div class="col-sm-6" style="padding:15px;">
                        <button class="btn btn-info col-sm-offset-3 col-sm-6 btn-select-ans">
                            <?php echo $option[$i];?>
                        </button>
                    </div>
            <?php
                }
            ?>
        </div>
    </div>

    <script>
        document.getElementById("question").scrollIntoView();
        $(".btn-select-ans").on('click',function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            
            var button=$(this);//get this button
            var table=$(this).closest('.panel-body').data("table");
            var sno=$(this).closest('.panel-body').data("sno");
            var answer=$(this).html().trim();
            
            var choose_payload={         
                "action" :"answer",
                "username" :"<?php echo $username?>",
                "answer":answer
            };
            console.log(choose_payload);
            ws.send(JSON.stringify(choose_payload));
        });
    </script>
<?php
}
?>
