

<!DOCTYPE html>
<html>
<head>
     <title>Todo Application  </title>
	 <link rel="stylesheet" type="text/css" href="main1.css">
	 </head>
	  
<?php

// declaring variable for connection
$servername = "localhost";
$username = "root";
$password = "Gayatri87";
$db="todo";
 $errors="";
               // connect to data base
     $conn = mysqli_connect($servername, $username, $password, $db);
	
	 
	 if (isset($_POST['submit']))
	 {
		
		 $task = $_POST['task'];
		  //check if task box is empty or not
		 if (empty($task))
		 {
			 $errors = "Please fill in the task";
		 }
		 else 
		 {
			 mysqli_query($conn,"INSERT INTO tasks (task) VALUES ('$task')");
			 
			 
		 header('location: main.php');
		 }
	 } 
	 
	  // delete tasks
	 
	 if (isset($_GET['del_task']))
	 {
		 $id = $_GET['del_task'];
		
			 mysqli_query($conn,"DELETE FROM tasks WHERE id=$id");
		 header('location: main.php');
		 
	 }
	
	 
       $tasks =  mysqli_query($conn,"SELECT *FROM tasks");
	   

?>	 
	 
	 
	 <body> 

	 <h2> <center> Todo Application </center> </h2>
	 
	 
	 <form method="POST" action="main.php">
	  
	 <?php if (isset($errors))
		 // calling error 
	 { 
     ?> 
	  <p> <?php echo $errors; ?> </p>
	 <?php } ?>
	 
	  
	 
	   <input type="text" name="task" class="text_input">
	   <button type="submit" class="btn"  name= "submit" > Add Task </button>
	   </form>
	 
	      <div class= "p1">
		  <p> List of task  </p>
		  </div>
	 
	 
	 <table>
	  <thead>
	   <tr> <th> Number </th>
		  <th> Name of Task </th>
		  <th> Action </th>
		  </tr>
		  </thead>
		  
		  </tbody>
		  <?php $i=1; while ($row = mysqli_fetch_array($tasks)) {  ?>
		     
		    <tr>
		      <td> <?php echo $i; ?> </td>
			 <td class="task" > <?php echo $row['task'] ?>  </td>
			 <td class ="delete" > 
			 <a href= "main.php?del_task= <?php echo $row['id'] ; ?>">Delete task </a>
              </td>
			  </tr>
		  <?php  $i++; } ?>
			 </tbody>
		  </table>
	 </body>
	 
	 </html>
	 
	 
	 