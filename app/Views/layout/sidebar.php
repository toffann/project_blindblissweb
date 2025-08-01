 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

   <ul class="sidebar-nav" id="sidebar-nav">

     <li class="nav-item">
       <a class="nav-link <?php echo (uri_string() == '') ? "" : "collapsed" ?>" href="/">
         <i class="bi bi-house-door"></i>
         <span>Home</span>
       </a>
     </li><!-- End Home Nav -->

     <li class="nav-item">
       <a class="nav-link <?php echo (uri_string() == 'keranjang') ? "" : "collapsed" ?>" href="keranjang">
         <i class="bi bi-cart4"></i>
         <span>Keranjang</span>
       </a>

     </li><!-- Kategori Nav -->
     <?php
      if (session()->get('role') == 'admin') {
      ?>

       <li class="nav-item">
         <a class="nav-link <?php echo (uri_string() == 'produk') ? "" : "collapsed" ?>" href="produk">
           <i class="bi bi-tag-fill"></i>
           <span>Produk</span>
         </a>
       </li><!-- End Produk Nav -->
     <?php
      }
      ?>
     <li class="nav-item">
       <a class="nav-link <?php echo (uri_string() == 'history') ? "" : "collapsed" ?>" href="history">
         <i class="bi bi-person"></i>
         <span>History</span>
       </a>
     </li><!-- End Profile Nav -->
     
     <li class="nav-item">
      <a class="nav-link <?= uri_string() == 'faq' ? '' : 'collapsed' ?>" href="<?= base_url('faq') ?>">
        <i class="bi bi-question-circle"></i> <span>F.A.Q</span>
      </a>
    </li> <!-- End F.A.Q Nav -->

   </ul>

 </aside>
 <!-- End Sidebar-->