<?php $this->extend("header") ?>

<?php $this->section("title") ?>
    <title>Job Hunt - Employer Profile</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <link rel="stylesheet" href="<?= base_url("css/employer/profile.css") ?>">
    <main>





<!--- start here for content -->
  <section class="section-1">

    <h2 class="title align-center text-default" >Employer Profile</h2>
        <br>


    <div class="tabs">

        <!-- first tab -->

          <?php 
              $employerLoginID = $_GET['employer_login_id']; //set to login session id later, currently is set to 3 from layout.php

              foreach($employers as $employer):

                if($employer["EMPLOYER_ID"]==$employerLoginID){

                  $array[0] = $employer["FIRST_NAME"];
                  $array[1] = $employer["LAST_NAME"];
                  $array[2] = $employer["BIRTHDAY"];
                  $array[3] = $employer["GENDER"];
                  $array[4] = $employer["PHONE"];
                  $array[5] = $employer["EMAIL"];
                  $array[6] = $employer["PASSWORD"];

                  $hide_password = str_repeat("*", strlen($array[6])); 
                }
              endforeach;
            ?>

        <input type="radio" class="radio-tabs-button" name="tab" id="tab1" checked>
        <label for="tab1" class="radio-tabs-label">Employer Profile</label>

        <div class="tabs-content">
              <div class="container-layout">

                <h1 id="employer-name"><?= $array[0]." ".$array[1] ?></h1>
                <p id="birthday"><span class="icon icon-image"><img src="http://localhost/JobHunt/public/assets/icon/birthday.png" alt=""></span>&nbsp;​&nbsp;<?= $array[2] ?>
                </p>
                <p id="gender"><span class="icon icon-image"><img src="http://localhost/JobHunt/public/assets/icon/gender.png" alt=""></span>&nbsp;​&nbsp;<?= $array[3] ?>
                </p>
                <p id="phone"><span class="icon icon-image"><img src="http://localhost/JobHunt/public/assets/icon/phone.png" alt=""></span>&nbsp;​&nbsp;<?= $array[4] ?>
                </p>
                <p id="email"><span class="icon icon-image"><img src="http://localhost/JobHunt/public/assets/icon/email.png" alt=""></span>&nbsp;​&nbsp;<?= $array[5] ?>
                </p>
                <p id="password" ><span class="icon icon-image"><img src="http://localhost/JobHunt/public/assets/icon/password.png" alt=""></span>&nbsp;​&nbsp;<?= $hide_password ?>
                </p>

                
                  <div class="align-center"><button class="button align-center" id="edit-profile-btn">Edit Profile</button></div>


              </div>
        </div>


        <!-- second tab-->

        <input type="radio" class="radio-tabs-button" name="tab" id="tab2">
        <label for="tab2" class="radio-tabs-label">Company List</label>
        <div class="tabs-content">


              <div class="container-layout align-center">
                <div class="card-container align-center">

                <?php foreach($companies as $company): 
                    if($company['EMPLOYER_ID'] == $employerLoginID) {
                  ?>

                <a id="company-link-card" href="<?= base_url("employer/company_profile?company_id=".$company["COMPANY_ID"].
                "&employer_login_id=".$employerLoginID)?>" style="text-decoration:none;">
 
                  <div id="company-link-card" class="card">

                   <div class="card-content">
                      
                      <img class="card-image align-center" src="data:image;base64,<?= base64_encode($company["PHOTO"]) ?>" alt="">
                        <h4 class="card-name"><?= $company["NAME"] ?></h4>
                    </div>
                  
                     </div>
                </a>

                  
              <?php } endforeach; ?>


                  <div class="card" id="add-company">
                    <div class="card-content">
                      
                        <img class="card-image align-center" src="http://localhost/JobHunt/public/assets/icon/add.png" alt="">
                        <h4 class="card-name align-center">Add Company</h4>
                     
                    </div>
                  </div>
                </div>

                <div class="align-center"><button class="button align-center" id="delete-company-btn">Delete Company</button></div>
              
              </div>

         </div>

    </div>

</section>
    
         <!-- edit profile popup -->

        <div class="popup-background">

          <div class="popup-contents">
            <div style="background-color: yellowgreen; width: 100%; height: 40px; border-radius: 15px;" ></div>
            <div class="close">+</div>
        
                <div style="font-size: 1.5em; text-align: center; margin-top: -35px; margin-bottom: 20px;">Edit Profile</div>
        
        
                      <form method="POST" action="<?= base_url("EmployerController/edit_employer?employer_login_id=".$employerLoginID)?>">

                          <table class="edit-table" >

                              <tr>
                                  <td style="width: 50%;">
                                      <label for="firstname" style="padding-left: 5px;">First Name</label>
                                      <input type="text" name="firstname" placeholder="First Name" value="<?= $array[0] ?>" style="width: 95%;">
                                  </td>                              
                                  <td style="width: 50%;">
                                      <label style="padding-left: 5px;">Last Name</label>
                                      <input type="text" name="lastname" placeholder="Last Name" value="<?= $array[1] ?>" style="width: 95%;">

                                  </td>
                              </tr>
                              <tr style="margin-top: 100px;">
                                  <td style="width: 50%;">
                                      <label style="padding-left: 5px;">Birthday</label>
                                      <input type="date" name="birthday" placeholder="Birthday" value="<?= $array[2] ?>" style="width: 95%;">
                                  </td>                              
                                  <td style="width: 50%;">
                                      <label style="padding-left: 5px;">Gender</label>
                                      <select name="gender" style="width: 95%; margin: 0px 0px 0px 5px; padding: 9.5px 16px;">
                                        <option value="M" <?php echo $array[3] == 'M' ? ' selected ' : '';?>>Male</option>
                                        <option value="F" <?php echo $array[3] == 'F' ? ' selected ' : '';?>>Female</option>
                                      </select>
                                  </td>
                              </tr>
                              <tr>
                                  <td colspan=2>
                                      <label style="padding-left: 5px;">Phone</label>
                                      <input type="tel" name="phone" placeholder="Phone" value="<?= $array[4] ?>" style="width: 97%;">
                                  </td>
                              </tr>
                              <tr>
                                  <td colspan=2>
                                      <label style="padding-left: 5px;">Email</label>
                                      <input type="email" name="email" placeholder="Email" value="<?= $array[5] ?>" style="width: 97%;">
                                  </td>
                              </tr>
                              <tr>
                                  <td colspan=2>
                                      <label style="padding-left: 5px;">Password</label><br>
                                      <input type="password" name="password1" placeholder="Password" value="<?= $array[6] ?>" style="width: 97%;">
                                  </td>
                              </tr>
                              <tr>
                                  <td colspan=2>
                                      <label style="padding-left: 5px;">Confirmed Password</label>
                                      <input type="password" name="password2" placeholder="Password" value="<?= $array[6] ?>" style="width: 97%;">
                                  </td>
                              </tr>

                          </table>

                          <input type="hidden" name="employer_id" value="<?= $employerLoginID ?>">
                          <button type="submit"  class="button" style="margin: 10px;">Edit</button>
                      </form>

                  </div>
                </div>

                <!-- add company popup - 2 -->

          <div class="popup-background" id="add-company-popup">

            <div class="popup-contents" style="height: 550px;">
              <div style="background-color: lightskyblue; width: 100%; height: 40px; border-radius: 15px;" ></div>
              <div id="close2" class="close">+</div>
          
                  <div style="font-size: 1.5em; text-align: center; margin-top: -35px; margin-bottom: 20px;">Add Company</div>
          
          
                <form method="POST" action="<?= base_url("EmployerController/insert_new_company?employer_login_id=".$employerLoginID)?>" style="margin-top: 20px;"
                  enctype="multipart/form-data">

                           <!--  <input type="hidden" name="COMPANY_ID" value=""> -->

                            <div class="add-form">
                                <label style="font-size: 1rem; padding-left: 6px;">Company Name</label>
                                <input type="text" name="name" placeholder="Company Name"  style="width: 97%;">
                                <!-- <small class="error-msg"></small> -->
                            </div>
                        
                        
                            <div class="add-form">
                                <label style="font-size: 1rem; padding-left: 6px;">Location</label>
                                <input type="text" name="location" placeholder="Location" style="width: 97%;">
                                <!-- <small class="error-msg"></small> -->
                            </div>
                        
                        
                            <div class="add-form">
                                <label style="font-size: 1rem; padding-left: 6px;">Industry</label><br>
                                <input type="text" name="industry" placeholder="Industry" style="width: 97%;">
                                <!-- <small class="error-msg"></small> -->
                            </div>
                        
                        
                            <div class="add-form">
                                <label style="font-size: 1rem; padding-left: 6px;">Size</label>
                                <input type="text" name="size" placeholder="Size" style="width: 97%;">
                                <!-- <small class="error-msg"></small> -->
                            </div>
                        
                        
                            <div class="add-form">
                               <label style="padding-left: 5px;">Select image:</label>
                                <input type="file" name="photo" accept="image/*" style="width: 97%;">
                                <!-- <small class="error-msg"></small> -->
                            </div>
                        
                            <input type="hidden" name="employer_id" value="<?= $employerLoginID ?>">

                    
                    <button type="submit"  class="button" style="margin: 10px;">SUBMIT</button>
                </form>

                    </div>
                  </div>

                  <!-- pop up 3 - delete company -->


          <div class="popup-background" id="delete-company-popup">

            <div class="popup-contents">
              <div style="background-color: lightskyblue; width: 100%; height: 40px; border-radius: 15px;" ></div>
              <div id="close3" class="close">+</div>
          
                  <div style="font-size: 1.5em; text-align: center; margin-top: -35px; margin-bottom: 20px;">Delete Company</div>
              <div class="align-center">
               <table class="table" style="width: 700px; text-align: center;">
                    <colgroup>
                      <col width="45%">
                      <col width="45%">
                      <col width="10%">
                    </colgroup>

                    <thead class="table-header">
                      <tr style="height: 21px;">
                        <th style="border-radius: 5px;">Company Name</th>
                        <th style="border-radius: 5px;">Location</th>
                        <th style="border-radius: 5px;">Delete</th>
                      </tr>
                    </thead>

                    <tbody>

                     <?php 
                      $table_data = 0;
                      foreach($companies as $company): 
                          if($company['EMPLOYER_ID'] == $employerLoginID) {
                            $table_data=1;
                          
                        ?>

                      <tr style="height: 75px;">
                        
                        <td class="align-center" style="border-radius: 5px; height: 80px; "><?= $company["NAME"] ?></td>
                        <td class="align-center" style="border-radius: 5px; height: 80px;"><?= $company["LOCATION"] ?></td>
                        <td class="align-center" style="border-radius: 5px; height: 80px;">

                            <a href="<?= base_url("EmployerController/delete_company?company_id=".$company['COMPANY_ID']
                          ."&employer_login_id=".$employerLoginID)?>" class="delete-button">Delete</a>
                        </td>
                      </tr>

                      <?php }  endforeach;


                        if($table_data == 0){ ?>
                       <tr style="height: 75px;">
                        <td class=""></td>
                        <td  class=""></td>
                        <td  class=""></td>
                      </tr>


                      <?php } ?>


                    </tbody>

                  </table>
              </div>  

                    </div>
                  </div>



   <!--  end content here -->

<script type="text/javascript">
  document.getElementById('edit-profile-btn').addEventListener("click", function() {
  document.querySelector('.popup-background').style.display = "flex";
  document.querySelector('.popup-background').style.overflow = "hidden";
  
});

document.querySelector('.close').addEventListener("click", function() {
  document.querySelector('.popup-background').style.display = "none";

});

  document.getElementById('add-company').addEventListener("click", function() {
  document.querySelector('#add-company-popup.popup-background').style.display = "flex";
  document.querySelector('.popup-background').style.overflow = "hidden";
  
});

document.querySelector('#close2.close').addEventListener("click", function() {
  document.querySelector('#add-company-popup.popup-background').style.display = "none";

}); 

document.getElementById('delete-company-btn').addEventListener("click", function() {
  document.querySelector('#delete-company-popup.popup-background').style.display = "flex";
  document.querySelector('.popup-background').style.overflow = "hidden";
  
});

document.querySelector('#close3.close').addEventListener("click", function() {
  document.querySelector('#delete-company-popup.popup-background').style.display = "none";

}); 


</script>
    </main>
<?php $this->endSection() ?>