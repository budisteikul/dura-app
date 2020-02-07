function BokunWidgetEmbedder() {
    this.host = 'localhost:9000',
        this.widgetHash = '',
        this.ssl = 'unset',
        this.async = false,
        this.autoResize = true,
        this.height = '',
        this.width = '100%',
        this.minHeight = 0,
        this.frameUrl = '',
        this.affiliateTrackingCode = '',
        this.key = '',
        this.resizeDone = '',
        this.transientSession = true,
        this.cookieLifetime = 30,

        this.initialize = function (params) {
            for (value in params) {
                this[value] = params[value];
            }
            var query = '';
            if (window.location.href.indexOf('?') != -1) {
                query = window.location.href.slice(window.location.href.indexOf('?') + 1);
            }

            this.sessionId = this.getSessionParameter();
            if (this.sessionId != undefined) {
                this.frameUrl += '&' + query;
            } else {
                this.sessionId = this.getCookie();
                if (this.sessionId == undefined) {
                    this.sessionId = this.UUID.generate();
                    this.setCookie(this.sessionId);
                }
                this.frameUrl += '&sessionId=' + this.sessionId + '&' + query;
            }

            this.key = this.widgetHash + '' + Math.floor(Math.random() * 1000000);

            this.addEvent(window, 'message', this.bindMethod(this.resizeBokunWidget, this));
            this.attachOnResizeEvent();
        },

        this.isFunction = function (object) {
            return typeof object === 'function';
        },

        this.determineSecurity = function () {
            if (this.ssl == true) {
                return 'https://';
            } else {
                return 'http://';
            }
        },

        this.generateFrameMarkup = function () {
            // google analytics: cross-iframe tracking
            var uaLinker, gaLinker;
            var allGa = window[window['GoogleAnalyticsObject'] || 'ga'];
            //if universal analytics
            if (typeof allGa !== 'undefined' && typeof allGa.getAll === 'function') {
                trackers = allGa.getAll();
                if (trackers.length) {
                    uaLinker = new window.gaplugins.Linker(trackers[0]);
                }
            }
            //if classic analytics
            if (typeof _gat !== 'undefined' && typeof _gat._getTrackers === 'function') {
                trackers = _gat._getTrackers();
                if (trackers.length) {
                    gaLinker = trackers[0];
                }
            }

            var src = this.frameUrl;
            if (uaLinker) {
                src = uaLinker.decorate(src);
            }
            if (gaLinker) {
                src = gaLinker._getLinkerUrl(src);
            }
            src = src.replace(/\|/g, '%7C');

            //TODO: decorate the iframeSrc with the params from  campaign
            var urlParams = this.getParams(window.location.href);
            console.log(urlParams);
            console.log('URL PARAMS');
            console.log('mammain');

			var newUrl = src;
			console.log('oldUrl');
			if (urlParams) {
                var self = this;
                Object.keys(urlParams).forEach(function(key){
                    newUrl = self.addParam(newUrl,key, urlParams[key]);
				})
            }
            console.log(newUrl,'oldUrl');
            var scroll = 'no';
            if (this.autoResize == false) {
                scroll = 'auto';
            }
            var iframe = '<iframe id="bokunWidget'
                + this.widgetHash
                + '" height="'
                + this.height
                + '" allowTransparency="true" frameborder="0" scrolling="'
                + scroll
                + '" style="width:1px;min-width:100%;border:none;"'
                + ' src="'
                + newUrl
                + '">Bokun Widget</iframe>';
            return iframe;
        },

        this.display = function () {
            if (this.async == true) {
                document.getElementById('bokun-' + this.widgetHash).innerHTML = this.generateFrameMarkup();
            } else {
                document.write(this.generateFrameMarkup());
            }
        },
        this.addParam = function (uri, key, value) {
            var re = new RegExp('([?&])' + key + '=.*?(&|$)', 'i');
            var separator = uri.indexOf('?') !== -1 ? '&' : '?';
            if (uri.match(re)) {
                return uri.replace(re, '$1' + key + '=' + value + '$2');
            } else {
                return uri + separator + key + '=' + value;
            }
        },
        this.getParams = function (url) {
            var params = {};
            var parser = document.createElement('a');
            parser.href = url;
            var query = parser.search.substring(1);
            var vars = query.split('&');
            for (var i = 0; i < vars.length; i++) {
                var pair = vars[i].split('=');
                params[pair[0]] = decodeURIComponent(pair[1]);
            }
            if (params['']) {
                return false;
            }
            return params;
        },
        this.resizeBokunWidget = function (event) {
            if (event.origin != 'http://' + this.host
                && event.origin != 'https://' + this.host) {
                return;
            }

            if (event.data.indexOf('redirect|') == 0) {
                // redirect event
                var data = event.data.split('|');
                location.href = data[2];
            } else {
                // resize event
                if (this.autoResize == true) {
                    var data = event.data.split('|');
                    var newFrameHeight = new Number(data[0]);

                    try {
                        if (parseInt(newFrameHeight) < this.minHeight) {
                            newFrameHeight = this.minHeight;
                        }
                    } catch (e) {
                    }

                    var frameEl = document.getElementById('bokunWidget' + this.widgetHash);
                    if (frameEl && this.isMessageFromCorrectWidget(data[1])) {
                        frameEl.height = newFrameHeight;
                    }
                    if (this.isFunction(this.resizeDone)) {
                        this.resizeDone(newFrameHeight);
                    }
                }
            }
        },

        this.isMessageFromCorrectWidget = function (dataHash) {
            dataHash = dataHash || '';
            var hash = dataHash.substring(0, this.widgetHash.length);
            return (hash == this.widgetHash) ? true : false;
        },

        this.addEvent = function (obj, type, fn) {
            if (obj.attachEvent) {
                obj['e' + type + fn] = fn;
                obj[type + fn] = function () {
                    obj['e' + type + fn](window.event);
                };
                obj.attachEvent('on' + type, obj[type + fn]);
            } else {
                obj.addEventListener(type, fn, false);
            }
        },

        this.bindMethod = function (method, scope) {
            return function () {
                method.apply(scope, arguments);
            };
        },

        this.resizeIFrame = function (widgetHash) {
            if (window.postMessage) {
                iframe = document.getElementById('bokunWidget' + this.widgetHash);
                var origin = this.determineSecurity() + this.host;
                iframe.contentWindow.postMessage('resize', origin);
            }
        },

        this.attachOnResizeEvent = function () {
            if (typeof (window.__bokunWidgets) != 'undefined') {
                window.__bokunWidgets.push(this);
            } else {
                window.__bokunWidgets = new Array();
                window.__bokunWidgets.push(this);
                window.oldHandler = window.onresize;
            }
            // Note: If user declares window.onresize after our scripts,
            // this gets overrideen.
            window.onresize = function () {
                for (i = 0; i < window.__bokunWidgets.length; i++) {
                    window.__bokunWidgets[i].resizeIFrame(window.__bokunWidgets[i].widgetHash);
                }
                if (window.oldHandler) {
                    window.oldHandler();
                }
            };
        },

        this.setCookie = function (cvalue) {
            var cookie = 'bokunSession=' + cvalue + ';path=/; ';
            if (!this.transientSession) {
                var d = new Date();
                d.setTime(d.getTime() + (this.cookieLifetime * 60 * 1000));
                cookie += 'expires=' + d.toUTCString() + '; ';
            }
            document.cookie = cookie;
        },

        this.getCookie = function () {
            var name = 'bokunSession=';
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return undefined;
        },

        this.getSessionParameter = function () {
            var value = this.findUrlVars('sessionId');
            return value != null ? value : undefined;
            return undefined;
        },

        this.findUrlVars = function (name) {
            if (window.location.href == '') {
                return null;
            }
            var hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for (var i = 0; i < hashes.length; i++) {
                hash = hashes[i].split('=');
                if (hash[0] == name) {
                    return hash[1];
                }
            }
            return null;
        };

    /**
     * Fast UUID generator, RFC4122 version 4 compliant.
     * @author Jeff Ward (jcward.com).
     * @license MIT license
     * @link http://stackoverflow.com/questions/105034/how-to-create-a-guid-uuid-in-javascript/21963136#21963136
     **/
    this.UUID = (function () {
        var self = {};
        var lut = [];
        for (var i = 0; i < 256; i++) {
            lut[i] = (i < 16 ? '0' : '') + (i).toString(16);
        }
        self.generate = function () {
            var d0 = Math.random() * 0xffffffff | 0;
            var d1 = Math.random() * 0xffffffff | 0;
            var d2 = Math.random() * 0xffffffff | 0;
            var d3 = Math.random() * 0xffffffff | 0;
            return lut[d0 & 0xff] + lut[d0 >> 8 & 0xff] + lut[d0 >> 16 & 0xff] + lut[d0 >> 24 & 0xff] + '-' +
                lut[d1 & 0xff] + lut[d1 >> 8 & 0xff] + '-' + lut[d1 >> 16 & 0x0f | 0x40] + lut[d1 >> 24 & 0xff] + '-' +
                lut[d2 & 0x3f | 0x80] + lut[d2 >> 8 & 0xff] + '-' + lut[d2 >> 16 & 0xff] + lut[d2 >> 24 & 0xff] +
                lut[d3 & 0xff] + lut[d3 >> 8 & 0xff] + lut[d3 >> 16 & 0xff] + lut[d3 >> 24 & 0xff];
        };
        return self;
    })();
}
