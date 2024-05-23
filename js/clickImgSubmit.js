function submitForm(imageNumber) 
{
    var form = document.getElementById('imageForm');
    form.imageChoice.value = imageNumber;
    form.submit();
}