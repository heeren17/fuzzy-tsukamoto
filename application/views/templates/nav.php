<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
  <?php if ($this->session->userdata('id_user')) { ?>
  <a class="navbar-brand mr-1"
    href="<?= base_url('home') ?>"><?php echo $this->session->userdata('usernname'); ?></a>

  <!-- Navbar Search -->
  <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
  </form>

  <!-- Navbar -->
  <ul class="navbar-nav ml-auto ml-md-0">
    <li class="nav-item dropdown no-arrow">

      <button class="btn btn-danger" href="">
        <?php echo anchor('Login/logout', '<i class="nav-icon fas fa-sign-out-alt"></i> Logout'); ?>
        <?php } else { ?>
        <?php echo anchor('Login', 'Login'); ?>
        <?php } ?>
      </button>
    </li>
  </ul>

</nav>