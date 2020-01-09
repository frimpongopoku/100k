const closeModal = function() {
    $("#modalion").fadeOut(5);
};
const showModal = function() {
    $("#modalion").fadeIn();
};
const showCongrats = function() {
    $("#complete-scan").fadeOut(100, function() {
        $("#Hurray").fadeIn();
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
    $.ajax({
        method: "POST",
        url: "/user.scanned",
        data: {
            ...scannedData,
            lat: lat,
            long: long,
            _token: csrf_token
        }
    }).then(res => {
        console.log(res);
        showCongrats();
        return;
        if (res.success) {
            console.log("show congrats, you are all done!");
        } else if (!res.success && res.error_code === 419) {
            //show sorry div
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
getToken();
getAuthenticatedUser();
window.closeModal = closeModal;
window.showModal = showModal;
window.determineLocationPoints = get100kLocationPoints;
window.getAuth = getAuthenticatedUser;
window.streamToBackEnd = streamToBackEnd;
