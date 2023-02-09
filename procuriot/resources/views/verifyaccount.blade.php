<!DOCTYPE html>
<html>
<style>
    a.inactive {
        color: gray;
        text-decoration: line-through;
    }
</style>
<head>
    <title>Satori.com</title>
</head>
<body>
{{--<h1>{{ $details['title'] }}</h1>--}}
<p>{{ $details['body'] }}</p>

<a href="{{ $details['link'] }}" class="btn" id="myButton"> {{ $details['link'] }} </a>


<script>

    (function(){
        var click_counter = 0;
        $('#myButton').on('click', function(event){
            $(this).hide();

        });
    })();

</script>
</body>
</html>
