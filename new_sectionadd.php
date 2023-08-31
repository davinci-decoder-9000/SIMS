<!DOCTYPE html>
<?php

	if(isset($_POST["year"])){
		
		require('db_connect.php');

		$schyearsemester_id = $_POST["schyearsemester_id"];
		$year = $_POST["year"];
		$section = $_POST["section"];
		$active = $_POST["active"];
	
		$sql = "INSERT INTO yearsection_tb(schyearsemester_id, year, section, active) VALUES(:schyearsemester_id, :year, :section, :active)";
		
		try {
			$result = $conn->prepare($sql);
			$values = array(":schyearsemester_id" => $schyearsemester_id, ":year" => $year, ":section" => $section, ":active" => $active);
			$result->execute($values);
			
			if($result){
				echo "<script> alert('Record has been saved!'); window.location = 'a_s_class_page.php'; </script>";
			}
			
		} catch(PDOException $e){
			die("Unexpected error has been occured!" . $e);
		}	
	}

?>
<html lang="en">

<?php
       $css = '<link rel="stylesheet" href="head.css">'."\n"
                  .'<link rel="stylesheet" href="../CSS/cardcss.css">'."\n"
                  .'<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>'."\n"
                  .'<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>';
      $titleName = "SIMS CS-Org - Add Class";

      include_once './MetaScript/meta.php';
?>
<body>
<?php 
            include './templates/header_1.php';
			$title = "Add Class";
            $_SESSION['Class'] = true;


            $add = "";
            $edit = "";
            $add_btn = $edit_btn = $search_input = $delete_btn = false;
            include './templates/back_tab.php';
			
?>
<section>
	<form action = "" method = "post">
		<div class=" p-1 text-center">
                        <img src="<?php echo "https://avatars.dicebear.com/api/identicon/initial.svg";?>" id='image' alt="" class="p-3 shadow profile rounded border border-3" style="width: 300px; height: 400px; object-fit: cover;"/>
                  </div>
                  <div class="p-1 text-center">
                        <input type="file" name="profile_img" onchange="readURL(this);" accept=".png,.jpg">
                  </div>

                  <br>
                  <div class="text-center">
                        <h1>Bachelor of Science in Computer Science</h1>
                  </div>
		<label>SCHOOL YEAR ID: </label>
		<input type = "text" class = "form-control" name = "schyearsemester_id">
			
		<label>SECTION:</label>
		<input type = "text" class = "form-control" name = "section">
		
		<label> YEAR LEVEL: </label>
		<input type = "text" class = "form-control" name = "year">
		
		<label> Active: </label>
		<input type = "text" class = "form-control" name = "active">
			
<br>
		
		<button type = "submit" class ="btn btn-primary">SUBMIT</button>
		
	</form>
</section>           
     <?php 
            include './templates/footer.php';

            include_once './MetaScript/script.php';
?>

</body>
</html> 