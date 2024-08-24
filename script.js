/*function hideLoadingScreen() {
    const loadingScreen = document.getElementById('loading-screen');
    loadingScreen.style.opacity = 0;
    setTimeout(() => {
        loadingScreen.style.display = 'none';
    }, 1000);
}*/

function toggleSpinninBass() {
    const spinninBass = document.querySelector('.spinnin-bass');
    const currentZIndex = window.getComputedStyle(spinninBass).zIndex;
    spinninBass.style.zIndex = currentZIndex == '0' ? '-1000' : '0';
    const ryby = document.getElementById('ryby');
    ryby.style.filter = 'blur(0)';
}

function parseTracklist(input) {
    const lines = input.split('\n');
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
        if (match = line.match(titleRegex)) {
            currentTrack.title = match[1];
        }
        if (match = line.match(performerRegex)) {
            currentTrack.artist = match[1];
        }
        if (match = line.match(indexRegex)) {
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
    const parts = time.split(':');
    return parseInt(parts[0], 10) * 3600 + parseInt(parts[1], 10) * 60 + parseInt(parts[2], 10);
}

function updatePlayingTrack(currentTime, trackList) {
    let currentTrack = "DLKTek - Enter the Bassw8tHardware - I Got 140 Problems But a Bass Ain't One";
    for (let i = 0; i < trackList.length; i++) {
        const trackTime = convertTimeToSeconds(trackList[i].time);
        const nextTrackTime = i < trackList.length - 1 ? convertTimeToSeconds(trackList[i + 1].time) : Infinity;
        if (currentTime >= trackTime && currentTime < nextTrackTime) {
            currentTrack = `${trackList[i].artist} - ${trackList[i].title}`;
            break;
        }
    }
    document.querySelector('#playing').textContent = currentTrack;
}

function printTracklist(trackList, widget) {
    const tracklistDiv = document.querySelector('#tracklist');
    tracklistDiv.innerHTML = "";
    trackList.forEach((track) => {
        const trackElement = document.createElement('div');
        const artist = document.createElement('span');
        artist.textContent = `${track.artist} - `;
        const title = document.createElement('span');
        title.textContent = `${track.title}`;
        trackElement.addEventListener('click', () => {
            widget.seekTo(convertTimeToSeconds(track.time) * 1000);
        });
        trackElement.appendChild(artist);
        trackElement.appendChild(title);
        tracklistDiv.appendChild(trackElement);
    });
}

var input = document.getElementById('cue').textContent;
const trackList = parseTracklist(input);

const iframeElement = document.querySelector('#soundcloud-player');
const widget = SC.Widget(iframeElement);

widget.bind(SC.Widget.Events.PLAY_PROGRESS, function (event) {
const currentTime = event.currentPosition / 1000;
updatePlayingTrack(currentTime, trackList);
});

//document.addEventListener('DOMContentLoaded', () => {
//    setTimeout(hideLoadingScreen, 3000);
//});
