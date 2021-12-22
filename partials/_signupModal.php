<?php
    echo '
    <!-- Modal -->
    <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="signupModalLabel">SignUp iDiscuss Account</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form action="/forum/partials/_handleSignup.php" method="POST">
                    <div class="form-group">
                        <label for="signupName">Name</label>
                        <input type="text" class="form-control" id="signupName" name="signupName" required>
                    </div>
                    <div class="form-group">
                        <label for="signupEmail">Email address</label>
                        <input type="email" class="form-control" id="signupEmail" name="signupEmail" aria-describedby="emailHelp" required>
                    </div>
                    <div class="form-group">
                        <label for="signupPassword">Password</label>
                        <input type="password" class="form-control" name="signupPassword" id="signupPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="signupcPassword">Confirm Password</label>
                        <input type="password" class="form-control" name="signupcPassword" id="signupcPassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary">SignUp</button>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>';
?>