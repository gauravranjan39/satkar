var Speech = (function(window, document) {
  function speech2text() {
    try {
      this.SpeechRecognition =
        window.SpeechRecognition ||
        window.webkitSpeechRecognition ||
        window.mozSpeechRecognition ||
        window.msSpeechRecognition ||
        window.oSpeechRecognition;
      this.recognition = new this.SpeechRecognition();
      this.recognition.continuous = true;
    } catch (e) {
      alert(
        "Sorry, Your Browser Doesn't Support the Web Speech API. Try Opening This Demo In Google Chrome."
      );
    }
  }

  speech2text.prototype.onResult = function(cb) {
    var that = this;
    this.recognition.onresult = function(event) {
      var current = event.resultIndex;
      var transcript = event.results[current][0].transcript;
      var mobileRepeatBug =
        current == 1 && transcript == event.results[0][0].transcript;
      transcript = transcript.toLowerCase().trim();
      if (!mobileRepeatBug) {
        if (
          typeof that.commands === "object" &&
          Object.keys(that.commands).length &&
          transcript in that.commands
        ) {
          that.commands[transcript]();
        }
      }
      cb(transcript);
    };
  }

  speech2text.prototype.start = function(cb) {
    this.recognition.start();
    this.onResult(cb);
  };

  speech2text.prototype.stop = function() {
    this.recognition.stop();
  };

  speech2text.prototype.onStart = function(cb) {
    this.recognition.onstart = cb;
  };

  speech2text.prototype.onPause = function(cb) {
    this.recognition.onspeechend = cb;
  };

  speech2text.prototype.onListen = function(cb) {
    return cb;
  };

  speech2text.prototype.onError = function(cb) {
    this.recognition.onerror = cb;
  };

  speech2text.prototype.addCommands = function(commands) {
    this.commands = commands;
  };

  speech2text.prototype.onReadLoud = function(message) {
    var speech = new window.SpeechSynthesisUtterance();
    speech.text = message;
    speech.volume = 1;
    speech.rate = 1;
    speech.pitch = 1;
    window.speechSynthesis.speak(speech);
    return true;
  };
  return (window.speech2text = speech2text);
})(window, document);
