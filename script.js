// Merged JavaScript Files
// =========================
// Start of vlna.js Content
// =========================

import GUI from "https://cdn.jsdelivr.net/npm/lil-gui@0.18.2/+esm"

const canvasEl = document.querySelector("canvas");
const imgInput = document.querySelector("#image-selector-input");
const devicePixelRatio = Math.min(window.devicePixelRatio, 2);

const params = {
    blueish: .2,
    scale: 12,
    illumination: .15,
    surfaceDistortion: .02,
    waterDistortion: .015,
    loadMyImage: () => {
        imgInput.click();
    }
};

imgInput.onchange = () => {
    const [file] = imgInput.files;
    if (file) {
        const reader = new FileReader();
        reader.onload = e => {
            loadImage(e.target.result);
        };
        reader.readAsDataURL(file);
    }
};


let image, uniforms;
const gl = initShader();
updateUniforms();
loadImage("./vlna.jpg");
//createControls();
render();
window.addEventListener("resize", resizeCanvas);


function initShader() {
    const vsSource = document.getElementById("vertShader").innerHTML;
    const fsSource = document.getElementById("fragShader").innerHTML;

    const gl = canvasEl.getContext("webgl") || canvasEl.getContext("experimental-webgl");

    if (!gl) {
        alert("WebGL is not supported by your browser.");
    }

    function createShader(gl, sourceCode, type) {
        const shader = gl.createShader(type);
        gl.shaderSource(shader, sourceCode);
        gl.compileShader(shader);

        if (!gl.getShaderParameter(shader, gl.COMPILE_STATUS)) {
            console.error("An error occurred compiling the shaders: " + gl.getShaderInfoLog(shader));
            gl.deleteShader(shader);
            return null;
        }

        return shader;
    }

    const vertexShader = createShader(gl, vsSource, gl.VERTEX_SHADER);
    const fragmentShader = createShader(gl, fsSource, gl.FRAGMENT_SHADER);

    function createShaderProgram(gl, vertexShader, fragmentShader) {
        const program = gl.createProgram();
        gl.attachShader(program, vertexShader);
        gl.attachShader(program, fragmentShader);
        gl.linkProgram(program);

        if (!gl.getProgramParameter(program, gl.LINK_STATUS)) {
            console.error("Unable to initialize the shader program: " + gl.getProgramInfoLog(program));
            return null;
        }

        return program;
    }

    const shaderProgram = createShaderProgram(gl, vertexShader, fragmentShader);
    uniforms = getUniforms(shaderProgram);

    function getUniforms(program) {
        let uniforms = [];
        let uniformCount = gl.getProgramParameter(program, gl.ACTIVE_UNIFORMS);
        for (let i = 0; i < uniformCount; i++) {
            let uniformName = gl.getActiveUniform(program, i).name;
            uniforms[uniformName] = gl.getUniformLocation(program, uniformName);
        }
        return uniforms;
    }

    const vertices = new Float32Array([-1., -1., 1., -1., -1., 1., 1., 1.]);

    const vertexBuffer = gl.createBuffer();
    gl.bindBuffer(gl.ARRAY_BUFFER, vertexBuffer);
    gl.bufferData(gl.ARRAY_BUFFER, vertices, gl.STATIC_DRAW);

    gl.useProgram(shaderProgram);

    const positionLocation = gl.getAttribLocation(shaderProgram, "a_position");
    gl.enableVertexAttribArray(positionLocation);

    gl.bindBuffer(gl.ARRAY_BUFFER, vertexBuffer);
    gl.vertexAttribPointer(positionLocation, 2, gl.FLOAT, false, 0, 0);

    return gl;
}

function updateUniforms() {
    gl.uniform1f(uniforms.u_blueish, params.blueish);
    gl.uniform1f(uniforms.u_scale, params.scale);
    gl.uniform1f(uniforms.u_illumination, params.illumination);
    gl.uniform1f(uniforms.u_surface_distortion, params.surfaceDistortion);
    gl.uniform1f(uniforms.u_water_distortion, params.waterDistortion);

}

function loadImage(src) {
    image = new Image();
    image.crossOrigin = "anonymous";
    image.src = src;
    image.onload = () => {
        const imageTexture = gl.createTexture();
        gl.bindTexture(gl.TEXTURE_2D, imageTexture);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.LINEAR);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.LINEAR);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_S, gl.CLAMP_TO_EDGE);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_T, gl.CLAMP_TO_EDGE);
        gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGBA, gl.RGBA, gl.UNSIGNED_BYTE, image);
        gl.uniform1i(uniforms.u_image_texture, 0);
        resizeCanvas();
    };
}

function render() {
    const currentTime = performance.now();
    gl.uniform1f(uniforms.u_time, currentTime);
    gl.drawArrays(gl.TRIANGLE_STRIP, 0, 4);
    requestAnimationFrame(render);
}

function resizeCanvas() {
    const imgRatio = image.naturalWidth / image.naturalHeight;
    canvasEl.width = window.innerWidth * devicePixelRatio;
    canvasEl.height = window.innerHeight * devicePixelRatio;
    gl.viewport(0, 0, canvasEl.width, canvasEl.height);
    gl.uniform1f(uniforms.u_ratio, canvasEl.width / canvasEl.height);
    gl.uniform1f(uniforms.u_img_ratio, imgRatio);
}

function createControls() {
    const gui = new GUI();
	 gui.close();

    gui
        .add(params, "loadMyImage")
        .name("load image");

    const paramsFolder = gui.addFolder("shader params");
    // paramsFolder.close();

    paramsFolder
        .add(params, "blueish", 0, .8)
        .onChange(updateUniforms)
    paramsFolder
        .add(params, "scale", 5, 12)
        .onChange(updateUniforms)
    paramsFolder
        .add(params, "illumination", 0, 1)
        .onChange(updateUniforms)
    paramsFolder
        .add(params, "surfaceDistortion", 0, .12)
        .onChange(updateUniforms)
        .name("surface distortion")
    paramsFolder
        .add(params, "waterDistortion", 0, .08)
        .onChange(updateUniforms)
        .name("water distortion")
}

// =========================
// Start of script.js Content
// =========================




var modal = document.getElementById("utilsModal");
var btn = document.getElementById("utilsModalBtn");
var span = document.getElementsByClassName("close")[0];

btn.onclick = function () {
  modal.style.display = "block";
};
span.onclick = function () {
  modal.style.display = "none";
};
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};

var eventModal = document.getElementById("eventModal");

    // Function to hide modal if clicked outside
    window.onclick = function(event) {
        if (event.target == eventModal) {
            eventModal.style.display = "none";
        }
    }

function toggleSpinninBass() {
  const spinninBass = document.querySelector(".spinnin-bass");
  const currentZIndex = window.getComputedStyle(spinninBass).zIndex;
  spinninBass.style.zIndex = currentZIndex == "0" ? "-1000" : "0";
  const ryby = document.getElementById("ryby");
  ryby.style.filter = "blur(0)";
}

function parseTracklist(input) {
  const lines = input.split("\n");
  const trackList = [];
  const trackMap = new Map();

  const trackRegex = /TRACK \d+ AUDIO/;
  const titleRegex = /\s+TITLE\s+"([^"]+)"/;
  const performerRegex = /\s+PERFORMER\s+"([^"]+)"/;
  const indexRegex = /\s+INDEX 01 (\d{2}:\d{2}:\d{2})/;

  let currentTrack = {};

  for (let line of lines) {
    if (trackRegex.test(line)) {
      if (currentTrack.time && currentTrack.artist && currentTrack.title) {
        const trackKey = `${currentTrack.artist} - ${currentTrack.title}`;
        if (!trackMap.has(trackKey)) {
          trackMap.set(trackKey, currentTrack);
          trackList.push(currentTrack);
        }
      }
      currentTrack = {};
    }

    let match;
    if ((match = line.match(titleRegex))) {
      currentTrack.title = match[1];
    }
    if ((match = line.match(performerRegex))) {
      currentTrack.artist = match[1];
    }
    if ((match = line.match(indexRegex))) {
      currentTrack.time = match[1];
    }
  }

  if (currentTrack.time && currentTrack.artist && currentTrack.title) {
    const trackKey = `${currentTrack.artist} - ${currentTrack.title}`;
    if (!trackMap.has(trackKey)) {
      trackMap.set(trackKey, currentTrack);
      trackList.push(currentTrack);
    }
  }

  return trackList;
}

function convertTimeToSeconds(time) {
  const parts = time.split(":");
  return parseInt(parts[0], 10) * 3600 + parseInt(parts[1], 10) * 60 + parseInt(parts[2], 10);
}

function updatePlayingTrack(currentTime, trackList, element) {
  let currentTrack = "";
  for (let i = 0; i < trackList.length; i++) {
    const trackTime = convertTimeToSeconds(trackList[i].time);
    const nextTrackTime = i < trackList.length - 1 ? convertTimeToSeconds(trackList[i + 1].time) : Infinity;
    if (currentTime >= trackTime && currentTime < nextTrackTime) {
      currentTrack = `${trackList[i].artist} - ${trackList[i].title}`;
      break;
    }
  }
  document.getElementById(element).textContent = currentTrack;
}

function printTracklist(trackList, widget) {
  const tracklistDiv = document.querySelector("#tracklist");
  tracklistDiv.innerHTML = "";
  trackList.forEach((track) => {
    const trackElement = document.createElement("div");
    const artist = document.createElement("span");
    artist.textContent = `${track.artist} - `;
    const title = document.createElement("span");
    title.textContent = `${track.title}`;
    trackElement.addEventListener("click", () => {
      widget.seekTo(convertTimeToSeconds(track.time) * 1000);
    });
    trackElement.appendChild(artist);
    trackElement.appendChild(title);
    tracklistDiv.appendChild(trackElement);
  });
}

///// PLAYERS
var input1 = document.getElementById("cue1").textContent;
var input2 = document.getElementById("cue2").textContent;
//var input3 = document.getElementById("cue3").textContent;

const trackList1 = parseTracklist(input1);
const trackList2 = parseTracklist(input2);
//const trackList3 = parseTracklist(input3);

const iframeElement1 = document.getElementById("soundcloud-player-1");
const iframeElement2 = document.getElementById("soundcloud-player-2");
//const iframeElement3 = document.getElementById("soundcloud-player-3");

const widget1 = SC.Widget(iframeElement1);
const widget2 = SC.Widget(iframeElement2);
//const widget3 = SC.Widget(iframeElement3);

widget1.bind(SC.Widget.Events.PLAY_PROGRESS, function (event) {
  const currentTime = event.currentPosition / 1000;
  updatePlayingTrack(currentTime, trackList1, "playing-1");
});

widget2.bind(SC.Widget.Events.PLAY_PROGRESS, function (event) {
  const currentTime = event.currentPosition / 1000;
  updatePlayingTrack(currentTime, trackList2, "playing-2");
});

//widget3.bind(SC.Widget.Events.PLAY_PROGRESS, function (event) {
//  const currentTime = event.currentPosition / 1000;
//  updatePlayingTrack(currentTime, trackList3, "playing-3");
//});

//////////

function convertToTracklist() {
  const cueText = document.getElementById("cueText");
  const output = document.getElementById("output");
  const formatOption = document.querySelector("select").value; // Get the selected format

  if (cueText.value.trim() !== "") {
    processCueContent(cueText.value.trim(), formatOption);
  }
}

function processCueContent(content, formatOption) {
  const lines = content.split("\n");
  let result = [];
  let seenTracks = new Set(); // Set to keep track of already added tracks
  let currentTimestamp = "";
  let currentTitle = "";
  let currentPerformer = "";

  for (let i = 0; i < lines.length; i++) {
    const line = lines[i].trim();

    if (line.startsWith("TITLE") && !line.startsWith("REM")) {
      const parts = line.split('"');
      if (parts.length > 1) {
        currentTitle = parts[1];
      }
    } else if (line.startsWith("PERFORMER")) {
      const parts = line.split('"');
      if (parts.length > 1) {
        currentPerformer = parts[1];
      }
    } else if (line.startsWith("INDEX 01")) {
      const timeParts = line.split(" ")[2].split(":");
      const minutes = parseInt(timeParts[0], 10);
      const seconds = parseInt(timeParts[1], 10);
      const frames = parseInt(timeParts[2], 10);
      const totalSeconds = minutes * 60 + seconds + frames / 75;
      currentTimestamp = formatTime(totalSeconds);

      const trackKey = `${currentPerformer} - ${currentTitle}`; // Unique key for each track

      if (currentPerformer && currentTitle) {
        if (formatOption === "timestamps") {
          result.push(`${currentTimestamp} ${currentPerformer} - ${currentTitle}`);
        } else if (formatOption === "numbered") {
          // Only add if this track has not been added before
          if (!seenTracks.has(trackKey)) {
            result.push(`${result.length + 1}. ${currentPerformer} - ${currentTitle}`);
            seenTracks.add(trackKey); // Mark this track as seen
          }
        }
      }

      currentTitle = "";
      currentPerformer = "";
    }
  }

  output.value = result.join("\n");
}

function formatTime(totalSeconds) {
  const minutes = Math.floor(totalSeconds / 60);
  const seconds = Math.floor(totalSeconds % 60);
  return `${String(minutes).padStart(2, "0")}:${String(seconds).padStart(2, "0")}:00`;
}












