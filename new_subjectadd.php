<!DOCTYPE html>
<?php

	if(isset($_POST["code"])){
		
		require('db_connect.php');

		$schyearsemester_id = $_POST["schyearsemester_id"];
		$title = $_POST["title"];
		$code = $_POST["code"];
		$active = $_POST["active"];
	
		$sql = "INSERT INTO subject_tb(schyearsemester_id, title, code, active) VALUES(:schyearsemester_id, :title, :code, :active)";
		
		try {
			$result = $conn->prepare($sql);
			$values = array(":schyearsemester_id" => $schyearsemester_id, ":title" => $title, ":code" => $code, ":active" => $active);
			$result->execute($values);
			
			if($result){
				echo "<script> alert('Record has been saved!'); window.location = 'a_subject_page.php'; </script>";
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
<body style="height: 100vh">

      <?php 
            $id = (isset($_GET["id"]))? $_GET["id"] : "";
            
            $_SESSION['Subject'] = (isset($_GET["id"]))? $userdata['code'].' - '.$userdata['title'] : true;
            include './templates/header_1.php';

            $title = "Add Subject";

            if (isset($_GET['page'])) $year = $schyearsem->getSelectedSchYear($_GET['page']);

            if (isset($_GET['s_id'])) $subject = $subj->getSubjectCardDataSpecific($_GET['s_id']);
            
            $add = "";
            $edit = "";
            $add_btn = $edit_btn = $search_input = $delete_btn = false;
            include './templates/back_tab.php';
      ?>
	  <section >
            <form action="" method="post">
	  <div class="mb-5">
                        <div class=" p-1 text-center">
                              <img src="<?php
                                          if ($id || isset($_GET['s_id'])) {
                                                echo (isset($subject['filename']))?
                                                      '../Assets/profiles/'.$subject['filename']:
                                                      "https://avatars.dicebear.com/api/initials/".$subject['title'].".svg";
                                          }
                                          else {
                                                $_SESSION['image'] = null;
                                                $_SESSION['image_name'] = null;
                                                echo '../Assets/placeholders/starting_profile.png';
                                          }
                                          ?>" 
                                    id='image' alt="" class="profile rounded border border-3 shadow" style="width: 300px; height: 400px; object-fit: cover;" >
                        </div>
                        <div class="p-1 text-center">
                              <input type="file" name="profile_img" onchange="readURL(this);" accept=".png,.jpg">
                        </div>
                  </div>
                  <br>
	  
		<label>SCHOOL YEAR ID: </label>
		<input type = "text" class = "form-control" name = "schyearsemester_id">
		
		<label>Title:</label>
		<input type = "text" class = "form-control" name = "title">
			
		<label>Code:</label>
		<input type = "text" class = "form-control" name = "code">
		
		<label>Active: </label>
		<input type = "text" class = "form-control" name = "active">
		
		<br>
		<div class="col text-end">
				<button class="btn btn-outline-dark btn-lg px-5" type="submit" name="submit">Submit</button>
                              </div>
                        
		</form>
		
</section>		

      <?php
            include './templates/footer.php';


            include_once './MetaScript/script.php';
      ?>
	  

</body>
</html>     