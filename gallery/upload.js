function addSup(obj) {
    var imagescr = obj.src;
    var imgsup = document.getElementById('superimg');
    imgsup.setAttribute('src', imagescr);
    document.getElementById('capture2').disabled = false;
}

(function() {
    var canvas = document.getElementById('canvas'),
        context = canvas.getContext('2d'),
        flow = document.getElementById('superimg'),
        image = document.getElementById('img_upload');


    document.getElementById('capture2').addEventListener('click', function () {
        context.drawImage(image, 0, 0, 640, 480);
        context.drawImage(flow, 0, 0, 640, 480);
        var element = document.getElementById('picture');
        var img = canvas.toDataURL('image/jpeg');
        element.value = img;
        document.getElementById('capture-form').submit();
    });

}) ();