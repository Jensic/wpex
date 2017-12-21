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
                
                $.getJSON(exData.root_url + '/wp-json/ex/v1/search?term=' + this.searchField.val(), (results) => {
                    this.resultsDiv.html(`
                    <div class="row">
                        <div class="one-third">
                            <h2 class="search-overlay_section-title">General Information</h2>
                            ${results.generalInfo.length ? '<ul class="link-list min-list">' : '<p>No general information matches that search.</p>'}
                            ${results.generalInfo.map(item => `<li><a href="${item.permalink}">${item.title}</a> ${item.postType == 'post' ? `by ${item.authorName}` : ''} </li>`).join('')} 
                            ${results.generalInfo.length ? '</ul>' : ''}
                        </div>
                        <div class="one-third">
                            <h2 class="search-overlay_section-title">Companies</h2>
                            ${results.companies.length ? '<ul class="link-list min-list">' : `<p>No company match that search.<a href="${exData.root_url}/companies">View all companies</a></p>`}
                            ${results.companies.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')} 
                            ${results.companies.length ? '</ul>' : ''}

                            <h2 class="search-overlay_section-title">Persons</h2>
                            ${results.persons.length ? '<ul class="professor-cards">' : '<p>No person match that search.</p>'}
                            ${results.persons.map(item => `
                            <li class="professor-card__list-item">
                                <a class="professor-card" href="${item.permalink}">
                                    <img class="professor-card__image" src="${item.image}" alt="">
                                    <span class="professor-card__name">${item.title}</span>
                                </a>
                            </li>
                            `).join('')} 
                            ${results.persons.length ? '</ul>' : ''}
                        </div>
                        <div class="one-third">
                            <h2 class="search-overlay_section-title">Arounds</h2>
                            ${results.arounds.length ? '<ul class="link-list min-list">' : `<p>No arounds match that search.<a href="${exData.root_url}/arounds">View all arounds</a></p>`}
                            ${results.arounds.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')} 
                            ${results.arounds.length ? '</ul>' : ''}

                            <h2 class="search-overlay_section-title">Events</h2>
                            ${results.events.length ? '' : `<p>No events match that search.<a href="${exData.root_url}/events">View all events</a></p>`}
                            ${results.events.map(item => `
                            <div class="event-summary">
                                <a class="event-summary__date t-center" href="${item.permalink}">
                                    <span class="event-summary__month">${item.month}</span>
                                    <span class="event-summary__day">${item.day}</span>  
                                </a>
                                <div class="event-summary__content">
                                    <h5 class="event-summary__title headline headline--tiny"><a href="${item.permalink}">${item.title}</a></h5>
                                    <p>${item.description}<a href="${item.permalink}" class="nu gray">Learn more</a></p>
                                </div>
                            </div>
                            `).join('')}
                        </div>
                    </div
                    `);
                    this.isSpinnerVisible = false;
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
        
        /****************************************
                        NOTES
        *****************************************/
        
        class MyNotes {
            constructor() {
                this.events();
            }

            events() {
                $("#my-notes").on("click", ".delete-note", this.deleteNote);
                $("#my-notes").on("click", ".edit-note", this.editNote.bind(this));
                $("#my-notes").on("click", ".update-note", this.updateNote.bind(this));
                $(".submit-note").on("click", this.createNote.bind(this));
            }

            //Methods will go here
            editNote(e) {
                var thisNote = $(e.target).parents("li");
                if(thisNote.data("state") == "editable") {
                    this.makeNotReadOnly(thisNote);
                } else {
                    this.makeNoteEditable(thisNote);
                }
            }

            makeNoteEditable(thisNote) {
                thisNote.find(".edit-note").html('<i class="fa fa-times" aria-hidden="true"></i> Cancel');
                thisNote.find(".note-title-field, .note-body-field").removeAttr("readonly").addClass("note-active-field");
                thisNote.find(".update-note").addClass("update-note--visible");
                thisNote.data("state", "editable");
            }

            makeNotReadOnly(thisNote) {
                thisNote.find(".edit-note").html('<i class="fa fa-pencil" aria-hidden="true"></i> Edit');
                thisNote.find(".note-title-field, .note-body-field").attr("readonly", "readonly").removeClass("note-active-field");
                thisNote.find(".update-note").removeClass("update-note--visible");
                thisNote.data("state", "cancel");
            }

            deleteNote(e) {
                var thisNote = $(e.target).parents("li");

                $.ajax({
                    beforeSend: (xhr) => {
                        xhr.setRequestHeader('X-WP-Nonce', exData.nonce);
                    },
                    url: exData.root_url + '/wp-json/wp/v2/note/' + thisNote.data('id'),
                    type: 'DELETE',
                    success: (response) => {
                        thisNote.slideUp();
                        console.log("Congrats");
                        console.log(response);
                        if(response.userNoteCount < 5) {
                            $(".note-limit-message").removeClass("active");
                        }
                    },
                    error: (response) => {
                        console.log("Sorry");
                        console.log(response);
                    }        
                });
            }

            updateNote(e) {
                var thisNote = $(e.target).parents("li");

                var ourUpdatedPost = {
                    'title': thisNote.find(".note-title-field").val(),
                    'content':  thisNote.find(".note-body-field").val()
                }

                $.ajax({
                    beforeSend: (xhr) => {
                        xhr.setRequestHeader('X-WP-Nonce', exData.nonce);
                    },
                    url: exData.root_url + '/wp-json/wp/v2/note/' + thisNote.data('id'),
                    type: 'POST',
                    data: ourUpdatedPost,
                    success: (response) => {
                        this.makeNotReadOnly(thisNote);
                        console.log("Congrats");
                        console.log(response);
                    },
                    error: (response) => {
                        console.log("Sorry");
                        console.log(response);
                    }        
                });
            }

            createNote() {
                var ourNewPost = {
                    'title': $(".new-note-title").val(),
                    'content': $(".new-note-body").val(),
                    'status': 'private'
                }

                $.ajax({
                    beforeSend: (xhr) => {
                        xhr.setRequestHeader('X-WP-Nonce', exData.nonce);
                    },
                    url: exData.root_url + '/wp-json/wp/v2/note/',
                    type: 'POST',
                    data: ourNewPost,
                    success: (response) => {
                        $(".new-note-title, .new-note-body").val('');
                        $(`
                        <li data-id="${response.id}">
                            <input readonly class="note-title-field" value="${response.title.raw}">
                            <span class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span>
                            <span class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span>
                            <textarea readonly class="note-body-field">${response.content.raw}</textarea>
                            <span class="update-note btn btn--blue btn--small"><i class="fa fa-arrow-right" aria-hidden="true"></i>Save</span>
                        </li>
                        `).prependTo("#my-notes").hide().slideDown();

                        console.log("Congrats");
                        console.log(response);
                    },
                    error: (response) => {
                        if(response.responseText == "You have reached youre note limit.") {
                            $(".note-limit-message").addClass("active");
                        }
                        console.log("Sorry");
                        console.log(response);
                    }        
                });
            }
        }
        
        var mynotes = new MyNotes();
        
        /****************************************
                        
        *****************************************/
        
    });
 
})(jQuery);