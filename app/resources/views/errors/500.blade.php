<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
       <link rel="shortcut icon" href="{{asset('/fav.png')}}">
    <!-- Page Title  -->
    <title>  Errors | 500</title>
    <!-- StyleSheets  -->
      <link rel="stylesheet" href="{{asset('/asset/css/dashlite.css?ver=2.2.0')}}">
    <link id="skin-default" rel="stylesheet" href="{{asset('/asset/css/theme.css?ver=2.2.0')}}">
</head>

<body class="nk-body bg-white npc-general pg-error">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle wide-xs mx-auto">
                        <div class="nk-block-content nk-error-ld text-center">
                            <h3 class="nk-error-title">Error Occured</h3>
                            <h3 class="nk-error-title">Opps!, Seems this page is broken</h3>
                            <a href="{{route('home')}}" class="btn btn-lg btn-primary mt-2">Back To Home</a>
                        </div>
                    </div><!-- .nk-block -->
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
   <script src="{{asset('/asset/bundle.js?ver=2.2.0')}}"></script>
    <script src="{{asset('/asset/scripts.js?ver=2.2.0')}}"></script>

</html>