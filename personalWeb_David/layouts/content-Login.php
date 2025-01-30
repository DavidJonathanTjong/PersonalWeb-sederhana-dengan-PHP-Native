<form name ="loginform" method="post" action="../configs/login-check.php">
  <div class="form-group">
    <label for="userID">Username</label>
    <input
      type="text"
      class="form-control"
      name="user"
      id="userID"
      aria-describedby="emailHelp"
      placeholder="Type Username Here"
    />
  </div>
  <div class="form-group">
    <label for="passID">Password</label>
    <input
      type="password"
      class="form-control"
      name="pass"
      id="passID"
      placeholder="Type Password Here"
    />
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-info" value="login" />
  </div>
</form>