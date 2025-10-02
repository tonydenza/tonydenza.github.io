// Wait for the page to fully load
      window.addEventListener('load', function () {

        document.getElementById("heading").addEventListener('mouseenter', function (e) {
          console.log('Simulating Numpad1 keydown for 1 second');

          const keydown5 = new KeyboardEvent('keydown', {
            key: '5',
            code: 'Numpad5',
            keyCode: 97, // Numpad1
            which: 97,
            location: KeyboardEvent.DOM_KEY_LOCATION_NUMPAD,
            bubbles: true,
            cancelable: true
          });

          const keyup5 = new KeyboardEvent('keyup', {
            key: '5',
            code: 'Numpad5',
            keyCode: 97,
            which: 97,
            location: KeyboardEvent.DOM_KEY_LOCATION_NUMPAD,
            bubbles: true,
            cancelable: true
          });

          // Dispatch keydown
          document.dispatchEvent(keydown5);

          // After 1 second, dispatch keyup
          setTimeout(() => {
            console.log('Simulating Numpad5 keyup');
            document.dispatchEvent(keyup5);
          }, 2000);
        });


        document.getElementById("tagline").addEventListener('mouseenter', function (e) {
          console.log('Simulating Numpad1 keydown for 1 second');

          const keydown5 = new KeyboardEvent('keydown', {
            key: '5',
            code: 'Numpad5',
            keyCode: 97, // Numpad1
            which: 97,
            location: KeyboardEvent.DOM_KEY_LOCATION_NUMPAD,
            bubbles: true,
            cancelable: true
          });

          const keyup5 = new KeyboardEvent('keyup', {
            key: '5',
            code: 'Numpad5',
            keyCode: 97,
            which: 97,
            location: KeyboardEvent.DOM_KEY_LOCATION_NUMPAD,
            bubbles: true,
            cancelable: true
          });

          // Dispatch keydown
          document.dispatchEvent(keydown5);

          // After 1 second, dispatch keyup
          setTimeout(() => {
            console.log('Simulating Numpad5 keyup');
            document.dispatchEvent(keyup5);
          }, 2000);
        });

        document.getElementById("synth-podcast").addEventListener('mouseenter', function (e) {
          console.log('Simulating Numpad1 keydown for 1 second');

          const keydown1 = new KeyboardEvent('keydown', {
            key: '1',
            code: 'Numpad1',
            keyCode: 97, // Numpad1
            which: 97,
            location: KeyboardEvent.DOM_KEY_LOCATION_NUMPAD,
            bubbles: true,
            cancelable: true
          });

          const keyup1 = new KeyboardEvent('keyup', {
            key: '1',
            code: 'Numpad1',
            keyCode: 97,
            which: 97,
            location: KeyboardEvent.DOM_KEY_LOCATION_NUMPAD,
            bubbles: true,
            cancelable: true
          });

          // Dispatch keydown
          document.dispatchEvent(keydown1);

          // After 1 second, dispatch keyup
          setTimeout(() => {
            console.log('Simulating Numpad1 keyup');
            document.dispatchEvent(keyup1);
          }, 2000);
        });

        document.getElementById("synth-mixseries").addEventListener('mouseenter', function (e) {
          console.log('Simulating Numpad1 keydown for 1 second');

          const keydown2 = new KeyboardEvent('keydown', {
            key: '2',
            code: 'Numpad2',
            keyCode: 97, // Numpad1
            which: 97,
            location: KeyboardEvent.DOM_KEY_LOCATION_NUMPAD,
            bubbles: true,
            cancelable: true
          });

          const keyup2 = new KeyboardEvent('keyup', {
            key: '2',
            code: 'Numpad2',
            keyCode: 97,
            which: 97,
            location: KeyboardEvent.DOM_KEY_LOCATION_NUMPAD,
            bubbles: true,
            cancelable: true
          });

          // Dispatch keydown
          document.dispatchEvent(keydown2);

          // After 1 second, dispatch keyup
          setTimeout(() => {
            console.log('Simulating Numpad2 keyup');
            document.dispatchEvent(keyup2);
          }, 2000);
        });

        document.getElementById("synth-hosting").addEventListener('mouseenter', function (e) {
          console.log('Simulating Numpad1 keydown for 1 second');

          const keydown3 = new KeyboardEvent('keydown', {
            key: '3',
            code: 'Numpad3',
            keyCode: 97, // Numpad1
            which: 97,
            location: KeyboardEvent.DOM_KEY_LOCATION_NUMPAD,
            bubbles: true,
            cancelable: true
          });

          const keyup3 = new KeyboardEvent('keyup', {
            key: '3',
            code: 'Numpad3',
            keyCode: 97,
            which: 97,
            location: KeyboardEvent.DOM_KEY_LOCATION_NUMPAD,
            bubbles: true,
            cancelable: true
          });

          // Dispatch keydown
          document.dispatchEvent(keydown3);

          // After 1 second, dispatch keyup
          setTimeout(() => {
            console.log('Simulating Numpad3 keyup');
            document.dispatchEvent(keyup3);
          }, 2000);
        });

        document.getElementById("synth-expeditions").addEventListener('mouseenter', function (e) {
          console.log('Simulating Numpad1 keydown for 1 second');

          const keydown4 = new KeyboardEvent('keydown', {
            key: '4',
            code: 'Numpad4',
            keyCode: 97, // Numpad1
            which: 97,
            location: KeyboardEvent.DOM_KEY_LOCATION_NUMPAD,
            bubbles: true,
            cancelable: true
          });

          const keyup4 = new KeyboardEvent('keyup', {
            key: '4',
            code: 'Numpad4',
            keyCode: 97,
            which: 97,
            location: KeyboardEvent.DOM_KEY_LOCATION_NUMPAD,
            bubbles: true,
            cancelable: true
          });

          // Dispatch keydown
          document.dispatchEvent(keydown4);

          // After 1 second, dispatch keyup
          setTimeout(() => {
            console.log('Simulating Numpad4 keyup');
            document.dispatchEvent(keyup4);
          }, 2000);
        });

        document.getElementById("synth-utilities").addEventListener('mouseenter', function (e) {
          console.log('Simulating Numpad1 keydown for 1 second');

          const keydown5 = new KeyboardEvent('keydown', {
            key: '5',
            code: 'Numpad5',
            keyCode: 97, // Numpad1
            which: 97,
            location: KeyboardEvent.DOM_KEY_LOCATION_NUMPAD,
            bubbles: true,
            cancelable: true
          });

          const keyup5 = new KeyboardEvent('keyup', {
            key: '5',
            code: 'Numpad5',
            keyCode: 97,
            which: 97,
            location: KeyboardEvent.DOM_KEY_LOCATION_NUMPAD,
            bubbles: true,
            cancelable: true
          });

          // Dispatch keydown
          document.dispatchEvent(keydown5);

          // After 1 second, dispatch keyup
          setTimeout(() => {
            console.log('Simulating Numpad5 keyup');
            document.dispatchEvent(keyup5);
          }, 2000);
        });

        // Optional: To prevent the default keyup behavior (which would stop the "holding")
        document.addEventListener('keyup', function (e) {
          if ((e.code === 'Numpad1' || e.code === 'Numpad2') &&
            e.location === KeyboardEvent.DOM_KEY_LOCATION_NUMPAD) {
            e.preventDefault();
            console.log('Prevented keyup for ' + e.code);
          }
        }, true);
      });