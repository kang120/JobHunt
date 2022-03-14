<?php $this->extend("header") ?>

<?php $this->section("title") ?>
    <title>Job Hunt - Job Posted</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <link rel="stylesheet" href="<?= base_url("css/employer/job_post.css") ?>">

    <main>





<!--- start here for content -->

    <section class="section-1">
      <div>

          <?php 
          $jobID = $_GET["job_id"];

              foreach($jobs as $job):
                if($job["JOB_ID"]==$jobID){

            ?>

        <h2 class="title align-center text-default" >Job Posted</h2>
        <br>

        <h2 class="job-title text-default"><?= $job["TITLE"] ?></h2>
        <h4 class="company-name text-default"><?= $job["COMPANY_NAME"] ?></h4>


        <div class="list-1">
          <div class="repeater-1 ">
            <div>
              <div><span class="icon icon-image"><img src="http://localhost/JobHunt/public/assets/icon/job_type.png" alt=""></span>
                <h3 class="attribute-name-1 text-default align-center">Type</h3>
                <p class="attribute-text-1 align-center"><?= $job["TYPE"] ?></p>
              </div>
            </div>
            <div> 
              <div><span class="icon icon-image"><img src="http://localhost/JobHunt/public/assets/icon/salary.png" alt=""></span>
                <h3 class="attribute-name-1 text-default align-center">Salary</h3>
                <p class="attribute-text-1 align-center">RM <?= $job["SALARY"] ?></p>
              </div>
            </div>
            <div>
              <div><span class="icon icon-image"><img src="http://localhost/JobHunt/public/assets/icon/career_level.png" alt=""></span>
                <h3 class="attribute-name-1 text-default align-center">Career Level</h3>
                <p class="attribute-text-1 align-center"><?= $job["CAREER_LEVEL"] ?></p>
              </div>
            </div>
          </div>
        </div>


        <div class="list-2">
          <div class="repeater-2">
            <div>
              <div>
                <h4 class="attribute-name-2 text-default">Requirement</h4>
                <hr class="attribute-line">
                <p class="attribute-text-2"><?= $job["REQUIREMENT"] ?></p>
              </div>
            </div>
            <div>
              <div>
                <h4 class="attribute-name-2 text-default">Specialization</h4>
                <hr class="attribute-line">
                <p class="attribute-text-2"><?= $job["SPECIALIZATION"] ?></p>
              </div>
            </div>
            <div>
              <div>
                <h4 class="attribute-name-2 text-default">Qualification</h4>
                <hr class="attribute-line">
                <p class="attribute-text-2"><?= $job["QUALIFICATION"] ?></p>
              </div>
            </div>
            <div>
              <div>
                <h4 class="attribute-name-2 text-default">Description</h4>
                <hr class="attribute-line">
                <p class="attribute-text-2"><?= $job["DESCRIPTION"] ?></p>
              </div>
            </div>
            <div>
              <div>
                <h4 class="attribute-name-2 text-default">Scope</h4>
                <hr class="attribute-line">
                <p class="attribute-text-2"><?= $job["SCOPE"] ?></p>
              </div>
            </div>
          </div>
        </div>

        <?php 
            break;
          }
          
        endforeach;
          
        ?>


        <a href="<?= base_url("employer/update_job?job_id=".$jobID)?>" class="button" >Edit</a>        
        
        <br><hr>
      </div>
    </section>


    <!-- applicants -->


    <section class="section-2">
      <div >


        <h2 class="title align-center text-default">Applicants</h2>

        <div class="table align-center">
          <table >
            <colgroup>
              <col width="25%">
              <col width="25%">
              <col width="25%">
              <col width="25%">
            </colgroup>

            <thead class="table-header"> 
              <tr style="height: 26px;">
                <th class="cell-border">NAME</th>
                <th class="cell-border">CONTACT</th>
                <th class="cell-border">EMAIL</th>
                <th class="cell-border">APPLICATION STATUS</th>
              </tr>
            </thead>

            <tbody >
 
             <?php 
              $table_data = 0;
              $results = array("PENDING","SUCCESS", "REJECTED");
              foreach($results as $result):
                foreach($applicants as $applicant):
                  if($applicant["JOB_ID"]==$jobID){
                    if($applicant["RESULT"]==$result){
                      $table_data = 1;

              ?>


               <tr style="height: 75px;">
                <td class="cell-border">
                  <a href="" >
                    <?= $applicant["FIRST_NAME"]." ".$applicant["LAST_NAME"] ?></a>
                </td>
                <td  class="cell-border"><?=  $applicant["PHONE"] ?></td>
                <td  class="cell-border"><?=  $applicant["EMAIL"] ?></td>
                <td  class="cell-border"><?=  $applicant["RESULT"] ?>&nbsp;
                  <?php  if($applicant["RESULT"] == "PENDING"){ ?>
                    <span class="applicant-icon"><img src="http://localhost/JobHunt/public/assets/icon/pending.png" alt=""></span>

                  <?php }elseif ($applicant["RESULT"] == "SUCCESS") { ?>
                    &nbsp;<span class="applicant-icon"><img src="http://localhost/JobHunt/public/assets/icon/success.png" alt=""></span>


                  <?php }elseif ($applicant["RESULT"] == "REJECTED") { ?>
                    <span class="applicant-icon"><img src="http://localhost/JobHunt/public/assets/icon/rejected.png" alt=""></span>
                  <?php } ?>

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
        <?php 
          $link = "window.location.href='";
          $link .= base_url('employer/edit_applications?job_id='.$jobID)."'";
        ?>
         <div class="align-right"><button class="button" onclick="<?= $link ?>">Edit</button></div>
        <br><hr><br>

      </div>
    </section>

   <!--  end content here -->


    </main>
<?php $this->endSection() ?>