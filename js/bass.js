export class BassEffect {
  constructor(element) {
      this.element = element;
      this.audioContext = null;
      this.oscillator = null;
      this.gainNode = null;
      this.isInitialized = false;

      // Bind methods to ensure correct 'this' context
      this.startEffect = this.startEffect.bind(this);
      this.stopEffect = this.stopEffect.bind(this);
      this.cleanupAudio = this.cleanupAudio.bind(this);

      this.element.addEventListener('mouseenter', this.startEffect);
      this.element.addEventListener('mouseleave', this.stopEffect);
      // Cleanup on page unload
      window.addEventListener('unload', this.cleanupAudio);
  }

  cleanupAudio() {
      if (this.oscillator) {
          try {
              this.oscillator.stop();
              this.oscillator.disconnect();
              this.oscillator = null;
          } catch (error) {
              console.log('Oscillator cleanup failed:', error);
          }
      }

      if (this.gainNode) {
          try {
              this.gainNode.disconnect();
              this.gainNode = null;
          } catch (error) {
              console.log('GainNode cleanup failed:', error);
          }
      }

      if (this.audioContext) {
          try {
              this.audioContext.close();
              this.audioContext = null;
          } catch (error) {
              console.log('AudioContext cleanup failed:', error);
          }
      }

      this.isInitialized = false;
  }

  async startEffect() {
      // Clean up any existing audio before starting
      this.cleanupAudio();

      try {
          this.audioContext = new (window.AudioContext || window.webkitAudioContext)();
          
          if (this.audioContext.state === 'suspended') {
              await this.audioContext.resume();
          }

          this.gainNode = this.audioContext.createGain();
          this.gainNode.connect(this.audioContext.destination);
          
          this.oscillator = this.audioContext.createOscillator();
          this.oscillator.type = 'sine';
          this.oscillator.frequency.setValueAtTime(50, this.audioContext.currentTime);
          this.gainNode.gain.setValueAtTime(0.3, this.audioContext.currentTime);
          
          this.oscillator.connect(this.gainNode);
          this.oscillator.start();
          this.isInitialized = true;
      } catch (error) {
          console.log('Audio initialization failed:', error);
          this.cleanupAudio();
      }
  }

  stopEffect() {
      this.cleanupAudio();
  }
}

// Initialize
document.addEventListener('DOMContentLoaded', () => {
  const bassText = document.querySelector('.bass-text');
  if (bassText) {
      new BassEffect(bassText);
  }
});