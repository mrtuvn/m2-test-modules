require([
    'Tuna_Frontend/js/parent',
], function(parent) {
    //var tempFromChild = parent().getTemp();

    parent().temp.subscribe(function(value) {
        console.log('The new value of temp is : ' + value);
    });

    console.log('last temp value: ' + parent().getTemp());
    //console.log('value from parent : ' + tempFromChild);


});
