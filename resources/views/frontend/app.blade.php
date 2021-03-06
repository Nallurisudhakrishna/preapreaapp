<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Prepareurself </title>
  <style type="text/css">
    body{
      background: #293859;
    }
    .wrapper{
      background: #efefef;
      margin: 70px 100px;
      padding: 40px;
      font-size: 15px;
    }
    @media screen and (max-width: 480px) {
      .wrapper {
        margin: 10px 5px;
        padding: 15px;
      }
    }
  </style>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body>
    <header>
      <!-- <p style="text-align: center;"><img src="{{asset('/defaults/logoBigName.png')}}" height="200px"></p> -->
    </header>
    <div class="wrapper">
      @yield('content')
    </div>
</body>  
</body>
</html>