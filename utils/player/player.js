$(document).ready(function () {
    $("#uploadModal").modal("show");
  });
  
  function extractSoundCloudUrl(input) {
    const div = document.createElement("div");
    div.innerHTML = input;
    const iframe = div.querySelector("iframe");
    if (iframe && iframe.src) {
      return iframe.src;
    } else {
      alert("Invalid input. Please make sure it contains a valid iframe.");
      return '';
    }
  }
  
  document.getElementById("submitButton").addEventListener("click", function (event) {
    event.preventDefault();  // Prevent form submission from reloading the page
    var scUrlInput = document.getElementById("scUrl").value;
    var extractedUrl = extractSoundCloudUrl(scUrlInput);  // Extract the URL from the iframe HTML
    if (!extractedUrl) {
      return;
    }
  
    var fileInput = document.getElementById("customFile");
    var file = fileInput.files[0];
    if (file) {
      var reader = new FileReader();
      reader.onload = function (e) {
        var fileContent = e.target.result;
        var trackList = parseTracklist(fileContent);  // Parse the file content to track list
        displayTrackList(trackList);  // Display the track list in textarea
  
        // Create a new iframe element with the extracted URL
        var scIframe = document.createElement('iframe');
        scIframe.width = "100%";
        scIframe.height = "300";
        scIframe.scrolling = "no";
        scIframe.frameBorder = "no";
        scIframe.allow = "autoplay";
        scIframe.src = extractedUrl;  // Set the extracted URL to the iframe
  
        // Replace the existing iframe in the main content
        var iframeContainer = document.getElementById("iframeContainer");
        iframeContainer.innerHTML = "";  // Clear previous iframes
        iframeContainer.appendChild(scIframe);
  
        // Close the modal
        $("#uploadModal").modal("hide");
  
        // Show the main content
        document.getElementById("mainContent").style.display = "block";
  
        // Initialize the SoundCloud widget with the new iframe element
        const widget = SC.Widget(scIframe);
  
        widget.bind(SC.Widget.Events.PLAY_PROGRESS, function (event) {
          const currentTime = event.currentPosition / 1000;
          updatePlayingTrack(currentTime, trackList);
        });
  
        printTracklist(trackList, widget);
        document.getElementById("tlh").onclick = function () {
          // Show tracklist in the modal
          $("#tracklistModal").modal("show");
        };
      };
      reader.readAsText(file);  // Start reading the file
    }
  });
  
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
    let currentTrack = "Nothing playing";
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
    const modalTracklistDiv = document.querySelector("#modalTracklist");
    tracklistDiv.innerHTML = "";
    modalTracklistDiv.innerHTML = "";
    trackList.forEach((track) => {
      const trackElement = document.createElement("div");
      const modalTrackElement = document.createElement("div");
      const artist = document.createElement("span");
      artist.textContent = `[${track.time}] ${track.artist} - `;
      const title = document.createElement("span");
      title.textContent = `${track.title}`;
      trackElement.addEventListener("click", () => {
        widget.seekTo(convertTimeToSeconds(track.time) * 1000);
      });
      modalTrackElement.addEventListener("click", () => {
        widget.seekTo(convertTimeToSeconds(track.time) * 1000);
      });
      trackElement.appendChild(artist);
      trackElement.appendChild(title);
      modalTrackElement.appendChild(artist.cloneNode(true));
      modalTrackElement.appendChild(title.cloneNode(true));
      tracklistDiv.appendChild(trackElement);
      modalTracklistDiv.appendChild(modalTrackElement);
    });
  }
  
  function displayTrackList(trackList) {
    const trackListElement = document.getElementById("tracklist");
    trackListElement.value = ""; // Clear any previous content
    trackList.forEach((track) => {
      trackListElement.value += `${track.time} - ${track.artist} - ${track.title}\n`;
    });
    trackListElement.value = "";
  }
  