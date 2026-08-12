function triggerClickProfileImage(e) {
  document.querySelector('#ProfileImage').click();
}
function displayProfileImage(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#ProfileImageDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}