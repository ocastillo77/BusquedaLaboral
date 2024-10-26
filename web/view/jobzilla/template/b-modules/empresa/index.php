<!-- CONTENT START -->
<div class="page-content">
  <?php
  if ($data['isMobile']) {
    include 'mod-banner-mobile.php';
  } else {
    include 'mod-banner.php';
  }

  include 'mod-jobs.php';
  include 'mod-adsense1.php';
  include 'mod-adsense2.php';
  include 'mod-plans.php';
  ?>
</div>
<!-- CONTENT END -->