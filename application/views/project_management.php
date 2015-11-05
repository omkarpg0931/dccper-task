<?php
    $schedule_var=0;
?>
<!DOCTYPE html>
<html>
    <head>
        
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap-3.3.4-dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap-3.3.4-dist/css/bootstrap.min.css">
        
        <style>
        
            a {background:#F2F2F2;}
            a:active {background:#CDD2D2;}
            
            .deactive {background:#F2F2F2;}
            
            .active {background:FCFFFF;}
            
            .thd {color:white;background:#515151;border-left: 1px solid white}
            
            .light{color:#BCBCBC}
            
            ul.tsc_pagination li a
            {
                border:solid 1px;
                border-radius:3px;
                -moz-border-radius:3px;
                -webkit-border-radius:3px;
                padding:6px 9px 6px 9px;
            }
            
            ul.tsc_pagination li
            {
                padding-bottom:1px;
            }
            
            ul.tsc_pagination li a:hover,
            
            ul.tsc_pagination li a.current
            {
                color:#FFFFFF;
                box-shadow:0px 1px #EDEDED;
                -moz-box-shadow:0px 1px #EDEDED;
                -webkit-box-shadow:0px 1px #EDEDED;
            }
            
            ul.tsc_pagination
            {
                
                padding:0px;
                height:100%;
                overflow:hidden;
                font:12px 'Tahoma';
                list-style-type:none;
            }
            
            ul.tsc_pagination li
            {
                
                margin-top:2em;
                padding:0px;
                margin-left:5px;
            }
            
            ul.tsc_pagination li a
            {
                color:black;
                display:block;
                text-decoration:none;
                padding:7px 10px 7px 10px;
            }
            
            ul.tsc_pagination li a img
            {
                border:none;
            }
            
            ul.tsc_pagination li a
            {
                color:#0A7EC5;
                border-color:#8DC5E6;
                background:#F8FCFF;
            }
            
            ul.tsc_pagination li a:hover,
            
            ul.tsc_pagination li a.current
            {
                text-shadow:0px 1px #388DBE;
                border-color:#3390CA;
                background:#58B0E7;
                background:-moz-linear-gradient(top, #B4F6FF 1px, #63D0FE 1px, #58B0E7);
                background:-webkit-gradient(linear, 0 0, 0 100%, color-stop(0.02, #B4F6FF), color-stop(0.02, #63D0FE), color-stop(1, #58B0E7));
            }
        
        </style>
    
    </head>
    
    <body>
 
   <div class="row" style="background:#F2F2F2;height:5em;margin-top:1em;margin-left:1em;margin-right:1em; border-radius: 0.3em;">
        <center style="margin-top:0.7em"><span style="font-size:30px;">Project Management</span></center>

        <span style="float:right;margin-top:-2em;margin-right:1em"><span class="glyphicon glyphicon-cog"></span >
        <span style=" text-decoration: underline;"><a href=<?php echo base_url();?>index.php/home/settings> Settings</a></span></span>
    </div>
    
    <div class="row" style="margin-top:1em;margin-top:1em;margin-left:1em;margin-right:1em;">
        
    <div class="col-sm-2" style="background:white;">
      
        <div class="list-group" >
    
            <span>
                <a class="list-group-item deactive"  style="text-align:center;font-size:1.4em" >Project Members</a>
            </span>
      
            <?php foreach($allmembers as $row): ?>
            
                <span>
                    <a class="list-group-item deactive" id="<?php echo "$row->members_id"; ?>" style="color:#BCBCBC" href=<?php echo base_url(); ?>index.php/home/member_info/<?php echo "$row->members_id" ; ?>>
                        <?php echo $row->members_name ; ?> </a>
                </span>
            
            <?php endforeach;?>
        
        </div>
    
    </div>
     
    <?php if($clicked_member != NULL){ ?>    
    <div class="col-sm-10" >
    
        <div class="row">
        
            <?php foreach($clicked_member as $row): ?>
                <div >
            
                    <img src="<?php echo base_url(); ?><?php echo $row->members_dp ; ?>"  height="150" width="200">  
            
                 </div> 
            
                <span style="float:right;margin-top:-3.6em;margin-right:1em;font-size:1.5em">
                    <?php echo $row->members_name ; ?>
                </span>
             <?php endforeach;?>
        </div>
   
        
    <div class="row" style="float:right">
  
        <div><button type="button" class="btn btn-default" style="color:white;background:#515151">Create Report</button></div>
    
    </div>
       
    <div class="row" style="margin-top:3em;">
    
        <table class="table table-striped">
            
            <col width="360">
            <col width="110">
            <col width="110">
            <col width="80">
            <col width="100">
            <col width="80">
            <thead>
            
                <tr>
                    <th class="text-center thd" style="vertical-align: middle;">Task</th>
                    <th class="text-center thd" style="vertical-align: middle;">Start Date</th>
                    <th class="text-center thd" style="vertical-align: middle;">End Date</th>
                    <th class="text-center thd">Estimated Hours</th>
                    <th class="text-center thd" style="vertical-align: middle;">Hours Spent</th>
                    <th class="text-center thd">Schedule Variance</th>
                
                </tr>
    
            </thead>
            <?php } ?> 
            <?php if(is_array($tasks) && sizeof($tasks)>0){ ?>
            
            <tbody>
                <?php foreach($tasks as $row) {?>
                <tr>
        
                    <td class="text-center"><?php echo $row->task_name ; ?></td>
        
                     <?php
                        $time = strtotime($row->start_date);
                        //then use the date function as you need
                        $start_date = date('d/m/Y', $time);
                     ?>
                    <td class="text-center"><?php echo $start_date ; ?></td>
                      <?php
                        $time = strtotime($row->end_date);
                        //then use the date function as you need
                        $end_date = date('d/m/Y', $time);
                     ?>  
                    
                    <td class="text-center"><?php echo $end_date ; ?></td>
          
                    <td class="text-center"><?php echo $row->est_time ; ?></td>
          
                    <td class="text-center"><?php echo $row->hours_spent ; ?></td>
                    
                    <?php $schedule_var = (($row->est_time - $row->hours_spent)/  $row->est_time)*100 ; ?>
                    <td class="text-center " ><?php echo number_format($schedule_var, 3)?>%</td>
                </tr>
                <?php }?>
                    
            </tbody>
             <?php }?>
        </table>
        <style>
            
            #mylinks a {display:inline;margin-left:1em}
        </style>
    </div>
    <?php if($links != NULL){ ?>      
    <div class="row text-center" id="pagination">
       <ul class="tsc_pagination" style='display:inline;margin-top:2em'>
        <!-- Show pagination links -->
        
        
        <?php foreach ($links as $link) {
                      echo " <li id='mylinks' style='display:inline;margin-top:2em;'<li>". $link."</li></li> ";
         }?>             
      
        </ul>
    </div>
         <?php }?>
   </div>

</body>
    
</html>
