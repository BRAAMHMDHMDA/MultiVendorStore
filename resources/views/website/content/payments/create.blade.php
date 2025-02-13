<x-website.website-layout title="Order Payment">
  <x-website.breadcrumb title="Stripe Payment" current="Order #{{ $order->number }} Payment"/>
  <section class="about section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="about-content">
            <div class="section-title">
              <h2 class="title-checkout"><i class="icon-basket-loaded"></i>Order #{{ $order->number }} Payment</h2>
            </div>
          </div>
        </div>
        <div class="col-lg-12 mb-50">
          {{-- order detailes --}}
          <div class="d-flex justify-content-center mb-20" style="display: flex; justify-content: center; gap: 30px">
            <div>
              <strong>Order Number:</strong>
              {{ $order->number }}
            </div>
            <div>
              <strong>Store:</strong>
              {{ $order->store->name }}
            </div>
            <div>
              <strong>Date:</strong>
              {{ $order->created_at->diffForHumans() }}
            </div>
            <div>
              <strong>Payment Status: </strong>
              {{ $order->payment_status }}
            </div>
          </div>
        </div>

        <!-- Start Left Area -->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <h2 class="title-checkout"><i class="icon-credit-card"></i>Card Info</h2>
          <div>
            <div id="payment-message" class="alert alert-info hidden"></div>

            <form action="" method="post" id="payment-form">

              <div id="payment-element"></div>

              <button type="submit" id="submit" class="btn btn-primary" style="margin-top: 25px">
                <span id="button-text">Pay Now</span>
                <span id="spinner" class="hidden">Processing..</span>
              </button>

            </form>
          </div>

        </div>
        <!-- End Left Area -->

        <!-- Start Right Area -->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="order-details mb-50">
            <h2 class="title-checkout"><i class="icon-basket-loaded"></i>Your Order</h2>
            <div class="order_review margin-bottom-35">

              <table class="table table-responsive table-review-order">
                <thead>
                <tr>
                  <th class="product-name">Product</th>
                  <th class="product-quantity" style="width:0">Qty</th>
                  <th class="product-total">Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->items as $item)
                  <tr>
                    <td><p>{{$item->product->name}}</p></td>
                    <td><p>{{$item->quantity}}</p></td>
                    <td><p class="price">{{Currency::format($item->product->price)}} x {{$item->quantity}}</p></td>
                  </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Subtotal</th>
                  <td colspan="2">
                    <p class="price">{{ Currency::format($order->total) }}</p>
                  </td>
                </tr>
                <tr>
                  <th>Total</th>
                  <td colspan="2"><p class="price">{{ Currency::format($order->total) }}</p></td>
                </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
        <!-- End Right Area -->
      </div>



    </div>
  </section>

  <script src="https://js.stripe.com/v3/"></script>
  <script>
    // This is your test publishable API key.
    const stripe = Stripe("{{ config('services.stripe.publishable_key') }}");

    let elements;


    initialize();

    document
      .querySelector("#payment-form")
      .addEventListener("submit", handleSubmit);

    // Fetches a payment intent and captures the client secret
    async function initialize() {
      const {clientSecret} = await fetch("{{ route('stripe.paymentIntent.create', $order->id) }}", {
        method: 'POST',
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({
          "_token": "{{ csrf_token() }}"
        }),
      }).then((r) => r.json());

      elements = stripe.elements({
        clientSecret
      });

      const paymentElement = elements.create("payment");
      paymentElement.mount("#payment-element");
    }

    async function handleSubmit(e) {
      e.preventDefault();
      setLoading(true);

      const {
        error
      } = await stripe.confirmPayment({
        elements,
        confirmParams: {
          // Make sure to change this to your payment completion page
          return_url: "{{ route('stripe.return', $order->id) }}",
        },
      });

      // This point will only be reached if there is an immediate error when
      // confirming the payment. Otherwise, your customer will be redirected to
      // your `return_url`. For some payment methods like iDEAL, your customer will
      // be redirected to an intermediate site first to authorize the payment, then
      // redirected to the `return_url`.
      if (error.type === "card_error" || error.type === "validation_error") {
        showMessage(error.message);
      } else {
        showMessage("An unexpected error occurred.");
      }

      setLoading(false);
    }

    // ------- UI helpers -------
    function showMessage(messageText) {
      const messageContainer = document.querySelector("#payment-message");

      messageContainer.classList.remove("hidden");
      messageContainer.textContent = messageText;

      setTimeout(function () {
        messageContainer.classList.add("hidden");
        messageContainer.textContent = "";
      }, 4000);
    }

    // Show a spinner on payment submission
    function setLoading(isLoading) {
      if (isLoading) {
        // Disable the button and show a spinner
        document.querySelector("#submit").disabled = true;
        document.querySelector("#spinner").classList.remove("hidden");
        document.querySelector("#button-text").classList.add("hidden");
      } else {
        document.querySelector("#submit").disabled = false;
        document.querySelector("#spinner").classList.add("hidden");
        document.querySelector("#button-text").classList.remove("hidden");
      }
    }
  </script>
  {{--@push('scripts')--}}
  {{--    <script src="https://js.stripe.com/v3/"></script>--}}

  {{--    <script>--}}
  {{--        // This is your test publishable API key.--}}
  {{--        const stripe = Stripe("{{config('services.stripe.publishable_key')}}");--}}

  {{--        // The items the customer wants to buy--}}
  {{--        const items = [{ id: "xl-tshirt" }];--}}

  {{--        let elements;--}}

  {{--        initialize();--}}

  {{--        document--}}
  {{--            .querySelector("#payment-form")--}}
  {{--            .addEventListener("submit", handleSubmit);--}}

  {{--        let emailAddress = '';--}}
  {{--        // Fetches a payment intent and captures the client secret--}}
  {{--        async function initialize() {--}}
  {{--            const {--}}
  {{--                clientSecret--}}
  {{--            } = await fetch("{{ route('stripe.paymentIntent.create', $order->id) }}", {--}}
  {{--                method: "post",--}}
  {{--                headers: {--}}
  {{--                    "Content-Type": "application/json"--}}
  {{--                },--}}
  {{--                body: JSON.stringify({--}}
  {{--                    "_token": "{{ csrf_token() }}"--}}
  {{--                }),--}}
  {{--            }).then((r) => r.json());--}}

  {{--            elements = stripe.elements({--}}
  {{--                clientSecret--}}
  {{--            });--}}

  {{--            const paymentElement = elements.create("payment");--}}
  {{--            paymentElement.mount("#payment-element");--}}
  {{--        }--}}

  {{--        async function handleSubmit(e) {--}}
  {{--            e.preventDefault();--}}
  {{--            setLoading(true);--}}

  {{--            const { error } = await stripe.confirmPayment({--}}
  {{--                elements,--}}
  {{--                confirmParams: {--}}
  {{--                    // Make sure to change this to your payment completion page--}}
  {{--                    return_url: "{{ route('stripe.return', $order->id) }}",--}}
  {{--                    receipt_email: emailAddress,--}}
  {{--                },--}}
  {{--            });--}}

  {{--            // This point will only be reached if there is an immediate error when--}}
  {{--            // confirming the payment. Otherwise, your customer will be redirected to--}}
  {{--            // your `return_url`. For some payment methods like iDEAL, your customer will--}}
  {{--            // be redirected to an intermediate site first to authorize the payment, then--}}
  {{--            // redirected to the `return_url`.--}}
  {{--            if (error.type === "card_error" || error.type === "validation_error") {--}}
  {{--                showMessage(error.message);--}}
  {{--            } else {--}}
  {{--                showMessage("An unexpected error occurred.");--}}
  {{--            }--}}

  {{--            setLoading(false);--}}
  {{--        }--}}



  {{--        // ------- UI helpers ---------}}
  {{--        function showMessage(messageText) {--}}
  {{--            const messageContainer = document.querySelector("#payment-message");--}}

  {{--            messageContainer.classList.remove("hidden");--}}
  {{--            messageContainer.textContent = messageText;--}}

  {{--            setTimeout(function () {--}}
  {{--                messageContainer.classList.add("hidden");--}}
  {{--                messageContainer.textContent = "";--}}
  {{--            }, 4000);--}}
  {{--        }--}}

  {{--        // Show a spinner on payment submission--}}
  {{--        function setLoading(isLoading) {--}}
  {{--            if (isLoading) {--}}
  {{--                // Disable the button and show a spinner--}}
  {{--                document.querySelector("#submit").disabled = true;--}}
  {{--                document.querySelector("#spinner").classList.remove("hidden");--}}
  {{--                document.querySelector("#button-text").classList.add("hidden");--}}
  {{--            } else {--}}
  {{--                document.querySelector("#submit").disabled = false;--}}
  {{--                document.querySelector("#spinner").classList.add("hidden");--}}
  {{--                document.querySelector("#button-text").classList.remove("hidden");--}}
  {{--            }--}}
  {{--        }--}}
  {{--    </script>--}}
  {{--@endpush--}}
</x-website.website-layout>
