"use strict";function _classCallCheck(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}var _createClass=function(){function e(e,t){for(var n=0;n<t.length;n++){var a=t[n];a.enumerable=a.enumerable||!1,a.configurable=!0,"value"in a&&(a.writable=!0),Object.defineProperty(e,a.key,a)}}return function(t,n,a){return n&&e(t.prototype,n),a&&e(t,a),t}}();!function(e){e(document).ready(function(){new(function(){function t(){_classCallCheck(this,t);var n=this;e(".acf-map").each(function(){n.new_map(e(this))})}return _createClass(t,[{key:"new_map",value:function(t){var n=t.find(".marker"),a={zoom:16,center:new google.maps.LatLng(0,0),mapTypeId:google.maps.MapTypeId.ROADMAP},s=new google.maps.Map(t[0],a);s.markers=[];var i=this;n.each(function(){i.add_marker(e(this),s)}),this.center_map(s)}},{key:"add_marker",value:function(e,t){var n=new google.maps.LatLng(e.attr("data-lat"),e.attr("data-lng")),a=new google.maps.Marker({position:n,map:t});if(t.markers.push(a),e.html()){var s=new google.maps.InfoWindow({content:e.html()});google.maps.event.addListener(a,"click",function(){s.open(t,a)})}}},{key:"center_map",value:function(t){var n=new google.maps.LatLngBounds;e.each(t.markers,function(e,t){var a=new google.maps.LatLng(t.position.lat(),t.position.lng());n.extend(a)}),1==t.markers.length?(t.setCenter(n.getCenter()),t.setZoom(16)):t.fitBounds(n)}}]),t}()),new(function(){function t(){_classCallCheck(this,t),this.addSearchHTML(),this.resultsDiv=e("#search-overlay__results"),this.openButton=e(".js-search-trigger"),this.closeButton=e(".search-overlay__close"),this.searchOverlay=e(".search-overlay"),this.searchField=e("#search-term"),this.events(),this.isOverlayOpen=!1,this.isSpinnerVisible=!1,this.previousValue,this.typingTimer}return _createClass(t,[{key:"events",value:function(){this.openButton.on("click",this.openOverlay.bind(this)),this.closeButton.on("click",this.closeOverlay.bind(this)),e(document).on("keydown",this.keyPressDispatcher.bind(this)),this.searchField.on("keyup",this.typingLogic.bind(this))}},{key:"typingLogic",value:function(){this.searchField.val()!=this.previousValue&&(clearTimeout(this.typingTimer),this.searchField.val()?(this.isSpinnerVisible||(this.resultsDiv.html('<div class="spinner-loader"></div>'),this.isSpinnerVisible=!0),this.typingTimer=setTimeout(this.getResults.bind(this),750)):(this.resultsDiv.html(""),this.isSpinnerVisible=!1)),this.previousValue=this.searchField.val()}},{key:"getResults",value:function(){var t=this;e.getJSON(exData.root_url+"/wp-json/ex/v1/search?term="+this.searchField.val(),function(e){t.resultsDiv.html('\n                    <div class="row">\n                        <div class="one-third">\n                            <h2 class="search-overlay_section-title">General Information</h2>\n                            '+(e.generalInfo.length?'<ul class="link-list min-list">':"<p>No general information matches that search.</p>")+"\n                            "+e.generalInfo.map(function(e){return'<li><a href="'+e.permalink+'">'+e.title+"</a> "+("post"==e.postType?"by "+e.authorName:"")+" </li>"}).join("")+" \n                            "+(e.generalInfo.length?"</ul>":"")+'\n                        </div>\n                        <div class="one-third">\n                            <h2 class="search-overlay_section-title">Companies</h2>\n                            '+(e.companies.length?'<ul class="link-list min-list">':'<p>No company match that search.<a href="'+exData.root_url+'/companies">View all companies</a></p>')+"\n                            "+e.companies.map(function(e){return'<li><a href="'+e.permalink+'">'+e.title+"</a></li>"}).join("")+" \n                            "+(e.companies.length?"</ul>":"")+'\n\n                            <h2 class="search-overlay_section-title">Persons</h2>\n                            '+(e.persons.length?'<ul class="professor-cards">':"<p>No person match that search.</p>")+"\n                            "+e.persons.map(function(e){return'\n                            <li class="professor-card__list-item">\n                                <a class="professor-card" href="'+e.permalink+'">\n                                    <img class="professor-card__image" src="'+e.image+'" alt="">\n                                    <span class="professor-card__name">'+e.title+"</span>\n                                </a>\n                            </li>\n                            "}).join("")+" \n                            "+(e.persons.length?"</ul>":"")+'\n                        </div>\n                        <div class="one-third">\n                            <h2 class="search-overlay_section-title">Arounds</h2>\n                            '+(e.arounds.length?'<ul class="link-list min-list">':'<p>No arounds match that search.<a href="'+exData.root_url+'/arounds">View all arounds</a></p>')+"\n                            "+e.arounds.map(function(e){return'<li><a href="'+e.permalink+'">'+e.title+"</a></li>"}).join("")+" \n                            "+(e.arounds.length?"</ul>":"")+'\n\n                            <h2 class="search-overlay_section-title">Events</h2>\n                            '+(e.events.length?"":'<p>No events match that search.<a href="'+exData.root_url+'/events">View all events</a></p>')+"\n                            "+e.events.map(function(e){return'\n                            <div class="event-summary">\n                                <a class="event-summary__date t-center" href="'+e.permalink+'">\n                                    <span class="event-summary__month">'+e.month+'</span>\n                                    <span class="event-summary__day">'+e.day+'</span>  \n                                </a>\n                                <div class="event-summary__content">\n                                    <h5 class="event-summary__title headline headline--tiny"><a href="'+e.permalink+'">'+e.title+"</a></h5>\n                                    <p>"+e.description+'<a href="'+e.permalink+'" class="nu gray">Learn more</a></p>\n                                </div>\n                            </div>\n                            '}).join("")+"\n                        </div>\n                    </div\n                    "),t.isSpinnerVisible=!1})}},{key:"keyPressDispatcher",value:function(t){83!=t.keyCode||this.isOverlayOpen||e("input, textarea").is(":focus")||this.openOverlay(),27==t.keyCode&&this.isOverlayOpen&&this.closeOverlay()}},{key:"openOverlay",value:function(){var t=this;this.searchOverlay.addClass("search-overlay--active"),e("body").addClass("body-no-scroll"),this.searchField.val(""),setTimeout(function(){return t.searchField.focus()},301),console.log("our open method just ran"),this.isOverlayOpen=!0}},{key:"closeOverlay",value:function(){this.searchOverlay.removeClass("search-overlay--active"),e("body").removeClass("body-no-scroll"),console.log("our close method jusr ran"),this.isOverlayOpen=!1}},{key:"addSearchHTML",value:function(){e("body").append('\n                <div class="search-overlay">\n                    <div classs="search-overlay__top">\n                        <div class="container">\n                            <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>\n                            <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term">\n                            <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>\n                        </div>\n                    </div>\n                    <div class="container">\n                        <div id="search-overlay__results"></div>\n                    </div>\n              </div>\n                ')}}]),t}()),new(function(){function t(){_classCallCheck(this,t),this.events()}return _createClass(t,[{key:"events",value:function(){e("#my-notes").on("click",".delete-note",this.deleteNote),e("#my-notes").on("click",".edit-note",this.editNote.bind(this)),e("#my-notes").on("click",".update-note",this.updateNote.bind(this)),e(".submit-note").on("click",this.createNote.bind(this))}},{key:"editNote",value:function(t){var n=e(t.target).parents("li");"editable"==n.data("state")?this.makeNotReadOnly(n):this.makeNoteEditable(n)}},{key:"makeNoteEditable",value:function(e){e.find(".edit-note").html('<i class="fa fa-times" aria-hidden="true"></i> Cancel'),e.find(".note-title-field, .note-body-field").removeAttr("readonly").addClass("note-active-field"),e.find(".update-note").addClass("update-note--visible"),e.data("state","editable")}},{key:"makeNotReadOnly",value:function(e){e.find(".edit-note").html('<i class="fa fa-pencil" aria-hidden="true"></i> Edit'),e.find(".note-title-field, .note-body-field").attr("readonly","readonly").removeClass("note-active-field"),e.find(".update-note").removeClass("update-note--visible"),e.data("state","cancel")}},{key:"deleteNote",value:function(t){var n=e(t.target).parents("li");e.ajax({beforeSend:function(e){e.setRequestHeader("X-WP-Nonce",exData.nonce)},url:exData.root_url+"/wp-json/wp/v2/note/"+n.data("id"),type:"DELETE",success:function(t){n.slideUp(),console.log("Congrats"),console.log(t),t.userNoteCount<5&&e(".note-limit-message").removeClass("active")},error:function(e){console.log("Sorry"),console.log(e)}})}},{key:"updateNote",value:function(t){var n=this,a=e(t.target).parents("li"),s={title:a.find(".note-title-field").val(),content:a.find(".note-body-field").val()};e.ajax({beforeSend:function(e){e.setRequestHeader("X-WP-Nonce",exData.nonce)},url:exData.root_url+"/wp-json/wp/v2/note/"+a.data("id"),type:"POST",data:s,success:function(e){n.makeNotReadOnly(a),console.log("Congrats"),console.log(e)},error:function(e){console.log("Sorry"),console.log(e)}})}},{key:"createNote",value:function(){var t={title:e(".new-note-title").val(),content:e(".new-note-body").val(),status:"private"};e.ajax({beforeSend:function(e){e.setRequestHeader("X-WP-Nonce",exData.nonce)},url:exData.root_url+"/wp-json/wp/v2/note/",type:"POST",data:t,success:function(t){e(".new-note-title, .new-note-body").val(""),e('\n                        <li data-id="'+t.id+'">\n                            <input readonly class="note-title-field" value="'+t.title.raw+'">\n                            <span class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span>\n                            <span class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span>\n                            <textarea readonly class="note-body-field">'+t.content.raw+'</textarea>\n                            <span class="update-note btn btn--blue btn--small"><i class="fa fa-arrow-right" aria-hidden="true"></i>Save</span>\n                        </li>\n                        ').prependTo("#my-notes").hide().slideDown(),console.log("Congrats"),console.log(t)},error:function(t){"You have reached youre note limit."==t.responseText&&e(".note-limit-message").addClass("active"),console.log("Sorry"),console.log(t)}})}}]),t}()),new(function(){function t(){_classCallCheck(this,t),this.events()}return _createClass(t,[{key:"events",value:function(){e(".like-box").on("click",this.ourClickDispatcher.bind(this))}},{key:"ourClickDispatcher",value:function(t){var n=e(t.target).closest(".like-box");"yes"==e(n).attr("data-exists")?this.deleteLike(n):this.creatLike(n)}},{key:"creatLike",value:function(t){e.ajax({beforeSend:function(e){e.setRequestHeader("X-WP-Nonce",exData.nonce)},url:exData.root_url+"/wp-json/ex/v1/manageLike",type:"POST",data:{eventId:t.data("event")},success:function(e){t.attr("data-exists","yes");var n=parseInt(t.find(".like-count").html(),10);n++,t.find(".like-count").html(n),t.attr("data-like",e),console.log(e)},error:function(e){console.log(e)}})}},{key:"deleteLike",value:function(t){e.ajax({beforeSend:function(e){e.setRequestHeader("X-WP-Nonce",exData.nonce)},url:exData.root_url+"/wp-json/ex/v1/manageLike",data:{like:t.attr("data-like")},type:"DELETE",success:function(e){t.attr("data-exists","no");var n=parseInt(t.find(".like-count").html(),10);n--,t.find(".like-count").html(n),t.attr("data-like",""),console.log(e)},error:function(e){console.log(e)}})}}]),t}())})}(jQuery);