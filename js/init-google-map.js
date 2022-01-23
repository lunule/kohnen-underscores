jQuery(document).ready(function($){

  /**
   * initMap
   *
   * Renders a Google Map onto the selected jQuery element
   *
   * @date    22/10/19
   * @since   5.8.6
   *
   * @param   jQuery $el The jQuery element.
   * @return  object The map instance.
   */
  function initMap( $el ) {

      // Find marker elements within map.
      var $markers = $el.find('.contact__styled-pin');

      const styledMapType = new google.maps.StyledMapType(
          [
              {
                featureType: "water",
                elementType: "geometry",
                stylers: [
                  {
                    color: "#e9e9e9",
                  },
                  {
                    lightness: 17,
                  },
                ],
              },
              {
                featureType: "landscape",
                elementType: "geometry",
                stylers: [
                  {
                    color: "#f5f5f5",
                  },
                  {
                    lightness: 20,
                  },
                ],
              },
              {
                featureType: "road.highway",
                elementType: "geometry.fill",
                stylers: [
                  {
                    color: "#ffffff",
                  },
                  {
                    lightness: 17,
                  },
                ],
              },
              {
                featureType: "road.highway",
                elementType: "geometry.stroke",
                stylers: [
                  {
                    color: "#ffffff",
                  },
                  {
                    lightness: 29,
                  },
                  {
                    weight: 0.2,
                  },
                ],
              },
              {
                featureType: "road.arterial",
                elementType: "geometry",
                stylers: [
                  {
                    color: "#ffffff",
                  },
                  {
                    lightness: 18,
                  },
                ],
              },
              {
                featureType: "road.local",
                elementType: "geometry",
                stylers: [
                  {
                    color: "#ffffff",
                  },
                  {
                    lightness: 16,
                  },
                ],
              },
              {
                featureType: "poi",
                elementType: "geometry",
                stylers: [
                  {
                    color: "#f5f5f5",
                  },
                  {
                    lightness: 21,
                  },
                ],
              },
              {
                featureType: "poi.park",
                elementType: "geometry",
                stylers: [
                  {
                    color: "#dedede",
                  },
                  {
                    lightness: 21,
                  },
                ],
              },
              {
                elementType: "labels.text.stroke",
                stylers: [
                  {
                    visibility: "on",
                  },
                  {
                    color: "#ffffff",
                  },
                  {
                    lightness: 16,
                  },
                ],
              },
              {
                elementType: "labels.text.fill",
                stylers: [
                  {
                    saturation: 36,
                  },
                  {
                    color: "#333333",
                  },
                  {
                    lightness: 40,
                  },
                ],
              },
              {
                elementType: "labels.icon",
                stylers: [
                  {
                    visibility: "off",
                  },
                ],
              },
              {
                featureType: "transit",
                elementType: "geometry",
                stylers: [
                  {
                    color: "#f2f2f2",
                  },
                  {
                    lightness: 19,
                  },
                ],
              },
              {
                featureType: "administrative",
                elementType: "geometry.fill",
                stylers: [
                  {
                    color: "#fefefe",
                  },
                  {
                    lightness: 20,
                  },
                ],
              },
              {
                featureType: "administrative",
                elementType: "geometry.stroke",
                stylers: [
                  {
                    color: "#fefefe",
                  },
                  {
                    lightness: 17,
                  },
                  {
                    weight: 1.2,
                  },
                ],
              },
            ]        
        ,
        { name: "Styled Map" }
      );

      // Create gerenic map.
      var mapArgs = {
          zoom        : $el.data('zoom') || 16,
          mapTypeId   : google.maps.MapTypeId.ROADMAP,
          mapTypeControlOptions: {
            mapTypeIds: ["roadmap", "satellite", "hybrid", "terrain", "styled_map"],
          },          
      };
      var map = new google.maps.Map( $el[0], mapArgs );

      map.mapTypes.set("styled_map", styledMapType);
      map.setMapTypeId("styled_map");      

      // Add markers.
      map.markers = [];
      $markers.each(function(){
          initMarker( $(this), map );
      });

      // Center map based on markers.
      centerMap( map );

      // Return map instance.
      return map;
  }

  /**
   * initMarker
   *
   * Creates a marker for the given jQuery element and map.
   *
   * @date    22/10/19
   * @since   5.8.6
   *
   * @param   jQuery $el The jQuery element.
   * @param   object The map instance.
   * @return  object The marker instance.
   */
  function initMarker( $marker, map ) {

      // Get position from marker.
      var lat = $marker.data('lat');
      var lng = $marker.data('lng');
      var latLng = {
          lat: parseFloat( lat ),
          lng: parseFloat( lng )
      };

      // Create marker instance.
      var marker = new google.maps.Marker({
          position : latLng,
          map: map,
          icon: {
            url: kohnen.siteurl + '/wp-content/themes/kohnen-underscores/img/marker.svg',
            scaledSize: new google.maps.Size(20, 20)
          }
      });

      // Append to reference for later use.
      map.markers.push( marker );

      // If marker contains HTML, add it to an infoWindow.
      if( $marker.html() ){

          // Create info window.
          /*var infowindow = new google.maps.InfoWindow({
              content: $marker.html()
          });*/

          // Show info window when marker is clicked.
          /*google.maps.event.addListener(marker, 'click', function() {
              infowindow.open( map, marker );
          });*/
      }
  }

  /**
   * centerMap
   *
   * Centers the map showing all markers in view.
   *
   * @date    22/10/19
   * @since   5.8.6
   *
   * @param   object The map instance.
   * @return  void
   */
  function centerMap( map ) {

      // Create map boundaries from all map markers.
      var bounds = new google.maps.LatLngBounds();
      map.markers.forEach(function( marker ){
          bounds.extend({
              lat: marker.position.lat(),
              lng: marker.position.lng()
          });
      });

      // Case: Single marker.
      if( map.markers.length == 1 ){
          map.setCenter( bounds.getCenter() );

      // Case: Multiple markers.
      } else{
          map.fitBounds( bounds );
      }
  }

  // Render maps on page load.
  $(document).ready(function(){
      $('.contact__google-map').each(function(){
          var map = initMap( $(this) );
      });
  });

});