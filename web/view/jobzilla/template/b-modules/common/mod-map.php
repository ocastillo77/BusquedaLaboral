<!-- Contact Me -->
<section class="section-padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 section-title text-left mb-4">
        <h2>Nuestra Ubicación</h2>
      </div>
      <div class="col-lg-12 col-md-12">
        <div class="card">
          <div class="card-body">
            <div id="map"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Contact Me -->
<script>
  function initMap() {
    var mendoza = {
      lat: -32.906311,
      lng: -68.8757114
    };
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
      center: mendoza
    });

    var image = '<?php echo URL_IMG; ?>marker.png';
    var marker = new google.maps.Marker({
      position: mendoza,
      map: map,
      icon: image
    });
  }
</script>