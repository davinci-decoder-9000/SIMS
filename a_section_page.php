<!DOCTYPE html>
<html lang="en">

<?php
      ob_start();
        $css = '<link rel="stylesheet" href="head.css">'."\n"
            .'<link rel="stylesheet" href="../CSS/cardcss.css">'."\n";
      $titleName = "SIMS CS-Org - Section";

      include_once './MetaScript/meta.php'
?>

<body>

<?php 
            $_SESSION['MainMenu'] = "Class";

            unset($_SESSION['Class'], $_SESSION['Student'], $_SESSION['year'], $_SESSION['section'], $_SESSION['section_id'], $_SESSION['Edit']);

            include './templates/header_1.php';

            $title = "Class List";
            $add = "./new_classadd.php";
            $edit = "";
            $add_btn = true; 
			$sort_btn = false; $edit_btn = false;
			$search_input = false;
            include './templates/back_tab.php'
?>

      <section class="cardscss">
            <div class="d-grid b-5 w-100">
                  <div id="app" class="container-fluid text-center">
<?php
                              $page = $_GET['page'];
                              $year = $schyearsem->getSelectedSchYear($page);
?>
                              <!-- Header And Page Controls -->
                              <div class="row mb-3">
                                    <?php echo ($_GET['page'] > 0)? '<a href="./a_section_page.php?page='. --$page .'" class="col-1 btn btn-secondary">Prev</a>' : '<div class="col-1"></div>' ?>
                                    <h3 class="col" ><?php if ($year != 1 && $year != 2) echo $year['sch_year']?></h3>
                                    <?php echo ($year != 1 && $year != 2)? '<a href="./a_section_page.php?page='.++$_GET['page'].'" class="col-1 btn btn-secondary">Next</a>' : '<div class="col-1"></div>'?>
                              </div>
<?php
                              if ($year != 1 && $year != 2) {
                                    $semesters = $schyearsem->getAllSemeter_Schyear($year['sch_year']);
                                    
                                    if ($semesters != 1 && $semesters != 2) {
                                          $current = true;
                                          foreach ($semesters as $semesters) {
?>
                                                      
                                                      <div class="py-2 <?php if ($current) {
                                                                              $current=false;
                                                                              echo "bg-warning rounded hover";
                                                                        } else
                                                                              echo "bg-warning mx-5 mt-5 rounded hover";?>">
                                                            <h4><?php 
                                                                  switch ($semesters['semester']) {
                                                                        case 1:
                                                                              echo "1st";
                                                                              break;
                                                                        case 2:
                                                                              echo "2nd";
                                                                              break;
                                                                        case 3:
                                                                              echo "Mid";
                                                                              break;
                                                                  }
                                                                  ?> Semester</h4>
                                                      </div>
<?php 
                                                      $section_data = $ys->getSectionCard_YearSemester($semesters['id']);
                                                      if ($section_data != 1 && $section_data != 2) {
                                                            foreach ($section_data as $section_data) {
                                                                  $count = $ssd->countStudentSectionYear($section_data['id']);
?>
                                                                  <a href="./a_s_class_page.php?id=<?php echo $section_data['id'] ?>" class="border btn text-center rounded m-3 p-0">
                                                                        <card data-image="<?php echo (false /*change to file_name*/)? "" : 
                                                                              "../Assets/placeholders/year/BSCS".$section_data['year'].".png"?>" class="m-0">
                                                                              <h2 slot="header" class="fs-1">BSCS <br><?php echo $section_data['year'].' - '.$section_data['section']?></h2>
                                                                              <p slot="content" class="text-light"><?php echo $count['student_count']?></p>
                                                                        </card>
                                                                  </a>
                                                                  
<?php 
                                                            }     
                                                      }else { 
                                                            $tag = "No Available Class!";
                                                            include './templates/not_available_card.php';
                                                      }
                                                }
                                    }else { 
                                          $tag = "No Available Class!";
                                          include './templates/not_available_card.php';
                                    }
                              }else { 
                                    $tag = "No Available Class!";
                                    include './templates/not_available_card.php';
                              }
?>
                  </div>
            </div>

      </section>

      <?php 
            include './templates/footer.php';


            include_once './MetaScript/script.php';
      ?>

</body>
</html>