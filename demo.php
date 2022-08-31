<?php
    $errors = "";

    $db = mysqli_connect('localhost', 'root', '', 'todo');

    if (isset($_POST['submit'])) {
        if (empty($_POST['task'])) {
            $errors = "You must fill in the task";
        }else{
            $task = $_POST['task'];
            $sql = "INSERT INTO task (task) VALUES ('$task')";
            mysqli_query($db, $sql);
            header('location: demo.php');
        }
    }
    if (isset($_GET['del_task'])) {
        $id = $_GET['del_task'];
    
        mysqli_query($db, "DELETE FROM task WHERE ID=".$id);
        header('location: demo.php');
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>ToDo App</title>
        <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
        <style>
            .gradient {
                background: linear-gradient(to bottom right, #fdc639, #ff7c60)
            }
            table {
    width: 50%;
    margin: 30px auto;
    border-collapse: collapse;
}

tr {
	border-bottom: 1px solid #cbcbcb;
}

th {
	font-size: 19px;
	color: #fff;
}

th, td{
	border: none;
    height: 30px;
    padding: 2px;
}

tr:hover {
	background: #E9E9E9;
}

.task {
	text-align: left;
}

.delete{
	text-align: center;
}
.delete a{
	color: white;
	background: #a52a2a;
	padding: 1px 6px;
	border-radius: 3px;
	text-decoration: none;
}
        </style>
    </head>
    <body>
         <div class='sm:ml-72 mt-24 ml-28 w-2/4 center h-auto gradient'>
            <h1 class='text-3xl font-bold font-serif text-white text-center'>ToDo App</h1>
            <form method='post' action='demo.php'>
            <?php if (isset($errors)) { ?>
	            <p><?php echo $errors; ?></p>
                <?php } 
            ?>
                <input type='text' placeholder='Input your task' name='task' class='w-full h-16 bg-twhite border-rounded-lg-black'>
                <button type='submit' name='submit' id='add_btn' class='bg-black h-12 mt-4 w-1/2 ml-16 sm:ml-36 text-base font-bold text-white'>Add Task</button>
        </form>
        <table>
	<thead>
		<tr>
			<th>N</th>
			<th>Tasks</th>
			<th style="width: 60px;">Action</th>
		</tr>
	</thead>
    <tbody>
		<?php 
		// select all tasks if page is visited or refreshed
		$task = mysqli_query($db, "SELECT * FROM task");

		$i = 1; 
        while ($row = mysqli_fetch_array($task)) { ?>
			<tr>
				<td> <?php echo $i; ?> </td>
				<td class="task"> <?php echo $row['Task']; ?> </td>
				<td class="delete"> 
					<a href="demo.php?del_task=<?php echo $row['ID'] ?>">x</a> 
				</td>
			</tr>
		<?php $i++; } ?>	
	</tbody>
        </div>
    </body>
</html>