<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Credit Card Page</title>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-md mx-auto bg-white p-8 rounded-md shadow-md">
        <h1 class="text-2xl font-semibold mb-6">Credit Card Information</h1>
        <form id="payment-form">
            <!-- Credit Card Number Input -->
            <div class="mb-4">
                <label for="cardNumber" class="block text-sm font-medium text-gray-600">Credit Card Number</label>
                <div id="cardElement" class="mt-1 p-2 w-full border rounded-md"></div>
            </div>

            <!-- Name on Card -->
            <div class="mb-4">
                <label for="cardName" class="block text-sm font-medium text-gray-600">Name on Card</label>
                <input type="text" id="cardName" name="cardName" class="mt-1 p-2 w-full border rounded-md">
            </div>

            <!-- Country, City, Postal Code -->
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <label for="country" class="block text-sm font-medium text-gray-600">Country</label>
                    <select id="country" name="country" class="mt-1 p-2 w-full border rounded-md" onchange="updateCities()">
                        <option value="Select..." selected disabled>Select...</option>
                        <option value="France">France</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Switzerland">Switzerland</option>
                    </select>
                </div>
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-600">City</label>
                    <select id="city" name="city" class="mt-1 p-2 w-full border rounded-md"></select>
                </div>
                <div>
                    <label for="postalCode" class="block text-sm font-medium text-gray-600">Postal Code</label>
                    <input type="text" id="postalCode" name="postalCode" class="mt-1 p-2 w-full border rounded-md">
                </div>
            </div>

            <!-- Submit Button -->
            <button id="submitBtn" class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">
                Continue
            </button>
        </form>
    </div>

    <script src="https://js.stripe.com/v3/"></script>

    <script>
        var stripe = Stripe('pk_test_51OsIOrRxCyi15F9mIiIwTpbJL2DCfkB0c3UirVtKkKOs4NMXN624T1T8RHy7gXtx6x1ZihrmCALwsoWGraPw0lj000pJ9WUzuh');

        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#cardElement');

        var form = document.getElementById('payment-form');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    console.error(result.error.message);
                } else {
                    var token = result.token.id;

                    fetch('process-payment.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ token: token }),
                    })

                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }
            });
        });

        function updateCities() {
            var countrySelect = document.getElementById("country");
            var citySelect = document.getElementById("city");

            var country = countrySelect.value;

            // Clear existing options
            citySelect.innerHTML = "";

            if (country === "France") {
                var cities = ["Select...", "Paris", "Marseille", "Lyon"];
            } else if (country === "Belgium") {
                var cities = ["Select...", "Brussels", "Antwerp", "Ghent"];
            } else if (country === "Switzerland") {
                var cities = ["Select...", "Zurich", "Geneva", "Basel"];
            } else {
                var cities = [];
            }

            // Populate city options
            cities.forEach(function(city) {
                var option = document.createElement("option");
                option.text = city;
                citySelect.add(option);
            });
        }
    </script>
</body>
</html>
