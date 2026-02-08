document.addEventListener('DOMContentLoaded', () => {
        // Initialize SoundCloud widgets and bind events after they're ready
        const widget1 = SC.Widget('soundcloud-player-1');
        const widget2 = SC.Widget('soundcloud-player-2');
        const podcast1 = SC.Widget('soundcloud-podcast-1');

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