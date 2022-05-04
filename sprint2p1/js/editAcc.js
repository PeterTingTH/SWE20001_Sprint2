function showSubmitPhotoForm(){
    document.getElementById('profImgForm').style.display='block';
}

function hideSubmitPhotoForm(){
    document.getElementById('profImgForm').style.display='none';
}

if(document.getElementById('UpdateProfImg').checked == true){
    document.getElementById('profImgForm').style.display='block';
}