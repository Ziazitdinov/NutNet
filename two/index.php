<?php

	include('settings/config.php');

$name = $_POST['name'];
$name2 = $_POST['name2'];
$age = $_POST['age'];

if ($name && $name2 && $age) {
	$insert = $mysqli->query("INSERT INTO users VALUES (NULL, '$name', '$name2', '$age')");
	header("Location:".$_SERVER['PHP_SELF']);
}

require_once '/vendor/autoload.php';
$googleAccountKey = __DIR__ . 'Table-7ebba1648ae2.json';
use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;

if (isset($_POST['Unload'])) {
	putenv('GOOGLE_APPLICATION_CREDENTIALS=' . __DIR__ . '/Table-7ebba1648ae2.json');
	$select = $mysqli->query("SELECT * FROM users WHERE age > 18");
$client = new Google_Client;
			try{
				$client->useApplicationDefaultCredentials();
			  $client->setApplicationName("Something to do with my representatives");
				$client->setScopes(['https://www.googleapis.com/auth/drive','https://spreadsheets.google.com/feeds']);
			   if ($client->isAccessTokenExpired()) {
					$client->refreshTokenWithAssertion();
				}
				$accessToken = $client->fetchAccessTokenWithAssertion()["access_token"];
				ServiceRequestFactory::setInstance(
					new DefaultServiceRequest($accessToken)
				);
			   // Get our spreadsheet
				$spreadsheet = (new Google\Spreadsheet\SpreadsheetService)
					->getSpreadsheetFeed()
					->getByTitle('table');
				// Get the first worksheet (tab)
				$worksheets = $spreadsheet->getWorksheetFeed()->getEntries();
				$worksheet = $worksheets[0];
				$listFeed = $worksheet->getListFeed();

	while ( $selectUsers = $select->fetch_array()) {

				$listFeed->insert([
					'name' => "'". $selectUsers['name'],
					'name2' => "'". $selectUsers['name2'],
					'age' => "'". $selectUsers['age'],
				]);
					}
			}catch(Exception $e){
			  echo $e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile() . ' ' . $e->getCode;
			}
			header("Location:".$_SERVER['PHP_SELF']);
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PHP</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body class="bg-dark">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4 mt-5 bg-light rounded">
        <h1 class="text-center font-weight-bold text-primary">Add in table</h1>
        <hr class="bg-light">
        <h5 class="text-center text-success"></h5>
        <form method="post" id="form-box" id="form" class="p-2">

          <div class="form-group input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Name</span>
            </div>
            <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
          </div>

          <div class="form-group input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Name2</span>
            </div>
            <input type="tect" name="name2" class="form-control" placeholder="Enter your name2" required>
          </div>

          <div class="form-group input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Age</span>
            </div>
            <input type="text" name="age" class="form-control" placeholder="Enter age" required>
          </div>

          	<button class="btn btn-primary btn-block" onsubmit="call()">Save</button>
            
          
        </form>
        <form method="post">
        	<input type="submit" name="Unload" id="submit" class="btn btn-success btn-block" value="Unload">
        </form>
        </div>
      </div>
    </div>
  </div>	
  <div class="container">
  <iframe src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSjXOn7T82xgAecKkGGiwnpWevVaF7kM7pGQggbeAlwM1uyGpJ0u_N39m-neklwsEdVuSK0gXkx9xfx/pubhtml?widget=true&amp;headers=false"></iframe>
  </div>
</body>
<script type="text/javascript">
	function call() {
 	  var msg = $('#form').serialize();
        $.ajax({
          type: 'POST',
          url: 'index.php',
          data: msg,
          error:  function(xhr, str){
	    alert('Возникла ошибка: ' + xhr.responseCode);
          }
        });
 
    }
</script>
</html>