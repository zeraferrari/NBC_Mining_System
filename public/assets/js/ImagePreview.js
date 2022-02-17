function PreviewImage(){
    const image = document.querySelector('#profile_picture');
    const PreviewImage = document.querySelector('.img-preview');

    // PreviewImage.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(oFREvent){
        PreviewImage.src = oFREvent.target.result;
    }
}