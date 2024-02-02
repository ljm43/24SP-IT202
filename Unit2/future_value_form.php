
<?php
//setting defualt values for vars
if (!isset($investment)) {$investment = '';}
if (!isset($interestRate)) {$interestRate = '';}
if (!isset($years)) {$years = '';}
?>



<!DOCTYPE html>
<html>
	<head>
	<title>FVC<Title>
	<link rel="stylesheet" href="main.css">
	</head>
	<body>
	<h1> Future Value Calculator </h1>


	<form action="future_value_reuslts.php" method ="post">
	<label>investment:</label>
	<input type="text"name="investemnt" value="<?php echo htmlspecialchars($investment);?> </input>

	<label


	</html>