<x-website.website-layout title="Order Payment">
    <x-website.breadcrumb title="About Us" current="About Us"/>
    <section class="about section">
        <div class="container">
                <div style="width: 50%; margin: auto">
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