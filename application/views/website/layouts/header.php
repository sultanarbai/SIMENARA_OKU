 <header class="header_area">
   <div class="main_menu">
     <nav class="navbar navbar-expand-lg navbar-light">
       <div class="container box_1620">
         <div class="navbar-brand logo_h">
           <img src="<?= temp('images/icons/LOGO OGAN KOMERING ULU.png') ?>" style="width: 40px;float:left;margin-top:-5px;margin-right: 5px">
           <h1 class="text-danger m-0 p-0" style="font-size: 30px"><a href="<?= site_url('') ?>">SimenaraOKU</a></h1>
         </div>

         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
         </button>

         <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
           <ul class="nav navbar-nav menu_nav justify-content-end">
             <li class="nav-item <?php if ($active == 'beranda') {
                                    echo 'active';
                                  } ?>"><a class="nav-link" href="<?= site_url(); ?>">Home</a></li>
             <li class="nav-item <?php if ($active == 'about') {
                                    echo 'active';
                                  } ?>"><a class="nav-link" href="<?= site_url('beranda/about') ?>">About</a></li>
             <li class="nav-item <?php if ($active == 'map' or $active == 'findmap') {
                                    echo 'active';
                                  } ?> submenu dropdown">
               <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Map</a>
               <ul class="dropdown-menu">
                 <li class="nav-item"><a class="nav-link" href="<?= site_url('beranda/map') ?>">Peta Menara</a>
                 <li class="nav-item"><a class="nav-link" href="<?= site_url('beranda/findmap') ?>">Cek Koordinat</a>
               </ul>
             </li>

             <li class="nav-item <?php if ($active == 'contact') {
                                    echo 'active';
                                  } ?>"><a class="nav-link" href="<?= site_url('beranda/contact') ?>">Contact</a></li>
           </ul>

           <div class="nav-right text-center text-lg-right py-4 py-lg-0">
             <a class="button" href="<?= site_url('admin_auth') ?>">Log In</a>
           </div>
         </div>
       </div>
     </nav>
   </div>
 </header>