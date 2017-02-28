<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Simple Weather App</title>
    <link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.9/css/weather-icons.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet prefetch" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <style>

        #loader {
            position: absolute;
            left: 50%;
            top: 50%;
            z-index: 1;
            width: 150px;
            height: 150px;
            margin: -75px 0 0 -75px;
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        body{
            background-color:#16a085;
            font-family: 'Oswald', sans-serif;
            color:#ecf0f1;
        }
        #app-container{
            background-color:rgba(44, 62, 80,.4);
            position:absolute;
            top:50%;
            left:50%;
            width:600px;
            height:420px;
            margin:-210px -300px;
            padding:10px;
            border-radius:10px;
        }
        hr{
            border:3px solid #ecf0f1;
        }

        .small-text{
            font-weight:300;
            font-size:12px;
            text-align:center;
        }

        #icon{
            font-size:70px;
            color:#ecf0f1;
        }
        #checks{
            color: #0f0f10;
        }

    </style>


</head>

<body>
<div id="checks" class="center-block btn-group"></div>
<div id="loader"></div>
<div class="container">
    <div id="app-container">
        <div class="text-center" id="details">
            <h1><span id="city-name"></span></h1>
            <h1><span id="temp"></span><button class="btn-link" id="toggle">°F</button></h1>
            <i id="icon"></i>
            <p><span  id="status"></span></p>
        </div>
        <hr/>
        <div class="clearfix"></div>
        <div class="col-xs 12">
            <p class="small-text">you can click on °F or °C to switch between units <br />thanks <a href="http://codepen.io/JiimenaMartin">Jiimena Martin</a> for the beautiful backgrounds links </p>
            <p class="alert alert-danger small-text">if your are using chrome please view this app via http becouse chrome does not support geolocation via https (or you can view in anthor browser)</p>
        </div>
    </div>
</div>
<?php resource("js","jquery-3.1.1.min");?>

<script>
    $(document).ready(() => {
        var url;
        function getCities() {
            $.ajax({
                dataType: "json",
                url: "http://localhost:8080/weather",
                success: (data) => {
                    $("#checks").empty();
                    $.each( data, function( key, value ) {
                        $("#checks").append(`<button  class="btns" name="${key}" data-api="${value}">${key}</button>`);
                        $('.btns').each(function(index) {
                            $(this).on('click',function (e) {
                                url=e.target.dataset.api
                                showW(url);
                            });
                        });
                    });
                    setTimeout(getCities,5000);
                }
            });
        }
        getCities();

        // weather icon object
        var owmIcons = {
            '200': 'wi-owm-200',
            '201': 'wi-owm-201',
            '202': 'wi-owm-202',
            '210': 'wi-owm-210',
            '211': 'wi-owm-211',
            '212': 'wi-owm-212',
            '221': 'wi-owm-221',
            '230': 'wi-owm-230',
            '231': 'wi-owm-231',
            '232': 'wi-owm-232',
            '300': 'wi-owm-300',
            '301': 'wi-owm-301',
            '302': 'wi-owm-302',
            '310': 'wi-owm-310',
            '311': 'wi-owm-311',
            '312': 'wi-owm-312',
            '313': 'wi-owm-313',
            '314': 'wi-owm-314',
            '321': 'wi-owm-321',
            '500': 'wi-owm-500',
            '501': 'wi-owm-501',
            '502': 'wi-owm-502',
            '503': 'wi-owm-503',
            '504': 'wi-owm-504',
            '511': 'wi-owm-511',
            '520': 'wi-owm-520',
            '521': 'wi-owm-521',
            '522': 'wi-owm-522',
            '531': 'wi-owm-531',
            '600': 'wi-owm-600',
            '601': 'wi-owm-601',
            '602': 'wi-owm-602',
            '611': 'wi-owm-611',
            '612': 'wi-owm-612',
            '615': 'wi-owm-615',
            '616': 'wi-owm-616',
            '620': 'wi-owm-620',
            '621': 'wi-owm-621',
            '622': 'wi-owm-622',
            '701': 'wi-owm-701',
            '711': 'wi-owm-711',
            '721': 'wi-owm-721',
            '731': 'wi-owm-731',
            '741': 'wi-owm-741',
            '761': 'wi-owm-761',
            '762': 'wi-owm-762',
            '771': 'wi-owm-771',
            '781': 'wi-owm-781',
            '800': 'wi-owm-800',
            '801': 'wi-owm-801',
            '802': 'wi-owm-802',
            '803': 'wi-owm-803',
            '804': 'wi-owm-804',
            '900': 'wi-owm-900',
            '901': 'wi-owm-901',
            '902': 'wi-owm-902',
            '903': 'wi-owm-903',
            '904': 'wi-owm-904',
            '905': 'wi-owm-905',
            '906': 'wi-owm-906',
            '957': 'wi-owm-957',
            find: function(wetherID) {
                return "wi " + this[wetherID.toString()];
            }
        }
        //change backgrounds function
        function changeBackground(Wdesc) {
            switch (Wdesc) {
                case "rain":
                    $("body").css("background-image", "url(http://hdwallnpics.com/wp-content/gallery/rain-wallpaper-hd/Rain-on-Window-HD.jpg)")
                    break;
                case "clouds":
                    $("body").css("background-image", "url(http://www.wallpaperup.com/uploads/wallpapers/2013/12/10/189877/499ef65723a381104c99f9842e7391eb.jpg)");
                    break;
                case "thunderstorm":
                    $("body").css("background-image", "url(https://lh5.ggpht.com/nt58b5SnzhsDTRzNR2zgjibuEDkiMQmPbUAWer1QBgslUssmwdYI2fVjWf1Kw3fB-TMo=h900)");
                    break;
                case "drizzle":
                    $("body").css("background-image", "url(http://wallsdesk.com/wp-content/uploads/2016/05/Pictures-of-Rain-.jpg)");
                    break;
                case "snow":
                    $("body").css("background-image", "url(http://wallpaperbeta.com/wallpaper/winter_branch_snow_city_macro_hd-wallpaper-12870.jpg)");
                    break;
                case "clear":
                    $("body").css("background-image", "url(http://www.traemcneely.com/wp-content/uploads/2015/02/wpid-wp-1424111867667.jpeg)");
                    break;
                case "extreme":
                    $("body").css("background-image", "url(http://www.wallpaperup.com/uploads/wallpapers/2014/02/05/247993/ffa1709e8663b39d4594f81d112b6fe1.jpg)");
                    break;
                case "atmosphere":
                    $("body").css("background-image", "url(http://hdwallpaperbackgrounds.net/wp-content/uploads/2015/11/dock-fog-best-high-resolution-wallpaper-for-desktop-wide-free.jpg)");
                    break;
                case "additional":
                    $("body").css("background-image", "url(http://cdn.pcwallart.com/images/wind-wallpaper-2.jpg)");
                    break;
            };
        }

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                url = `http://api.openweathermap.org/data/2.5/find?lat=${position.coords.latitude}&lon=${position.coords.longitude}&cnt=1&units=imperial&APPID=989463c75ec0c46a34213695b2d6eb39`;
                showW(url);
            });
        }

        function showW(url) {
            $.ajax({
                dataType: "jsonp",
                url: url,
                success: (data) => {
                    if(Array.isArray(data)){
                        changeBackground(data.list[0].weather[0].main.toLowerCase());
                        $('#city-name').html(data.list[0].name + ", " + data.list[0].sys.country);
                        $('#temp').html(Math.round(data.list[0].main.temp));
                        $('#status').html(data.list[0].weather[0].description);
                        $('#icon').addClass(owmIcons.find(data.list[0].weather[0].id));
                        $('#loader').css("display","none");
                    }else{
                        changeBackground(data.weather[0].main.toLowerCase());
                        $('#city-name').html(data.name + ", " + data.sys.country);
                        $('#temp').html(Math.round(data.main.temp));
                        $('#status').html(data.weather[0].description);
                        $('#icon').addClass(owmIcons.find(data.weather[0].id));
                        $('#loader').css("display","none");
                    }

                }
            });
        }
        $('#toggle').click(function() {
            var temp = $('#temp');
            var tempValue = $('#temp').text();
            var tsymbole = $('#toggle');
            if (tempValue) {
                if (tsymbole.text() === '°F') {
                    temp.text(Math.round((tempValue - 32) * .5556));
                    tsymbole.text('°C');
                } else {
                    temp.text(Math.round(tempValue * 1.8 + 32));
                    tsymbole.text('°F');
                }
            }
        });
    });
</script>
</body>
</html>
