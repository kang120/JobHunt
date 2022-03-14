<?php $this->extend("layout") ?>

<?php $this->section("title") ?>
    <title>Job Hunt - inquiry</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <link rel="stylesheet" href="<?= base_url("css/candidate/inquiry.css") ?>">
    <script src="<?= base_url("js/inquiry.js") ?>"></script>

    <div id="container" class="container">
        <div class="title-row">
            <div style="font-size: 2em"><b>Your question</b></div>
            <div style="margin-left: auto"><button class="btn btn-success" onclick="showQuestionModal()">Ask question</button></div>
        </div>

        <table width="100%" style="margin-top: 20px">
            <col width="10%">
            <col width="45%">
            <col width="45%">
            <thead>
                <th>ID</th>
                <th>Question</th>
                <th>Answer</th>
            </thead>
            <tbody>
                <?php foreach($inquiries as $inquiry): ?>
                    <tr>
                        <td style="text-align: center"><?= $inquiry["INQUIRY_ID"] ?></td>
                        <td><?= $inquiry["QUESTION"] ?></td>
                        <td><?= $inquiry["ANSWER"] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <form method="POST" id="question-modal" class="question-modal">
        <div style="font-size: 1.5em"><b>Ask a Question</b></div>
        <textarea name="question" id="question-box"></textarea>
        <div style="width: 100%; display: flex; align-items: center; justify-content: center; position: absolute; bottom: 15px; left: 0">
            <button class="btn btn-success">Submit</button>
            <button class="btn btn-primary" style="margin-left: 20px" type="button" onclick="closeQuestionModal()">Cancel</button>
        </div>
    </form>
<?php $this->endSection() ?>