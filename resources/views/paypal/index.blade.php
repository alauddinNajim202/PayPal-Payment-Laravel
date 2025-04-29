<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel PayPal Payment Gateway Integration Example - ItSolutionStuff.com</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container">

    <div class="row mt-5 mb-5">

        <div class="col-10 offset-1 mt-5">

            <div class="card">

              

                <div class="card-body">

  

                    @if ($message = Session::get('success'))

                      <div class="alert alert-success alert-dismissible fade show" role="alert">

                        <strong>{{ $message }}</strong>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                      </div>

                    @endif

  

                    @if ($message = Session::get('error'))

                        <div class="alert alert-danger alert-dismissible fade show" role="alert">

                          <strong>{{ $message }}</strong>

                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                        </div>

                    @endif

                    <h3 class="text-center">Laravel PayPal Payment Gateway Integration Example</h3>
                    <p class="text-center">This is a simple example of PayPal payment gateway integration in Laravel.</p>
                    <p class="text-center">Click the button below to make a payment.</p>


                    {{-- product information --}}

                    <div class="text-center mb-4">
                        <h4>Product Name: Sample Product</h4>
                        <p>Price: $10.00</p>
                        <p>Currency: USD</p>
                        <p>Order ID: 12345</p>
                        <p>Quantity: 1</p>
                        <p>Description: This is a sample product for testing PayPal integration.</p>
                    </div>

                    


                    <form action="{{ route('paypal.payment') }}" method="GET" class="text-center">
                        @csrf
                        <input type="hidden" name="amount" value="10.00">
                        <input type="hidden" name="currency" value="USD">
                        <input type="hidden" name="description" value="Payment for order #12345">
                        
                        <button type="submit" class="btn btn-primary">Pay with PayPal</button>
                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>