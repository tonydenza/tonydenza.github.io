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

function updatePlayingTrack(currentTime, trackList) {
  let currentTrack = "";
  for (let i = 0; i < trackList.length; i++) {
    const trackTime = convertTimeToSeconds(trackList[i].time);
    const nextTrackTime = i < trackList.length - 1 ? convertTimeToSeconds(trackList[i + 1].time) : Infinity;
    if (currentTime >= trackTime && currentTime < nextTrackTime) {
      currentTrack = `${trackList[i].artist} - ${trackList[i].title}`;
      break;
    }
  }
  document.querySelector("#playing").textContent = currentTrack;
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

var input = document.getElementById("cue").textContent;
const trackList = parseTracklist(input);
const iframeElement = document.querySelector(".soundcloud-player");
const widget = SC.Widget(iframeElement);

widget.bind(SC.Widget.Events.PLAY_PROGRESS, function (event) {
  const currentTime = event.currentPosition / 1000;
  updatePlayingTrack(currentTime, trackList);
});

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











