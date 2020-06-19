<?php if(!empty($_SESSION['errors'])): ?>
  <div class="alert alert-warning">
  <?php foreach($_SESSION['errors'] as $error): ?>
  <li><?php echo $error ?></li>
  <?php endforeach ?>
  </div>
  <?php unset($_SESSION['errors']); ?>
  <?php endif; ?>
  
  <?php if(isset($_SESSION['message'])): ?>
<div class="alert alert-success"><?php echo $_SESSION['message']; ?></div>
<?php unset($_SESSION['message']); ?>
<?php endif ?>