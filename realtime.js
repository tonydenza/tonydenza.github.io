const audioContext = new (window.AudioContext || window.webkitAudioContext)();
const analyser = audioContext.createAnalyser();
const canvas = document.getElementById('waveformCanvas');
const ctx = canvas.getContext('2d');
const waveform = new Uint8Array(analyser.frequencyBinCount);
let source;

function animate() {
  analyser.getByteTimeDomainData(waveform);
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  ctx.beginPath();
  for (let i = 0; i < waveform.length; i++) {
    const value = waveform[i] / 255;
    const y = canvas.height * (1 - value);
    const x = canvas.width * (i / waveform.length);
    if (i === 0) { ctx.moveTo(x, y); }
    else { ctx.lineTo(x, y); }
  }
  ctx.stroke();
  requestAnimationFrame(animate);
}

document.getElementById('play').addEventListener('click', function() {
  fetch('tracks/bongos.mp3')
    .then(response => response.arrayBuffer())
    .then(arrayBuffer => audioContext.decodeAudioData(arrayBuffer))
    .then(buffer => {
      source = audioContext.createBufferSource();
      source.buffer = buffer;
      source.connect(analyser);
      analyser.connect(audioContext.destination);
      source.start();
      animate();
    })
    .catch(e => console.error(e));
});

document.getElementById('pause').addEventListener('click', function() {
    if (source) {
      source.stop(); // Stop the source node
    }
  });