<?php
$info = $data[$data['tabla']];
$url_image = !empty($info['Imagen']) ? URL_GAL . 'secciones/images/IM_' . $info['Imagen'] : '';
$url_video = !empty($info['Video']) ? $info['Video'] : '';
$detalle = strip_tags($info['Detalle']);
$is_active = false;
$active = '';
?>
<!-- OUR BLOG START -->
<div class="section-full  p-t120 p-b90 bg-white">
  <div class="container">
    <!-- BLOG SECTION START -->
    <div class="section-content p-t90">
      <?php
      if (!empty($info['Titulo'])) :
        ?>
        <div class="row d-flex justify-content-center">
          <div class="col-lg-12 col-md-12">
            <!-- BLOG START -->
            <div class="blog-post-single-outer">
              <div class="blog-post-single bg-white">                                    
                <div class="wt-post-info">
                  <?php if (!empty($url_image)) : ?>
                    <div class="wt-post-media m-b30">
                      <img src="<?php echo $url_image; ?>" alt="<?php echo $info['Titulo']; ?>">
                    </div>
                  <?php endif; ?>
                  <div class="wt-post-title ">
                    <h3 class="post-title"><?php echo $info['Titulo']; ?></h3>
                  </div>
                  <div class="wt-post-discription">
                    <?php echo $info['Detalle']; ?>                  
                  </div> 
                </div>
              </div>
              <div class="post-area-tags-wrap">
                <div class="post-social-icons-wrap">
                  <h4 class="mb-4">Compartir</h4>
                  <div class="addthis_inline_share_toolbox text-center"></div>
                </div>
              </div>
            </div>                             
          </div>
        </div>
        <?php
      endif;
      ?>
    </div>
  </div>
</div>   
<!-- OUR BLOG END --> 
