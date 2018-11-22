<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Job Dashboard</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
        <?php 
            // echo '<pre>';
            // print_r($info);
            // echo '</pre>';
            ?>
        <div class='jumbotron' style='margin:auto; text-align: center; margin-top: 40vh; font-family:monospace'>
                Choose Company:
            <select class='cc'>
                @foreach($info as $i)
                    <option value='{{$i->id}}'>{{$i->name}}</option>
                @endforeach
            </select>
            <button class='btn btn-primary submitButton'>Choose</button>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function(){
                $('.submitButton').click(function(){
                    var chosenCompanyID = $('.cc').children('option:selected').val();
                    var chosenCompanyName = $('.cc').children('option:selected').text();
                    console.log( 'id is ' + chosenCompanyID + ' : name is ' + chosenCompanyName);
                    let url = 'http://localhost:4200/cID=' + chosenCompanyID;
                    window.location.href = url;
                });
            });
        </script>
    </body>
</html>
