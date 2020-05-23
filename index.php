
<?php
include 'server.php';
$errors = "";

if (isset($_POST['submit'])) {

	if (empty($_POST['add'])) {
		$errors = "You must input something!!!";
	} else {
		$list = $_POST['add'];
		$date = $_POST['dtm'];
		$query = "INSERT INTO todo (list, deadline) VALUES ('$list' , '$date')";

		mysqli_query($db, $query);
		header('location: index.php');
	}
}

if (isset($_GET['rm'])) {
	$id = $_GET['rm'];

	mysqli_query($db, "DELETE FROM todo WHERE id=" . $id);
	header('location: index.php');
}

$list = mysqli_query($db, "SELECT * FROM todo");
$date = mysqli_query($db, "SELECT * FROM deadline");
?>



<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<STYLE>A {text-decoration: none;} </STYLE>
	<title>ToDo</title>
</head>


<body>
	<div class="root">

	<div class="top">
		<h2 style="font-family: Arial, Helvetica, sans-serif;" class="header">TODO list</h2>
	</div>

	<form method="post" action="index.php" class="col-1">
		<?php if (isset($errors)) {?>
			<p><?php echo $errors; ?></p>
		<?php }?>
		<div>
			<input type="text" name="add" id="add" class="todo_in" placeholder="Make Your List! ">
		</div>

		<br>
		<div>
			<input type="date"  name="dtm">
		</div>
		<br>
		<button type="submit" name="submit"  class="add_btn">Submit</button>
		<button type="reset" name="submit" class="clr_btn">Reset</button>
	</form>

	<div class="table">
	<table class="col-2">

		<thead>
			<tr>
				<th>No.</th>
				<th>Title</th>
				<th>Deadline</th>
				<th>Action</th>
			</tr>
		</thead>

		<tbody>
			<?php $i = 1;while ($row = mysqli_fetch_array($list)) {?>
				<tr>
					<td style="color: #8A2BE2"> <?php echo $i; ?> </td>
					<td style="color: #FFFAF0"> <?php echo $row['list']; ?> </td>
					<td style="color: #DC143C"><?php echo $row['deadline']; ?></td>
					<td>
						<a class="del" href="index.php?rm=<?php echo $row['id'] ?>">X</a>
					</td>
				</tr>
			<?php $i++;}?>
		</tbody>

	</table>
	</div>
	</div>
</body>
</html>