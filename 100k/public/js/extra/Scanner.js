//If you can't find the declaration of any variable here, its 'prolly been set to as a global variable 
//in js 
import QrScanner from "./Scanner/qr-scanner.min.js";
QrScanner.WORKER_PATH = "./js/extra/Scanner/qr-scanner-worker.min.js";
var info1, info2, info3, userName, userEmail,completeDiv; 
info1 = $("#tree-info-1"); 
info2 = $('#tree-info-2');
userName = $('#user-name'); 
userEmail = $('#user-email');
completeDiv = $('#complete-scan');
const video = document.getElementById("qr-video");

function setResult( result) {
  var data = resultToJson(result);
  clearScannedData();//just so a user can scan more than once, and not have to refresh
  closeScanner();
  showModal();
  window.scannedData = data;
  var { type, number, name, db_id } = data;
  showScanData(name,type);
}
const scanner = new QrScanner(video, result => setResult(result));
const showScanData = function (tree_name, tree_type){
  completeDiv.fadeIn();
  info1.text("Name: "+tree_name+', '); 
  info2.text("Specie: "+tree_type); 
  userName.text(Auth.name); 
  userEmail.text(Auth.email);
}
const closeScanner = function(){
  $('#m-close-scanner').fadeOut(); 
  $('.video-curtain').fadeIn();
  scanner.stop();
  $('#start-capture').fadeIn();
}
const openScanner = function(){
  $('#start-capture').fadeOut();
  $('.video-curtain').fadeOut();
  scanner.start();
  $('#m-close-scanner').fadeIn();
}
$('#start-capture').click(function(){
  openScanner();
})

$('#m-close-scanner').click(()=>{
 closeScanner();
})

$('#generate').click(()=>{
  if(navigator.geolocation){
    navigator.geolocation.getCurrentPosition((data)=>{
      _lat  = data.coords.latitude; 
      _long = data.coords.longitude;
    })
  }
})

const resultToJson = function(string){
  //result comes in the string format :" name,type,number,db_id"
  var arr = string.split(','); 
  return { name: arr[0], type:arr[1], number:arr[2], db_id:arr[3]};
}