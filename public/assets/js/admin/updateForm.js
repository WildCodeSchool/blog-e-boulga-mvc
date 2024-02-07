const imageUpload = document.getElementById('imageUpload');
function previewImage(e) {
   const input = e.target;
   const image = document.getElementById('preview');
   
   if (input.files && input.files[0]) {
      const reader = new FileReader();
        reader.onload = function(e) {
             image.src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
   }
}
document.getElementById('imageUpload').addEventListener('change', previewImage);