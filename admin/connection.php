<?php
    // date_default_timezone_set("Asia/Calcutta"); 
    date_default_timezone_set('Europe/London');
    $conn=mysqli_connect("localhost","activrm2_foodwaste","Active4u.","activrm2_foodwaste") or die(mysqli_error($conn));

    //ADMIN
    
    $webname = "Food Waste Saver";
    // $domain = "https://foodwaste.activeapp.in/	";
	$domain = "http://localhost/web/";
	$resdomain = "http://localhost/web/admin/";
    
    $ADMIN_PRODUCT_IMG = "assets/images/meal/";
    $ADMIN_CATEGORY_IMG = "images/category/";  
    $ADMIN_DELIVERYBOY_IMG = "images/deliveryboy/";   
    $ADMIN_MORE_IMG = "images/more/";       
    $ADMIN_DELIVERYBOY_CASH_IMG = "images/payment_deliveryboy/";
    
    $ADMIN_SLIDER_IMG = "images/slider/";  

    $ADMIN_SUBCATEGORY_IMG = "images/subcategory/";
    $ADMIN_CATALOGUE_IMG = "images/catalogue/";
    $ADMIN_CATALOGUE_PDF = "images/catalogue/pdf/";
    $ADMIN_SERVICE_IMG = "images/service/";
    $ADMIN_MEDIA_IMG = "images/media/";
    $ADMIN_SLIDER_IMG = "images/slider/";
    $ADMIN_GALLERY_IMG  = "images/gallery/";
    $ADMIN_BLOG_IMG  = "images/blog/";
    $ADMIN_MENU_IMG  = "images/logo/";


    $RES_PRODUCT_IMG = "../admin/assets/images/meal/";
    $ADMIN_RESTAURANT_IMG = "assets/images/restaurant/";
    $ADMIN_FOODBANK_IMG = "assets/images/foodbank/";

?>