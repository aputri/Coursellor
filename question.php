<?php
require_once 'stackphp/src/api.php';
require_once 'google/GoogleCustomSearch.php';
$search = new api\GoogleCustomSearch('009595008090785904867:1lqc9abl4dm', 'AIzaSyAZRKhVxNgwyAfcXldSg1tZNaBdGxmF5z8');
$search1 = new api\GoogleCustomSearch('009595008090785904867:rfngofxjtjs', 'AIzaSyAZRKhVxNgwyAfcXldSg1tZNaBdGxmF5z8');
$search2 = new api\GoogleCustomSearch('009595008090785904867:qr-vm9tuqb4', 'AIzaSyAZRKhVxNgwyAfcXldSg1tZNaBdGxmF5z8');
$stackoverflow = API::Site('stackoverflow');
$qid = $_GET["qid"];
$id = $_GET["id"];
if(!isset($id)){ 
    header("Location: login.php");
}
if(!isset($qid)){
	header("Location: table.php?id=$id");
}
$response = $stackoverflow->Questions($qid)->Exec();
$response2 = $stackoverflow->Questions($qid)->Exec();
$response3 = $stackoverflow->Questions($qid)->Exec();
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Coursellor - Question</title>

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
                <li class>
                    <a href="index.php?id=<?php echo $_GET["id"];?>">
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
                <li class="active">
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
                    <a class="navbar-brand" href="#">Question</a>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><?php
										while($user2 = $response2->Fetch(FALSE))
    									echo "<tr><td>{$user2['title']}</td></tr>";
									?></h4>
                                <p class="category">
                                	<br>
                                	<?php
                                	 $qstFilter = new Filter();
    								 $qstFilter->SetIncludeItems(array('question.body'));
    								 $qstFilter->SetUnsafe(FALSE);
									 $questionObj = $stackoverflow->Questions($qid); 
    								 $question = $questionObj->Filter($qstFilter->GetID())->Exec();
									 while($user10 = $question->Fetch(FALSE))
										echo"{$user10['body']}";                          	
									 while($user = $response->Fetch(FALSE))
										$taggies = $user['tags'];
									 foreach($taggies as $tag) {
										echo "<button class='btn btn-info btn-fill'> {$tag}</button>";
									 }
									 $query = $taggies[0];
									 $query2 = $taggies[0]." ".$taggies[1];
									?>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>Online Courses</th>
                                    	<th>Topics</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $results = $search->search($query);
									$r = $results->results;
									$results1 = $search1->search($query);
									$r1 = $results1->results;
									$results2 = $search2->search($query2);
									$r2 = $results2->results;
									$titlee = $r1[0]->title;
									$linkk = $r1[0]->link;
                                    $title1 = $r[0]->title;
									$link1 = $r[0]->link;
									$title2 = $r[1]->title;
									$link2 = $r[1]->link;
									$title3 = $r[2]->title;
									$link3 = $r[2]->link;
									$lin = $r2[0]->link;
                                    ?>
                                        <tr>
                                        	<td>Coursera</td>
                                        	<td><a href="<?php echo $link1?>"><?php echo $title1?></a></td>
                                        	
                                        </tr>
                                        <tr>
                                        	<td>Coursera</td>
                                        	<td><a href="<?php echo $link2?>"><?php echo $title2?></a></td>
                                        </tr>
                                        <tr>
                                        	<td>Coursera</td>
                                        	<td><a href="<?php echo $link3?>"><?php echo $title3?></a></td>
                                        </tr>
                                        <tr>
                                        	<td>Codecademy</td>
                                        	<td><a href="<?php echo $linkk?>"><?php echo $titlee?></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="header">
                                <h4 class="title">Youtube Tutorial</h4>
                            </div>
                            <div class = "content">
                            	<?php
                            	$url = $lin;
    								preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
    								$idz = $matches[1];
									?>
									<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $idz ?>" frameborder="0" allowfullscreen></iframe>
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
