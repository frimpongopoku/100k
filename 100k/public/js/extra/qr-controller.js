
var scanner = new Instascan.Scanner({ video: document.getElementById('code-preview') });
scanner.addListener('scan',function(content){
  console.log("I am the content", content);
});
//-----------FXNS
function openScanner(){
  Instascan.Camera.getCameras().then(function (cameras) {
    if (cameras.length > 0) {
      scanner.start(cameras[0]);
    } else {
      console.error('No cameras found.');
    }
  }).catch(function (e) {
    console.error(e);
  });
}
