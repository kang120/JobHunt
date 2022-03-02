<?php $this->extend("layout") ?>

<?php $this->section("title") ?>
    <title>Job Hunt - Profile</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <?php foreach($profiles as $profile): ?>
        <?= $profile["AGE"] ?><br>
        <?= $profile["GENDER"] ?><br>
        <?= $profile["PHONE"] ?><br>
        <?= $profile["ADDRESS"] ?><br>
        <img src='data:image/*;base64,<?= base64_encode($profile["PHOTO"]) ?>'><br>
    <?php endforeach ?>
<?php $this->endSection() ?>