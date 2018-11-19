 <div class="modal fade" id="modalContact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content cyan lighten-5 text-dark">
            <div class="modal-header cyan lighten-1 text-center">
                <h4 class="modal-title w-100 font-weight-bold"><span class="fa fa-mobile"></span> Contact Us</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <p class="text-center">Contact us for more information or<br> you can contact us for enrollment</p>
            <div class="modal-body mx-3">
            <form method="post">
                <div class="md-form mb-5">
                    <i class="fa fa-user prefix text-dark"></i>
                    <input type="text" name="name" id="user" class="form-control validate">
                    <label data-error="wrong" data-success="right" for="user">Name</label>
                </div>

                <div class="md-form mb-5">
                    <i class="fa fa-envelope prefix text-dark"></i>
                    <input type="email" name="email" id="email" class="form-control validate">
                    <label data-error="wrong" data-success="right" for="email">Email</label>
                </div>

                <div class="md-form mb-5">
                    <i class="fa fa-tag prefix text-dark"></i>
                    <input type="text" name="subject" id="subject" class="form-control validate">
                    <label data-error="wrong" data-success="right" for="subject">Subject</label>
                </div>

                <div class="md-form">
                    <i class="fa fa-pencil prefix text-dark"></i>
                    <textarea type="text" name="message" id="message" class="md-textarea form-control" rows="4"></textarea>
                    <label data-error="wrong" data-success="right" for="message">Your message</label>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" name="send" class="btn btn-success"><i class="fa fa-paper-plane-o ml-1"></i> Send</button>
            </div>
        </form>
        </div>
    </div>
</div>
<?php
    include('connection.php');
    date_default_timezone_set('Asia/Manila');
    if (isset($_POST['send'])) {
            
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $subject = mysqli_real_escape_string($conn, $_POST['subject']);
            $message = mysqli_real_escape_string($conn, $_POST['message']);
            

            $feedback_sql = "INSERT INTO feedback(Name, Email, Subject, Message, DateSend)
            VALUES ('$name', '$email', '$subject', '$message', NOW());";
            $feedback_res = mysqli_query($conn, $feedback_sql);

            if ($feedback_res) {
                echo "<script>
                    alert('Feedback sent Successfully');
                </script>
                <meta http-equiv='refresh' content='0; url=index.php'>";
            }
            else {
                echo "<script>
                    alert('Failure in sending feedback');
                </script>";
            }
        }
?>