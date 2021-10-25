"use strict";

$('.multi').multi_select({
    selectColor: 'purple',
    selectSize: 'small',
    selectText: 'Sort',
    duration: 300,
    easing: 'slide',
    listMaxHeight: 300,
    selectedCount: 2,
    sortByText: true,
    fillButton: true,
    data: {
        "1": "Our favourites",
        "3": "What's new",
        "3": "Price high to low",
        "4": "Price low to high",
    },
    onSelect: function(values) {
        console.log('return values: ', values);
    }
});

$('#get_values').on('click', function(event) {
    console.log($('#multi').multi_select('getSelectedValues'));
    $('.data-display').remove();
    var json = {
        items: $('#multi').multi_select('getSelectedValues')
    };
    if (json.items.length) {
        var ul = $('<ul>', {
            'class': 'data-display'
        }).appendTo('body');
        $(json.items).each(function(index, item) {
            ul.append(
                '<li style="display: block;">' + item + '</li>'
            );
        });
    }
})
$('#clear_values').on('click', function(event) {
    $('#multi').multi_select('clearValues');
    $('.data-display').slideUp(300, function() {
        $(this).remove()
    })
})




$('.multi2').multi_select({
    selectColor: 'purple',
    selectSize: 'small',
    selectText: 'Product Type',
    duration: 300,
    easing: 'slide',
    listMaxHeight: 300,
    selectedCount: 2,
    sortByText: true,
    fillButton: true,
    data: {
        "1": "Seat cover",
        "3": "Piston pin bush",
        "3": "Alloy Wheel",
        "4": "Airbag sensors",
        "4": "Indicator light",
    },
    onSelect: function(values) {
        console.log('return values: ', values);
    }
});
$('#get_values').on('click', function(event) {
    console.log($('#multi2').multi_select('getSelectedValues'));
    $('.data-display').remove();
    var json = {
        items: $('#multi2').multi_select('getSelectedValues')
    };
    if (json.items.length) {
        var ul = $('<ul>', {
            'class': 'data-display'
        }).appendTo('body');
        $(json.items).each(function(index, item) {
            ul.append(
                '<li style="display: block;">' + item + '</li>'
            );
        });
    }
})
$('#clear_values').on('click', function(event) {
    $('#multi2').multi_select('clearValues');
    $('.data-display').slideUp(300, function() {
        $(this).remove()
    })
})




$('.multi3').multi_select({
    selectColor: 'purple',
    selectSize: 'small',
    selectText: 'Style',
    duration: 300,
    easing: 'slide',
    listMaxHeight: 300,
    selectedCount: 2,
    sortByText: true,
    fillButton: true,
    data: {
        "1": "Brake Shoes",
        "3": "Brake Disc Rotor",
        "3": "Track Control Arms",
        "4": "Ball Joints & Parts",
        "4": "Stablizer Joint",
    },

    onSelect: function(values) {
        console.log('return values: ', values);
    }
});
$('#get_values').on('click', function(event) {
    console.log($('#multi3').multi_select('getSelectedValues'));
    $('.data-display').remove();
    var json = {
        items: $('#multi3').multi_select('getSelectedValues')
    };
    if (json.items.length) {
        var ul = $('<ul>', {
            'class': 'data-display'
        }).appendTo('body');
        $(json.items).each(function(index, item) {
            ul.append(
                '<li style="display: block;">' + item + '</li>'
            );
        });
    }
})
$('#clear_values').on('click', function(event) {
    $('#multi3').multi_select('clearValues');
    $('.data-display').slideUp(300, function() {
        $(this).remove()
    })
})




$('.multi4').multi_select({
    selectColor: 'purple',
    selectSize: 'small',
    selectText: 'Brand',
    duration: 300,
    easing: 'slide',
    listMaxHeight: 300,
    selectedCount: 2,
    sortByText: true,
    fillButton: true,
    data: {
        "1": "Champion (3)",
        "3": "Cheap Monday (6)",
        "3": "Classics 77 (39)",
        "4": "Cluse (1)",
        "5": "CMS (2)",

    },

    onSelect: function(values) {
        console.log('return values: ', values);
    }
});
$('#get_values').on('click', function(event) {
    console.log($('#multi3').multi_select('getSelectedValues'));
    $('.data-display').remove();
    var json = {
        items: $('#multi3').multi_select('getSelectedValues')
    };
    if (json.items.length) {
        var ul = $('<ul>', {
            'class': 'data-display'
        }).appendTo('body');
        $(json.items).each(function(index, item) {
            ul.append(
                '<li style="display: block;">' + item + '</li>'
            );
        });
    }
})
$('#clear_values').on('click', function(event) {
    $('#multi4').multi_select('clearValues');
    $('.data-display').slideUp(300, function() {
        $(this).remove()
    })
})