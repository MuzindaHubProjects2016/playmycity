var artistBio = '';
artistBio += '<div id="artist-bio">';
artistBio += '<div id="artist-image"></div>';
artistBio += '<div id="artist-details">';
artistBio += '<ul><li>Artist:<span id="bio-name"></span></li>';
artistBio += '<li id="bio-rank">Rank:</li>';
artistBio += '<li>Genre:<span id="bio-genre"></span></li>';
artistBio += '<li>City:<span id="bio-city"></span></li>';
artistBio += '<li>Requests:<span id="bio-requests"></span></li>';
artistBio += '<li><a href="#">Confirmed:<span id="bio-confirmed"></span></a></li></ul>';
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
    var bioRequests = $('#'+currentId+' span.requests').text();
    var bioConfirmed = $('#'+currentId+' span.confirmed-shows').text();
    var bioImageUrl = $('#'+currentId+' span.artist-image-url').text();
    console.log(bioImageUrl);
    $('#bio-name').text(bioName);
    $('#bio-requests').text(bioRequests);
    $('#bio-confirmed').text(bioConfirmed);
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