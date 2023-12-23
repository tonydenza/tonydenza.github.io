const canvasInteractive = document.createElement('canvas')
const ctxInteractive = canvasInteractive.getContext('2d')

function renderfunction(channels, ctx) {
  const { width, height } = ctx.canvas
  const scale = channels[0].length / width
  const step = 10

  ctx.translate(0, height / 2)
  ctx.strokeStyle = ctx.fillStyle
  ctx.beginPath()

  for (let i = 0; i < width; i += step * 2) {
    const index = Math.floor(i * scale)
    const value = Math.abs(channels[0][index])
    let x = i
    let y = value * height

    ctx.moveTo(x, 0)
    ctx.lineTo(x, y)
    ctx.arc(x + step / 2, y, step / 2, Math.PI, 0, true)
    ctx.lineTo(x + step, 0)

    x = x + step
    y = -y
    ctx.moveTo(x, 0)
    ctx.lineTo(x, y)
    ctx.arc(x + step / 2, y, step / 2, Math.PI, 0, false)
    ctx.lineTo(x + step, 0)
  }

  ctx.stroke()
  ctx.closePath()
}

const objectURL = ''
const formatTime = (seconds) => `${Math.floor(seconds / 60)}:${`0${Math.round(seconds) % 60}`.slice(-2)}`;
const options = {
  container: '#waveform',
  height: 250, 
  width: 1000, 
  splitChannels: false, 
  normalize: false,
  waveColor: '#ff4e00', 
  progressColor: '#dd5e98', 
  cursorColor: '#ddd5e9',
  cursorWidth: 4, 
  barWidth: 4, 
  barGap: 4, 
  barRadius: 4, 
  barHeight: 4, 
  barAlign: 'center',
  minPxPerSec: 1, 
  fillParent: true, 
  url: 'tracks/bongos.mp3',
  mediaControls: false,
  autoplay: false, 
  interact: true, 
  dragToSeek: false, 
  hideScrollbar: true,
  audioRate: 1, 
  autoScroll: true, 
  autoCenter: true, 
  sampleRate: 8000, 
  renderFunction: renderfunction,
}

const schema = {
  height:      { value: 128, min: 10, max: 512, step: 1, },
  width:       { value: 300, min: 10, max: 2000, step: 1, },
  cursorWidth: { value: 2, min: 1, max: 10, step: 1, },
  minPxPerSec: { value: 1, min: 1, max: 100, step: 1, },
  barWidth:    { value: 0, min: 1, max: 100, step: 1, },
  barHeight:   { value: 0, min: 1, max: 100, step: 1, },
  barGap:      { value: 0, min: 1, max: 100, step: 1, },
  barRadius:   { value: 0, min: 1, max: 100, step: 1, },
  peaks:       { value: [], type: 'json', },
  audioRate:   { value: 1, min: 0.1, max: 4, step: 0.1, },
  sampleRate:  { value: 8000, min: 8000, max: 48000, step: 1000, },
}

let wavesurfer = WaveSurfer.create(options);
const timeEl     = document.querySelector('#time')
const durationEl = document.querySelector('#duration')
const rangeLabel = document.createElement('label');
const rangeInput = document.createElement('input');
const form = document.createElement('form')

Object.assign(form.style, { display: 'flex', flexDirection: 'column', gap: '1rem', padding: '1rem', })
document.getElementById("config").appendChild(form)

for (const key in options) {
  if (options[key] === undefined) continue
  if (options[key] === 'container') continue
  const isColor = key.includes('Color')
  const label = document.createElement('label')
  Object.assign(label.style, { display: 'flex', alignItems: 'center',})
  const span = document.createElement('span')
  Object.assign(span.style, { textTransform: 'capitalize', width: '5em',})
  span.textContent = `${key.replace(/[a-z0-9](?=[A-Z])/g, '$& ')}: `
  label.appendChild(span)
  const input = document.createElement('input')
  const type = typeof options[key]
  Object.assign(input, {
    type: isColor ? 'color' : type === 'number' ? 'range' : type === 'boolean' ? 'checkbox' : 'text',
    name: key,
    value: options[key],
    checked: options[key] === true,
  })
  if (input.type === 'text') input.style.flex = 1
  if (options[key] instanceof HTMLElement) input.disabled = true
  if (schema[key]) Object.assign(input, schema[key])

  label.appendChild(input)
  form.appendChild(label)

  input.oninput = () => {
    if (type === 'number') { options[key] = input.valueAsNumber }
    else if (type === 'boolean') { options[key] = input.checked }
    else if (schema[key] && schema[key].type === 'json') { options[key] = JSON.parse(input.value)}
    else { options[key] = input.value }
    wavesurfer.setOptions(options)
  }
}

const playButton = document.getElementById('play');

wavesurfer.on('play', function() {
  const icon = playButton.querySelector('i');
  icon.classList.remove('fas', 'fa-play');
  icon.classList.add('fas', 'fa-pause');
  console.log('Play');
});

wavesurfer.on('pause', function() {
  const icon = playButton.querySelector('i');
  icon.classList.remove('fas', 'fa-pause');
  icon.classList.add('fas', 'fa-play');
  console.log('Pause');
});

playButton.addEventListener('click', function() {
  if (wavesurfer.isPlaying()) {
    wavesurfer.pause();
  } else {
    wavesurfer.play();
  }
});

rangeLabel.appendChild('range', '10', '1000', '100');
document.querySelector('form').appendChild(rangeLabel);

const fileLabel = document.createElement('label');
Object.assign(fileLabel.style, { display: 'flex', alignItems: 'center' });

const fileSpan = document.createElement('span');
Object.assign(fileSpan.style, { textTransform: 'capitalize', width: '7em', });
fileSpan.textContent = 'File: ';
fileLabel.appendChild(fileSpan);

const fileInput = document.createElement('input');
Object.assign(fileInput, { type: 'file', name: 'file', id: 'fileInput', });
fileLabel.appendChild(fileInput);
form.appendChild(fileLabel);

wavesurfer.on('load', (url) => { console.log('Load', url) }) /** When audio starts loading */
wavesurfer.on('loading', (percent) => { console.log('Loading', percent + '%') }) /** During audio loading */
wavesurfer.on('decode', (duration) => { console.log('Decode', duration + 's') }) /** When the audio has been decoded */
wavesurfer.on('ready', (duration) => { console.log('Ready', duration + 's') }) /** When the audio is both decoded and can play */
wavesurfer.on('redraw', () => { console.log('Redraw') }) /** When a waveform is drawn */
wavesurfer.on('finish', () => { console.log('Finish') }) /** When the audio finishes playing */
wavesurfer.on('timeupdate', (currentTime) => { timeEl.textContent = formatTime(currentTime) }) /** On audio position change, fires continuously during playback */
wavesurfer.on('seeking', (currentTime) => { console.log('Seeking', currentTime + 's') }) /** When the user seeks to a new position */
wavesurfer.on('interaction', (newTime) => { wavesurfer.playPause() }) /** When the user interacts with the waveform (i.g. clicks or drags on it) */
wavesurfer.on('click', (relativeX) => { console.log('Click', relativeX) }) /** When the user clicks on the waveform */
wavesurfer.on('drag', (relativeX) => { console.log('Drag', relativeX) }) /** When the user drags the cursor */
wavesurfer.on('scroll', (visibleStartTime, visibleEndTime) => { console.log('Scroll', visibleStartTime + 's', visibleEndTime + 's') }) /** When the waveform is scrolled (panned) */
wavesurfer.on('zoom', (minPxPerSec) => { console.log('Zoom', minPxPerSec + 'px/s') }) /** When the zoom level changes */
wavesurfer.on('destroy', () => { console.log('Destroy') }) /** Just before the waveform is destroyed so you can clean up your events */
wavesurfer.once('decode', () => { // Update the zoom level on slider change
  const slider = document.querySelector('input[type="range"]')
  durationEl.textContent = formatTime(durationEl)
  slider.addEventListener('input', (e) => { const minPxPerSec = e.target.valueAsNumber; wavesurfer.zoom(minPxPerSec) })
})

wavesurfer.on('play', function() {
  const icon = playButton.querySelector('i');
  icon.classList.remove('fas', 'fa-play');
  icon.classList.add('fas', 'fa-pause');
  console.log('Play');
});

wavesurfer.on('pause', function() {
  const icon = playButton.querySelector('i');
  icon.classList.remove('fas', 'fa-pause');
  icon.classList.add('fas', 'fa-play');
  console.log('Pause');
});
