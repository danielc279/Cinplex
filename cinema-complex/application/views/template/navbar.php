<nav class="navbar navbar-expand-lg navbar-default">
  <div class="d-flex flex-grow-1">
    <span class="w-100 d-lg-none d-block"><!-- hidden spacer to center brand on mobile --></span>
    <a class="navbar-brand d-none d-lg-inline-block" href="#">
                CINPLEX
            </a>
    <div class="w-100 text-right">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
    </div>
  </div>
  <div class="collapse navbar-collapse flex-grow-1 text-right" id="myNavbar">
    <ul class="navbar-nav ml-auto flex-nowrap">
      <li class="nav-item">
      <?php echo build_nav($nav); ?>
      </li>
    </ul>
  </div>
</nav>
