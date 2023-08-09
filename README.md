# HubSpot Integration with Laravel Demo

This repository offers a demo showing how several HubSpot capabilities can be integrated with a Laravel project. Integrations for email, contact management, form submission, and process triggers are all included in the sample. You can follow the instructions in this README for setting up and using the integration.

## Table of Contents

- [Features](#features)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Contribute](#contribute)
- [Scope](#scope)

## Features
- **Contact Management**: Shows how to create, update, and retrieve contact information from HubSpot.
- **Form Integration**: Illustrates integrating HubSpot forms into your Laravel application.
- **Workflow Triggers**: Explains how to set up workflow triggers based on certain conditions.Here we have used new contact creation trigger.
- **Email Integration**: Demonstrates how to send welcome email to contact using workflow when new user submit form.

## Prerequisites

- [Laravel](https://laravel.com/docs) installed on your system.
- [Composer](https://getcomposer.org/download/) for managing PHP dependencies.
- HubSpot API credentials. Create a developer account and obtain your HubSpot API key.

  Here's steps how you can obtain your HubSpot API key and steps to setup hubspot form,email template and worflow:

  - Log in to your HubSpot account(https://app.hubspot.com/).
  - Navigate to the API key section in your account settings
      - Go To Setting > Account Setup > Integration >Private App > Access Token
  - Copy Key In .env File for our project 
  - Create Custom Object Product With Below Field : 
    - Product Name - Text 
    - Product Price - Number
    - Product Category  - Dropdown 
    - Product Image  - File
  - Create Form And Embed Script In Blade File. 
    - Go To Marketing > Lead capture > Form 
    - Create Form with Contact Property That You want to Display in Web Page With Desgin
    - After Creating Form Add Scipt In Blade File (signup_news.blade.php)
    - Now Create Form For Custom Object Product and Add Scipt In Blade File(product_create.blade.php)
  - Create Mail Template To send Welcome For New Contact 
    - Go To Marketing > Email 
    - Now create Email with Template and Add Required Details in Template 
  - Now Create Workflow For New Contact : 
    - Go To Automation > Workflows 
    - Create Workflow for Form Submission Action
    - Trigger : Send Mail With Mail Template We Created 
## Installation

1. Clone this repository to your local machine:

   ```sh
   git clone https://github.com/SimformSolutionsPvtLtd/LaravelHubspot.git
   cd hubspot-laravel-demo
2. Install Dependencies: Use Composer to install the PHP dependencies:

   ```sh 
   composer install 
3. Create a copy of the .env.example file and name it .env:

   ```sh
   cp .env.example .env
4. Run database migrations to create the necessary tables:
      ```sh
   php artisan migrate   
## Configuration

1. Open the .env file and provide your HubSpot API credentials:
   ```sh 
   HUBSPOT_API_KEY=your-hubspot-api-key 
2. Add scrip of hubspot form which we have created in hubspot setup in our blade file.    
## Usage

1. Start Laravel Server: Launch the Laravel development server:

   ```sh
   php artisan serve
2. Access the Demo: Open your browser and visit:

   ```sh 
   http://localhost:8000 
3. Explore the Demo: Navigate through the different sections of the demo to see the HubSpot integrations in action. 
   - List Of User From Hubspt : http://localhost:8000/hubspot-user 
   - Sign Up Form : http://localhost:8000/signup-news 
   - Product Form : http://localhost:8000//create-product  

   
   When you submit form in our website that data will store on hubspot object and workflow trigger which we have created at the time of hubspot setup.

## Contribute 

- We welcome contributions from the community to improve and enhance this HubSpot Integration Demo with Laravel. Whether you want to fix a bug, improve existing features, or add new functionality, your contributions are valuable.

## Scope 
- We encourage feature additions that align with the scope of this demo and enhance the understanding of integrating HubSpot with Laravel. Here are some ideas for potential features:

  - **Custom Workflow Integration**: Demonstrating more complex workflow triggers or actions.
  - **Interactive Examples**: Adding interactive examples to guide users through the integration process step-by-step.
  - **Additional HubSpot Features**: Exploring and integrating other HubSpot features like social media interactions or marketing automation.
    