<!DOCTYPE html>
<?php

	if(isset($_POST["title"])){
		
		require('db_connect.php');
		
		$title = $_POST["title"];
		$abstract = $_POST["abstract"];
		$publish_date = $_POST["publish_date"];
	
		
		
		
		$sql = "INSERT INTO research_tb(title, abstract, publish_date) VALUES(:title, :abstract, :publish_date)";
		
		try {
			$result = $conn->prepare($sql);
			$values = array(":title" => $title, ":abstract" => $abstract,":publish_date" => $publish_date);
			$result->execute($values);
			
			if($result){
				echo "<script> alert('Record has been saved!'); window.location = 'a_research_page.php'; </script>";
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
      $titleName = "SIMS CS-Org - Webinars";

      include_once './MetaScript/meta.php';

      //delete this
      if (isset($_POST['submit'])) {
            echo $address = $homeurl.((isset($_GET["id"]))? "p_admin/a_researchInfo_page.php?id=".$_GET["id"] : "p_admin/a_research_page.php");
            echo "<script type='text/javascript'>document.location.href='{$address}';</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $address . '">';
      }
?>
<body>
<?php
			$id = (isset($_GET["id"]))? $_GET["id"] : '';
            if (isset($_GET["id"])) $reseachdata = $research->getSpecificResearch($id);
            
            $_SESSION['research'] = (isset($_GET["id"]))? $reseachdata['title'] : 'Add Research' ;
            include './templates/header_1.php';

            $title = $_SESSION['research'];
            $add = "";
            $edit = "";
            $datatypeDelete = 'research' ;
            $add_btn = $search_input = false; $edit_btn = $delete_btn = false;
            include './templates/back_tab.php';
?>
<section>
<div class = "container">
	<form action = "" method = "post">
		 <div class="mb-2">
                        <div class=" p-1 text-center">
                              <img src="<?php if ($id != '') { 
                                                      echo ($reseachdata['profile_filename'] != "")?
                                                            '../Assets/profiles/'.$_SESSION['filename']=$student_data['profile_filename']:
                                                            "https://avatars.dicebear.com/api/bottts/".preg_replace('/\s+/', '', $reseachdata['title']).".svg";
                                                } else 
                                                      echo '../Assets/placeholders/starting_profile.png'?>"
                                    id='image' alt="" class="shadow p-3 profile rounded border border-3" style="width: 300px; height: 400px; object-fit: cover;" >
                        </div>
                  </div>
                  <div class="p-1 text-center">
                        <input type="file" name="profile_img" onchange="readURL(this);" accept=".png,.jpg">
                  </div>
		<div class="row text-center">
                              <h2>Title</h2>
                        </div>
                        <div class="row text-center">
                              <input type="text" name="title" id="" class="h2 text-center">
                        </div>
                        <br>
		
		<div class="row text-center">
                              <h2>Abstract</h2>
                        </div>
                    
                        <div class="row">
                              <td style="display: block; height: 100px; overflow-y: auto">
                                    <textarea name="description" id="" cols="30" rows="10">
                                         
                                    </textarea>
                              </td>
                        </div>
		
		<br>
		<div class="row container mx-auto  shadow border">
                        <div class="row">
                              <div class="col m-2 mb-0">
                                    <h4>Published Date: <input type="text" name="publish_date" placeholder="YYYY-MM-DD"></h4>
                              </div>
                              <div class="col m-2">
                              </div>
                        </div>
						<div class="row m-3">
                              <div class="col">
                                    <h4>Publishers</h4>
                              </div>
                              <div class="grid-container grid-container--fit">
                                    <?php for ($i=0; $i < 5; $i++) { ?>
                                    <a href="" class="btn btn-primary m-3 border" style="height: 250px;">
                                          <img src="https://avatars.dicebear.com/api/avataaars/<?php echo rand() ?>.svg" alt="" class="rounded-circle bg-light mx-auto mt-3" style="height: 100px; width: 100px">
                                                
                                          </img>
                                          <div class="grid-element text-center h3 mb-0">
                                                <script type='text/javascript'>
                                                      consonnants = [
                                                            'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 
                                                            'n', 'p', 'r', 's', 't', 'th', 'v', 'x', 'z'];
                                                      vowels = ['a', 'au', 'e', 'i', 'o', 'ou', 'u', 'y'];
            
                                                      name = "";
                                                      length = Math.floor(Math.random() * 3) + 2; 
                                                      for (i = 0; i < length; i++)
                                                            name += (consonnants[Math.floor(Math.random()*consonnants.length)]
                                                                        + vowels[Math.floor(Math.random()*vowels.length)]);
                                                      name = name.charAt(0).toUpperCase() + name.slice(1);
                                                      document.write("<p id='name'>" + name + "</p>"); 
                                                </script>
                                          </div>
                                    </a>
                                    <?php } ?>
                              </div>
		</div>
<br>
		
		<div class="text-end mb-5">
                              <button class="btn btn-outline-dark btn-lg px-5" type="submit" name="submit">Submit</button>
                        </div>
		
	</form>
</div>
</section>
   <div class="row w-100">

            <?php
                  include './templates/footer.php';

                  include_once './MetaScript/script.php';
            ?>
      </div>

</body>
</html>   