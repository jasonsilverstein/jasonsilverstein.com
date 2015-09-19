(function() {
  window.Empyre || (window.Empyre = {
    App: {
      config: {
        mediumScreen: 640,
        largeScreen: 1024,
        debugMode: false
      }
    }
  });

  window.Empyre.Origin = {
    version: '1.0.15'
  };

}).call(this);

(function() {
  var bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  Empyre.Origin || (Empyre.Origin = {});

  Empyre.Origin.Inform = (function() {
    var ContextualInform, ContextualInformsByNameMap, Inform, globalInform, logHandler, merge, moduleId;
    moduleId = 'Inform';
    Inform = {};
    ContextualInformsByNameMap = {};
    logHandler = void 0;
    Inform.DEBUG = {
      value: 1,
      name: 'DEBUG'
    };
    Inform.INFO = {
      value: 2,
      name: 'INFO'
    };
    Inform.WARN = {
      value: 4,
      name: 'WARN'
    };
    Inform.ERROR = {
      value: 8,
      name: 'ERROR'
    };
    Inform.OFF = {
      value: 99,
      name: 'OFF'
    };
    merge = function() {
      var args, i, key, target;
      args = arguments;
      target = args[0];
      key = void 0;
      i = void 0;
      i = 1;
      while (i < args.length) {
        for (key in args[i]) {
          if ((!(key in target)) && args[i].hasOwnProperty(key)) {
            target[key] = args[i][key];
          }
        }
        i++;
      }
      return target;
    };
    ContextualInform = (function() {
      function ContextualInform(defaultContext) {
        this.invoke = bind(this.invoke, this);
        this.error = bind(this.error, this);
        this.warn = bind(this.warn, this);
        this.info = bind(this.info, this);
        this.debug = bind(this.debug, this);
        this.enabledFor = bind(this.enabledFor, this);
        this.setLevel = bind(this.setLevel, this);
        this.context = defaultContext;
        this.setLevel(defaultContext.filterLevel);
        this.log = this.info;
      }

      ContextualInform.prototype.setLevel = function(newLevel) {
        if (newLevel && 'value' in newLevel) {
          return this.context.filterLevel = newLevel;
        }
      };

      ContextualInform.prototype.enabledFor = function(level) {
        var filterLevel;
        filterLevel = this.context.filterLevel;
        return level.value >= filterLevel.value;
      };

      ContextualInform.prototype.debug = function() {
        return this.invoke(Inform.DEBUG, arguments);
      };

      ContextualInform.prototype.info = function() {
        return this.invoke(Inform.INFO, arguments);
      };

      ContextualInform.prototype.warn = function() {
        return this.invoke(Inform.WARN, arguments);
      };

      ContextualInform.prototype.error = function() {
        return this.invoke(Inform.ERROR, arguments);
      };

      ContextualInform.prototype.invoke = function(level, msgArgs) {
        if (logHandler && this.enabledFor(level)) {
          return logHandler(msgArgs, merge({
            level: level
          }, this.context));
        }
      };

      return ContextualInform;

    })();
    globalInform = new ContextualInform({
      filterLevel: Inform.OFF
    });
    Inform.enabledFor = globalInform.enabledFor.bind(globalInform);
    Inform.debug = globalInform.debug.bind(globalInform);
    Inform.info = globalInform.info.bind(globalInform);
    Inform.warn = globalInform.warn.bind(globalInform);
    Inform.error = globalInform.error.bind(globalInform);
    Inform.log = Inform.info;
    Inform.setHandler = function(func) {
      return logHandler = func;
    };
    Inform.setLevel = function(level) {
      var key, results;
      globalInform.setLevel(level);
      results = [];
      for (key in ContextualInformsByNameMap) {
        if (ContextualInformsByNameMap.hasOwnProperty(key)) {
          results.push(ContextualInformsByNameMap[key].setLevel(level));
        } else {
          results.push(void 0);
        }
      }
      return results;
    };
    Inform.get = function(name) {
      return ContextualInformsByNameMap[name] || (ContextualInformsByNameMap[name] = new ContextualInform(merge({
        name: name
      }, globalInform.context)));
    };
    Inform.useDefaults = function(defaultLevel) {
      if (!('console' in window)) {
        return;
      }
      if (Empyre.App.config.debugMode !== true) {
        return;
      }
      Inform.setLevel(defaultLevel || Inform.DEBUG);
      return Inform.setHandler(function(messages, context) {
        var console, hdlr, messagePrefix;
        console = window.console;
        hdlr = console.log;
        messagePrefix = '[Empyre]';
        if (context.name) {
          messagePrefix += '[' + context.name + ']';
        }
        messagePrefix += ' ';
        if (context.level === Inform.DEBUG && console.debug) {
          console.debug(messagePrefix);
          hdlr = console.debug;
        } else {
          messages[0] = messagePrefix + messages[0];
          if (context.level === Inform.WARN && console.warn) {
            hdlr = console.warn;
          } else if (context.level === Inform.ERROR && console.error) {
            hdlr = console.error;
          } else if (context.level === Inform.INFO && console.info) {
            hdlr = console.info;
          }
        }
        return hdlr.apply(console, messages);
      });
    };
    Inform.useDefaults();
    return Inform;
  })();

}).call(this);

(function() {
  Empyre.Origin || (Empyre.Origin = {});

  Empyre.Origin.Utilities = (function($) {
    var config, delay, inform, init, moduleId, msieVersion, notify, onAjaxError, screenSize;
    moduleId = 'Utilities';
    inform = Empyre.Origin.Inform.get(moduleId);
    config = Empyre.App.config;
    notify = Empyre.Origin.Notify;
    $.extend($.expr[":"], {
      'contains-ins': function(elem, i, match, array) {
        return (elem.textContent || elem.innerText || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
      }
    });
    $.fn.randomize = function(selector) {
      return (selector ? this.find(selector) : this).parent().each(function() {
        return $(this).children(selector).sort(function() {
          return Math.random() - 0.5;
        });
      });
    };
    $.fn.randomizeInPlace = function(selector) {
      return (selector ? this.find(selector) : this).parent().each(function() {
        return $(this).children(selector).sort(function() {
          return Math.random() - 0.5;
        }).detach().appendTo(this);
      });
    };
    delay = function(ms, func) {
      return setTimeout(func, ms);
    };
    msieVersion = function() {
      var msie, ua;
      ua = window.navigator.userAgent;
      msie = ua.indexOf('MSIE ');
      if (msie > 0) {
        return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)));
      }
      return false;
    };
    onAjaxError = function(XMLHttpRequest, textStatus, showError, message) {
      var response, responseMessage;
      response = $.parseJSON(XMLHttpRequest.responseText);
      responseMessage = response.message + ': ' + response.description;
      message || (message = responseMessage);
      inform.warn(textStatus);
      inform.debug(response);
      if (showError) {
        return notify.error(message);
      }
    };
    screenSize = function() {
      var queryMedium, querySmall;
      querySmall = 'screen and (max-width: ' + config.mediumScreen + 'px)';
      queryMedium = 'screen and (min-width: ' + config.mediumScreen + 'px) and (max-width: ' + config.largeScreen + 'px)';
      if (window.matchMedia(querySmall).matches) {
        return 'small';
      } else if (window.matchMedia(queryMedium).matches) {
        return 'medium';
      } else {
        return 'large';
      }
    };
    init = function() {
      $('[data-target-new]').attr('target', '_blank');
      $('[data-history-back]').click(function() {
        window.history.back();
        return false;
      });
      return $('form').attr('novalidate', '');
    };
    $(document).ready(function() {
      return init();
    });
    return {
      delay: delay,
      screenSize: screenSize,
      msieVersion: msieVersion,
      onAjaxError: onAjaxError
    };
  })(jQuery.noConflict());

}).call(this);

(function() {
  Empyre.Origin || (Empyre.Origin = {});

  Empyre.Origin.Accordions = (function($) {
    var accordionSelector, closePanels, inform, init, moduleId, openPanel;
    moduleId = 'Accordions';
    inform = Empyre.Origin.Inform.get(moduleId);
    accordionSelector = '.accordion';
    closePanels = function($accordion, animated) {
      var $openPanels;
      if (animated == null) {
        animated = true;
      }
      $openPanels = $('>dt.open', $accordion);
      if (animated) {
        $openPanels.removeClass('open').next('dd').velocity('slideUp', {
          duration: 400,
          easing: 'easeOutQuint',
          queue: false,
          complete: function() {
            return $accordion.data('locked', false);
          }
        });
      } else {
        $openPanels.removeClass('open').next('dd').hide();
      }
      return false;
    };
    openPanel = function($panel, animated) {
      var $accordion;
      if (animated == null) {
        animated = true;
      }
      $accordion = $panel.closest(accordionSelector);
      $panel.addClass('open');
      if (animated) {
        $panel.addClass('open').next('dd').velocity('slideDown', {
          duration: 400,
          easing: 'easeOutQuint',
          queue: false,
          complete: function() {
            return $accordion.data('locked', false);
          }
        });
      } else {
        $panel.next('dd').show();
      }
      return false;
    };
    init = function() {
      $(accordionSelector).each(function(i) {
        var $openPanels, $panels, self;
        self = this;
        $panels = $('>dt', this);
        $openPanels = $panels.filter('.open');
        $(this).data('locked', false);
        if ($openPanels.length) {
          $openPanels.each(function() {
            return openPanel($(this), false);
          });
        }
        return $panels.each(function() {
          var $panel;
          $panel = $(this).closest('dt');
          return $('>a', this).on('click', function(e) {
            e.preventDefault();
            if (!$(self).data('locked')) {
              $(self).data('locked', true);
              if ($panel.hasClass('open')) {
                closePanels($(self));
              } else {
                closePanels($(self));
                openPanel($panel);
              }
            }
            return false;
          });
        });
      });
      return false;
    };
    $(document).ready(function() {
      return init();
    });
    return {
      closePanels: closePanels,
      openPanel: openPanel
    };
  })(jQuery.noConflict());

}).call(this);

(function() {
  Empyre.Origin || (Empyre.Origin = {});

  Empyre.Origin.AudioPlayer = (function($) {
    var canPlayType, eCancel, eEnd, eMove, eStart, inform, isTouch, moduleId, secondsToTime;
    moduleId = 'AudioPlayer';
    inform = Empyre.Origin.Inform.get(moduleId);
    isTouch = 'ontouchstart' in window;
    eStart = isTouch ? 'touchstart' : 'mousedown';
    eMove = isTouch ? 'touchmove' : 'mousemove';
    eEnd = isTouch ? 'touchend' : 'mouseup';
    eCancel = isTouch ? 'touchcancel' : 'mouseup';
    canPlayType = function(file) {
      var audioElement;
      audioElement = document.createElement('audio');
      return !!(audioElement.canPlayType && audioElement.canPlayType('audio/' + file.split('.').pop().toLowerCase() + ';').replace(/no/, ""));
    };
    secondsToTime = function(secs) {
      var hours, hoursDiv, minutes, minutesDiv, seconds;
      hoursDiv = secs / 3600;
      hours = Math.floor(hoursDiv);
      minutesDiv = secs % 3600 / 60;
      minutes = Math.floor(minutesDiv);
      seconds = Math.ceil(secs % 3600 % 60);
      if (seconds > 59) {
        seconds = 0;
        minutes = Math.ceil(minutesDiv);
      }
      if (minutes > 59) {
        minutes = 0;
        hours = Math.ceil(hoursDiv);
      }
      return (hours === 0 ? "" : (hours > 0 && hours.toString().length < 2 ? "0" + hours + ":" : hours + ":")) + (minutes.toString().length < 2 ? "0" + minutes : minutes) + ":" + (seconds.toString().length < 2 ? "0" + seconds : seconds);
    };
    $.fn.audioPlayer = function(params) {
      var cssClass, cssClassSub, subName;
      params = $.extend({
        classPrefix: 'audioplayer',
        strPlay: 'Play',
        strPause: 'Pause',
        strVolume: 'Volume'
      }, params);
      cssClass = {};
      cssClassSub = {
        playPause: 'playpause',
        playing: 'playing',
        stopped: 'stopped',
        time: 'time',
        timeCurrent: 'time-current',
        timeDuration: 'time-duration',
        bar: 'bar',
        barLoaded: 'bar-loaded',
        barPlayed: 'bar-played',
        volume: 'volume',
        volumeButton: 'volume-button',
        volumeAdjust: 'volume-adjust',
        noVolume: 'novolume',
        muted: 'muted',
        mini: 'mini'
      };
      for (subName in cssClassSub) {
        cssClass[subName] = params.classPrefix + '-' + cssClassSub[subName];
      }
      return this.each(function() {
        var $this, adjustCurrentTime, adjustVolume, audioFile, audioTag, barLoaded, barPlayed, isAutoPlay, isLoop, isSupport, theAudio, theBar, thePlayer, timeCurrent, timeDuration, updateLoadBar, volumeAdjuster, volumeButton, volumeDefault, volumeTestDefault, volumeTestValue;
        if ($(this).prop('tagName').toLowerCase() !== 'audio') {
          return false;
        }
        $this = $(this);
        audioFile = $this.attr('src');
        isSupport = false;
        isAutoPlay = $this.get(0).getAttribute('autoplay');
        isAutoPlay = (isAutoPlay === "" || isAutoPlay === 'autoplay' ? true : false);
        isLoop = $this.get(0).getAttribute('loop');
        isLoop = (isLoop === "" || isLoop === 'loop' ? true : false);
        if (typeof audioFile === 'undefined') {
          $('source', $this).each(function() {
            audioFile = $(this).attr('src');
            if (typeof audioFile !== 'undefined' && canPlayType(audioFile)) {
              isSupport = true;
              return false;
            }
          });
        } else {
          if (canPlayType(audioFile)) {
            isSupport = true;
          }
        }
        thePlayer = $('<div class="not-fitvid ' + params.classPrefix + '">' + (isSupport ? $('<div>').append($this.eq(0).clone()).html() : '<embed src="' + audioFile + '" width=0 height=0 volume=100 autostart="' + isAutoPlay.toString() + '" type="audio/mpeg" loop="' + isLoop.toString() + '" />') + '<div class="' + cssClass.playPause + '" title="' + params.strPlay + '"><a href="#">"' + params.strPlay + '"</a></div></div>');
        audioTag = isSupport ? 'audio' : 'embed';
        theAudio = $(audioTag, thePlayer).get(0);
        if (isSupport) {
          adjustCurrentTime = function(e) {
            var theRealEvent;
            theRealEvent = (isTouch ? e.originalEvent.touches[0] : e);
            theAudio.currentTime = Math.round((theAudio.duration * (theRealEvent.pageX - theBar.offset().left)) / theBar.width());
          };
          adjustVolume = function(e) {
            var theRealEvent;
            theRealEvent = (isTouch ? e.originalEvent.touches[0] : e);
            theAudio.volume = Math.abs((theRealEvent.pageY - (volumeAdjuster.offset().top + volumeAdjuster.height())) / volumeAdjuster.height());
          };
          updateLoadBar = function() {
            var interval;
            interval = setInterval(function() {
              if (theAudio.buffered.length < 1) {
                return true;
              }
              barLoaded.width((theAudio.buffered.end(0) / theAudio.duration) * 100 + "%");
              if (Math.floor(theAudio.buffered.end(0)) >= Math.floor(theAudio.duration)) {
                clearInterval(interval);
              }
            }, 100);
          };
          volumeDefault = 0;
          $('audio', thePlayer).css({
            width: 0,
            height: 0,
            visibility: 'hidden'
          });
          thePlayer.append('<div class="' + cssClass.time + ' ' + cssClass.timeCurrent + '"></div><div class="' + cssClass.bar + '"><div class="' + cssClass.barLoaded + '"></div><div class="' + cssClass.barPlayed + '"></div></div><div class="' + cssClass.time + ' ' + cssClass.timeDuration + '"></div><div class="' + cssClass.volume + '"><div class="' + cssClass.volumeButton + '" title="' + params.strVolume + '"><a href="#">"' + params.strVolume + '"</a></div><div class="' + cssClass.volumeAdjust + '"><div><div></div></div></div></div>');
          theBar = $('.' + cssClass.bar, thePlayer);
          barPlayed = $('.' + cssClass.barPlayed, thePlayer);
          barLoaded = $('.' + cssClass.barLoaded, thePlayer);
          timeCurrent = $('.' + cssClass.timeCurrent, thePlayer);
          timeDuration = $('.' + cssClass.timeDuration, thePlayer);
          volumeButton = $('.' + cssClass.volumeButton, thePlayer);
          volumeAdjuster = $('.' + cssClass.volumeAdjust + ' > div', thePlayer);
          volumeTestDefault = theAudio.volume;
          volumeTestValue = theAudio.volume = 0.111;
          if (Math.round(theAudio.volume * 1000) / 1000 === volumeTestValue) {
            theAudio.volume = volumeTestDefault;
          } else {
            thePlayer.addClass(cssClass.noVolume);
          }
          timeDuration.html('&hellip;');
          timeCurrent.html(secondsToTime(0));
          theAudio.addEventListener('loadeddata', function() {
            updateLoadBar();
            timeDuration.html(($.isNumeric(theAudio.duration) ? secondsToTime(theAudio.duration) : '&hellip;'));
            volumeAdjuster.find('div').height(theAudio.volume * 100 + '%');
            volumeDefault = theAudio.volume;
          });
          theAudio.addEventListener('timeupdate', function() {
            timeCurrent.html(secondsToTime(theAudio.currentTime));
            barPlayed.width((theAudio.currentTime / theAudio.duration) * 100 + '%');
          });
          theAudio.addEventListener('volumechange', function() {
            volumeAdjuster.find('div').height(theAudio.volume * 100 + '%');
            if (theAudio.volume > 0 && thePlayer.hasClass(cssClass.muted)) {
              thePlayer.removeClass(cssClass.muted);
            }
            if (theAudio.volume <= 0 && !thePlayer.hasClass(cssClass.muted)) {
              thePlayer.addClass(cssClass.muted);
            }
          });
          theAudio.addEventListener('ended', function() {
            thePlayer.removeClass(cssClass.playing).addClass(cssClass.stopped);
          });
          theBar.on(eStart, function(e) {
            adjustCurrentTime(e);
            theBar.on(eMove, function(e) {
              adjustCurrentTime(e);
            });
          }).on(eCancel, function() {
            theBar.unbind(eMove);
          });
          volumeButton.on('click', function() {
            if (thePlayer.hasClass(cssClass.muted)) {
              thePlayer.removeClass(cssClass.muted);
              theAudio.volume = volumeDefault;
            } else {
              thePlayer.addClass(cssClass.muted);
              volumeDefault = theAudio.volume;
              theAudio.volume = 0;
            }
            return false;
          });
          volumeAdjuster.on(eStart, function(e) {
            adjustVolume(e);
            volumeAdjuster.on(eMove, function(e) {
              adjustVolume(e);
            });
          }).on(eCancel, function() {
            volumeAdjuster.unbind(eMove);
          });
        } else {
          thePlayer.addClass(cssClass.mini);
        }
        thePlayer.addClass(isAutoPlay ? cssClass.playing : cssClass.stopped);
        $('.' + cssClass.playPause, thePlayer).on('click', function() {
          if (thePlayer.hasClass(cssClass.playing)) {
            $(this).attr('title', params.strPlay).find('a').html(params.strPlay);
            thePlayer.removeClass(cssClass.playing).addClass(cssClass.stopped);
            if (isSupport) {
              theAudio.pause();
            } else {
              theAudio.Stop();
            }
          } else {
            $(this).attr('title', params.strPause).find('a').html(params.strPause);
            thePlayer.addClass(cssClass.playing).removeClass(cssClass.stopped);
            if (isSupport) {
              theAudio.play();
            } else {
              theAudio.Play();
            }
          }
          return false;
        });
        $this.replaceWith(thePlayer);
      });
    };
    return $(document).ready(function() {
      return $('audio').audioPlayer();
    });
  })(jQuery.noConflict());

}).call(this);

(function() {
  Empyre.Origin || (Empyre.Origin = {});

  Empyre.Origin.Notify = (function($) {
    var $nb, close, easingIn, easingOut, inform, moduleId, nbTimeout, notifyBarHTML, open, pauseDuration, timerClass, transitionSpeed;
    moduleId = 'Notify';
    inform = Empyre.Origin.Inform.get(moduleId);
    easingIn = 'easeOutCirc';
    easingOut = 'easeInExpo';
    nbTimeout = '';
    notifyBarHTML = '<div id="notify-bar"><div class="message"></div><a href="#" class="close" data-close>&times;</div>';
    pauseDuration = 6000;
    timerClass = 'timer';
    transitionSpeed = 300;
    $nb = {};
    close = function() {
      var inline;
      inline = $nb.hasClass('inline');
      if (inline) {
        return $nb.velocity({
          'margin-top': -$nb.outerHeight()
        }, {
          duration: transitionSpeed / 1.5,
          easing: easingOut,
          queue: false,
          complete: function() {
            return $nb.hide();
          }
        });
      } else {
        return $nb.velocity({
          translateY: '-100%'
        }, {
          duration: transitionSpeed / 1.5,
          easing: easingOut,
          queue: false,
          complete: function() {
            clearTimeout(nbTimeout);
            return $nb.removeAttr('style').hide();
          }
        });
      }
    };
    open = function(type, message, duration, sticky, inline, showTime) {
      type || (type = 'default');
      duration || (duration = pauseDuration);
      sticky || (sticky = false);
      inline || (inline = false);
      showTime || (showTime = false);
      clearTimeout(nbTimeout);
      $('.message', $nb).html(message);
      $('.' + timerClass, $nb).remove();
      $nb.removeClass('inline').removeAttr('style').attr('class', type);
      $('a[data-close]', $nb).on('click', function(e) {
        e.preventDefault();
        return close();
      });
      if (inline) {
        $nb.addClass('inline').show().velocity({
          'margin-top': [0, -$nb.outerHeight()]
        }, {
          duration: transitionSpeed,
          easing: easingIn,
          queue: false
        });
      } else {
        $nb.show().velocity({
          translateY: [0, '-100%']
        }, {
          duration: transitionSpeed,
          easing: easingIn,
          queue: false
        });
      }
      if (!sticky) {
        nbTimeout = setTimeout(close, duration);
        if (showTime) {
          return $('<div>').addClass(timerClass).prependTo($nb).velocity({
            width: ['100%', 0]
          }, {
            duration: duration,
            easing: 'linear',
            queue: false
          });
        }
      }
    };
    $(document).ready(function() {
      $('body').prepend(notifyBarHTML);
      $nb = $('#notify-bar');
      return $nb.hide();
    });
    $(document).on('keydown', function(e) {
      if (e.keyCode === 27) {
        close();
      }
    });
    return {
      close: close,
      open: open
    };
  })(jQuery.noConflict());

}).call(this);

(function() {
  Empyre.Origin || (Empyre.Origin = {});

  Empyre.Origin.NavPrimary = (function($) {
    var activeClass, closeNode, defaults, inform, init, levelClass, moduleId, navPrimarySelector, navToggleCloseHTML, navToggleOpenHTML, navToggleSelector, nodeClass, openClass, openNode, reset;
    moduleId = 'Nav Primary';
    inform = Empyre.Origin.Inform.get(moduleId);
    activeClass = 'np-active';
    levelClass = 'np-level';
    navPrimarySelector = '.nav-primary';
    navToggleCloseHTML = '<i class="fa fa-minus"></i>';
    navToggleOpenHTML = '<i class="fa fa-bars"></i>';
    navToggleSelector = '.np-toggle';
    nodeClass = 'np-node';
    openClass = 'np-open';
    defaults = {
      easing: 'easeOutCirc',
      nodeTransitionDuration: 300
    };
    closeNode = function($node) {
      $node.closest('li').removeClass(openClass).end().velocity('stop').velocity({
        height: 0
      }, {
        display: 'none',
        duration: defaults.nodeTransitionDuration,
        easing: defaults.easing,
        queue: false
      });
    };
    openNode = function($node) {
      $node.closest('li').addClass(openClass).end().css({
        'height': 'auto'
      }).velocity('stop').velocity({
        height: [$node.outerHeight(), 0]
      }, {
        display: 'block',
        duration: defaults.nodeTransitionDuration,
        easing: defaults.easing,
        queue: false,
        complete: function() {
          $(this).css('height', 'auto');
        }
      });
    };
    reset = function() {
      $(navPrimarySelector).each(function() {
        $('ul', this).removeAttr('style');
        $('.' + openClass, this).removeClass(openClass);
        return $(navToggleSelector, this).html(navToggleOpenHTML);
      });
    };
    init = function() {
      $(navPrimarySelector).each(function() {
        var $nodes, $rootNode, $toggleSelector, self;
        self = this;
        $nodes = $('ul', this);
        $rootNode = $('> ul', this).first();
        $toggleSelector = $(navToggleSelector, this);
        $nodes.each(function() {
          var level, node;
          node = this;
          level = parseInt($(this).parentsUntil(self, 'ul').length + 1);
          return $(this).addClass(levelClass + '-' + level).closest('li').addClass(nodeClass).children(':first-child').on('click', function(e) {
            e.stopPropagation();
            if (Empyre.Origin.Utilities.screenSize() === 'small') {
              e.preventDefault();
              if ($(node).closest('li').hasClass(openClass)) {
                closeNode($(node));
              } else {
                openNode($(node));
              }
            }
          });
        });
        if ($rootNode.hasClass(openClass)) {
          $toggleSelector.html(navToggleCloseHTML);
        } else {
          $toggleSelector.html(navToggleOpenHTML);
        }
        $toggleSelector.on('click', function(e) {
          if ($rootNode.hasClass(openClass)) {
            $rootNode.removeClass(openClass);
            $(this).html(navToggleOpenHTML);
            return closeNode($rootNode);
          } else {
            $rootNode.addClass(openClass);
            $(this).html(navToggleCloseHTML);
            return openNode($rootNode);
          }
        });
      });
    };
    $(document).ready(function() {
      var windowWidth;
      windowWidth = $(window).width();
      init();
      return $(window).resize(function() {
        if ($(window).width() !== windowWidth) {
          windowWidth = $(window).width();
          return reset();
        }
      });
    });
    return {
      closeNode: closeNode,
      openNode: openNode,
      reset: reset
    };
  })(jQuery.noConflict());

}).call(this);

(function() {
  Empyre.Origin || (Empyre.Origin = {});

  Empyre.Origin.NavSide = (function($) {
    var activeClass, closeKinNodes, closeNode, defaults, inform, init, levelClass, moduleId, navSideSelector, nodeClass, openClass, openNode, toggleNode;
    moduleId = 'Nav Side';
    inform = Empyre.Origin.Inform.get(moduleId);
    activeClass = 'ns-active';
    levelClass = 'ns-level';
    navSideSelector = '.nav-side > ul';
    nodeClass = 'ns-node';
    openClass = 'ns-open';
    defaults = {
      closeKin: false,
      easingKin: 'easeInOutCirc',
      easing: 'easeOutCirc',
      nodeTransitionDuration: 300
    };
    closeKinNodes = function($node) {
      var $nodesToClose, duration;
      duration = $node.closest(navSideSelector).data('node-transition-duration');
      duration || defaults.nodeTransitionDuration;
      $nodesToClose = $node.closest('li').siblings('.' + openClass).children('ul');
      $nodesToClose.each(function() {
        closeNode($(this), duration, true);
      });
    };
    closeNode = function($node, nodeTransitionDuration, closeKin) {
      nodeTransitionDuration = typeof nodeTransitionDuration !== 'undefined' ? nodeTransitionDuration : defaults.nodeTransitionDuration;
      $node.closest('li').removeClass(openClass);
      if (nodeTransitionDuration > 0) {
        $node.velocity('stop').velocity({
          height: 0
        }, {
          display: 'none',
          duration: nodeTransitionDuration,
          easing: closeKin ? defaults.easingKin : defaults.easing,
          queue: false
        });
      } else {
        $node.css({
          'height': 0
        }).hide();
      }
    };
    openNode = function($node, nodeTransitionDuration, closeKin) {
      nodeTransitionDuration = typeof nodeTransitionDuration !== 'undefined' ? nodeTransitionDuration : defaults.nodeTransitionDuration;
      closeKin = typeof closeKin !== 'undefined' ? closeKin : defaults.closeKin;
      $node.closest('li').addClass(openClass).end().css({
        'height': 'auto'
      });
      if (nodeTransitionDuration > 0) {
        $node.velocity('stop').velocity({
          height: [$node.outerHeight(), 0]
        }, {
          display: 'block',
          duration: nodeTransitionDuration,
          easing: closeKin ? defaults.easingKin : defaults.easing,
          queue: false,
          complete: function() {
            $(this).css('height', 'auto');
          }
        });
      } else {
        $node.show();
      }
      if (closeKin) {
        closeKinNodes($node);
      }
    };
    toggleNode = function($node, nodeTransitionDuration, closeKin) {
      nodeTransitionDuration = typeof nodeTransitionDuration !== 'undefined' ? nodeTransitionDuration : defaults.nodeTransitionDuration;
      closeKin = typeof closeKin !== 'undefined' ? closeKin : defaults.closeKin;
      if ($node.closest('li').hasClass(openClass)) {
        closeNode($node, nodeTransitionDuration, closeKin);
      } else {
        openNode($node, nodeTransitionDuration, closeKin);
      }
    };
    init = function() {
      return $(navSideSelector).each(function() {
        var $nodes, closeKin, expanded, nodeTransitionDuration, rootNode;
        rootNode = this;
        closeKin = $(this).data('close-kin');
        expanded = $(this).data('expanded');
        nodeTransitionDuration = $(this).data('node-transition-duration');
        $nodes = $('ul', this);
        $(this).addClass(levelClass + '-' + 1);
        $nodes.each(function() {
          var $openNodes, level, node;
          node = this;
          level = parseInt($(this).parentsUntil(rootNode, 'ul').length + 2);
          $(this).addClass(levelClass + '-' + level);
          if (expanded) {
            $(this).closest('li').addClass(openClass).end().css({
              height: 'auto',
              display: 'block'
            });
          }
          $(this).closest('li').addClass(nodeClass).children(':first-child').on('click', function(e) {
            e.preventDefault();
            toggleNode($(node), nodeTransitionDuration, closeKin);
          });
          if ($(this).closest('li').hasClass(openClass)) {
            $openNodes = $(node).parentsUntil(rootNode, 'ul');
            $openNodes.push($(node));
            return $openNodes.each(function() {
              return openNode($(this), 0, false);
            });
          }
        });
      });
    };
    $(document).ready(function() {
      return init();
    });
    return {
      closeNode: closeNode,
      openNode: openNode,
      toggleNode: toggleNode
    };
  })(jQuery.noConflict());

}).call(this);

(function() {
  Empyre.Origin || (Empyre.Origin = {});

  Empyre.Origin.Tabs = (function($) {
    var closeTabs, inform, init, moduleId, openClass, openTab, tabLinkSelector, tabSelector, tabsSelector;
    moduleId = 'Tabs';
    inform = Empyre.Origin.Inform.get(moduleId);
    openClass = 'open';
    tabsSelector = '.tabs';
    tabSelector = '.tab';
    tabLinkSelector = '.tab-title';
    openTab = function($tab) {
      if (!$tab.hasClass(openClass)) {
        return $tab.addClass(openClass);
      }
    };
    closeTabs = function(tabs) {
      var $openTabs;
      $openTabs = $(tabSelector + '.' + openClass, tabs);
      return $openTabs.removeClass(openClass);
    };
    init = function() {
      return $(tabsSelector).each(function(i) {
        var $openTab, self;
        self = this;
        $openTab = $(tabSelector + '.' + openClass, this);
        if (!$openTab.length) {
          openTab($(tabSelector, this).first(), false);
        }
        return $(this).on('click', tabLinkSelector, function(e) {
          var $tab;
          $tab = $(this).closest(tabSelector);
          e.preventDefault();
          if (!$tab.hasClass(openClass)) {
            closeTabs(self);
            return openTab($tab);
          }
        });
      });
    };
    $(document).ready(function() {
      return init();
    });
    return {
      closeTabs: closeTabs,
      init: init,
      openTab: openTab
    };
  })(jQuery.noConflict());

}).call(this);

(function() {
  var base;

  (base = Empyre.Origin).Vendor || (base.Vendor = {});

  Empyre.Origin.Vendor.BXSlider = (function($) {
    var $loadingHTML, inform, init, moduleId, pagerClass, sliderClass, sliders, wrapperClass;
    moduleId = 'BXSlider';
    inform = Empyre.Origin.Inform.get(moduleId);
    $loadingHTML = $('<div class="loading-indicator default center"></div>');
    pagerClass = '.bx-pager';
    sliders = [];
    sliderClass = '.bx-slider';
    wrapperClass = '.bx-wrapper';
    init = function() {
      return $(sliderClass).each(function(i, s) {
        var $s, autoStart, controls, easing, mode, nextText, pager, pause, preloadImages, prevText, randomStart, speed, theme;
        $s = $(s);
        $s.attr('id', 'bx-slider-' + i);
        autoStart = $s.data('auto-start');
        controls = $s.data('display-controls') === true;
        easing = $s.data('easing') || 'swing';
        mode = $s.data('transition') || 'horizontal';
        nextText = '<i class="fa fa-caret-right"></i>';
        pager = $s.data('display-pager') === true;
        pause = parseInt($s.data('duration'), 10) || 4000;
        preloadImages = 'visible';
        prevText = '<i class="fa fa-caret-left"></i>';
        randomStart = $s.data('random-start') === true;
        speed = parseInt($s.data('transition-duration'), 10) || 600;
        theme = $s.data('theme');
        if ((Empyre.Origin.Utilities.msieVersion < 11) && easing.indexOf('cubic') > 0) {
          easing = 'swing';
        }
        return s = $s.bxSlider({
          adaptiveHeight: true,
          adaptiveHeightSpeed: speed * 0.8,
          auto: autoStart,
          autoControls: false,
          autoControlsCombine: true,
          autoHover: true,
          autoStart: false,
          controls: controls,
          easing: easing,
          mode: mode,
          nextText: nextText,
          pager: pager,
          pause: pause,
          preloadImages: preloadImages,
          randomStart: randomStart,
          prevText: prevText,
          speed: speed,
          useCSS: true,
          video: true,
          onSliderLoad: function(ci) {
            var $initialSlide, $pager, $wrapper, animateIn, hasVideo, initialHeight;
            $wrapper = $s.closest(wrapperClass);
            $initialSlide = $(sliderClass + '>*:not(.bx-clone)', $wrapper).eq(ci);
            $pager = $(pagerClass, $wrapper);
            animateIn = $s.data('animate-in') === true;
            hasVideo = $initialSlide.hasClass('video');
            initialHeight = $initialSlide.outerHeight();
            $loadingHTML.prependTo($wrapper).velocity({
              opacity: [1, 0]
            });
            if (animateIn) {
              return $(window).load(function() {
                return $wrapper.velocity({
                  height: initialHeight,
                  'max-height': initialHeight
                }, speed, 'easeInOutQuint', function() {
                  $(this).css({
                    height: 'auto'
                  });
                  $s.velocity({
                    opacity: 1
                  }, speed, 'easeOutQuart', function() {
                    $wrapper.addClass('bx-loaded').css({
                      'max-height': 'none'
                    });
                    return $('.loading-indicator', $wrapper).remove();
                  });
                  if (autoStart === true) {
                    return s.startAuto();
                  }
                });
              });
            } else {
              $wrapper.addClass('bx-loaded').css({
                height: initialHeight,
                'max-height': 'none'
              });
              $s.css({
                opacity: 1
              });
              $('.loading-indicator', $wrapper).remove();
              if (autoStart === true) {
                return s.startAuto();
              }
            }
          }
        });
      });
    };
    return $(document).ready(function() {
      if (typeof jQuery.fn.bxSlider === 'function') {
        return init();
      }
    });
  })(jQuery.noConflict());

}).call(this);

(function() {
  var base;

  (base = Empyre.Origin).Vendor || (base.Vendor = {});

  Empyre.Origin.Vendor.FancyBox = (function($) {
    var buildCustomTransitions, inform, init, moduleId, setDefaults;
    moduleId = 'FancyBox';
    inform = Empyre.Origin.Inform.get(moduleId);
    buildCustomTransitions = function(F) {
      F.transitions.originIn = function() {
        var tDistance;
        tDistance = 20;
        F.wrap.velocity({
          opacity: [1, 0],
          translateY: [0, -tDistance]
        }, {
          duration: F.current.openSpeed,
          easing: F.current.openEasing,
          complete: F._afterZoomIn
        });
      };
      F.transitions.originOut = function() {
        var tDistance;
        tDistance = 20;
        F.wrap.removeClass('fancybox-opened').velocity({
          opacity: 0,
          translateY: -tDistance
        }, {
          duration: F.current.closeSpeed,
          easing: F.current.closeEasing,
          complete: function() {
            return F._afterZoomOut();
          }
        });
      };
      F.transitions.originChangeIn = function() {
        var direction, tDistance, tX, tY;
        direction = F.direction;
        tDistance = 60;
        if (direction === 'left') {
          tX = [0, tDistance];
          tY = 0;
        }
        if (direction === 'right') {
          tX = [0, -tDistance];
          tY = 0;
        }
        if (direction === 'up') {
          tX = 0;
          tY = [0, tDistance];
        }
        if (direction === 'down') {
          tX = 0;
          tY = [0, -tDistance];
        }
        F.wrap.velocity({
          opacity: [1, 0],
          translateX: tX,
          translateY: tY
        }, {
          duration: F.current.nextSpeed,
          easing: F.current.nextEasing,
          complete: F._afterZoomIn
        });
      };
      F.transitions.originChangeOut = function() {
        var direction, tDistance, tX, tY;
        direction = F.direction;
        tDistance = 60;
        if (direction === 'left') {
          tX = -tDistance;
          tY = 0;
        }
        if (direction === 'right') {
          tX = tDistance;
          tY = 0;
        }
        if (direction === 'up') {
          tX = 0;
          tY = -tDistance;
        }
        if (direction === 'down') {
          tX = 0;
          tY = tDistance;
        }
        F.previous.wrap.velocity({
          opacity: 0,
          translateX: tX,
          translateY: tY
        }, {
          duration: F.current.prevSpeed,
          easing: F.previous.easing,
          complete: function() {
            return $(this).trigger('onReset').remove();
          }
        });
      };
    };
    setDefaults = function() {
      return $.extend($.fancybox.defaults, {
        closeBtn: false,
        closeEasing: 'easeInCirc',
        closeMethod: 'originOut',
        closeSpeed: 200,
        nextEasing: 'easeInOutCirc',
        nextMethod: 'originChangeIn',
        nextSpeed: 300,
        openEasing: 'easeOutCirc',
        openMethod: 'originIn',
        openSpeed: 500,
        padding: 0,
        prevEasing: 'easeInOutCirc',
        prevMethod: 'originChangeOut',
        prevSpeed: 300,
        wrapCSS: 'fancybox-origin',
        helpers: {
          overlay: {
            css: {
              background: 'rgba(255, 255, 255, 0.94)'
            }
          },
          title: {
            type: 'inside'
          },
          media: {}
        },
        beforeLoad: function() {
          var height, width;
          if (this.element.is('.not-fancy')) {
            return false;
          }
          height = parseInt(this.element.data('fancybox-height'));
          width = parseInt(this.element.data('fancybox-width'));
          if (width) {
            this.width = width;
          }
          if (height) {
            return this.height = height;
          }
        },
        afterLoad: function() {
          $('.fancybox-overlay').addClass(this.wrapCSS);
        },
        afterShow: function() {
          $('[data-modal-close]', this.inner).on('click', function(e) {
            e.preventDefault();
            return $.fancybox.close();
          });
          if (!$('.fancybox-overlay > .fancybox-close-wrap').length) {
            if (this.element.data('modal-type') !== 'modal') {
              $('<div class="fancybox-close-wrap" />').html('<div class="fancybox-close"><i class="fa fa-close"></div>').prependTo($('.fancybox-overlay')).on('click', function(e) {
                e.preventDefault();
                return $.fancybox.close();
              });
            }
          }
          if ($('.fancybox-nav', this.wrap).length) {
            if (!$('.fancybox-overlay > .fancybox-nav-prev-wrap').length) {
              $('<div class="fancybox-nav-prev-wrap" />').html('<div class="fancybox-nav-prev"><i class="fa fa-caret-left"></div>').prependTo($('.fancybox-overlay')).on('click', function() {
                return $.fancybox.prev();
              });
              $('<div class="fancybox-nav-next-wrap" />').html('<div class="fancybox-nav-next"><i class="fa fa-caret-right"></div>').prependTo($('.fancybox-overlay')).on('click', function() {
                return $.fancybox.next();
              });
            }
            if (this.wrap.hasClass('fancybox-type-ajax')) {
              $('.fancybox-nav', this.outer).hide();
            }
          }
        },
        beforeClose: function() {
          $('.fancybox-overlay').addClass('fancybox-closing');
        }
      });
    };
    init = function() {
      $('.fancybox').fancybox();
      return $('.fancybox[data-modal-type="modal"]').fancybox({
        modal: true
      });
    };
    return $(document).ready(function() {
      if (typeof jQuery.fn.fancybox === 'function') {
        buildCustomTransitions(jQuery.fancybox);
        setDefaults();
        return init();
      }
    });
  })(jQuery.noConflict());

}).call(this);

(function() {
  Empyre.App || (Empyre.App = {});

  Empyre.App.Base = (function($) {
    var inform, initFitVids, locale, moduleId, multicurrencyEnabled, notify;
    moduleId = 'Base';
    inform = Empyre.Origin.Inform.get(moduleId);
    notify = Empyre.Origin.Notify;
    locale = Empyre.App.i18n;
    multicurrencyEnabled = Empyre.App.config.multicurrencyEnabled;
    initFitVids = function() {
      return $('body').fitVids({
        ignore: '.not-fitvid'
      });
    };
    return $(document).ready(function() {
      return initFitVids();
    });
  })(jQuery.noConflict());

}).call(this);
