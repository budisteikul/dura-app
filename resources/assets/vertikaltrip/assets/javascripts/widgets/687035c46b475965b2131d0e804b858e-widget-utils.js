(function() {

    /*(function(a){$.browser.mobile=/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od|ad)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))})(navigator.userAgent||navigator.vendor||window.opera);*/

    // top-level namespace
    var WidgetUtils = this.WidgetUtils = {};

    WidgetUtils.PriceFormatter = function(attributes) {
        $.extend(this, {
            currency: 'USD',
            language: 'EN',
            decimalSeparator: '.',
            groupingSeparator: ',',
            symbol: '$'
        }, attributes);

        var instance = this;

        this.setCurrency = function(currency, symbol) {
            this.currency = currency;
            this.symbol = symbol;
        };

        this.format = function(amt) {
            if ( amt != null ) {
                return amt.toString().replace(/\B(?=(\d{3})+(?!\d))/g, instance.groupingSeparator);
            } else {
                return '-';
            }
        };

        this.symbolAndFormat = function(amt) {
        	return (instance.symbol.length > 1 ? instance.symbol + " " : instance.symbol) + instance.format(amt);
		};

        this.formatHtml = function(amt) {
            return '<span class="price"><span class="symbol">' + (instance.symbol.length > 1 ? instance.symbol + " " : instance.symbol) + '</span><span class="amount">' + instance.format(amt) + '</span></span>';
        };

        this.formatHtmlSimple = function(amt) {
            return '<span class="symbol">' + (instance.symbol.length > 1 ? instance.symbol + " " : instance.symbol) + '</span><span class="amount">' + instance.format(amt) + '</span>';
        };
    };

    WidgetUtils.Translator = function(attributes) {
        $.extend(this, {
            language: 'EN',
            translations: []
        }, attributes);

        this.add = function(key, value) {
            this.translations.push({
                key: key,
                value: value
            });
        };

        this.get = function(key) {
            for (var i = 0; i < this.translations.length; i++) {
                if ( this.translations[i].key == key ) {
                    return this.translations[i].value;
                }
            }
            return key;
        }
    };

    WidgetUtils.WidgetIframe = function(attributes) {
        $.extend(this, {
            key: null
        }, attributes);

        var instance = this;

        this.redirectParent = function(url) {
            if( top.postMessage ){
                top.postMessage('redirect|'+instance.key + '|' + url, "*");
            } else if( parent.postMessage ){
        		parent.postMessage('redirect|'+instance.key + '|' + url, "*");
        	}
        };

	    this.autoResize = function(additionalOffset){
    		additionalOffset = instance.getAdditionalOffset(additionalOffset);
    		if( parent.postMessage ){
    			parent.postMessage((document.body.offsetHeight+additionalOffset)+'|'+instance.key, "*");
    		}
	    };

	    this.getAdditionalOffset = function(additionalOffset){
	    	additionalOffset=additionalOffset||0;
	    	if(navigator.userAgent.toUpperCase().indexOf('MSIE 7')!=-1){additionalOffset+=70;}
	    	//additionalOffset += 70;
	    	this.offset = additionalOffset;
	    	return this.offset;
	    };

		this.bindMethod = function(method, scope) {
			return function() {
				method.apply(scope, arguments);
			}
		};

	    this.resizeCallFromParent = function(event){
	    	if(event.data=='resize'){
	    		instance.autoResize();
	    	}
	    };

		this.addEvent = function(obj, type, fn) {
			if (obj.attachEvent) {
				obj["e" + type + fn] = fn;
				obj[type + fn] = function() {
					obj["e" + type + fn](window.event)
				};
				obj.attachEvent("on" + type, obj[type + fn]);
			} else {
				obj.addEventListener(type, fn, false);
			}
		}

    	instance.autoResize(0);
    	this.addEvent(window, 'message', this.bindMethod(this.resizeCallFromParent, this));
    };

    WidgetUtils.GetSessionId = function(bookingChannelUUID) {
      return window.bokunSessionId;
    }

    WidgetUtils.StoreSessionId = function(sessionId, bookingChannelUUID) {
      window.bokunSessionId = sessionId;
    	window.bokunBookingChannelUUID = bookingChannelUUID;
    }

    WidgetUtils.AddRequestHeaders = function(request) {
    	request.setRequestHeader("X-Bokun-Channel", window.bokunBookingChannelUUID);
    	request.setRequestHeader("X-Bokun-Session", window.bokunSessionId);
    };

    WidgetUtils.AddHeaders = function(request, productLanguage, currency, agentId, agentContractType, affiliateId) {
        if (typeof productLanguage !== 'undefined' && productLanguage !== null)
            request.setRequestHeader('X-Bokun-ProductLang', productLanguage);
        if (typeof currency !== 'undefined' && currency !== null)
            request.setRequestHeader('X-Bokun-Currency', currency);
        if (typeof agentId !== 'undefined' && agentId !== null)
            request.setRequestHeader('X-Bokun-BookingAgent', agentId);
        if (typeof agentContractType !== 'undefined' && agentContractType !== null)
            request.setRequestHeader('X-Bokun-ContractType', agentContractType);
        if (typeof affiliateId !== 'undefined' && affiliateId !== null)
            request.setRequestHeader('X-Bokun-Affiliate', affiliateId);
    };

    WidgetUtils.AddCustomHeaders = function(request, headers) {
        for (var i = 0; i < headers.length; i++) {
            request.setRequestHeader(headers[i].name, headers[i].value);
        }
    };

    WidgetUtils.DateField = function(attributes) {
        $.extend(this, {
            field: null,
            dateFormat: 'dd.mm.yy'
        }, attributes);

        var instance = this;

        if ( !Modernizr.inputtypes.date ) {
        	instance.field.datepicker({
                dateFormat: instance.dateFormat,
                changeMonth: true,
                changeYear: true,
                onSelect: function( selectedDate ) {
                }
        	});
        }

        this.getDate = function() {
        	if ( !Modernizr.inputtypes.date ) {
        		return instance.field.datepicker('getDate');
        	} else {
        		return instance.field.val();
        	}
        }
    };

    WidgetUtils.DateRange = function(attributes) {
        $.extend(this, {
            container: null,
            startSelector: '.check-in-date',
            endSelector: '.check-out-date',
            dateFormat: 'dd.mm.yy',
            monthDropdown: true,
            yearDropdown: true,
            allowPast: false,
            nativeIfSupported: false,
            startDate: null,
            endDate: null
        }, attributes);

        var instance = this;

        this.formattedDate = function(date) {
        	if ( instance.nativeIfSupported == false || !Modernizr.inputtypes.date ) {
        		return date.format('DD.MM.YY');
        	} else {
        		return date.format('YYYY-MM-DD');
        	}
        };

        this.getStartAsStr = function() {
       		return instance.container.find(instance.startSelector).val();
        };

        this.getEndAsStr = function() {
        	return instance.container.find(instance.endSelector).val();
        };

        if ( instance.nativeIfSupported == false || !Modernizr.inputtypes.date ) {
        	// proprietary date fields
            this.container.find(this.startSelector).data('rangerole','start');
            this.container.find(this.endSelector).data('rangerole','end');

            var dates = this.container.find(this.startSelector + ', ' + this.endSelector).datepicker({
                dateFormat: instance.dateFormat,
                changeMonth: instance.monthDropdown,
                changeYear: instance.yearDropdown,
                onSelect: function( selectedDate ) {
                    var picker = $(this).data("datepicker");
                    var date = moment($.datepicker.parseDate(picker.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, picker.settings ));
                    var nextDay = moment($.datepicker.parseDate(picker.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, picker.settings )).add('d',1);

                    $(this).data('selecteddate', date);
                    if ( $(this).data('rangerole') == 'start' ) {
                        var diff = moment(instance.container.find(instance.endSelector).datepicker('getDate')).diff(moment(instance.startDate), 'days');
                        if ( isNaN(diff) || diff == 0 ) {
                            diff = 1;
                        }
                        var futureDiffDay = moment($.datepicker.parseDate(picker.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, picker.settings )).add('d',diff);

                        dates.not(this).datepicker('option', 'minDate', date.toDate());
                        instance.container.find(instance.endSelector).datepicker('setDate', futureDiffDay.toDate());
                        if ( instance.container.find(instance.endSelector).val() != ''
                        	&& moment(instance.container.find(instance.endSelector).datepicker('getDate')).diff(date) < 0 ) {
                        }
                    }
                    if ( instance.container.find(instance.startSelector).val() != '' && instance.container.find(instance.endSelector).val() == '' ) {
                    	instance.container.find(instance.endSelector).datepicker('setDate', nextDay.toDate());
                    }

                    instance.startDate = instance.container.find(instance.startSelector).datepicker('getDate');
                    instance.endDate = instance.container.find(instance.endSelector).datepicker('getDate');
                }
            });
            if ( !instance.allowPast ) {
            	instance.container.find(instance.startSelector).datepicker("option", "minDate", "0");
            }
            if ( instance.container.find(instance.startSelector).val() != '' ) {
                var picker = instance.container.find(instance.endSelector).data("datepicker");
                var minDate = moment($.datepicker.parseDate(picker.settings.dateFormat || $.datepicker._defaults.dateFormat, instance.container.find(instance.startSelector).val(), picker.settings )).add('days',1).toDate();
                instance.container.find(this.endSelector).datepicker("option", "minDate", minDate);
            }

            instance.startDate = instance.container.find(instance.startSelector).datepicker('getDate');
            instance.endDate = instance.container.find(instance.endSelector).datepicker('getDate');

        } else {
            instance.startDate = instance.container.find(instance.startSelector).val();
            instance.endDate = instance.container.find(instance.endSelector).val();

            if(instance.container.find(instance.startSelector).val() != '') {
                instance.container.find(instance.endSelector).attr('min', instance.container.find(instance.startSelector).val());
            }

        	// native date fields in browser
        	instance.container.find(instance.startSelector).on('change', function() {
        		instance.container.find(instance.endSelector).attr('min', $(this).val());

                var diff = moment(instance.container.find(instance.endSelector).val()).diff(moment(instance.startDate), 'days');
                var startDay = moment($(this).val(), 'YYYY-MM-DD');
                var futureDiffDay = startDay.add('d',diff);

        		instance.container.find(instance.endSelector).val(instance.formattedDate(futureDiffDay));

                instance.startDate = instance.container.find(instance.startSelector).val();
                instance.endDate = instance.container.find(instance.endSelector).val();
        	});
        }
    };

    WidgetUtils.createDateRange = function(name, $form) {
        if ($form.find('.' + name + '-startdate').val() != '') {
            $form.find('.' + name + '-startdate').val(moment($form.find('.' + name + '-startdate').val(), moment.ISO_8601).format('DD.MM.YY'));
        }
        if ($form.find('.' + name + '-enddate').val() != '') {
            $form.find('.' + name + '-enddate').val(moment($form.find('.' + name + '-enddate').val(), moment.ISO_8601).format('DD.MM.YY'));
        }
		var dateRange = new WidgetUtils.DateRange({
			startSelector: '.' + name + '-startdate',
			endSelector: '.' + name + '-enddate',
			dateFormat: 'dd.mm.y',
			container: $form
		});
		$('button.' + name + '-startdate-btn').click(function() {
			$form.find('.' + name + '-startdate').focus();
		});
		$('button.' + name + '-enddate-btn').click(function() {
			$form.find('.' + name + '-enddate').focus();
		});
		return dateRange;
	};

    WidgetUtils.formattedDate = function(date) {
    	if ( Modernizr.inputtypes.date ) {
    		return date.format('YYYY-MM-DD');
    	} else {
    		return date.format('DD.MM.YY');
    	}
    };

	WidgetUtils.parseDate = function(str) {
	    var date = moment(str, 'YYYY-MM-DD');
	    if ( date == null || date.isBefore(moment(), 'year') ) {
	        date = moment(str, 'DD.MM.YYYY');
	        if ( date == null || date.isBefore(moment(), 'year') ) {
	            date = moment(str, 'DD.MM.YY');
	        }
	    }
        return date;
	};

	WidgetUtils.parseDateAndTime = function(str) {
	    var date = moment(str, 'YYYY-MM-DD HH:mm');
	    if ( date == null || date.isBefore(moment(), 'year') ) {
	        date = moment(str, 'DD.MM.YYYY HH:mm');
	        if ( date == null || date.isBefore(moment(), 'year') ) {
	            date = moment(str, 'DD.MM.YY HH:mm');
	        }
	    }
        return date;
	};

	WidgetUtils.isNumber = function(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    };

	WidgetUtils.addHiddenInput = function($form, name, value) {
        $form.append( $('<input/>').attr('type','hidden').attr('name',name).attr('value',value) );
    };

    WidgetUtils.validateForm = function(formSelector) {
        var valid = true;
        var $form = formSelector;
        if ( typeof formSelector == 'string' ) {
            $form = $(formSelector);
        }

        $form.find('input,select').each(function() {
            var $field = $(this);
            var fieldValid = true;

            var validate = !(typeof $field.data('validate') == 'undefined') && $field.data('validate') == true;
            if ( !validate ) {
            	WidgetUtils.clearMessagesFromInput($field);
                return;
            }

            var missingMsg = $field.data('missing-msg');
            var invalidMsg = $field.data('invalid-msg');

            var useDataValue = $field.data('use-value');
            var value = useDataValue ? $field.data('value') : $field.val();

            // check if required
            if ( $field.data('required') == true ) {
                if ( $.trim(value) == '' && !$field.is(':disabled')  ) {
                	WidgetUtils.addErrorToInput($field, missingMsg);
                    fieldValid = false;
                }
            }

            // min length
            var minLength = parseInt($field.data('min-length'));
            if ( fieldValid && minLength > 0 && ($.trim(value).length < minLength) ) {
            	WidgetUtils.addErrorToInput($field, invalidMsg);
                fieldValid = false;
            }

            // max length
            var maxLength = parseInt($field.data('max-length'));
            if ( fieldValid && maxLength > 0 && ($.trim(value).length > maxLength) ) {
            	WidgetUtils.addErrorToInput($field, invalidMsg);
                fieldValid = false;
            }

            // match another field
            var matchField = $field.data('match');
            if ( fieldValid && $.trim(matchField) != '' && $('#'+matchField).val() != value) {
            	WidgetUtils.addErrorToInput($field, invalidMsg);
                fieldValid = false;
            }

            // content format
            var format = $field.data('content');
            if ( fieldValid && $.trim(format) != '' ) {
                if ( format == 'email' ) {
                    try {
                        var pattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                        if ( !pattern.test($.trim(value)) ) {
                            WidgetUtils.addErrorToInput($field, invalidMsg);
                            fieldValid = false;
                        }
                    } catch ( ignored ) {
                        console.log(ignored);
                    }

                } else if ( format == 'date' ) {
                    try {
                        $.datepicker.parseDate('dd.mm.yy', $.trim(value));
                    } catch ( ex ) {
                    	WidgetUtils.addErrorToInput($field, invalidMsg);
                        fieldValid = false;
                    }
                } else if ( format == 'number' ) {
                	if ( $.trim(value) != '' ) {
	                    if ( !WidgetUtils.isNumber($.trim(value))) {
	                    	WidgetUtils.addErrorToInput($field, invalidMsg);
	                        fieldValid = false;
	                    } else {
	                        var minVal = $field.data('minval');
	                        if ( $.trim(minVal) != '') {
	                            minVal = parseInt(minVal);
	                            if ( parseInt($.trim(value)) < minVal ) {
	                            	WidgetUtils.addErrorToInput($field, invalidMsg);
	                                fieldValid = false;
	                            }
	                        }
	                        var maxVal = $field.data('maxval');
	                        if ( $.trim(maxVal) != '') {
	                            maxVal = parseInt(maxVal);
	                            if ( parseInt($.trim(value)) > maxVal ) {
	                            	WidgetUtils.addErrorToInput($field, invalidMsg);
	                                fieldValid = false;
	                            }
	                        }
	                    }
                	}
                }
            }

            if ( fieldValid ) {
                // clear error messages
            	WidgetUtils.clearMessagesFromInput($field);
            } else {
                valid = false;
            }
        });
        if ( !valid ) {
            $form.find('.alert-danger').fadeIn();
        } else {
            $form.find('.alert-danger').fadeOut();
        }
        return valid;
    };

    WidgetUtils.addSuccessToInput = function($field, msg) {
        var $controlGrp = $field.closest('.form-group');
        if ( !$controlGrp.hasClass('has-success') ) { $controlGrp.addClass('has-success') };
        $controlGrp.find('.help-inline').text(msg);
    }

    WidgetUtils.addErrorToInput = function( $field, msg ) {
        var $controlGrp = $field.closest('.form-group');
        if ( $controlGrp.size() > 0 ) {
	        if ( !$controlGrp.hasClass('has-error') ) { $controlGrp.addClass('has-error'); };
	        if ( $controlGrp.find('.help-inline').size() > 0 ) {
	            $controlGrp.find('.help-inline').text(msg);
	        } else {
	            $controlGrp.find('.help-block').text(msg);
	        }
        }
        $field.data('invalid',true);
    };

    WidgetUtils.clearMessagesFromInput = function( $field ) {
    	$field.data('invalid',false);
        var $controlGrp = $field.closest('.form-group');
        var otherInvalids = false;
        $controlGrp.find('input').each(function() {
            if ( $(this).data('invalid') == true ) {
                otherInvalids = true;
            }
        });
        if ( !otherInvalids ) {
            $controlGrp.removeClass('has-error');
            $controlGrp.removeClass('has-success');
            $controlGrp.removeClass('has-warning');
            $controlGrp.find('.help-inline').text('');
            $controlGrp.find('.help-block').text('');
        }
    };

    WidgetUtils.flashMessage = function(type, msg) {
        var $box = $('<div />').addClass('alert').addClass('hide').addClass('fade').addClass('in').addClass('alert-' + type).html(msg);
        $('.flash-container').empty();
        $('.flash-container').append($box);
        $box.fadeIn();

        setTimeout(function() {
            $box.fadeOut();
        }, 5000);
    };

    WidgetUtils.executeCallback = function(callback, data) {
    	if ( callback != undefined && callback != null ) {
    	    if ( data != undefined && data != null ) {
    	        return callback.call(undefined, data);
    	    } else {
    	        return callback.call(undefined);
    	    }
    	}
    };

    WidgetUtils.setButtonLoading = function($btn) {
		var oldHtml = $btn.html();
		var btnText = $btn.text();
		var loadingTxt = $btn.data('loading-text');
		if ( loadingTxt != undefined && loadingTxt != '' && loadingTxt != null ) {
			btnText = loadingTxt;
		}
		$btn.attr('disabled','true').addClass('disabled');
		$btn.html('<i class="fa fa-spinner fa-spin"></i> ' + btnText + '');
		$btn.data('oldhtml', oldHtml);
    };

    WidgetUtils.resetButtonLoading = function($btn) {
		$btn.removeAttr('disabled').removeClass('disabled');
		$btn.html($btn.data('oldhtml'));
    };

    WidgetUtils.formatInsufficientAvailabilityItems = function(msg, data) {
        var $msg = $($.parseHTML(msg));

    	// add the items
    	try {
    		if ( data.fields.insufficientAvailabilities != undefined ) {
    			$ul = $('<ul/>');
    			for (var i = 0; i < data.fields.insufficientAvailabilities.length; i++) {
    				var obj = data.fields.insufficientAvailabilities[i];
    				var dateStr = '';
    				if ( obj.startDate != undefined && obj.startDate != null ) {
    					var start = moment(obj.startDate);
    					dateStr = start.format('D.MMM YYYY');
    				}
    				if ( obj.endDate != undefined && obj.endDate != null ) {
    					var end = moment(obj.endDate);
    					dateStr += ' - ' + end.format('D.MMM YYYY');
    				}
    				if ( dateStr != '' ) {
    					dateStr = ' (' + dateStr + ')';
    				}
    				$ul.append($('<li/>').append(obj.title + dateStr));
    			}
    			$msg.find('p').append($ul);
    		}

    	} catch (e) {}

    	return $msg;
    };

    WidgetUtils.ResizeIframe = function() {
    	if ( window.widgetIframe != undefined ) { window.widgetIframe.autoResize(); }
    };

    WidgetUtils.findQueryStringParam = function(q, key) {
	    key = key.replace(/[*+?^$.\[\]{}()|\\\/]/g, "\\$&"); // escape RegEx control chars
	    var match = q.match(new RegExp("[?&]" + key + "=([^&]+)(&|$)"));
	    return match && decodeURIComponent(match[1].replace(/\+/g, " "));
    };

    /**
     * Facet management.
     */
	WidgetUtils.Facets = function(attributes) {
        $.extend(this, {
            container: null,
        	facetFilters: [],
        	onChange: null,
            singleValue: false
        }, attributes);

        var instance = this;

        this.removeFacetValue = function(name, value) {
            var f = instance.findFacet(name);
            if ( f != null ) {
                var newValues = [];
                for ( var i = 0; i < f.values.length; i++ ) {
                    if ( f.values[i] != value ) {
                        newValues.push(f.values[i]);
                    }
                }
                f.values = newValues;
            }
        };

        this.removeFacetValues = function(name) {
            var f = instance.findFacet(name);
            if (f != null) {
                f.values = [];
            }
        };

        this.findFacet = function(name, createIfNotFound) {
        	var facetFilter = null;
            for ( var i = 0; i < instance.facetFilters.length; i++ ) {
                if ( instance.facetFilters[i].name == name ) {
                    facetFilter = instance.facetFilters[i];
                    break;
                }
            }
            if ( facetFilter == null && createIfNotFound == true ) {
                facetFilter = {
                    name: name,
                    values: []
                };
                instance.facetFilters.push(facetFilter);
            }
            return facetFilter;
        };

        instance.container.on('click', '.facet input', function(){
            var term = $(this).data('term');
            var name = $(this).closest('.facet-container').data('facetname');
            if ($(this).is(':checked') ) {
                if(instance.singleValue){
                    instance.removeFacetValues(name);
                }
            	instance.findFacet(name, true).values.push(term);
            } else {
            	instance.removeFacetValue(name, term);
            }

            if ( instance.onChange != null && instance.onChange !== undefined) {
            	instance.onChange.call(this, instance.facetFilters);
            }
        });
    };

})();

var defaultDiacriticsRemovalap = [
    {'base':'A', 'letters':'\u0041\u24B6\uFF21\u00C0\u00C1\u00C2\u1EA6\u1EA4\u1EAA\u1EA8\u00C3\u0100\u0102\u1EB0\u1EAE\u1EB4\u1EB2\u0226\u01E0\u00C4\u01DE\u1EA2\u00C5\u01FA\u01CD\u0200\u0202\u1EA0\u1EAC\u1EB6\u1E00\u0104\u023A\u2C6F'},
    {'base':'AA','letters':'\uA732'},
    {'base':'AE','letters':'\u00C6\u01FC\u01E2'},
    {'base':'AO','letters':'\uA734'},
    {'base':'AU','letters':'\uA736'},
    {'base':'AV','letters':'\uA738\uA73A'},
    {'base':'AY','letters':'\uA73C'},
    {'base':'B', 'letters':'\u0042\u24B7\uFF22\u1E02\u1E04\u1E06\u0243\u0182\u0181'},
    {'base':'C', 'letters':'\u0043\u24B8\uFF23\u0106\u0108\u010A\u010C\u00C7\u1E08\u0187\u023B\uA73E'},
    {'base':'D', 'letters':'\u0044\u24B9\uFF24\u1E0A\u010E\u1E0C\u1E10\u1E12\u1E0E\u0110\u018B\u018A\u0189\uA779'},
    {'base':'DZ','letters':'\u01F1\u01C4'},
    {'base':'Dz','letters':'\u01F2\u01C5'},
    {'base':'E', 'letters':'\u0045\u24BA\uFF25\u00C8\u00C9\u00CA\u1EC0\u1EBE\u1EC4\u1EC2\u1EBC\u0112\u1E14\u1E16\u0114\u0116\u00CB\u1EBA\u011A\u0204\u0206\u1EB8\u1EC6\u0228\u1E1C\u0118\u1E18\u1E1A\u0190\u018E'},
    {'base':'F', 'letters':'\u0046\u24BB\uFF26\u1E1E\u0191\uA77B'},
    {'base':'G', 'letters':'\u0047\u24BC\uFF27\u01F4\u011C\u1E20\u011E\u0120\u01E6\u0122\u01E4\u0193\uA7A0\uA77D\uA77E'},
    {'base':'H', 'letters':'\u0048\u24BD\uFF28\u0124\u1E22\u1E26\u021E\u1E24\u1E28\u1E2A\u0126\u2C67\u2C75\uA78D'},
    {'base':'I', 'letters':'\u0049\u24BE\uFF29\u00CC\u00CD\u00CE\u0128\u012A\u012C\u0130\u00CF\u1E2E\u1EC8\u01CF\u0208\u020A\u1ECA\u012E\u1E2C\u0197'},
    {'base':'J', 'letters':'\u004A\u24BF\uFF2A\u0134\u0248'},
    {'base':'K', 'letters':'\u004B\u24C0\uFF2B\u1E30\u01E8\u1E32\u0136\u1E34\u0198\u2C69\uA740\uA742\uA744\uA7A2'},
    {'base':'L', 'letters':'\u004C\u24C1\uFF2C\u013F\u0139\u013D\u1E36\u1E38\u013B\u1E3C\u1E3A\u0141\u023D\u2C62\u2C60\uA748\uA746\uA780'},
    {'base':'LJ','letters':'\u01C7'},
    {'base':'Lj','letters':'\u01C8'},
    {'base':'M', 'letters':'\u004D\u24C2\uFF2D\u1E3E\u1E40\u1E42\u2C6E\u019C'},
    {'base':'N', 'letters':'\u004E\u24C3\uFF2E\u01F8\u0143\u00D1\u1E44\u0147\u1E46\u0145\u1E4A\u1E48\u0220\u019D\uA790\uA7A4'},
    {'base':'NJ','letters':'\u01CA'},
    {'base':'Nj','letters':'\u01CB'},
    {'base':'O', 'letters':'\u004F\u24C4\uFF2F\u00D2\u00D3\u00D4\u1ED2\u1ED0\u1ED6\u1ED4\u00D5\u1E4C\u022C\u1E4E\u014C\u1E50\u1E52\u014E\u022E\u0230\u00D6\u022A\u1ECE\u0150\u01D1\u020C\u020E\u01A0\u1EDC\u1EDA\u1EE0\u1EDE\u1EE2\u1ECC\u1ED8\u01EA\u01EC\u00D8\u01FE\u0186\u019F\uA74A\uA74C'},
    {'base':'OI','letters':'\u01A2'},
    {'base':'OO','letters':'\uA74E'},
    {'base':'OU','letters':'\u0222'},
    {'base':'OE','letters':'\u008C\u0152'},
    {'base':'oe','letters':'\u009C\u0153'},
    {'base':'P', 'letters':'\u0050\u24C5\uFF30\u1E54\u1E56\u01A4\u2C63\uA750\uA752\uA754'},
    {'base':'Q', 'letters':'\u0051\u24C6\uFF31\uA756\uA758\u024A'},
    {'base':'R', 'letters':'\u0052\u24C7\uFF32\u0154\u1E58\u0158\u0210\u0212\u1E5A\u1E5C\u0156\u1E5E\u024C\u2C64\uA75A\uA7A6\uA782'},
    {'base':'S', 'letters':'\u0053\u24C8\uFF33\u1E9E\u015A\u1E64\u015C\u1E60\u0160\u1E66\u1E62\u1E68\u0218\u015E\u2C7E\uA7A8\uA784'},
    {'base':'T', 'letters':'\u0054\u24C9\uFF34\u1E6A\u0164\u1E6C\u021A\u0162\u1E70\u1E6E\u0166\u01AC\u01AE\u023E\uA786'},
    {'base':'TZ','letters':'\uA728'},
    {'base':'U', 'letters':'\u0055\u24CA\uFF35\u00D9\u00DA\u00DB\u0168\u1E78\u016A\u1E7A\u016C\u00DC\u01DB\u01D7\u01D5\u01D9\u1EE6\u016E\u0170\u01D3\u0214\u0216\u01AF\u1EEA\u1EE8\u1EEE\u1EEC\u1EF0\u1EE4\u1E72\u0172\u1E76\u1E74\u0244'},
    {'base':'V', 'letters':'\u0056\u24CB\uFF36\u1E7C\u1E7E\u01B2\uA75E\u0245'},
    {'base':'VY','letters':'\uA760'},
    {'base':'W', 'letters':'\u0057\u24CC\uFF37\u1E80\u1E82\u0174\u1E86\u1E84\u1E88\u2C72'},
    {'base':'X', 'letters':'\u0058\u24CD\uFF38\u1E8A\u1E8C'},
    {'base':'Y', 'letters':'\u0059\u24CE\uFF39\u1EF2\u00DD\u0176\u1EF8\u0232\u1E8E\u0178\u1EF6\u1EF4\u01B3\u024E\u1EFE'},
    {'base':'Z', 'letters':'\u005A\u24CF\uFF3A\u0179\u1E90\u017B\u017D\u1E92\u1E94\u01B5\u0224\u2C7F\u2C6B\uA762'},
    {'base':'a', 'letters':'\u0061\u24D0\uFF41\u1E9A\u00E0\u00E1\u00E2\u1EA7\u1EA5\u1EAB\u1EA9\u00E3\u0101\u0103\u1EB1\u1EAF\u1EB5\u1EB3\u0227\u01E1\u00E4\u01DF\u1EA3\u00E5\u01FB\u01CE\u0201\u0203\u1EA1\u1EAD\u1EB7\u1E01\u0105\u2C65\u0250'},
    {'base':'aa','letters':'\uA733'},
    {'base':'ae','letters':'\u00E6\u01FD\u01E3'},
    {'base':'ao','letters':'\uA735'},
    {'base':'au','letters':'\uA737'},
    {'base':'av','letters':'\uA739\uA73B'},
    {'base':'ay','letters':'\uA73D'},
    {'base':'b', 'letters':'\u0062\u24D1\uFF42\u1E03\u1E05\u1E07\u0180\u0183\u0253'},
    {'base':'c', 'letters':'\u0063\u24D2\uFF43\u0107\u0109\u010B\u010D\u00E7\u1E09\u0188\u023C\uA73F\u2184'},
    {'base':'d', 'letters':'\u0064\u24D3\uFF44\u1E0B\u010F\u1E0D\u1E11\u1E13\u1E0F\u0111\u018C\u0256\u0257\uA77A'},
    {'base':'dz','letters':'\u01F3\u01C6'},
    {'base':'e', 'letters':'\u0065\u24D4\uFF45\u00E8\u00E9\u00EA\u1EC1\u1EBF\u1EC5\u1EC3\u1EBD\u0113\u1E15\u1E17\u0115\u0117\u00EB\u1EBB\u011B\u0205\u0207\u1EB9\u1EC7\u0229\u1E1D\u0119\u1E19\u1E1B\u0247\u025B\u01DD'},
    {'base':'f', 'letters':'\u0066\u24D5\uFF46\u1E1F\u0192\uA77C'},
    {'base':'g', 'letters':'\u0067\u24D6\uFF47\u01F5\u011D\u1E21\u011F\u0121\u01E7\u0123\u01E5\u0260\uA7A1\u1D79\uA77F'},
    {'base':'h', 'letters':'\u0068\u24D7\uFF48\u0125\u1E23\u1E27\u021F\u1E25\u1E29\u1E2B\u1E96\u0127\u2C68\u2C76\u0265'},
    {'base':'hv','letters':'\u0195'},
    {'base':'i', 'letters':'\u0069\u24D8\uFF49\u00EC\u00ED\u00EE\u0129\u012B\u012D\u00EF\u1E2F\u1EC9\u01D0\u0209\u020B\u1ECB\u012F\u1E2D\u0268\u0131'},
    {'base':'j', 'letters':'\u006A\u24D9\uFF4A\u0135\u01F0\u0249'},
    {'base':'k', 'letters':'\u006B\u24DA\uFF4B\u1E31\u01E9\u1E33\u0137\u1E35\u0199\u2C6A\uA741\uA743\uA745\uA7A3'},
    {'base':'l', 'letters':'\u006C\u24DB\uFF4C\u0140\u013A\u013E\u1E37\u1E39\u013C\u1E3D\u1E3B\u017F\u0142\u019A\u026B\u2C61\uA749\uA781\uA747'},
    {'base':'lj','letters':'\u01C9'},
    {'base':'m', 'letters':'\u006D\u24DC\uFF4D\u1E3F\u1E41\u1E43\u0271\u026F'},
    {'base':'n', 'letters':'\u006E\u24DD\uFF4E\u01F9\u0144\u00F1\u1E45\u0148\u1E47\u0146\u1E4B\u1E49\u019E\u0272\u0149\uA791\uA7A5'},
    {'base':'nj','letters':'\u01CC'},
    {'base':'o', 'letters':'\u006F\u24DE\uFF4F\u00F2\u00F3\u00F4\u1ED3\u1ED1\u1ED7\u1ED5\u00F5\u1E4D\u022D\u1E4F\u014D\u1E51\u1E53\u014F\u022F\u0231\u00F6\u022B\u1ECF\u0151\u01D2\u020D\u020F\u01A1\u1EDD\u1EDB\u1EE1\u1EDF\u1EE3\u1ECD\u1ED9\u01EB\u01ED\u00F8\u01FF\u0254\uA74B\uA74D\u0275'},
    {'base':'oi','letters':'\u01A3'},
    {'base':'ou','letters':'\u0223'},
    {'base':'oo','letters':'\uA74F'},
    {'base':'p','letters':'\u0070\u24DF\uFF50\u1E55\u1E57\u01A5\u1D7D\uA751\uA753\uA755'},
    {'base':'q','letters':'\u0071\u24E0\uFF51\u024B\uA757\uA759'},
    {'base':'r','letters':'\u0072\u24E1\uFF52\u0155\u1E59\u0159\u0211\u0213\u1E5B\u1E5D\u0157\u1E5F\u024D\u027D\uA75B\uA7A7\uA783'},
    {'base':'s','letters':'\u0073\u24E2\uFF53\u00DF\u015B\u1E65\u015D\u1E61\u0161\u1E67\u1E63\u1E69\u0219\u015F\u023F\uA7A9\uA785\u1E9B'},
    {'base':'t','letters':'\u0074\u24E3\uFF54\u1E6B\u1E97\u0165\u1E6D\u021B\u0163\u1E71\u1E6F\u0167\u01AD\u0288\u2C66\uA787'},
    {'base':'tz','letters':'\uA729'},
    {'base':'u','letters': '\u0075\u24E4\uFF55\u00F9\u00FA\u00FB\u0169\u1E79\u016B\u1E7B\u016D\u00FC\u01DC\u01D8\u01D6\u01DA\u1EE7\u016F\u0171\u01D4\u0215\u0217\u01B0\u1EEB\u1EE9\u1EEF\u1EED\u1EF1\u1EE5\u1E73\u0173\u1E77\u1E75\u0289'},
    {'base':'v','letters':'\u0076\u24E5\uFF56\u1E7D\u1E7F\u028B\uA75F\u028C'},
    {'base':'vy','letters':'\uA761'},
    {'base':'w','letters':'\u0077\u24E6\uFF57\u1E81\u1E83\u0175\u1E87\u1E85\u1E98\u1E89\u2C73'},
    {'base':'x','letters':'\u0078\u24E7\uFF58\u1E8B\u1E8D'},
    {'base':'y','letters':'\u0079\u24E8\uFF59\u1EF3\u00FD\u0177\u1EF9\u0233\u1E8F\u00FF\u1EF7\u1E99\u1EF5\u01B4\u024F\u1EFF'},
    {'base':'z','letters':'\u007A\u24E9\uFF5A\u017A\u1E91\u017C\u017E\u1E93\u1E95\u01B6\u0225\u0240\u2C6C\uA763'}
];

var diacriticsMap = {};
for (var i=0; i < defaultDiacriticsRemovalap.length; i++){
    var letters = defaultDiacriticsRemovalap[i].letters;
    for (var j=0; j < letters.length ; j++){
        diacriticsMap[letters[j]] = defaultDiacriticsRemovalap[i].base;
    }
}

// "what?" version ... http://jsperf.com/diacritics/12
function removeDiacritics(str) {
    return str.replace(/[^\u0000-\u007E]/g, function(a){
        return diacriticsMap[a] || a;
    });
}
