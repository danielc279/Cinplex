<aside id="sidebar" class="collapse d-block">
    <header class="navbar navbar-light align-items-stretch">
        <h4 class="navbar-brand">CINPLEX</h4>

        <a href="#sidebar" class="toggle-sidebar ml-auto d-block d-md-none border-left" data-toggle="collapse">
            <i class="icon fas fa-arrow-left"></i>
        </a>
    </header>

    <nav id="sidebar-nav">
        <ul class="nav flex-column">
            <?php echo build_nav($nav); ?>
        </ul>
    </nav>
</aside>

<div id="content">
    <nav class="navbar navbar-light align-items-stretch">
        <a href="#sidebar" class="toggle-sidebar ml-auto d-block d-md-none border-left" data-toggle="collapse">
            <i class="icon fas fa-bars"></i>
        </a>
    </nav>

    <div class="container-fluid px-4">
        <header class="page-header row no-gutters py-4 border-bottom">
            <div class="col-12">
                <h6 class="text-center text-md-left"><?php echo $section; ?></h6>
                <h3 class="text-center text-md-left"><?php echo ucwords($page); ?></h3>
            </div>
        </header>
