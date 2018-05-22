<section class="menu cid-qLmU5TmGwq" once="menu" id="menu2-6">
    <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm">
        <button class="navbar-toggler navbar-toggler-right" 
                type="button" 
                data-toggle="collapse" 
                data-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" 
                aria-expanded="false" 
                aria-label="Toggle navigation">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        <div class="menu-logo">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="index.php">
                        <img src="assets/images/logo-teambuilder-blanco-2-1670x1184.png" alt="teambuilder" title="" style="height: 3.8rem;">
                    </a>
                </span>
                
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
              <li class="nav-item">
                <a class="nav-link link text-white display-4" href="index.php">
                  PANEL DE ADMINISTRACÍON
                </a>
              </li>
            </ul>
            <?php if(!$logged) { ?>
            <div class="navbar-buttons mbr-section-btn">
              <a class="btn btn-sm btn-white-outline display-4" href="#" id="acceso">
                <span class="mbri-cursor-click mbr-iconfont mbr-iconfont-btn"></span>
                ACCESO
              </a>
            </div>
            <?php } else { ?>
            <div class="navbar-buttons mbr-section-btn">
              <a class="btn btn-sm btn-white-outline display-4" href="../includes/process_login.php?action=logout">
                <span class="mbri-cursor-click mbr-iconfont mbr-iconfont-btn"></span>
                SALIR
              </a>
            </div>
            <?php } ?>
            <div class="navbar-buttons mbr-section-btn">
              <a class="btn btn-sm btn-white-outline display-4" href="../includes/process_login.php?action=logout">
                <span class="mbri-cursor-click mbr-iconfont mbr-iconfont-btn"></span>
                SALIR
              </a>
            </div>
        </div>
    </nav>


    <!-- Modal -->
    <div id="myModal" class="modal" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Acceso</h4>
          </div>
          <div class="modal-body">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <div class="panel panel-login">
                    <div class="panel-heading">
                      <div class="row">
                        <div class="col-md-6">
                          <a href="#" class="active" id="login-form-link">Iniciar sesión</a>
                        </div>
                      </div>
                      <hr>
                    </div>
                    <div class="panel-body">
                      <div class="row">
                        <div class="col-lg-12">
                          <form id="login-form" action="includes/process_login.php" method="post" role="form" style="display: block;">
                            <input type="hidden" name="action" value="login">
                            <div class="form-group">
                              <input type="text" name="emailUsuario" id="emailUsuario" tabindex="1" class="form-control" placeholder="Email" value="">
                            </div>
                            <div class="form-group">
                              <input type="password" name="passwordUsuario" id="passwordUsuario" tabindex="2" class="form-control" placeholder="Contraseña">
                            </div>
                            <div class="form-group">
                              <div class="row">

                                <input type="submit" name="login-submit" id="login-submit" tabindex="3" class="form-control btn btn-login" value="Iniciar sesión">

                              </div>
                            </div>
                          </form>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
</section>