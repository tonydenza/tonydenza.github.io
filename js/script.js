import { BassEffect } from "./bass.js";
import "./wave.js";

document.addEventListener("DOMContentLoaded", () => {
  const bassText = document.querySelector(".bass-text");
  if (bassText) {
    new BassEffect(bassText);
  }

    // Get all close buttons
    const closeButtons = document.getElementsByClassName("close");
        
    // Set up all close buttons to close their parent modal
    for (let i = 0; i < closeButtons.length; i++) {
      closeButtons[i].onclick = function() {
        // Find the parent modal of this close button
        let modal = this.closest('.modal');
        if (modal) {
          modal.style.display = "none";
        }
      };
    }
    
    // When user clicks anywhere outside of the modal content, close it
    window.onclick = (event) => {
      if (event.target.classList.contains('modal')) {
        event.target.style.display = "none";
      }
    };

  // SoundCloud player initialization
  const initializePlayers = () => {
    const players = {
      player1: {
        cue: document.getElementById("cue1").textContent,
        iframe: document.getElementById("soundcloud-player-1"),
        playingId: "playing-1",
      },
      player2: {
        cue: document.getElementById("cue2").textContent,
        iframe: document.getElementById("soundcloud-player-2"),
        playingId: "playing-2",
      },
    };

    // Initialize each player
    Object.values(players).forEach((player) => {
      if (player.cue && player.iframe) {
        const trackList = parseTracklist(player.cue);
        const widget = SC.Widget(player.iframe);

        widget.bind(SC.Widget.Events.PLAY_PROGRESS, (event) => {
          const currentTime = event.currentPosition / 1000;
          updatePlayingTrack(currentTime, trackList, player.playingId);
        });
      }
    });
  };

  initializePlayers();

  // Initialize SoundCloud widgets and bind events after they're ready
      const widget1 = SC.Widget('soundcloud-player-1');
      const widget2 = SC.Widget('soundcloud-player-2');
      const podcast1 = SC.Widget('soundcloud-podcast-1');
      const podcast2 = SC.Widget('soundcloud-podcast-2');

      // Wait for widgets to be ready
      widget1.bind(SC.Widget.Events.READY, function () {
        widget1.bind(SC.Widget.Events.PLAY_PROGRESS, function (e) {
          updateTrackDisplay(e.currentPosition, 'cue1', 'playing-1');
        });
      });

      widget2.bind(SC.Widget.Events.READY, function () {
        widget2.bind(SC.Widget.Events.PLAY_PROGRESS, function (e) {
          updateTrackDisplay(e.currentPosition, 'cue2', 'playing-2');
        });
      });

      podcast1.bind(SC.Widget.Events.READY, function () {
        podcast1.bind(SC.Widget.Events.PLAY_PROGRESS, function (e) {
          updateTrackDisplay(e.currentPosition, 'cuep1', 'playing-p1');
        });
      });

      podcast2.bind(SC.Widget.Events.READY, function () {
        podcast2.bind(SC.Widget.Events.PLAY_PROGRESS, function (e) {
          updateTrackDisplay(e.currentPosition, 'cuep2', 'playing-p2');
        });
      });

      function updateTrackDisplay(position, cueId, displayId) {
        const currentTime = Math.floor(position / 1000);
        const tracklist = document.getElementById(cueId).innerText;
        const currentTrack = findCurrentTrack(currentTime, tracklist);

        const displayElement = document.getElementById(displayId);
        if (displayElement && currentTrack) {
          displayElement.innerText = currentTrack;
        }
      }

      function findCurrentTrack(currentTime, tracklist) {
        // Parse the tracklist and find current track
        const tracks = tracklist
          .split('\n')
          .map(line => line.trim())
          .filter(line => line.match(/^\d{2}:\d{2}:\d{2}/))
          .map(line => {
            const timeStr = line.substring(0, 8);
            const trackName = line.substring(9).trim();
            return {
              time: timeToSeconds(timeStr),
              track: trackName
            };
          });

        // Find the current track based on time
        for (let i = 0; i < tracks.length; i++) {
          const nextTime = i < tracks.length - 1 ? tracks[i + 1].time : Infinity;
          if (currentTime >= tracks[i].time && currentTime < nextTime) {
            return tracks[i].track;
          }
        }

        return '';
      }

      function timeToSeconds(timeStr) {
        const [hours, minutes, seconds] = timeStr.split(':').map(Number);
        return (hours * 3600) + (minutes * 60) + seconds;
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
