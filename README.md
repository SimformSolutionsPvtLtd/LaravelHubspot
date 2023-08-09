## HUBSPOT SETUP STEPS : 
    1. Create Hubspot Account (https://app.hubspot.com/)
    
    2. Create API Key 
        - Go To Setting > Account Setup > Integration >Private App > Access Token
    
    3. Copy Key In .env File (HUBSPOT_ACCESS_TOKEN)
    
    4. Create Custom Object Product With Below Field : 
        - Product Name - Text 
        - Product Price - Number
        - Product Category  - Dropdown 
        - Product Image  - File 
    
    5. Create Form And Embed Script In Blade File. 
        - Go To Marketing > Lead capture > Form 
        - Create Form with Contact Property That You want to Display in Web Page With Desgin
        - After Creating Form Add Scipt In Blade File (signup_news.blade.php)
        - Now Create Form For Custom Object Product and Add Scipt In Blade File(product_create.blade.php)
    
    6. Create Mail Template To send Welcome For New Contact 
        - Go To Marketing > Email 
        - Now create Email with Template and Add Required Details in Template 
    
    7. Now Create Workflow For New Contact : 
        - Go To Automation > Workflows 
        - Create Workflow for Form Submission Action
        - Trigger : Send Mail With Mail Template We Created
    
    8. When User Submit Form That Data Store In Our Hubspot Object         
    
    9. When Sign_up form which we have integrate in Our Signup_news Page Submit By User, That Trigger Workflow and Send Mail To That User.
