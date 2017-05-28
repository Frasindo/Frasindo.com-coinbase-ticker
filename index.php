<!DOCTYPE html>
<html>

<head>
    <style>
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }
        
        li {
            float: left;
        }
        
        li section {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        
        li section:hover:not(.active) {
            background-color: #111;
        }
        
        .up {
            color: #709A31;
        }
        
        .down {
            color: #DE5F66;
        }

    </style>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>

    <ul id="status">
        <li><section><span id="dollar_class" class="fa fa-minus"></span><p><b>BTC/USD</b></p><p id="dollar_value">0</p></section></li>
        <li><section><span id="idr_class" class="fa fa-minus"></span><p><b>BTC/IDR</b></p><p id="idr_value">0</p></section></li>
    </ul>
    <script>
        $(document).ready(function() {
            getData();
            console.log("Starting Loop");
            setInterval(function(){getData();},10000);
        });
        function getData() {
                console.log("Update Data . .");
                $.get("./ajax.php", function(data) {
                    console.log("Get Data");
                    var jsonData = jQuery.parseJSON(data);
                    console.log(jsonData);
                    $("#dollar_class").removeAttr("class");
                    $("#idr_class").removeAttr("class");
                    $("#dollar_class").attr("class",jsonData.USD.icon);
                    $("#idr_class").attr("class",jsonData.IDR.icon);
                    $("#dollar_value").html(jsonData.USD.value);
                    $("#idr_value").html(jsonData.IDR.value);
                });
        }

    </script>
</body>

</html>
