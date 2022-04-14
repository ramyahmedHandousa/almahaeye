<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content=".">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>عيون المها</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&family=Nova+Square&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <style type="text/css">
        *{outline:0;box-sizing:border-box;user-select:none}html{-webkit-text-size-adjust:none;scroll-behavior:smooth;font-size:14px;width:100%}body{font-family:"Source Sans Pro",sans-serif;background-color:#202020;background-image:linear-gradient(to right,#000,rgba(0,0,0,0) 20%,rgba(0,0,0,0) 80%,#000),linear-gradient(45deg,#000 25%,transparent 25%,transparent 75%,#000 75%,#000),linear-gradient(45deg,#000 25%,transparent 25%,transparent 75%,#000 75%,#000),linear-gradient(to bottom,#080808,#202020);background-size:100% 100%,10px 10px,10px 10px,10px 5px;background-position:0 0,0 0,5px 5px,0 0;color:#fbfcd4;position:relative;overflow-x:hidden;min-height:100vh}#content-wrapper{padding:100px 0;min-height:100vh;position:relative}.showroom-category{text-align:center;padding-top:15px;border:2px solid #151515;margin-bottom:30px;border-radius:8px;cursor:pointer;transition:all .4s ease-in}.showroom-category:hover{filter:invert(40%) sepia(93%) saturate(577%) hue-rotate(10deg) brightness(105%) contrast(106%)}.showroom-category>div{height:200px;width:90%;margin:0 auto;position:relative;transition:all .3s linear}.showroom-category:hover>div{transform:scale(.75)}.showroom-category>div>svg{position:absolute;top:0;left:0;width:100%;height:100%;z-index:1}.showroom-category h4{font-size:28px;user-select:none}.showroom-container{position:relative;display:none;width:100%;min-height:calc(100vh - 150px)}#loader{position:absolute;top:0;left:0;width:100%;height:100%;z-index:1003;background:#151515;color:#fff}#loader-title,#loader-value{position:absolute;top:50px;left:50%;font-size:30px;margin:0;transform:translateX(-50%);z-index:2}#loader-value{top:unset;bottom:50px;font-size:90px}#showroom{position:absolute;top:50%;left:50%;width:640px;height:480px;overflow:hidden; margin:0 auto;border:3px solid #151515;transform:translate(-50%,-50%);background:#151515}#showroom-variants{display:block;width: 100%; position:absolute; bottom: 0; left: 50%; transform: translateX(-50%); text-align: center; background:#000;height:115px;background:#000;z-index:1001;overflow:hidden;overflow-x:auto;padding:15px 30px;margin-top: 400px;vertical-align:middle;white-space:nowrap}#showroom-variants>div{display:inline-block;width:120px;height:70px;background-size:contain;background-position:center;background-repeat:no-repeat;background-color:rgba(255,255,255,.3);margin:0 15px;border:2px solid #fff;cursor:pointer;transition:all .3s ease-in}#showroom-variants>div.active,#showroom-variants>div:hover{border-color:orange}.orientation-landscape{position:absolute;top:40%;left:50%;right:0;bottom:0;transform:translate(-50%,-50%);z-index:9999;text-align:center;display:none}.orientation-landscape p{font-size:20px;font-weight:600;color:#fff}.orientation-landscape img{width:200px}::-webkit-scrollbar-track{-webkit-box-shadow:inset 0 0 6px rgba(0,0,0,.3);background-color:#f5f5f5}::-webkit-scrollbar{width:6px;height:6px;background-color:#f5f5f5}::-webkit-scrollbar-thumb{background-color:#000;border:2px solid #555;max-width:100px}::-webkit-scrollbar-track-piece:end{margin-right:30px}::-webkit-scrollbar-track-piece:start{margin-left:30px}@media (orientation:portrait){#showroom{width:90%;height:420px;top:80px;transform:translate(-50%,0)}#scene canvas{position:absolute;top:0;left:50%;transform:translateX(-50%);z-index:1}#showroom-controls{border-radius:0}}@media (orientation:landscape){#showroom{width:640px;height:480px}}
    </style>
</head>
<body>

<a class="btn"  href="{{route('products',$product->id)}}">

    <span>رجوع للمنتج</span>
</a>
<section id="content-wrapper">


    <div id="showroom">
        <video id="video" muted playsinline autoplay style="display: none;"></video>
        <section id="scene"></section>
        <div id="loader">
            <h3 id="loader-title">Loading...</h3>
            <div id="loader-value">0%</div>
        </div>
    </div>
    <div id="showroom-variants">

        <img src="#" data-url="{{$product->getFirstMediaUrl('glb')}}" style="display: none" id="first_path_inti" alt="">

        <div class="showroom-variant showroom-variant-1 active"
             style="background-image: url({{$product->getFirstMediaUrl('master_image')}});"
             onclick="changeVariant(1,'{{$product->getFirstMediaUrl('glb')}}')">
        </div>
    </div>
    <div class="orientation-landscape">
        <p>Turn your device</p>
        <img loading="lazy" src="{{asset('website/virtual_glasses/img/orientation.png')}}" alt="orientation">

    </div>
</section>

<script src="//unpkg.com/@tensorflow/tfjs-core@2.4.0/dist/tf-core.js"></script>
<script src="//unpkg.com/@tensorflow/tfjs-converter@2.4.0/dist/tf-converter.js"></script>
<script src="//unpkg.com/@tensorflow/tfjs-backend-wasm@2.4.0/dist/tf-backend-wasm.js"></script>
<script src="//unpkg.com/@tensorflow-models/face-landmarks-detection@0.0.3/dist/face-landmarks-detection.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/UAParser.js/0.7.20/ua-parser.min.js"></script>

<script src='{{asset('website/virtual_glasses/js/three.min.js')}}'></script>
<script src="{{asset('website/virtual_glasses/js/GLTFLoader.js')}}"></script>
<script src="{{asset('website/virtual_glasses/js/DRACOLoader.js')}}"></script>
<script src="{{asset('website/virtual_glasses/js/script.js')}}"></script>

</body>
</html>
