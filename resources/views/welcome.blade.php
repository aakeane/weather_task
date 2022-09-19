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

      <div class="container p-4 mx-auto mt-10 text-white">

        <h1 class="text-4xl text-center sm:mt-5 mt-1">Welcome to the Weather App</h1>

        <form action="/" class="my-20 w-2/3 md:w-2/4 lg:w-1/3 xl:w-1/4 mx-auto" method="POST">
          @csrf

          <label for="city" class="block text-left mx-3">Enter a City:</label>
          <input type="text" id="city" value="" name="city" placeholder="Please enter a city" class="bg-blue-100 p-2 m-3 w-full border rounded text-black focus:outline-none">

          <label for="country_code" class="block text-left mx-3 mt-5">Select a Country:</label>
          <select name="country_code" id="country_code" class="bg-blue-100 p-2 m-3 w-full border rounded text-black focus:outline-none">

          </select>

          <button type="submit" class="rounded-full p-2 px-6 m-3 mt-7 mx-auto w-2/4 block border-2 bg-gradient-to-r from-rose-700 to-rose-900">Submit</button>
        </form>

      </div>

    </body>
</html>
