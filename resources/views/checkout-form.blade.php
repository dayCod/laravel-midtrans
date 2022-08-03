<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <title>Document</title>
</head>
<body>
    @if(session('alert-success'))
    <script>alert("{{session('alert-success')}}")</script>
    @elseif(session('alert-failed'))
    <script>alert("{{session('alert-failed')}}")</script>
    @endif
    <div class="wrapper flex_box">
      <form method="GET" action="/checkout">
        <div class="input">
          <label>
            full name
          </label>
          <input class="name" placeholder="your name...?" type="text" name="full_name">
        </div>
        <div class="input">
          <label>
            email
          </label>
          <input placeholder="enter whatever you feel like..." class="name" type="email" name="email"></input>
        </div>
        <div class="input">
            <label>
              number
            </label>
            <input type="text" placeholder="enter whatever you feel like..." class="name" name="number"></input>
          </div>
        <div class="button_wrapper">
          <button type="submit">
            submit
          </button>
        </div>
      </form>
    </div>
    <div class="cover"></div>
    <div class="sign">
      by masahito / <a href="http://www.ma5a.com/" >ma5a.com</a>
    </div>

  </body>
</html>