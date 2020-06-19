<?php include "pertials/_header.php"; ?>

<?php require_once 'pertials/_message.php'; ?>

  <body class="text-center">
    <form class="form-signin" action="register" method="post" enctype="multipart/form-data">
  <img class="mb-4" src="/docs/4.5/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="text" id="inputEmail" name="username" class="form-control" placeholder="user name" required >
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
  <div class="checkbox mb-3">
  <label for="myfile">Select a file:</label>
  <input type="file" id="myfile" name="profile_photo">
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
</form>

<?php include "pertials/_footer.php"; ?>
</body>
</html>
