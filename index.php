<?php
require_once 'stackphp/src/api.php';
$stackoverflow = API::Site('stackoverflow');
$id = $_GET["id"];
if(!isset($id)){ 
    header("Location: login.php");
}
$response = $stackoverflow->Users($id)->Questions()->SortByVotes()->Exec();
$response2 = $stackoverflow->Users($id)->Exec();
$response3 = $stackoverflow->Users($id)->Answers()->SortByVotes()->Exec();
$response4 = $stackoverflow->Users($id)->Questions()->SortByVotes()->Exec();
$response5 = $stackoverflow->Users($id)->Exec();
$response6 = $stackoverflow->Users($id)->Tags()->Exec();
$response7 = $stackoverflow->Users($id)->Answers()->SortByVotes()->Exec();
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Coursellor - Dashboard</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="danger">

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    <img src=logo.png width="150">
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="#">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="user.php?id=<?php echo $_GET["id"];?>">
                        <i class="ti-user"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li>
                    <a href="table.php?id=<?php echo $_GET["id"];?>">
                        <i class="ti-view-list-alt"></i>
                        <p>Question List</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
						<li>
                            <a href="login.php">
								<i class="ti-power-off"></i>
								<p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
	

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-warning text-center">
                                            <i class="ti-help"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Questions</p>
                                           (<?php
                                                	$questcFilter = new Filter();
													$questcFilter->SetIncludeItems(array('user.question_count'));
													$questcFilter->SetUnsafe(FALSE);
													$questcObj = $stackoverflow->Users($id);
													$questc = $questcObj->Filter($questcFilter->GetID())->Exec();
													while($userquest = $questc->Fetch(FALSE))
														echo"{$userquest['question_count']}";
                                                ?>)
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-reload"></i> Updated now
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-success text-center">
                                            <i class="ti-comments"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Answers</p>
                                           (<?php
                                                	$anscFilter = new Filter();
													$anscFilter->SetIncludeItems(array('user.answer_count'));
													$anscFilter->SetUnsafe(FALSE);
													$anscObj = $stackoverflow->Users($id);
													$ansc = $anscObj->Filter($anscFilter->GetID())->Exec();
													while($userans = $ansc->Fetch(FALSE))
														echo"{$userans['answer_count']}";
                                                ?>)
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-reload"></i> Updated now
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-danger text-center">
                                            <i class="ti-pulse"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Reputation</p>
                                            (<?php
										while($user2 = $response2->Fetch(FALSE))
    									echo "{$user2['reputation']}";
									?>)
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-reload"></i> Updated now
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-info text-center">
                                            <i class="ti-server"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>Badges</p>
                                          (<?php
										while($user5 = $response5->Fetch(FALSE)){
    										$badgie = $user5['badge_counts'];
											$total = 0;
    										foreach($badgie as $badgies){
    											$total = $total + $badgies;		
    										}
											echo $total;									
										}
									?>)
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-reload"></i> Updated now
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Top Answers</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <tbody>
                                    <?php
										while($user = $response7->Fetch(FALSE)){
    										$qid = $user['question_id'];
											$response8 = $stackoverflow->Questions($qid)->Exec();
											while($user8 = $response8->Fetch(FALSE)){
    											echo "<tr><td><a href=answer.php?qid=".$user8['question_id']."&id=$id> {$user8['title']}</a></td></tr>";
											}
										}
									?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
				</div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Top Tags</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <tbody>
                                    <?php
										while($user8 = $response6->Fetch(FALSE))
    									echo "<div class='col-md-2'><button class='btn btn-info btn-fill'> {$user8['name']}</button></div>";
									?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <div class="copyright pull-right">
                    &copy; Coursellor
                </div>
            </div>
        </footer>

    </div>
</div>

</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="assets/js/paper-dashboard.js"></script>

	<script type="text/javascript">
    	$(document).ready(function(){
        	demo.initChartist();
    	});
	</script>

</html>
