<?php $this->extend("header") ?>

<?php $this->section("title") ?>
    <title>Job Hunt - Edit Job Applications</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <link rel="stylesheet" href="<?= base_url("css/employer/edit_applications.css") ?>">

    <main>





<!--- start here for content -->

    <section class="section-1">

            <div>


        <h2 class="title align-center text-default">Edit Applicants</h2>
      <form method="POST" action="<?= base_url("EmployerController/update_applications?")?>" id="result-form" >

        <div class="table align-center">
          <table >
            <colgroup>
              <col width="20%">
              <col width="20%">
              <col width="20%">
              <col width="40%">
            </colgroup>

            <thead class="table-header"> 
              <tr style="height: 26px;">
                <th class="cell-border">NAME</th>
                <th class="cell-border">CONTACT</th>
                <th class="cell-border">EMAIL</th>
                <th class="cell-border">APPLICATION STATUS</th>
              </tr>
            </thead>

            <tbody>
 
             <?php 
              $table_data = 0;
              $jobID = $_GET["job_id"];

              $results = array("PENDING","SUCCESS", "REJECTED");
              foreach($results as $result):
                foreach($applicants as $applicant):
                  if($applicant["JOB_ID"]==$jobID){
                    if($applicant["RESULT"]==$result){
                      $table_data += 1;

              ?>


               <tr style="height: 75px;">
                <td class="cell-border">
                  <a href="" >
                    <?= $applicant["FIRST_NAME"]." ".$applicant["LAST_NAME"] ?></a>
                </td>
                <td  class="cell-border no-select"><?=  $applicant["PHONE"] ?></td>
                <td  class="cell-border"><?=  $applicant["EMAIL"] ?></td>
                <td  class="cell-border ">

                  <?php  
                  $pending_checked="";
                  $success_checked="";
                  $rejected_checked="";
                  if($applicant["RESULT"] == "PENDING"){ 
                      $pending_checked="checked";
                    ?>
                      
                  <?php }elseif ($applicant["RESULT"] == "SUCCESS") { 
                      $success_checked="checked";
                    ?>


                  <?php }elseif ($applicant["RESULT"] == "REJECTED") {
                      $rejected_checked="checked";

                  } ?>
                  <div class="radio-container align-center">
                          <div>
                            <input type="radio" id="<?= $applicant["APPLICATION_ID"]."1" ?>" name="<?= $applicant["APPLICATION_ID"] ?>" class="radio-button" <?= $success_checked ?> value="SUCCESS" >
                            <label  for="<?= $applicant["APPLICATION_ID"]."1" ?>" class="radio-label no-select success">SUCCESS</label>
                          </div>
                          <div>
                            <input type="radio" id="<?= $applicant["APPLICATION_ID"]."2" ?>" name="<?= $applicant["APPLICATION_ID"] ?>" class="radio-button" <?= $rejected_checked ?> value="REJECTED">
                            <label for="<?= $applicant["APPLICATION_ID"]."2" ?>" class="radio-label no-select rejected">REJECTED</label>
                          </div>
                          <div>
                            <input type="radio" id="<?= $applicant["APPLICATION_ID"]."3" ?>" name="<?= $applicant["APPLICATION_ID"] ?>" class="radio-button" <?= $pending_checked ?> value="PENDING">
                            <label for="<?= $applicant["APPLICATION_ID"]."3" ?>" class="radio-label no-select pending">PENDING</label>
                          </div>

                  </div>




                </td>
              </tr>
              
              <?php 
                      }
                    }
                  endforeach;
                endforeach;
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
                 <div class="align-right">
                  <input type="hidden" name="total-data" value="<?= $table_data ?>">
                  <input type="hidden" name="job_id" value="<?= $jobID ?>">
                  <input type="submit" name="" value="Save" class="button">
                <a href="<?= base_url("employer/job_post?job_id=".$jobID)?>" class="button align-center">Cancel</a>
                <br><hr><br>

                 </div>

      </form>

      </section>





<script type="text/javascript">
  document.getElementById('save-result-btn').addEventListener("click", function() {
   document.getElementById("result-form").submit();// Form submission

});

document.querySelector('.close').addEventListener("click", function() {
  document.querySelector('.popup-background').style.display = "none";

});








</script>  

   <!--  end content here -->


    </main>

<?php $this->endSection() ?>