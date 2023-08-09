<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Sign Up News</title>
    @include('layouts.link')
</head>
<style>
    /* Center the form container */
</style>

<body>
    @include('layouts.navbar')  
    <div id="form-container">
        <!-- Embeded Sign Up HubSpot form code here -->

        <!-- End Here -->
        <div class="container mt-5 text-center">
            <span class="h3">Enter Details To Create Contact In Hubspot</span>
            <div id="hubspot-form-container"></div>
        </div>
    </div>
</body>
</html>
