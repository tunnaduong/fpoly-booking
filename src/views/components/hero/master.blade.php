@php
    $httpClient = new \GuzzleHttp\Client();
    $openMeteo = new \PhpWeather\Provider\OpenMeteo\OpenMeteo($httpClient);

    $latitude = 20.5453;
    $longitude = 105.9122;

    $currentWeatherQuery = \PhpWeather\Common\WeatherQuery::create($latitude, $longitude);
    $currentWeather = $openMeteo->getCurrentWeather($currentWeatherQuery);
@endphp

<div class="col-md-6 grid-margin stretch-card">
    <div class="card tale-bg">
        <div class="card-people mt-auto">
            <img src="images/dashboard/people.svg" alt="people">
            <div class="weather-info">
                <div class="d-flex">
                    <div>
                        <h2 class="mb-0 font-weight-normal"><i
                                class="icon-sun mr-2"></i>{{ $currentWeather->getTemperature() }}<sup>°C</sup>
                        </h2>
                    </div>
                    <div class="ml-2">
                        <h4 class="location font-weight-normal">Phu Ly</h4>
                        <h6 class="font-weight-normal">Vietnam</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
