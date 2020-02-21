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

            window.setInterval(function() {
                var newValue = self.temp() + 1;
                self.temp(newValue);
            }, 2000);
        },

        getTemp: function() {
            return this.temp();
        }
    });
});
