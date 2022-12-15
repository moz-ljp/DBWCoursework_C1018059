<?php
include("navbar.php");

?>

<div class="container pb-5">
    <main role="main" class="pb-3">
        <h2>Our Gym Location</h2><br>
        
        <div class="row">
            <div class="col-sm-12">
            <div id="googleMap" style="width:100%;height:600px;"></div>

            <script>
            function myMap() {
            var mapProp= {
              center:new google.maps.LatLng(53.375817683486666, -1.47367240162685),
              zoom:15,
            };
            
            var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
            var marker = new google.maps.Marker({position: new google.maps.LatLng(53.375817683486666, -1.47367240162685)});
            marker.setMap(map); 
            }
            </script>
            </div>
        </div>

        <p>We are located on the Moor!</p>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWzy9hiftr4jPJeWYHVR6n6rvqMcE3TJ8&callback=myMap"></script>

        <a href="index.php" class="btn btn-warning">< Go Back</a>

    </main>
</div>


<?php
    include("footer.php");
    ?>