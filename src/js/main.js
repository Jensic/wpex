/****************************************
            MAIN JAVASCRIPT CODE
*****************************************/

(function($) {
 
    "use strict";
     
    // javascript code here. i.e.: $(document).ready( function(){} );
    $(document).ready( function(){
        //console.log("It WORKS! YIPPIE!!");
        
        /****************************************
                        GMAP
        *****************************************/
        
        class GMap {
            constructor() {
                var self = this;
                $('.acf-map').each(function(){
                  self.new_map( $(this) );
                });

            } // end constructor

            new_map($el) {

                // var
                var $markers = $el.find('.marker');

                // vars
                var args = {
                  zoom    : 16,
                  center    : new google.maps.LatLng(0, 0),
                  mapTypeId : google.maps.MapTypeId.ROADMAP
                };

                // create map
                var map = new google.maps.Map($el[0], args);

                // add a markers reference
                map.markers = [];

                var that = this;

                // add markers
                $markers.each(function(){
                  that.add_marker($(this), map);
                });

                // center map
                this.center_map(map);

            } // end new_map

            add_marker($marker, map) {

                // var
                var latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));

                var marker = new google.maps.Marker({
                  position  : latlng,
                  map     : map
                });

                map.markers.push(marker);

                // if marker contains HTML, add it to an infoWindow
                if($marker.html()) {
                  // create info window
                  var infowindow = new google.maps.InfoWindow({
                    content   : $marker.html()
                  });

                  // show info window when marker is clicked
                  google.maps.event.addListener(marker, 'click', function() {

                    infowindow.open(map, marker);

                  });
                }

            } // end add_marker

            center_map(map) {

                // vars
                var bounds = new google.maps.LatLngBounds();

                // loop through all markers and create bounds
                $.each(map.markers, function(i, marker){

                  var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng());

                  bounds.extend(latlng);

                });

                // only 1 marker?
                if(map.markers.length == 1) {
                  // set center of map
                    map.setCenter(bounds.getCenter());
                    map.setZoom( 16 );
                } else {
                  // fit to bounds
                  map.fitBounds(bounds);
                }

            } // end center_map
        }
        var googleMap = new GMap();
        
        /****************************************
                        SEARCH
        *****************************************/
        

        class Search {
            // 1. describe and create/initiate our object
            // this.name = "Jane";
            constructor() {
                this.addSearchHTML();
                this.resultsDiv     = $("#search-overlay__results");
                this.openButton     = $(".js-search-trigger");
                this.closeButton    = $('.search-overlay__close');
                this.searchOverlay  = $(".search-overlay");
                this.searchField    = $("#search-term");
                this.events();
                this.isOverlayOpen = false;
                this.isSpinnerVisible = false;
                this.previousValue;
                this.typingTimer; 
            }
            // 2. events
            // on this.head feels cold, wearsHat
            events() {
                this.openButton.on("click", this.openOverlay.bind(this));
                this.closeButton.on("click", this.closeOverlay.bind(this));
                $(document).on("keydown", this.keyPressDispatcher.bind(this));
                this.searchField.on("keyup", this.typingLogic.bind(this));
            }

            // 3. methods (function, action....)
            // wearsHat() {}
            typingLogic() {
                //alert("Hi!");
                if(this.searchField.val() != this.previousValue) {
                    clearTimeout(this.typingTimer);

                    if(this.searchField.val()) {
                        if (!this.isSpinnerVisible) {
                            this.resultsDiv.html('<div class="spinner-loader"></div>');
                            this.isSpinnerVisible = true;
                        }
                        this.typingTimer = setTimeout(this.getResults.bind(this), 750);
                    } else {
                        this.resultsDiv.html('');
                        this.isSpinnerVisible = false;        
                    }
                }
                this.previousValue = this.searchField.val();
            }

            getResults() {

                $.when(
                    $.getJSON(exData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val()),
                    $.getJSON(exData.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val())
                    ).then((posts, pages) => {
                    var combineResults = posts[0].concat(pages[0]);
                    this.resultsDiv.html(`
                        <h2 class="search-overlay_section-title">General Information</h2>
                        ${combineResults.length ? '<ul class="link-list min-list">' : '<p>No general information matches that search.</p>'}
                           ${combineResults.map(item => `<li><a href="${item.link}">${item.title.rendered}</a> ${item.type == 'post' ? `by ${item.authorName}` : ''} </li>`).join('')} 
                        ${combineResults.length ? '</ul>' : ''}
                    `);
                    this.isSpinnerVisible = false;
                }, () => {
                    this.resultsDiv.html('<p>Unexpected error; please try again.</p>');
                });
            }

            keyPressDispatcher(e) {
                // console.log(e.keyCode);

                if(e.keyCode == 83 && !this.isOverlayOpen && !$("input, textarea").is(':focus')) {
                    this.openOverlay();
                }

                if(e.keyCode == 27 && this.isOverlayOpen) {
                    this.closeOverlay();
                }
            }

            openOverlay() {
                this.searchOverlay.addClass("search-overlay--active");
                $("body").addClass("body-no-scroll");
                this.searchField.val('');
                setTimeout(() => this.searchField.focus(), 301);
                console.log("our open method just ran");
                this.isOverlayOpen = true;
            }

            closeOverlay() {
                this.searchOverlay.removeClass("search-overlay--active");
                $("body").removeClass("body-no-scroll");
                console.log("our close method jusr ran");
                this.isOverlayOpen = false;
            }

            addSearchHTML() {
                $("body").append(`
                <div class="search-overlay">
                    <div classs="search-overlay__top">
                        <div class="container">
                            <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
                            <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term">
                            <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="container">
                        <div id="search-overlay__results"></div>
                    </div>
              </div>
                `);
            }
        }
        
        var search = new Search();
        
        /****************************************
                        
        *****************************************/
        
    });
 
})(jQuery);