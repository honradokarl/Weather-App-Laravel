<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Weather Report</title>
  </head>
  <body>
    <div class="container">
        <!-- Content here -->
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand">What's the current weather on your location?</a>
            <form class="form-inline" method="POST" action="/store">
                @csrf
                <input class="form-control mr-sm-2" type="search" name="city" placeholder="Enter city / region" aria-label="Enter city / region">
                <select class="form-control mr-sm-2" id="exampleFormControlSelect1" name="country">
                    <option value="">- Select Country -</option>
                    @foreach ($countries as $key=>$val)
                        <option value={{ $key }}> {{ $val }} </option>
                    @endforeach
                </select>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Get Weather</button>
            </form>
        </nav>
        <div class="container-fluid">
            @php
                //dd($weather);
            @endphp
            @isset($weather)
                <div class="card" style="width: 18rem;">
                    <img src={{ $weather['weather_icon'][0] }} class="card-img-top" alt="Weather Icon" height="200px" width="100px">
                    <div class="card-body">
                        <h5 class="card-title"><span>{{ $weather['temperature'] }} &#8451;</span>  -  {{ $weather['region'] }}, {{ $weather['country'] }}</h5>
                        <p class="card-text">Temperature: {{ $weather['temperature'] }}</p>
                        <p class="card-text">Humidity: {{ $weather['humidity'] }}</p>
                        <p class="card-text">Wind Speed: {{ $weather['wind_speed'] }}</p>
                        <p class="card-text">Wind Degree: {{ $weather['wind_degree'] }}</p>
                        <p class="card-text">UV Index: {{ $weather['uv_index'] }}</p>
                        <p class="card-text">Visibility: {{ $weather['visibility'] }}</p>
                        <p class="card-text">Coordinates: {{ $weather['lon'] }}, {{ $weather['lat'] }}</p>
                        <p class="card-text">Sunrise: {{ $weather['sunrise'] }}</p>
                        <p class="card-text">Sunset: {{ $weather['sunset'] }}</p>
                    </div>
                </div>
            @endisset
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>
