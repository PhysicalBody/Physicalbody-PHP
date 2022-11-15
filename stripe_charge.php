<?php
session_start();
require_once 'config.php';
// Include Stripe PHP library 
require_once 'stripe-php/init.php';

//Pegando chave da URL
$chave = $_SESSION['chave'];
// Set API key
\Stripe\Stripe::setApiKey('sk_test_51L41u9BvZ1aJbSFtvPGvWZ0YyV3LpAbGAaPf5UBT8R1aHXNF33mZMQBFj7CTW43s2aFsAiTbvFEJSKJsiLWysIF500DgcgjGGx');
$response = array(
    'status' => 0,
    'error' => array(
        'message' => 'Invalid Request!'   
    )
);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$input = file_get_contents('php://input');
	$request = json_decode($input);	
}
if (json_last_error() !== JSON_ERROR_NONE) {
	http_response_code(400);
	echo json_encode($response);
	exit;
}
$productName = $request->Name; 
$productID = $request->ID;
$productPrice = $request->Price; 


 
// Convert product price to cent 
$stripeAmount = round($productPrice*100, 2); 

if(!empty($request->checkoutSession)){
    // Create new Checkout Session for the order
    try {
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'product_data' => [
                        'name' => $productName,
                        'metadata' => [
                            'pro_id' => $productID
                        ]
                    ],
                    'unit_amount' => $stripeAmount,
                    'currency' => 'brl',
                ],
                'quantity' => 1,
                'description' => $productName,
            ]],
            'mode' => 'payment',
            'success_url' => STRIPE_SUCCESS_URL.'?session_id={CHECKOUT_SESSION_ID}&getID='.$productID.'&chave='.$chave,
            'cancel_url' => STRIPE_CANCEL_URL,
        ]);
    }catch(Exception $e) { 
        $api_error = $e->getMessage(); 
    }
    
    if(empty($api_error) && $session){
        $response = array(
            'status' => 1,
            'message' => 'Checkout Session created successfully!',
            'sessionId' => $session['id']
        );
    }else{
        $response = array(
            'status' => 0,
            'error' => array(
                'message' => 'Checkout Session creation failed! '.$api_error   
            )
        );
    }
}

// Return response
echo json_encode($response);