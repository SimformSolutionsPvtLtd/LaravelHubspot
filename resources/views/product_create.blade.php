<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Product Create Page</title>
    @include('layouts.link')
</head>
<style>
    /* Center the form container */
</style>
<body>
    @include('layouts.navbar')
    <div id="form-container">
        <!-- Embeded Custom Object HubSpot form code here -->
        
        <!-- End Here -->
        <div class="container mt-5 text-center">
            <span class="h3">Enter Details To Create Custom Object Record - Product</span>
            <div id="hubspot-form-container"></div>
        </div>
    </div>
</body>
</html>
