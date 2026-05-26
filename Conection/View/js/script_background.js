document.addEventListener('DOMContentLoaded', function () {
  var video = document.getElementById('video-background');

  function changeVideo() {
    if (video.src.endsWith('/View/assets/Video1.mp4')) {
      video.src = 'assets/Video2.mp4';
    } else {
      video.src = '/View/assets/Video1.mp4';
    }
    video.play();
  }

  video.addEventListener('ended', function () {
    changeVideo();
  });

  changeVideo();
});
