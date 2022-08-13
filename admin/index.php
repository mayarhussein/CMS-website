<?php  include "includes/admin_header.php"; ?>

<div id="wrapper">

    <!-- Navigation -->
<?php  include "includes/admin_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to My Admin
                        <small><?php  echo $_SESSION['username'];  ?></small>
                    </h1>
             
                  
              </div>
            </div>
       
            <!-- /.row -->
   
<?php   
 $post_count=getCount1('posts');
 $comments_count=getCount1('comments'); 
 $users_count=getCount1('users'); 
 $categories_count=getCount1('categories');
 $published_post_count=getCount2('posts','post_status','Published'); 
 $draft_post_count=getCount2('posts','post_status','draft');
  $unapproved_comments_count=getCount2('comments','comment_status','unapproved');;
  $subscribers_count=getCount2('users','user_role','subscriber');
?>


<div class="row">
<div class="col-lg-3 col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-file-text fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">



              <div class='huge'><?php echo $post_count; ?></div>
                    <div>Posts</div>
                </div>
            </div>
        </div>
        <a href="./posts.php">
            <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="panel panel-green">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-comments fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                 <div class='huge'><?php echo $comments_count; ?></div>
                  <div>Comments</div>
                </div>
            </div>
        </div>
        <a href="./comments.php">
            <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="panel panel-yellow">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-user fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                <div class='huge'><?php echo $users_count; ?></div>
                    <div> Users</div>
                </div>
            </div>
        </div>
        <a href="./users.php">
            <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="panel panel-red">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-list fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class='huge'><?php echo $categories_count; ?></div>
                     <div>Categories</div>
                </div>
            </div>
        </div>
        <a href="categories.php">
            <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
</div>
</div>
            <!-- /.row -->

            <div class='row'>


                 <script type="text/javascript">     //Barchart
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Data', 'Count'],
        
      <?php 
        
        $textArr=['All Posts','Active Posts','Draft Posts','Comments','Unapproved Comments','Users','Subscribers','Categories'];
        $countArr=[$post_count,$published_post_count,$draft_post_count, $comments_count,$unapproved_comments_count ,$users_count, $subscribers_count,$categories_count];
        
        for($i=0; $i<7; $i++)
            echo "['{$textArr[$i]}'".","."{$countArr[$i]}],";
        
        
        ?>
        
      
    ]);

    var options = {
      chart: {
        title: '',
        subtitle: '',
      }
    };

    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>

    <div id="columnchart_material" style="width:'auto'; height: 500px;"></div>

            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php  include "includes/admin_footer.php"; ?>