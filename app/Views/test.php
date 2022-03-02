<?php $this->extend("layout") ?>

<?php $this->section("title") ?>
    <title>Job Hunt - Test</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <?php foreach($jobs as $job): ?>
        <div style="width: 50%; margin: auto;">
            <?= $job["TITLE"] ?><br>
            <?= $job["SALARY"] ?><br>
            Description
            <?= $job["DESCRIPTION"] ?><br>
        </div>
    <?php endforeach ?>
<?php $this->endSection() ?>