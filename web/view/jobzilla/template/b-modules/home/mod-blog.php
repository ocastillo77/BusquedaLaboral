<!-- BLOG SECTION START -->
<?php if (isset($data['lastposts']) && count($data['lastposts']) > 0) : ?>
  <div class="blog-section-2 pt-60 pb-30">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-title text-left mb-40">
            <h2 class="uppercase">Noticias</h2>
          </div>
        </div>
      </div>
      <div class="blog">
        <div class="row active-blog-2">
          <?php
          foreach ($data['lastposts'] as $item) :
            $image = URL_GAL . 'posts/images/IM_' . $item['Imagen'];
            $url = URL_WEB . 'posts/' . $item['ID'] . '/' . $item['URL'];
            ?>
            <!-- blog-item start -->
            <div class="col-xs-12">
              <div class="blog-item-2">
                <div class="row">
                  <div class="col-md-6 col-xs-12">
                    <div class="blog-image">
                      <a href="<?php echo $url; ?>">
                        <img src="<?php echo $image; ?>" alt="<?php echo $item['Titulo']; ?>">
                      </a>
                    </div>
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <div class="blog-desc">
                      <h5 class="blog-title-2"><a href="<?php echo $url; ?>"><?php echo $item['Titulo']; ?></a></h5>
                      <p><?php echo $item['Sumario']; ?></p>
                      <div class="read-more">
                        <a href="<?php echo $url; ?>">Leer más</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- blog-item end -->
            <?php
          endforeach;
          ?>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
<!-- BLOG SECTION END -->   