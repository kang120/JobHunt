<?php $this->extend("header") ?>

<?php $this->section("title") ?>
    <title>Job Hunt - Edit Job Applications</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <link rel="stylesheet" href="<?= base_url("css/employer/add_job.css") ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 

    <main>





<!--- start here for content -->

    <section class="section-1">



           <div class="container ">  
                <br />  
                <br />  

            <div style="background-color: yellowgreen; width: 100%; height: 60px; border-radius: 15px;" ></div>
        
                <div style="font-size: 2.5em; text-align: center; margin-top: -55px; margin-bottom: 30px;">Add New Job</div>
        
                <br>

                <h2> Job Title</h2>
                <div class="form-group">
                    <table class="table" >     
                     <td><input type="text" name="job-title" placeholder="Title" class="form-control name_list" style="width: 73%;" /></td>
                   </table>  
                </div>

                <h2>Type</h2>
                <div class="form-group">
                    <table class="table" >     
                     <td><input type="text" name="job-title" placeholder="Type" class="form-control name_list" style="width: 73%;" /></td>
                   </table>  
                </div>

                <h2>Salary</h2>
                <div class="form-group">
                    <table class="table" >     
                     <td><input type="text" name="job-title" placeholder="Salary" class="form-control name_list" style="width: 73%;" /></td>
                   </table>  
                </div>

                <h2>Career Level</h2>
                <div class="form-group">
                    <table class="table" >     
                     <td><input type="text" name="job-title" placeholder="Career Level" class="form-control name_list" style="width: 73%;" /></td>
                   </table>  
                </div>




                <h2 >Requirement</h2>  
                <div class="form-group">  
                     
                          <div class="table-responsive">  
                               <table class="table" id="requirement_field">  
                                    <tr>  
                                         <td><input type="text" name="requirement" placeholder="Requirement 1" class="form-control name_list" /></td>  
                                         <td style="text-align: left;"><button type="button" name="add" id="add-requirement" class="btn btn-success">+ Add</button></td>      
                                    </tr>  
                               </table>  
                          </div>  
                     
                </div>  


                <h2 >Specialization</h2>  
                <div class="form-group">  
                          <div class="table-responsive">  
                               <table class="table " id="specialization_field">  
                                    <tr>  
                                         <td><input type="text" name="specialization" placeholder="Specialization 1" class="form-control name_list" /></td>  
                                         <td style="text-align: left;"><button type="button" name="add" id="add-specialization" class="btn btn-success">+ Add</button></td>  
                                    </tr>  
                               </table>  
                          </div>  
                </div>  


                <h2 >Qualification</h2>  
                <div class="form-group">  
                          <div class="table-responsive">  
                               <table class="table " id="qualification_field">  
                                    <tr>  
                                         <td><input type="text" name="qualification" placeholder="Qualification 1" class="form-control name_list" /></td>  
                                         <td style="text-align: left;"><button type="button" name="add" id="add-qualification" class="btn btn-success">+ Add</button></td>  
                                    </tr>  
                               </table>  
                          </div>  
                </div>  


                <h2 >Description</h2>  
                <div class="form-group">  
                          <div class="table-responsive">  
                               <table class="table " id="description_field">  
                                   
                                         <td style="width: 73%;"><textarea type="text" name="description" placeholder="Description" class="form-control " style="height: 100px;"></textarea></td>  
                                         <td> </td>  
                                      
                               </table>  
                          </div>  
                </div>  

                <h2 >Scope</h2>  
                <div class="form-group">  
                          <div class="table-responsive">  
                               <table class="table " id="scope_field">  
                                   
                                         <td style="width: 73%;"><textarea type="text" name="scope" placeholder="Scope" class="form-control " style="height: 100px;"></textarea></td>  
                                         <td> </td>  
                                      
                               </table>  
                          </div>  
                </div>  
                <div style="text-align: center;">
                 <input type="button" name="submit" id="submit" class="button" value="Submit" />  
                 </div>
           </div>

 </section>





<script type="text/javascript">

 $(document).ready(function(){  
      var requirement_count=1,specialization_count=1,qualification_count=1;  
      $('#add-requirement').click(function(){  
           requirement_count++;  
           $('#requirement_field').append('<tr id="row1'+requirement_count+'"><td><input type="text" name="requirement" placeholder="Requirement '+requirement_count+'" class="form-control name_list" /></td><td style="text-align: left;"><button type="button" name="remove1" id="'+requirement_count+'" class="btn btn-danger requirement_btn_remove">X</button></td></tr>');  
      }); 
      $('#add-specialization').click(function(){  
           specialization_count++;  
           $('#specialization_field').append('<tr id="row2'+specialization_count+'"><td><input type="text" name="specialization" placeholder="Specialization '+specialization_count+'" class="form-control name_list" /></td><td style="text-align: left;"><button type="button" name="remove2" id="'+specialization_count+'" class="btn btn-danger specialization_btn_remove">X</button></td></tr>');  
      });  
      $('#add-qualification').click(function(){  
           qualification_count++;  
           $('#qualification_field').append('<tr id="row3'+qualification_count+'"><td><input type="text" name="qualification" placeholder="Qualification '+qualification_count+'" class="form-control name_list" /></td><td style="text-align: left;"><button type="button" name="remove3" id="'+qualification_count+'" class="btn btn-danger qualification_btn_remove">X</button></td></tr>');  

      });  




      $(document).on('click', '.requirement_btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row1'+button_id+'').remove();  
      });
      $(document).on('click', '.specialization_btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row2'+button_id+'').remove();  
      });
      $(document).on('click', '.qualification_btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row3'+button_id+'').remove();  
      });  

 
 });  




</script>  

   <!--  end content here -->


    </main>

<?php $this->endSection() ?>