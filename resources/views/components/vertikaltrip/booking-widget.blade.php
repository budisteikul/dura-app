<div class="widget-body" id="WidgetContent">
<div class="widget">
	<div id="ActivityBookingWidget"></div>
    <script>
    window.priceFormatter = new WidgetUtils.PriceFormatter({
        currency: 'USD',
        language: 'en',
        decimalSeparator: '.',
        groupingSeparator: ',',
        symbol: '$'
    });

	window.i18nLang = 'en';
    window.ActivityBookingWidgetConfig = {
        currency: 'USD',
        language: 'en',
        embedded: {!! $embedded !!},
        priceFormatter: window.priceFormatter,
        invoicePreviewUrl: '/snippets/activity/invoice-preview',
        addToCartUrl: '/snippets/widget/cart/session/<?= $sessionId ?>/activity',
        calendarUrl: '/snippets/activity/{id}/calendar/json/{year}/{month}',
        activities: [],
        pickupPlaces: [],
        dropoffPlaces: [],
        showOnRequestMessage: false,
        showCalendar: true,
        showUpcoming: false,
        displayOrder: 'Calendar',
        selectedTab: 'all',
        hideExtras: false,
        showActivityList: false,
        showFewLeftWarning: false,
        warningThreshold: 10,
        displayStartTimeSelectBox: false,
        displayMessageAfterAddingToCart: false,
        defaultCategoryMandatory: true,
        defaultCategorySelected: true,
        affiliateCodeFromQueryString: true,
        affiliateParamName: 'trackingCode',
        affiliateCode: '',
        onAfterRender: function() {
            if ( window.widgetIframe != undefined ) { window.widgetIframe.autoResize(); }
            setTimeout(function() {
                if ( window.widgetIframe != undefined ) { window.widgetIframe.autoResize(); }
            }, 200);

            if (typeof onWidgetRender !== 'undefined') {
                onWidgetRender();
            }
        },
        onAvailabilitySelected: function(selectedRate, selectedDate, selectedAvailability) {
        },
        onAddedToCart: function(cart) {
				$('.btn-theme').attr("disabled",true);
				$('.btn-theme').html(' <i class="fa fa-spinner fa-spin fa-fw"></i>  processing... ');
				var successUrl = '/booking/shoppingcart';
                if ( successUrl.indexOf('?') == -1 ) {
                  successUrl += '?sessionId=<?= $sessionId ?>';
                } else {
                  successUrl += '&sessionId=<?= $sessionId ?>';
                }
                if ( window.widgetIframe != undefined ) {
                  window.widgetIframe.redirectParent(successUrl);
                } else {
                  window.location = successUrl;
                }
            
        },
        
        calendarMonth: {!!$month!!},
        calendarYear: {!!$year!!},
        loadingCalendar: true,
        
        activity: {!! json_encode($contents) !!},
        
        upcomingAvailabilities: [],
        
        firstDayAvailabilities: {!! $firstavailability !!}
    }; 
    </script>
</div>
<div id="generic-loading-template" style="display:none">
	<div class="well well-large well-transparent lead">
		<i class="fa fa-spinner icon-spin icon-2x pull-left"></i> processing...
	</div>
</div>
</div>


