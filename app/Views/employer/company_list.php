<?php $this->extend("employer/layout") ?>

<?php $this->section("title") ?>
    <title>Job Hunt - Home</title>
<?php $this->endSection() ?>

<?php
    $locations = ["Kuala Lumpur", "Johor", "Penang", "Selangor", "Melaka", "Pahang", "Negeri Sembilan", "Terengganu",
                  "Perak", "Perlis", "Kelantan", "Kedah", "Sarawak", "Sabah"];

    $industries = ["Accounting / Finance", "Animation", "AR / VR", "Construction / Facilities", "Education / Training", "Engineering / Robotics / Automation", "Games",
                   "Health Care", "Manufacturing", "Research & Development", "Sales / Marketing", "Software / Information System", "Telecommunications", "Others"];
?>

<?php $this->section("content") ?>
    <link rel="stylesheet" href="<?= base_url("css/employer/company_list.css") ?>">

    <script src="<?= base_url("js/employer/company_list.js") ?>"></script>

    <div id="container" class="container <?= isset($validation) ? "fade" : "" ?>" <?= isset($validation) ? "disabled" : "" ?>>
        <div style="font-size: 2em; display: flex; align-items: center">
            <b>My Company</b>
            <button class="btn btn-success" style="margin-left: auto" onclick="showAddCompanyModal()">Add Company</button>
        </div>

        <?php if(empty($companies)): ?>
            <div style="width: fit-content; margin: auto; text-align: center; margin-top: 100px">
                <ion-icon name="business-outline" style="font-size: 200px"></ion-icon>
                <div style="font-size: 1.5em; margin-top: 30px;">You haven't add your company</div>
                <button class="btn btn-primary" style='margin-top: 50px' onclick="showAddCompanyModal()">Add Company</button>
            </div>
        <?php else: ?>
            <div class="company-container">
                <?php $index = 0 ?>
                <?php foreach($companies as $company): ?>
                    <div style="display: flex; align-items: center">
                        <a class="company-box" href="<?= base_url("employer/company/" . $index) ?>" style='text-decoration: none; color: black; width: 90%'>
                            <div class="company-img">
                                <img src="data:image/*;base64,<?= base64_encode($company["PHOTO"]) ?>" width="250px">
                            </div>
                            <div class="company-detail">
                                <h2 style="font-size: 2em; margin-bottom: 25px"><?= $company["NAME"] ?></h2>
                                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                                    <i class="fa-solid fa-location-dot fa-lg"></i><b style="margin-left: 10px; font-size: 1.3em;"><?= $company["LOCATION"] ?></b>
                                </div>
                                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                                    <i class="fa-solid fa-industry fa-lg"></i><b style="margin-left: 10px; font-size: 1.3em;"><?= $company["INDUSTRY"] ?></b>
                                </div>
                                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                                    <i class="fa-solid fa-user-large fa-lg"></i><b style="margin-left: 10px; font-size: 1.3em;"><?= $company["SIZE"] ?> Employees</b>
                                </div>
                            </div>
                        </a>

                        <div class="delete-company-btn">
                            <form method="POST" action="<?= base_url("employer/company/delete") ?>" id="delete-form-<?= $index ?>">
                                <input name="company_id" type="text" value=<?= $company["COMPANY_ID"] ?> hidden>
                            </form>
                            <button class="btn btn-danger" onclick="deleteCompany(<?= $index ?>)">Delete</button>
                        </div>
                    </div>
                    <?php $index += 1 ?>
                <?php endforeach ?>
            </div>
        <?php endif ?>
    </div>

    <!--  Add Company Modal  -->
    <div id="add-company-modal" class=<?= isset($validation) ? "show" : "hide" ?>>
        <div style='text-align: center; font-size: 2em;'>Add Company</div>
        <form method="POST" class="add-form" enctype="multipart/form-data">
            <div style="text-align: center; margin-bottom: 25px;">
                <input id="photo" name="photo" type="file" accept="image/*" hidden>
                <div class="company-photo" onclick="changeCompanyPicture()">
                    <?php if(isset($photo)): ?>
                        <img id="company-photo" src="data:image/*;base64,<?= base64_encode($photo) ?>" width="200px" height="200px" style="border-radius: 50%">
                        <input name="encode_photo" type="text" value="<?= isset($photo) ? "1" : "0" ?>" hidden>
                    <?php else: ?>
                        <img id="company-photo" src="<?= base_url("assets/blank_building.jpg") ?>" width="200px" height="200px" style="border-radius: 50%">
                    <?php endif ?>
                    <div class="overlay-image">Edit</div>
                </div>
            </div>
            <table style="margin: auto; width: 100%;">
                <tr>
                    <td>
                        <label>Company Name</label><br>
                        <input id="company_name" name="company_name" value="<?= isset($company_name) ? $company_name : "" ?>" type="text" style="width: 100%"><br>
                        <div class="error-msg"><?= isset($validation) ? $validation->getError("company_name") : "" ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Location</label><br>
                        <!-- <input name="location" value="<?= isset($location) ? $location : "" ?>" type="text" style="width: 100%"> -->
                        <select name="location" style="width: 100%">
                            <?php foreach($locations as $l): ?>
                                <?php if(isset($location) && $location == $l): ?>
                                    <option value="<?= $l ?>" selected><?= $l ?></option>
                                <?php else: ?>
                                    <option value="<?= $l ?>"><?= $l ?></option>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>
                        <div class="error-msg"><?= isset($validation) ? $validation->getError("location") : "" ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Industry</label><br>
                        <!-- <input id="industry" name="industry" value="<?= isset($industry) ? $industry : "" ?>" type="text" style="width: 100%"><br> -->
                        <select name="industry" style="width: 100%">
                            <?php foreach($industries as $ind): ?>
                                <?php if(isset($industry) && $industry == $ind): ?>
                                    <option value="<?= $ind ?>" selected><?= $ind ?></option>
                                <?php else: ?>
                                    <option value="<?= $ind ?>"><?= $ind ?></option>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>
                        <div class="error-msg"><?= isset($validation) ? $validation->getError("industry") : "" ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Size</label><br>
                        <input name="min_employee" style="width: 30%;" type="number" value="<?= isset($min_employee) ? $min_employee : "" ?>" placeholder="Minimum Employee">
                        <input name="max_employee" style="margin-left: 15px; width: 30%;" type="number" value="<?= isset($max_employee) ? $max_employee : "" ?>" placeholder="Maximum Employee">
                        <div style="display: flex; align-items: center">
                            <div class="error-msg" style="width: 30%"><?= isset($validation) ? $validation->getError("min_employee") : "" ?></div>
                            <div class="error-msg" style="margin-left: 25px"><?= isset($validation) ? $validation->getError("max_employee") : "" ?></div>
                        </div>
                    </td>
                </tr>
            </table>
            <div style="display: flex; align-items: center; justify-content: center; position: absolute; bottom: 15px; left: 0; width: 100%;">
                <input class="btn btn-success" type="submit" value="Submit" style="width: 20%; margin-right: 10px">
                <input class="btn btn-primary" type="button" value="Close" style="width: 20%; margin-left: 10px" onclick="closeAddCompanyModal()">
            </div>
        </form>
    </div>
<?php $this->endSection() ?>