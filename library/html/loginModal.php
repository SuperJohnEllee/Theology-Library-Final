<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content teal lighten-5">
            <div class="modal-header text-center teal lighten-3">
                <h4 class="modal-title w-100 font-weight-bold"><span class="fa fa-sign-in"></span> Log in </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <p class="text-center">Note: Only an administrator can operate this system</p>
            <div class="modal-body mx-3">
                <form action="login.php" method="post">
                    <div class="md-form mb-5">
                        <i class="fa fa-user prefix dark-text"></i>
                        <input type="text" name="username" id="username" class="form-control" required>
                        <label data-error="wrong" data-success="right" for="username">Username</label>
                    </div>
                    <div class="md-form mb-4">
                        <i class="fa fa-lock prefix dark-text"></i>
                        <input type="password" name="password" id="password" class="form-control" required>
                        <label data-error="wrong" data-success="right" for="password">Password</label>
                        <a class="btn btn-default" id="show_pass" href="#"><span class="fa fa-eye"></span> Show</a>
                        <button type="submit" class="btn btn-primary pull-right" name="login" data-loading-text="Logging in.."><span class="fa fa-sign-in"></span> Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

function show() {
    var p = document.getElementById('password');
    p.setAttribute('type', 'text');
}
function hide() {
    var p = document.getElementById('password');
    p.setAttribute('type', 'password');
}
var pwShown = 0;
document.getElementById("show_pass").addEventListener("click", function () {
    if (pwShown == 0) {
        pwShown = 1;
        show();
    } else {
        pwShown = 0;
        hide();
        }
    }, false);
</script>