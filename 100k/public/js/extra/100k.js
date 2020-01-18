


const countAndUpdate = function(){
  $.ajax({method:'GET',url:'/count.planted'}).done((number)=>{
    $('#counter').text(number);
    $('#hurray-count').text(number);
  })
}
const plotMarker=   function(lat,long,owner,thumbnail,other){
  var position =  new google.maps.LatLng({lat: lat, lng:long});
  var icon = {
    url: thumbnail, 
    labelOrigin: new google.maps.Point(0,-39)
  }
  var label = { 
    text:owner, 
    color:other?'#3bb62b' : 'red', 
    fontSize:'13px', 
    fontWeight:'800'
  }

  const marker = new google.maps.Marker({
    position: position, 
    // icon:icon, 
    animation:google.maps.Animation.DROP,
    label:label
  }); 
  window.markerList.push(marker);//save all the markers somewhere
  marker.setMap(map);
}
const closeModal = function() {
    $("#modalion").fadeOut(5); //remove modal instantly, and do the rest in the background 
    removeHurray(); //remove the hurray div, if that is what was shown
    removeSorry(); //remove the sorry div, if that is what was shown
    hookToggle('enable');//enable the hook button again
};
const showModal = function() {
    $("#modalion").fadeIn();
};
const removeCompleteScan = function(){
  $('#complete-scan').fadeOut(5);
}
const removeHurray = function(){
  $('#Hurray').fadeOut();
}
const removeSorry = function(){
  $('#sorry').fadeOut()
}
const showSorry = function(){
  $('#sorry').fadeIn();
}
const showCongrats = function() {
    $("#complete-scan").fadeOut(100, function() {
        $("#Hurray").fadeIn();
        $('#hurray-count').text(window.availableTrees.length);
    });
};

const hookToggle = function(type) {
    var hook = document.getElementById("hook-btn");
    if (type === "disable") {
        hook.innerHTML = "Hooking...";
        hook.disabled = true;
    } else if (type === "enable") {
        hook.innerHTML = "Hook Me To My Tree";
        hook.disabled = false;
    }
};
const get100kLocationPoints = function() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(data => {
            window._lat = data.coords.latitude;
            window._long = data.coords.longitude;
        });
    }
};
const getToken = function() {
    $.ajax({ method: "get", url: "/get-token" }).done(data => {
        window.csrf_token = data;
    });
};
const getAuthenticatedUser = function() {
    $.ajax({ method: "GET", url: "/auth.get" }).done(res => {
        window.Auth = res.data;
    });
};
const shipData = function(lat, long) {
  //console.log("the coordinates",lat,long);
    $.ajax({
        method: "POST",
        url: "/user.scanned",
        data: {
            ...scannedData,
            lat: lat.toString(),
            long: long.toString(),
            _token: csrf_token
        }
    }).then(res => {
      removeCompleteScan(); 
        if (res.success) {
            showCongrats();
        } else if (!res.success && res.error_code === 419) {
            showSorry();
            var user = res.data; 
            $('#owned-name').text(user.name);
        }
    });
};
const streamToBackEnd = function() {
    if (navigator.geolocation) {
        hookToggle('disable');
        navigator.geolocation.getCurrentPosition(data => {
            if (data.coords) {
                shipData(data.coords.latitude, data.coords.longitude);
            }
        });
    } else {
        console.log("We couldn't determine your location");
    }
};
const getTreeCount = function(){
  //just a function to get all planted trees and user trees to be saved as  global variables
  $.ajax({method:'GET',url:'/get-count'}).done((res)=>{
    window.availableTrees = res.all_planted; 
    window.Auth_trees = res.user_trees;
  });
}

const plotTrees = function(){
  var def_img = './../../default-imgs/tree-ico.png'; 
  var user_img = './../../default-imgs/red-tree.png'
  window.markerList = [];//initializer global marker container
  $.ajax({method:'GET',url:'/get-count'}).done((res)=>{
    $.ajax({method:'GET',url:'/auth.get'}).done((data)=>{
      var left = res.all_planted; 
      var user_trees = res.user_trees;
      if(data.success){ //if user is authenticated
        left = left.filter(tree => tree.user_id !== data.data.id);
      }
      //plot user's trees
      user_trees.forEach(tree => {
        var owner = tree.user.name +' (' +tree.user.email.split('@')[0]+') ';
        plotMarker(parseFloat(tree.location.latitude),parseFloat(tree.location.longitude),owner,user_img,false);
      });
      //plot other peoples trees
      left.forEach(tree => {
        var owner = tree.user.name +' (' +tree.user.email.split('@')[0]+') ';
        plotMarker(parseFloat(tree.location.latitude),parseFloat(tree.location.longitude),owner,def_img,true);
      });
    });
  });
  
}
const clearMarkerField = function(){
  //clean up all markers first
  window.markerList.forEach(marker => {
    marker.setMap(null);
  });
}

getTreeCount();
getToken();
getAuthenticatedUser();
plotTrees();
window.clearScannedData = removeCompleteScan;
window.closeModal = closeModal;
window.showModal = showModal;
window.determineLocationPoints = get100kLocationPoints;
window.getAuth = getAuthenticatedUser;
window.streamToBackEnd = streamToBackEnd;

setInterval(() => { //check for tree updates every 10 seconds
  getTreeCount();
}, 10000);

setInterval(()=>{
  countAndUpdate();
},5000)

setInterval(()=>{
  //Replot all tress every minute 
  //before that, clear markers first
  clearMarkerField();
  plotTrees();
},60000)