<div class="z-background"></div>
<div class="z-background2"></div>
<div class="z-canvas col-sm-10 col-sm-offset-1">
    <div class="panel panel-danger">
        <div class="panel-heading text-center">
            <?php echo $canvas_heading;?>
        </div>
    </div>
    <nav class="navbar col-sm-11 z-menubar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#"><?php echo $menu_heading;?></a>
            </div>
            <ul class="nav navbar-nav" data-requester='module' data-fragment="module">
                <?php $c=0; foreach($menu_items as $x => $x_value) { ?>
                <li class="<?php if($c++==0) echo 'active';?>" data-module="<?php echo $x;?>"><a href="javascript:void(0)"><?php echo $x_value; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>
    <div class="col-sm-1"><button id="logout" class="btn btn-lg btn-danger <?php if($menu_heading=='Login') echo 'hidden';?>">Logout</button></div>
    <div id="module" class="col-xs-12">
        <?php
        // $keys=array_keys($menu_items);
        // $canvas_paint=$menu_items[$keys[0]];
        include 'php-front/'.$canvas_paint;
        ?>
    </div>
</div>
<script>
    $('#logout').on('click',function(){
        window.location="php-back/logout.php";
    });
</script>
