define([
    'uiComponent',
    'ko'
], function(Component,ko) {
    "use strict";

    return Component.extend({
        defaults:{
            temp: ko.observable(0)
        },

        initialize: function() {
            this._super();
            var self = this;
            var len = 100;

            for (var i=0; i < len; i++) {
                var newValue = self.temp() + i;
                self.temp(newValue);
            }
        },

        getTemp: function() {
            return this.temp();
        }
    });
});
