<?php $this->extend("header") ?>

<?php $this->section("title") ?>
    <title>Job Hunt - Company Profile</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <link rel="stylesheet" href="<?= base_url("css/employer/company_profile.css") ?>">

    <main>





<!--- start here for content -->

  <section class="section-1">
      <br>


      <div class="tabs">

        <!-- first tab -->
        <input type="radio" class="radio-tabs-button" name="tab" id="tab1" checked>
        <label for="tab1" class="radio-tabs-label">Company Profile</label>

        <div class="tabs-content">

              <div class="container-layout">

                <?php 
                    $companyID = $_GET['company_id'];
                    $employerID = $_GET['employer_login_id'];


                    foreach($companies as $company):

                      if($company["COMPANY_ID"]==$companyID){

                        $array[0] = $company["NAME"];
                        $array[1] = $company["LOCATION"];
                        $array[2] = $company["INDUSTRY"];
                        $array[3] = $company["SIZE"];
                        $array[4] = $company["PHOTO"];

                      }
                    endforeach;
                  ?>

                <div class="content-container">

                <div class="image-container"><img alt="" class="image" src="data:image;base64,<?= base64_encode($array[4]) ?>" ></div>

                <div class="content-data">
                <h1 class="company-name"><?= $array[0] ?></h1>
                <p class="company-content"><span class="icon icon-image"><img src="http://localhost/JobHunt/public/assets/icon/industry.png" alt=""></span>&nbsp;​&nbsp;<?= $array[1] ?>
                </p>
                <p class="company-content"><span class="icon icon-image"><img src="http://localhost/JobHunt/public/assets/icon/location.png" alt=""></span>&nbsp;​&nbsp;<?= $array[2] ?>
                </p>
                <p class="company-content"><span class="icon icon-image"><img src="http://localhost/JobHunt/public/assets/icon/companysize.png" alt=""></span>&nbsp;​&nbsp;<?= $array[3] ?>
                </p>
                </div>
              </div>
                  <div id="edit-company-btn" class="align-center"><button class="button align-center">Edit</button></div>


              </div>
        



        </div>


        <!-- second -->
        <input type="radio" class="radio-tabs-button" name="tab" id="tab2">
        <label for="tab2" class="radio-tabs-label">Job Post Details</label>
        <div class="tabs-content">


              <div class="container-layout">
                <div class="table">
                  <table>
                    <colgroup>
                      <col width="25%">
                      <col width="25%">
                      <col width="25%">
                      <col width="25%">
                    </colgroup>

                    <thead class="table-header">
                      <tr style="height: 21px;">
                        <th class="cell-border">Job Title</th>
                        <th class="cell-border">Job Type</th>
                        <th class="cell-border">Not Processed Apllication</th>
                        <th class="cell-border">Total Applications</th>
                        <th class="" style="color: #000000; background-color: white;">Delete</th>
                      </tr>
                    </thead>

                    <tbody>

                      <?php 

                          $table_data = 0; //for knowing have at least one table record or not

                          foreach($jobs as $job):
                            if($job["COMPANY_ID"]==$companyID){
                              $table_data = 1;
                              $total_application = 0;
                              $pending = 0;

                                foreach($jobsresults as $jobsresult){
                                 if($job["JOB_ID"]==$jobsresult["JOB_ID"]){
                                  if($jobsresult["RESULT"] !== ""){
                                    $array1 = explode(" ", rtrim($jobsresult["RESULT"]));

                                    foreach($array as $result){
                                      if($result == "PENDING")
                                        $pending+=1;
                                      $total_application+=1;
                                    }
                                   }
                                  }
                                } //to calculate total unprocessed and processed applications
                        ?>

                       

                      <tr style="height: 75px;">
                        <td class="cell-border">
                          <a href="<?= base_url("employer/job_post?job_id=".$job["JOB_ID"])."&company_id=".$companyID ?>" ><?= $job["TITLE"] ?></a>
                        </td>
                        <td class="cell-border"><?= $job["TYPE"] ?></td>
                        <td class="cell-border"><?= $pending ?></td>
                        <td class="cell-border"><?= $total_application ?></td>
                        <td class="">

                          <form method="POST" action="<?= base_url("EmployerController/delete_job")?>">
                            <input type="hidden" name="job_id" value="<?= $job["JOB_ID"] ?>">
                            <input type="hidden" name="company_id" value="<?= $companyID ?>">
                            <input type="hidden" name="employer_login_id" value="<?= $employerID?>">
                            <button type="submit" class="delete-button">Delete</button>
                          </form>
                        </td>
                      </tr>

                      <?php }  endforeach;

                        if($table_data == 0){ ?>
                       <tr style="height: 75px;">
                        <td class="cell-border"></td>
                        <td  class="cell-border"></td>
                        <td  class="cell-border"></td>
                        <td  class="cell-border"></td>
                      </tr>


                      <?php } ?>


                    </tbody>

                  </table>


                </div>
                 <div class="align-center">
                  <a class="button" href="<?= base_url("employer/add_job?company_id=".$companyID) ?>" >Add Job</a>
                 </div>
              </div>



          
        </div>


    </div>

</section>

    <!-- edit company popup -->

          <div class="popup-background" >

            <div class="popup-contents" style="height: 550px;">
              <div style="background-color: lightskyblue; width: 100%; height: 40px; border-radius: 15px;" ></div>
              <div class="close">+</div>
          
                  <div style="font-size: 1.5em; text-align: center; margin-top: -35px; margin-bottom: 20px;">Edit Company</div>
          
          
                <form method="POST" action="<?= base_url("EmployerController/edit_company")?>" enctype="multipart/form-data">

                    <table style="margin: auto; width: 100%">


                            <td colspan=2>
                                <label style="padding-left: 5px;">Company Name</label>
                                <input type="text" name="name" placeholder="Company Name"  style="width: 97%;" value="<?= $array[0] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan=2>
                                <label style="padding-left: 5px;">Location</label>
                                <input type="text" name="location" placeholder="Location" style="width: 97%;" value="<?= $array[1] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan=2>
                                <label style="padding-left: 5px;">Industry</label><br>
                                <input type="text" name="industry" placeholder="Industry" style="width: 97%;" value="<?= $array[2] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan=2>
                                <label style="padding-left: 5px;">Size</label>
                                <input type="text" name="size" placeholder="Size" style="width: 97%;" value="<?= $array[3] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan=2>
<!--                                 <label style="padding-left: 5px;">Photo</label>
                                <input type="image" name="photo" placeholder="" style="width: 97%;">
 -->                                <label for="img" style="padding-left: 5px;">Select image:</label>
                                <input type="file" id="img" name="photo" accept="image/*" style="width: 97%;" value="data:image;base64,<?= base64_encode($array[4]) ?>">
                            </td>
                        </tr>


                    </table>
                    <input type="hidden" name="company_id" value="<?= $companyID ?>">
                    <input type="hidden" name="employer_login_id" value="<?= $employerID ?>">
                    <button type="submit"  class="button" style="margin: 10px;">Edit</button>
                </form>

                    </div>
                  </div>

  


  



<script type="text/javascript">
  document.getElementById('edit-company-btn').addEventListener("click", function() {
  document.querySelector('.popup-background').style.display = "flex";  
});

document.querySelector('.close').addEventListener("click", function() {
  document.querySelector('.popup-background').style.display = "none";

});




</script>

   <!--  end content here -->


    </main>
<?php $this->endSection() ?>