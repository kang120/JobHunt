<?php $this->extend("layout") ?>

<?php $this->section("title") ?>
    <title>Job Hunt - Sign up</title>
<?php $this->endSection() ?>

<?php $this->section("content") ?>
    <link rel="stylesheet" href="<?= base_url("/css/candidate/signup_validation.css") ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <main>
        <form method="POST" action="">
            <input id="email" type="text" value="<?= $_GET["email"] ?>" hidden>
            <div style="font-size: 2.5em; margin-bottom: 50px;">Please verify your email</div>
            <p style="font-size: 1.4em;">We have sent a 6-digits number to your email, please check and enter the number below within 5 minutes.</p>
            <div id="container" class="numbers-container">
                <input id="number_1" type="number" max="9" disabled>
                <input id="number_2" type="number" max="9" disabled>
                <input id="number_3" type="number" max="9" disabled>
                <input id="number_4" type="number" max="9" disabled>
                <input id="number_5" type="number" max="9" disabled>
                <input id="number_6" type="number" max="9" disabled>
                <input id="status" name="status" value="pending" hidden>
                <input id="input" name="input" value="" hidden>
                <input id="submit-btn" type="submit" hidden>
            </div>
            <div style="margin-top: 40px;">
                <span>Did not receive email?<span id="resend-email-btn" class="resend-email-btn">Send again</span></span>
            </div>
        </form>
    </main>

    <script>
        function sendVerificationToEmail(){
            var verificationNumber = String("<?php echo session()->getTempData("signup_verification") ?>");
            var email = "<?= $_GET["email"] ?>";
            console.log(email);
            console.log(verificationNumber);

            // call api to send email
            $.ajax({
                url: "http://localhost:2175/send_signup_verification_email",
                method: "POST",
                data: {
                    email: email,
                    verificationNumber: verificationNumber
                },
                success: function(){
                    console.log("email sent");
                },
                error: function(){
                    console.log("Something error");
                }
            });
        }

        window.onload = function(){
            var send_email = "<?= isset($send_email) ? "no" : "yes" ?>";

            if(send_email != "no"){   // if wrong input, it will not send email again
                sendVerificationToEmail();
            }

            var number1 = document.getElementById("number_1");
            var number2 = document.getElementById("number_2");
            var number3 = document.getElementById("number_3");
            var number4 = document.getElementById("number_4");
            var number5 = document.getElementById("number_5");
            var number6 = document.getElementById("number_6");

            var numberBoxes = [number1, number2, number3, number4, number5, number6];

            numberBoxes.forEach(numberBox => {
                numberBox.style.fontSize = (numberBox.offsetHeight * 0.7) + "px";

                // filter number only
                numberBox.onkeydown = function(e){
                    if((e.key != "Backspace" || e.key != "") && (e.key < "0" || e.key > "9") && !e.ctrlKey){
                        e.preventDefault();
                    }

                    // backspace
                    if(e.key == "Backspace" && numberBox.id != "number_1"){
                        numberBox.setAttribute("disabled", true);
                        numberBox.previousElementSibling.focus();
                        numberBox.previousElementSibling.value = "";
                    }
                }

                // focus transfer
                if(numberBox.id != "number_6"){
                    numberBox.oninput = function(){
                        if(this.value != ""){
                            numberBox.nextElementSibling.removeAttribute("disabled");
                            numberBox.nextElementSibling.focus();
                        }
                    }
                }else{
                    numberBox.oninput = function(){
                        var inputCode = "";

                        numberBoxes.forEach(box => {
                            inputCode += box.value;
                            box.value = "";
                            box.setAttribute("disabled", true);
                        })

                        document.getElementById("status").value = "submit";
                        document.getElementById("input").value = inputCode;
                        $("#submit-btn").click();

                        /*
                        if(inputCode == verificationDigit){
                            console.log("sign up successfully");
                            window.location.href = window.location.href + "&result=success";
                        }
                        */
                    }
                }
            });

            document.getElementById("container").onclick = function(){
                var stop = false;

                numberBoxes.forEach(box => {
                    if(stop){
                        return;
                    }

                    if(box.value == ""){
                        stop = true;
                        box.removeAttribute("disabled");
                        box.focus();
                    }
                })
            }

            document.getElementById("resend-email-btn").onclick = function(){
                document.getElementById("status").value = "resend";
                $("#submit-btn").click();
            }
        }
    </script>
<?php $this->endSection() ?>