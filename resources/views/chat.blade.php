<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
	<div id="app" class="container card p-4 mt-4">
        <div class="row flex-wrap-reverse">
            <div class="col-md-8" >
                
        		<chat-log :messages="messages"></chat-log>
        		<chat-composer v-on:messagesent="addmessage" :user="{{ json_encode(Auth::user()) }}"></chat-composer>
            </div>
            <div class="col-md-4">
                <ideas :ideas="ideas" :end="{{ json_encode($endtime) }}"></ideas>
            </div>
        </div>
                <notifications group="foo" position="bottom right"/></notifications>

	</div>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript">
        
    </script>
</body>
</html>