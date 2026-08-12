function triggerClickCover(e) {
  document.querySelector('#coverImage').click();
}
function displayImageCover(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#coverDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}

function triggerClickImageOne(e) {
  document.querySelector('#ImageOne').click();
}
function displayImageOne(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#ImageOneDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}

function triggerClickImageTwo(e) {
  document.querySelector('#ImageTwo').click();
}
function displayImageTwo(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#ImageTwoDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}

function triggerClickImageThree(e) {
  document.querySelector('#ImageThree').click();
}
function displayImageThree(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#ImageThreeDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}

function triggerClickImageFour(e) {
  document.querySelector('#ImageFour').click();
}
function displayImageFour(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#ImageFourDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}

function triggerClickImageFive(e) {
  document.querySelector('#ImageFive').click();
}
function displayImageFive(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#ImageFiveDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}


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