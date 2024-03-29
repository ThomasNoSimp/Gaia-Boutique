<?php

require_once('vendor/autoload.php');

\Stripe\Stripe::setApiKey('sk_test_51OsIOrRxCyi15F9mVyXby2mqslkawyUbnvjAxxYjsCU3opsFZc3QQhqymATA2VSlQeqohHp1Vxx3GnUO1ep1tmKR00Sk0QRpgK');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the token generated by Stripe.js
    $token_json = file_get_contents("php://input");
    $token_data = json_decode($token_json);

    if (!isset($token_data->token)) {
        // Token is missing, handle the error
        echo json_encode(['success' => false, 'error' => 'Token is missing']);
        exit;
    }

    $token = $token_data->token;

    try {
        // Create a charge using the Stripe API
        $charge = \Stripe\Charge::create([
            'amount' => 1000, // Adjust the amount as needed
            'currency' => 'usd',
            'source' => $token,
            'description' => 'Example charge',
        ]);

        
        // Return a success response
        echo json_encode(['success' => true, 'message' => 'Payment successful']);

    } catch (\Stripe\Exception\CardException $e) {
        // Handle card errors
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    } catch (\Stripe\Exception\InvalidRequestException $e) {
        // Handle invalid request errors
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    } catch (\Stripe\Exception\AuthenticationException $e) {
        // Handle authentication errors
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    } catch (\Stripe\Exception\ApiConnectionException $e) {
        // Handle API connection errors
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    } catch (\Stripe\Exception\ApiErrorException $e) {
        // Handle other API errors
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}

?>
