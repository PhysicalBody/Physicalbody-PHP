<?php 
// Product Details 
// Minimum amount is $0.50 US 
// Test Stripe API configuration 

define('STRIPE_API_KEY', 'sk_test_51L41u9BvZ1aJbSFtvPGvWZ0YyV3LpAbGAaPf5UBT8R1aHXNF33mZMQBFj7CTW43s2aFsAiTbvFEJSKJsiLWysIF500DgcgjGGx');  
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51L41u9BvZ1aJbSFtesfY3mGS9EpeB8XzuexSxSIGVnWhAGnpWzb0SVMO2equbRWICLjMAypHmeWV0UxkTNi2buoQ00X8chRssF'); 

define('STRIPE_SUCCESS_URL', 'http://localhost/success.php'); 
define('STRIPE_CANCEL_URL', 'http://localhost/cancel.php'); 

// Database configuration   
define('DB_HOST', 'localhost');  
define('DB_USERNAME', 'root');  
define('DB_PASSWORD', '');  
define('DB_NAME', 'physicalbody'); 
?>



