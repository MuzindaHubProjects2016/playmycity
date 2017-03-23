var artistBio = '';
artistBio += '<div id="artist-bio">';
artistBio += '<div id="artist-image"></div>';
artistBio += '<div id="artist-details">';
artistBio += '<ul><li><span class="span-label">Artist:</span><span id="bio-name"></span></li>';
artistBio += '<li id="bio-rank"><span class="span-label">Rank:</span></li>';
artistBio += '<li><span class="span-label">Genre:</span><span id="bio-genre"></span></li>';
artistBio += '<li><span class="span-label">City:</span><span id="bio-city"></span></li>';
artistBio += '<li><span class="span-label">Requests:</span><span id="bio-requests"></span></li>';
artistBio += '<li><a href="#"><span class="span-label">Confirmed:</span><span id="bio-confirmed"></span></a></li></ul>';
artistBio += '</div>';
artistBio += '<div id="artist-bio-button-holder">';
artistBio += '<button id="view-artist-details">In Detail</button>';
artistBio += '</div>';
artistBio += '</div>';
var requests;

function requestsUpdate () {
  var currentId = $(this).parents('li').attr('id'); // get id of current element
  var currentRequest = $('#'+currentId+' span.requests').text(); //add current id to selector to specify only the span in the element with the current id
  requests = parseInt(currentRequest) + 1;
  $(this).siblings('span.requests').text(requests);
}

$('.play-my-city').click(requestsUpdate);

$('.artist-name').hover(
  function () {
  $(this).append(artistBio);
    $('#artist-bio').hide().fadeIn();
//Update Inner Htmls for artist-bio here
    var currentId = $(this).attr('id');
    var bioName = $('#'+currentId+' span#stage-name').text();
    var bioGenre = $('#'+currentId+' span#genre').text();
    var bioCity = $('#'+currentId+' span#artist-city').text();
    var bioRequests = $('#'+currentId+' span.requests').text();
    var bioConfirmed = $('#'+currentId+' span.confirmed-shows').text();
    var bioImageUrl = $('#'+currentId+' span.artist-image-url').text();
//    console.log(bioImageUrl);
    $('#bio-name').text(bioName);
    $('#bio-requests').text(bioRequests);
    $('#bio-confirmed').text(bioConfirmed);
    $('#bio-city').text(bioCity);
    $('#bio-genre').text(bioGenre);
    $('#artist-image').append('<img src='+bioImageUrl+'>');
    
    $('#view-artist-details').click(function () {
//      alert('Artist Details!!');
      $('#artist-bio-button-holder').hide();
      $('#artist-bio').animate({'width': '800px', 
                            'height': '500px', 
                           'background-color': 'white'});
    });
},
  function () {
    $('#artist-bio').detach();
  }            
);
