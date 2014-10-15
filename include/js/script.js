/**
 * Created by Peter on 5-1-14.
 */

$( document ).ready(function() {
    console.log('ready')
    $('.stationmenu').click(function () {
        var stationId = $(this).attr('id');
        var newStation = $("#station-" + stationId);
        var oldStation = $(".weatherstation.selected");
        setCookie('station', stationId, 30);
        //document.cookie="station="+stationId;
        //$.cookie("station", stationId, { expires: 30 });

        // Show/hide the proper title
        checkTitleBar(newStation);

        // Show/hide the proper measurements
        oldStation.addClass("hidden");
        oldStation.removeClass("selected");
        newStation.removeClass("hidden");
        newStation.addClass("selected");

        // Show/hide the proper menu-items
        var oldMenuItem = $('.menu-selected');
        oldMenuItem.addClass("menu-unselected");
        oldMenuItem.removeClass("menu-selected");

        var newMenuItem = $(this);
        newMenuItem.removeClass("menu-unselected");
        newMenuItem.addClass("menu-selected");

        var menuText = newMenuItem.text();
        console.log("menu: " + menuText);

        $('.menu-station-name').text(menuText);
    });

    $('.madeby ').click(function () {
        $('.madeby ').text('Gemaakt door Peter Ton en Jason Alma');
    });

    var on = false;
    $('.measurement-icon').click(function () {
        imageUrl = 'include/images/rain.gif';
        if(!on) {
            $('.selected').css('background-image', 'url(' + imageUrl + ')');
            on = true;
        }
        else {
            $('.selected').css('background-image', 'none');
            on = false;
        }

    });
});

function checkTitleBar(newStation) {
    if(newStation.hasClass('success')) {
        $('.title.alert-success').removeClass('hidden');
        $('.title.alert-warning').addClass('hidden');
        $('.title.alert-danger').addClass('hidden');
        $('.title.alert-default').addClass('hidden');
    }
    if(newStation.hasClass('warning')) {
        $('.title.alert-success').addClass('hidden');
        $('.title.alert-warning').removeClass('hidden');
        $('.title.alert-danger').addClass('hidden');
        $('.title.alert-default').addClass('hidden');
    }
    if(newStation.hasClass('danger')) {
        $('.title.alert-success').addClass('hidden');
        $('.title.alert-warning').addClass('hidden');
        $('.title.alert-danger').removeClass('hidden');
        $('.title.alert-default').addClass('hidden');
    }
    if(newStation.hasClass('default')) {
        $('.title.alert-success').addClass('hidden');
        $('.title.alert-warning').addClass('hidden');
        $('.title.alert-danger').addClass('hidden');
        $('.title.alert-default').removeClass('hidden');
    }
}

function setCookie(key, value, days) {
    var date = new Date();
    date.setDate(date.getDate()+31)
    var expires = "expires="+date.toGMTString();
    document.cookie = key + "=" + value + "; " + expires;
}