<?php $this->extend("employer/layout") ?>

<?php $this->section("title") ?>
    <title>Job Hunt - <?= $company["NAME"] ?></title>
<?php $this->endSection() ?>

<?php
    $types = ["Full Time", "Part Time", "Internship"];

    $fields = ["Accounting / Finance", "Animation", "AR / VR", "Construction / Facilities", "Education / Training", "Engineering / Robotics / Automation", "Games",
               "Health Care", "Manufacturing", "Research & Development", "Sales / Marketing", "Software / Information System", "Telecommunications", "Others"];

    $qualifications = ["SPM", "Foundation", "Diploma / STPM / A-Level", "Bachelor's Degree", "Master's Degree", "Doctor's Degree"];

    $career_levels = ["Entry", "Junior", "Senior", "Manager"];
?>

<?php $this->section("content") ?>
    <link rel="stylesheet" href="<?= base_url("css/employer/company.css") ?>">

    <script src="<?= base_url("js/employer/company.js") ?>"></script>

    <div id="container" class="container <?= isset($validation) ? "fade" : "" ?>" <?= isset($validation) ? "disabled" : "" ?>>
        <div class="company-box">
            <div class="company-detail">
                <form id="upload-picture" method="POST" action="<?= base_url("employer/company/picture/upload") ?>" enctype="multipart/form-data" hidden>
                    <input name="company_index" type="number" value="<?= $company_index ?>" hidden>
                    <input id="company-picture" name="company_picture" type="file" accept="image/*" hidden>
                </form>
                <div class="company-img" onclick="uploadCompanyPicture()">
                    <img src="data:image/*;base64,<?= base64_encode($company["PHOTO"]) ?>" style="width: 200px; height: 200px; border-radius: 50%">
                    <div class="overlay-image">Edit</div>
                </div>
                <h2 style="font-size: 2em; margin-top: 25px"><?= $company["NAME"] ?></h2>

                <table id="company-info" class="company-info">
                    <tr>
                        <td class="icon-col"><i class="fa-solid fa-location-dot"></i></i></td>
                        <td><?= $company["LOCATION"] ?></td>
                    </tr>
                    <tr>
                        <td class="icon-col"><i class="fa-solid fa-industry"></i></td>
                        <td><?= $company["INDUSTRY"] ?></td>
                    </tr>
                    <tr>
                        <td class="icon-col"><i class="fa-solid fa-user-large"></i></td>
                        <td><?= $company["SIZE"] ?> Employees</td>
                    </tr>
                </table>
                
                <div id="open-edit-btn">
                    <button class="btn btn-gray" style="margin-top: 20px; width: 80%;" onclick="openEditCompanyForm()">Edit company</button>
                </div>

                <!--  Edit Company Modal  -->
                <form method="POST" action="<?= base_url("employer/company/update") ?>">
                    <input name="index" type="text" value="<?= $company_index ?>" hidden>
                    <input name="company_id" type="text" value="<?= $company["COMPANY_ID"] ?>" hidden>
                    <table id="edit-company-info" class="company-info" style="display: none">
                        <tr>
                            <td class="icon-col"><i class="fa-solid fa-location-dot"></i></i></td>
                            <td>
                                <input name="location" type="text" value="<?= $company["LOCATION"] ?>" placeholder="location">
                            </td>
                        </tr>
                        <tr>
                            <td class="icon-col"><i class="fa-solid fa-industry"></i></td>
                            <td><input name="industry" type="text" value="<?= $company["INDUSTRY"] ?>" placeholder="industry"></td>
                        </tr>
                        <tr>
                            <td class="icon-col"><i class="fa-solid fa-user-large"></i></td>
                            <td><input name="size" type="text" value="<?= $company["SIZE"] ?>" placeholder="size"></td>
                        </tr>
                    </table>

                    <div id="action-btn" style="margin-top: 30px; display: none; justify-content: center">
                        <button class="btn btn-success" onclick="updateBio()">Save</button>
                        <button class="btn btn-primary" style="margin-left: 10px" onclick="closeEditCompanyForm()" type="button">Cancel</button>
                    </div>
                </form>
            </div>

            <div class="job-container">
                <div style="font-size: 2.5em; text-align: center"><b>Jobs</b></div>
                <div style="display: flex; margin-top: 25px"><button class="btn btn-success" style="margin-left: auto" onclick="showAddJobModal()">Add Job</button></div>
                <div class="job-list">
                    <?php if($jobs == null): ?>
                        <div style="width: fit-content; margin: auto; text-align: center; margin-top: 100px">
                            <ion-icon name="clipboard-outline" style="font-size: 200px"></ion-icon></ion-icon>
                            <div style="font-size: 1.5em; margin-top: 30px;">You haven't upload any post</div>
                            <button class="btn btn-primary" style='margin-top: 50px' onclick="showAddJobModal()">Add Job</button>
                        </div>
                    <?php else: ?>
                        <?php $index = 0 ?>
                        <?php foreach($jobs as $job): ?>
                            <div style="display: flex; align-items: center; margin-top: 30px;">
                                <a class="job-box" href="<?= base_url("employer/company/$company_index/job/$index") ?>">
                                    <div style="display: flex; align-items: center">
                                        <div style="font-size: 1.5em"><b><?= $job["TITLE"] ?></b></div>
                                        <?php if(strtolower($job["TYPE"]) == "fulltime"): ?>
                                            <div class="jobtype-label fulltime-label">Full Time</div>
                                        <?php elseif(strtolower($job["TYPE"]) == "parttime"): ?>
                                            <div class="jobtype-label parttime-label">Part Time</div>
                                        <?php else: ?>
                                            <div class="jobtype-label internship-label">Internship</div>
                                        <?php endif ?>
                                    </div>
                                    <div style="margin-top: 20px"><?= $job["SALARY"] ?></div>
                                </a>
                                <div class="delete-btn">
                                    <form method="POST" action="<?= base_url("employer/job/delete") ?>" id="delete-form-<?= $index ?>">
                                        <input name="job_id" type="number" value=<?= $job["JOB_ID"] ?> hidden>
                                        <input name="company_index" type="number" value=<?= $company_index ?> hidden>
                                    </form>
                                    <button class="btn btn-danger" onclick="deleteJob(<?= $index ?>)">Delete</button>
                                </div>
                            </div>
                            <?php $index += 1 ?>
                        <?php endforeach ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>

    <!--  Add Job Modal  -->
    <div id="add-job-modal" class=<?= isset($validation) ? "show" : "hide" ?>>
        <div style='text-align: center; font-size: 2em;'><b>Add Job</b></div>
        <form class="add-job-form" method="POST" style="margin-top: 20px">
            <table style="margin: auto; width: 100%;">
                <tr>
                    <td>
                        <label>Job Title</label><br>
                        <input id="job_title" name="job_title" value="<?= isset($job_title) ? $job_title : "" ?>" type="text" style="width: 100%"><br>
                        <div class="error-msg"><?= isset($validation) ? $validation->getError("job_title") : "" ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Salary</label><br>
                        <input name="min_salary" style="width: 30%;" type="number" value="<?= isset($min_salary) ? $min_salary : "" ?>" placeholder="Minimum Salary (RM)">
                        <input name="max_salary" style="margin-left: 15px; width: 30%;" type="number" value="<?= isset($max_salary) ? $max_salary : "" ?>" placeholder="Maximum Salary (RM)">
                        <div style="display: flex; align-items: center">
                            <div class="error-msg" style="width: 30%"><?= isset($validation) ? $validation->getError("min_salary") : "" ?></div>
                            <div class="error-msg" style="margin-left: 25px"><?= isset($validation) ? $validation->getError("max_salary") : "" ?></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Description</label><br>
                        <textarea name="description"><?= isset($description) ? $description : "" ?></textarea><br>
                        <div class="error-msg"><?= isset($validation) ? $validation->getError("description") : "" ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Scope</label><br>
                        <div id="scope-box">
                            <?php if(isset($scope)): ?>
                                <input name="scope[]" style="width: 100%;" type="text" value="<?= $scope[0] ?>">
                                <?php unset($scope[0]) ?>
                                <?php foreach($scope as $key => $s): ?>
                                    <div id="scope-<?= $key ?>" style="position: relative; margin-top: 5px; height: 30px">
                                        <ion-icon name="close-circle-outline" class="close-icon" onclick="removeScope(<?= $key ?>)"></ion-icon>
                                        <input name="scope[]" style="width: 100%; display: block; padding-left: 40px" type="text" value="<?= $s ?>">
                                    </div>
                                <?php endforeach ?>
                            <?php else: ?>
                                <input name="scope[]" style="width: 100%;" type="text">
                            <?php endif ?>
                        </div>
                        <div class="error-msg"><?= isset($validation) ? $validation->getError("scope") : "" ?></div>
                        <button type="button" class="btn btn-success" style="margin-top: 5px; font-size: 10px; padding: 5px 10px" onclick="addScope()">Add Scope</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Requirement</label><br>
                        <div id="requirement-box">
                            <?php if(isset($requirement)): ?>
                                <input name="requirement[]" style="width: 100%;" type="text" value="<?= $requirement[0] ?>">
                                <?php unset($requirement[0]) ?>
                                <?php foreach($requirement as $key => $r): ?>
                                    <div id="requirement-<?= $key ?>" style="position: relative; margin-top: 5px; height: 30px">
                                        <ion-icon name="close-circle-outline" class="close-icon" onclick="removeRequirement(<?= $key ?>)"></ion-icon>
                                        <input name="requirement[]" style="width: 100%; display: block; padding-left: 40px" type="text" value="<?= $r ?>">
                                    </div>
                                <?php endforeach ?>
                            <?php else: ?>
                                <input name="requirement[]" style="width: 100%;" type="text">
                            <?php endif ?>
                        </div>
                        <div class="error-msg"><?= isset($validation) ? $validation->getError("requirement") : "" ?></div>
                        <button type="button" class="btn btn-success" style="margin-top: 5px; font-size: 10px; padding: 5px 10px" onclick="addRequirement()">Add Requirement</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Type</label><br>
                        <!-- <input name="type" style="width: 100%;" type="text" value="<?= isset($type) ? $type : "" ?>"> -->
                        <select name="type" style="width: 100%;">
                                <?php foreach($types as $t): ?>
                                    <?php if(isset($type) && $type == $t): ?>
                                        <option value="<?= $t ?>" selected><?= $t ?></option>
                                    <?php else: ?>
                                        <option value="<?= $t ?>"><?= $t ?></option>
                                    <?php endif ?>
                                <?php endforeach ?>
                        </select>
                        <div class="error-msg"><?= isset($validation) ? $validation->getError("type") : "" ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Specialization</label><br>
                        <!-- <input name="specialization" style="width: 100%;" type="text" value="<?= isset($specialization) ? $specialization : "" ?>"> -->
                        <select name="specialization" style="width: 100%">
                            <?php foreach($fields as $field): ?>
                                <?php if(isset($specialization) && $specialization == $field): ?>
                                    <option value="<?= $field ?>" selected><?= $field ?></option>
                                <?php else: ?>
                                    <option value="<?= $field ?>"><?= $field ?></option>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>
                        <div class="error-msg"><?= isset($validation) ? $validation->getError("specialization") : "" ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Qualification</label><br>
                        <!-- <input name="qualification" style="width: 100%;" type="text" value="<?= isset($qualification) ? $qualification : "" ?>"> -->
                        <select name="qualification" style="width: 100%">
                            <?php foreach($qualifications as $q): ?>
                                <?php if(isset($qualification) && $qualification == $q): ?>
                                    <option value="<?= $q ?>" selected><?= $q ?></option>
                                <?php else: ?>
                                    <option value="<?= $q ?>"><?= $q ?></option>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>
                        <div class="error-msg"><?= isset($validation) ? $validation->getError("qualification") : "" ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Career Level</label><br>
                        <!-- <input name="career_level" style="width: 100%;" type="text" value="<?= isset($career_level) ? $career_level : "" ?>"> -->
                        <select name="career_level" style="width: 100%">
                            <?php foreach($career_levels as $c): ?>
                                <?php if(isset($career_level) && $career_level == $c): ?>
                                    <option value="<?= $c ?>" selected><?= $c ?></option>
                                <?php else: ?>
                                    <option value="<?= $c ?>"><?= $c ?></option>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>
                        <div class="error-msg"><?= isset($validation) ? $validation->getError("career_level") : "" ?></div>
                    </td>
                </tr>
            </table>
            <div style="display: flex; align-items: center; justify-content: center; position: absolute; bottom: 15px; left: 0; width: 100%;">
                <input class="btn btn-success" type="submit" value="Submit" style="width: 20%; margin-right: 10px">
                <input class="btn btn-primary" type="button" value="Close" style="width: 20%; margin-left: 10px" onclick="closeAddJobModal()">
            </div>
        </form>
    </div>
<?php $this->endSection() ?>