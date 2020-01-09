import QrScanner from "./Scanner/qr-scanner.min.js";
QrScanner.WORKER_PATH = "./js/extra/Scanner/qr-scanner-worker.min.js";


const video = document.getElementById("qr-video");
function setResult( result) {
  console.log("I am the result", result);
  // get the user information 
  // get geo location, 
  //reroute to db, and save info
   
}

const scanner = new QrScanner(video, result => setResult(result));
//scanner.start();
$('#start-capture').click(function(){
  $(this).fadeOut();
  $('.video-curtain').fadeOut();
  scanner.start();
  $('#m-close-scanner').fadeIn();
})

$('#m-close-scanner').click(()=>{
  $('#m-close-scanner').fadeOut(); 
  $('.video-curtain').fadeIn();
  scanner.stop();
  $('#start-capture').fadeIn();
})
