<?php
require_once 'stackphp/src/api.php';
$stackoverflow = API::Site('stackoverflow');
$id = $_GET["id"];
if(!isset($id)){ 
    header("Location: login.php");
}
$response = $stackoverflow->Users($id)->Exec();
$response2 = $stackoverflow->Users($id)->Exec();
$response3 = $stackoverflow->Users($id)->Exec();
$response4 = $stackoverflow->Users($id)->Exec();
$response5 = $stackoverflow->Users($id)->Questions()->SortByVotes()->Exec();
$response6 = $stackoverflow->Users($id)->Answers()->SortByVotes()->Exec();
$response7 = $stackoverflow->Users($id)->Exec();
$response8 = $stackoverflow->Users($id)->Exec();
$response9 = $stackoverflow->Users($id)->Exec();
$response10 = $stackoverflow->Users($id)->Exec();
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Coursellor - Profile</title>

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
                <li>
                    <a href="index.php?id=<?php echo $_GET["id"];?>">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="active">
                    <a href="#">
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
                    <a class="navbar-brand" href="#">User Profile</a>
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
                    <div class="col-lg-4 col-md-5">
                        <div class="card card-user">
                            <div class="image">
                                <img src="assets/img/background.jpg" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                  <img class="avatar border-white" src="<?php
										while($user = $response->Fetch(FALSE))
    									echo "{$user['profile_image']}";
									?>" alt="..."/>
                                  <h4 class="title"><?php
										while($user4 = $response4->Fetch(FALSE))
    										$name = $user4['display_name'];
											echo $name;
									?><br />
                                     <a href="#"><small>@<?php
    									echo $name;
									?></small></a>
                                  </h4>
                                </div>
                                <p class="description text-center">
                                    <?php
										while($user3 = $response3->Fetch(FALSE))
    									$location = $user3['location'];
										echo $location;
									?>
									<br>
									 
									<div class ="row">
									<?php
										while($user10 = $response10->Fetch(FALSE)){
    										$badgie = $user10['badge_counts'];
											$colors = array("danger btn-fill","muted btn-fill","warning btn-fill");
											$i=0;
    										foreach($badgie as $badgies){    											
												echo "<div class='col-md-4'><button class='btn btn-".$colors[$i]."'><span class='ti-control-record'></span>{$badgies}</button></div>";
												$i=$i+1;
												}		
    										}
									?>
									</div>
                              </p>
                              <hr>
                            </div>

                            <div class="text-center">
                                <div class="row">
                                    <div class="col-md-3 col-md-offset-1">
                                        <h5><?php
                                                	$anscFilter = new Filter();
													$anscFilter->SetIncludeItems(array('user.answer_count'));
													$anscFilter->SetUnsafe(FALSE);
													$anscObj = $stackoverflow->Users($id);
													$ansc = $anscObj->Filter($anscFilter->GetID())->Exec();
													while($userans = $ansc->Fetch(FALSE))
														echo"{$userans['answer_count']}";
                                                ?><br /><small>Answers</small></h5>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <h5><?php
                                                	$questcFilter = new Filter();
													$questcFilter->SetIncludeItems(array('user.question_count'));
													$questcFilter->SetUnsafe(FALSE);
													$questcObj = $stackoverflow->Users($id);
													$questc = $questcObj->Filter($questcFilter->GetID())->Exec();
													while($userquest = $questc->Fetch(FALSE))
														echo"{$userquest['question_count']}";
                                                ?><br /><small>Questions</small></h5>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <h5><?php
										while($user7 = $response7->Fetch(FALSE))
    									echo "{$user7['reputation']}";
									?><br /><small>Reputation</small></h5>
                                    </div>
                                    
                                </div>
                            </div>  
                        </div>                
                    </div>
                    
                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Profile</h4>
                            </div>
                            <div class="content">
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Display Name</label>
                                                <br>
                                                
                                                <input type="text" class="form-control border-input" placeholder="Username" value="<?php echo htmlspecialchars($name); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>User ID</label>
                                                <input type="text" class="form-control border-input" placeholder="User ID" value="<?php echo htmlspecialchars($id); ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Location</label>
                                                <input type="text" class="form-control border-input" placeholder="City, Country" value="<?php echo htmlspecialchars($location); ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Age</label>
                                                <?php
												while($user8 = $response8->Fetch(FALSE))
    											$age = $user8['age'];
												?>
                                                <input type="text" class="form-control border-input" placeholder="Age" value="<?php echo htmlspecialchars($age); ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label>Website</label>
                                                <?php
												while($user9 = $response9->Fetch(FALSE))
    											$link = $user9['website_url'];
												?>
                                                <input type="text" class="form-control border-input" placeholder="Link" value="<?php echo htmlspecialchars($link); ?>">
                                            </div>
                                        </div>                                                             
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>About Me</label>
                                                <?php
                                                	$aboutFilter = new Filter();
													$aboutFilter->SetIncludeItems(array('user.about_me'));
													$aboutFilter->SetUnsafe(FALSE);
													$aboutObj = $stackoverflow->Users($id);
													$about = $aboutObj->Filter($aboutFilter->GetID())->Exec();
													while($userz = $about->Fetch(FALSE))
														echo"{$userz['about_me']}";
                                                ?> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                </form>
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

</html>
