<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Weather App</title>

        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>body {font-family: 'Nunito', sans-serif;}</style>
    </head>

    <body class="bg-slate-700">

      <div class="container text-center p-4 mx-auto mt-10 text-white">

        <h1 class="text-4xl sm:mt-5 mt-1">{{ $city }} - {{ $country }}</h1>

        @isset($info)
          <div class="sm:mt-10 mt-6">
              @foreach ($info as $key => $value)
                  <p class="text-lg">{{ $key }}: {{ $value }}</p>
                  <br>
              @endforeach
          </div>
        @endisset

        <form action="/" class="my-20 w-2/3 md:w-2/4 lg:w-1/3 xl:w-1/4 mx-auto" method="POST">
          @csrf

          <label for="city" class="block text-left mx-3">Enter a City:</label>
          <input type="text" id="city" value="{{ old('city') }}" name="city" placeholder="Please enter a city" class="bg-blue-100 p-2 m-3 w-full border rounded text-black focus:outline-none">

          <label for="country_code" class="block text-left mx-3 mt-5">Select a Country:</label>
          <select name="country_code" id="country_code" class="bg-blue-100 p-2 m-3 w-full border rounded text-black focus:outline-none">

          @php
            $countries = config('countries');
            foreach($countries as $country => $country_code) {
              if($country_code == 'GB') {
                echo '<option value="' . $country_code . '" selected>'. $country .'</option>';
              } else {
                echo '<option value="' . $country_code . '">'. $country .'</option>';
              }
            }
          @endphp

          </select>
          <div class="text-white">
            <button type="submit" class="rounded-full p-2 px-6 m-3 mt-7 mb-10 md:mb-3 mx-auto w-2/4 border-2 bg-gradient-to-r from-rose-700 to-rose-900">Submit</button>
            <a href="/" class="rounded-full p-2 px-6 m-3 mt-7 border-2 bg-gradient-to-r from-blue-700 to-violet-900 hover:bg-sky-500">Homepage</a>
          </div>

        </form>

      </div>

    </body>
</html>
