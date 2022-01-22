<?php $this->extend("layout") ?>

<?php $this->section("title") ?>
    <title>Job Hunt - search job</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <h1>Search Result: <?= $_GET["query"] ?></h1>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<?php $this->endSection() ?>