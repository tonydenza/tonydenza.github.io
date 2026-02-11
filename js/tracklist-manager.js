/**
 * TracklistManager - System for managing tracklists and displaying currently playing tracks
 * for SoundCloud playlists and individual tracks
 */
class TracklistManager {
  constructor() {
    this.tracklists = new Map();
    this.widgets = new Map();
  }

  /**
   * Load tracklists from external JSON file
   */
  async loadTracklists(jsonUrl) {
    try {
      const response = await fetch(jsonUrl);
      const data = await response.json();
      
      // Store all tracklists indexed by mixId
      Object.entries(data).forEach(([mixId, mixData]) => {
        if (mixData.tracklist && mixData.tracklist.trim()) {
          this.registerTracklist(mixId, mixData.tracklist);
        }
      });
      
      return data;
    } catch (error) {
      console.error('Error loading tracklists:', error);
      return null;
    }
  }

  /**
   * Register a tracklist for a specific mix
   */
  registerTracklist(mixId, tracklistString) {
    const tracks = this.parseTracklist(tracklistString);
    this.tracklists.set(mixId, tracks);
  }

  /**
   * Parse tracklist string into structured data
   */
  parseTracklist(input) {
    return input
      .split('\n')
      .map(line => line.trim())
      .filter(line => line.match(/^\d{2}:\d{2}:\d{2}/))
      .map(line => {
        const timeStr = line.substring(0, 8);
        const trackName = line.substring(9).trim();
        return {
          time: this.timeToSeconds(timeStr),
          track: trackName
        };
      });
  }

  /**
   * Convert HH:MM:SS to seconds
   */
  timeToSeconds(timeStr) {
    const [hours, minutes, seconds] = timeStr.split(':').map(Number);
    return (hours * 3600) + (minutes * 60) + seconds;
  }

  /**
   * Find the currently playing track based on current time
   */
  getCurrentTrack(mixId, currentTime) {
    const tracks = this.tracklists.get(mixId);
    if (!tracks || tracks.length === 0) return null;

    for (let i = 0; i < tracks.length; i++) {
      const nextTime = i < tracks.length - 1 ? tracks[i + 1].time : Infinity;
      if (currentTime >= tracks[i].time && currentTime < nextTime) {
        return tracks[i].track;
      }
    }
    return null;
  }

  /**
   * Initialize a SoundCloud widget with tracklist tracking
   */
  initWidget(mixId, iframeId, displayId) {
    if (typeof SC === 'undefined') {
      console.error('SoundCloud Widget API not loaded');
      return;
    }

    const iframe = document.getElementById(iframeId);
    if (!iframe) {
      console.error(`Iframe with id '${iframeId}' not found`);
      return;
    }

    const widget = SC.Widget(iframe);
    
    widget.bind(SC.Widget.Events.READY, () => {
      widget.bind(SC.Widget.Events.PLAY_PROGRESS, (event) => {
        const currentTime = Math.floor(event.currentPosition / 1000);
        const currentTrack = this.getCurrentTrack(mixId, currentTime);
        
        const displayElement = document.getElementById(displayId);
        if (displayElement) {
          if (currentTrack) {
            displayElement.textContent = currentTrack;
            displayElement.parentElement.style.display = 'block';
          } else {
            displayElement.textContent = '-';
          }
        }
      });

      widget.bind(SC.Widget.Events.PAUSE, () => {
        const displayElement = document.getElementById(displayId);
        if (displayElement && displayElement.parentElement) {
          displayElement.parentElement.style.opacity = '0.6';
        }
      });

      widget.bind(SC.Widget.Events.PLAY, () => {
        const displayElement = document.getElementById(displayId);
        if (displayElement && displayElement.parentElement) {
          displayElement.parentElement.style.opacity = '1';
        }
      });
    });

    this.widgets.set(mixId, widget);
  }

  /**
   * Get a widget by mixId
   */
  getWidget(mixId) {
    return this.widgets.get(mixId);
  }
}

// Make available globally
if (typeof window !== 'undefined') {
  window.TracklistManager = TracklistManager;
}
