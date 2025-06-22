<main id="main" class="main">

<div class="pagetitle">
  <h1>Kategori</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item">Kategori</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Kategori</h5>
            <ul>
                <?php
                    foreach($kat as $key => $value)
                    {
                ?>
                    <li><a href="/kategori/<?php echo $key?>"><?php echo $value?></a></li>
                <?php
                    }
                ?>
            </ul>
        </div>
      </div>

    </div>
  </div>
</section>

</main><!-- End #main -->