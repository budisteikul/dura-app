(function() {
    var gaHelper = (this.gaHelper = {});
    gaHelper.tracker = 'tracker_';
    gaHelper.globalTracker = 'bokun_tracker_';

    gaHelper.trackPage = function(channelId, customTracking) {
        if (customTracking) {
            ga(this.tracker + channelId + '.send', 'pageview');
        }
        ga(this.globalTracker + channelId + '.send', 'pageview');
    };
    gaHelper.updateCurrency = function(channelId, newCurrency, customTracking) {
        if (customTracking) {
            ga(this.tracker + channelId + '.set', '&cu', newCurrency);
        }
        ga(this.globalTracker + channelId + '.set', '&cu', newCurrency);
    };
    gaHelper.addProduct = function(channelId, product, customTracking) {
        if (customTracking) {
            ga(this.tracker + channelId + '.ec:addProduct', product);
        }
        ga(this.globalTracker + channelId + '.ec:addProduct', product);
    };
    gaHelper.setAction = function(channelId, actionName, customTracking, properties) {
        if (customTracking) {
            ga(this.tracker + channelId + '.ec:setAction', actionName, properties);
        }
        ga(this.globalTracker + channelId + '.ec:setAction', actionName, properties);
    };
    gaHelper.sendCustomEvent = function(channelId, category, type, label, customTracking) {
        if (customTracking) {
            ga(this.tracker + channelId + '.send', 'event', category, type, label);
        }
        ga(this.globalTracker + channelId + '.send', 'event', category, type, label);
    };
    gaHelper.isGaEnabled = function() {
        return typeof ga !== 'undefined';
    };
})();
