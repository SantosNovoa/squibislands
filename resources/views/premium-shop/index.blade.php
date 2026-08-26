@extends('home.layout')

@section('title') Premium Shop @endsection

@section('content')
    {!! breadcrumbs(['Premium Shop' => 'premium-shop']) !!}

    <h1>Premium Shop</h1>
    <p>Purchase items and currency using real money. Payments are processed securely by Stripe.</p>

    @if (!$products->count())
        <p class="text-center">No products are currently available.</p>
    @else
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if ($product->imageUrl)
                            <img src="{{ $product->imageUrl }}" class="card-img-top" alt="{{ $product->name }}" style="object-fit: cover; height: 200px;" />
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            @if ($product->description)
                                <p class="card-text">{{ $product->description }}</p>
                            @endif
                            <p class="card-text">
                                <strong>Reward:</strong>
                                {{ $product->quantity }}x
                                {{ $product->rewardable_type === 'Currency'
                                    ? \App\Models\Currency\Currency::find($product->rewardable_id)->name ?? 'Unknown'
                                    : \App\Models\Item\Item::find($product->rewardable_id)->name ?? 'Unknown' }}
                            </p>
                            <p class="card-text"><strong>Price:</strong> {{ $product->price_display }}</p>
                            <div class="mt-auto">
                                @auth
                                    <button class="btn btn-primary btn-block buy-btn"
                                            data-id="{{ $product->id }}"
                                            data-name="{{ $product->name }}"
                                            data-price="{{ $product->price_display }}">
                                        Buy Now
                                    </button>
                                @else
                                    <a href="{{ url('login') }}" class="btn btn-secondary btn-block">Login to Purchase</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Payment Modal --}}
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Complete Purchase</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <p id="purchase-summary"></p>
                    <div id="payment-element"></div>
                    <div id="payment-message" class="text-danger mt-2 hide"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="submit-payment">
                        <span id="button-text">Pay Now</span>
                        <span id="spinner" class="hide">...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ $stripeKey }}');
        let elements;
        let currentProductId;

        $('.buy-btn').on('click', async function() {
            currentProductId = $(this).data('id');
            const name  = $(this).data('name');
            const price = $(this).data('price');

            $('#purchase-summary').text('You are purchasing: ' + name + ' for ' + price);
            $('#payment-message').addClass('hide').text('');
            $('#paymentModal').modal('show');

            // Create payment intent
            const response = await fetch('{{ url('premium-shop/intent') }}/' + currentProductId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            const data = await response.json();

            if (data.error) {
                $('#payment-message').removeClass('hide').text(data.error);
                return;
            }

            elements = stripe.elements({ clientSecret: data.clientSecret });
            const paymentElement = elements.create('payment');
            paymentElement.mount('#payment-element');
        });

        $('#paymentModal').on('hidden.bs.modal', function() {
            $('#payment-element').empty();
        });

        $('#submit-payment').on('click', async function() {
            $('#button-text').addClass('hide');
            $('#spinner').removeClass('hide');
            $('#submit-payment').prop('disabled', true);

            const { error } = await stripe.confirmPayment({
                elements,
                confirmParams: {
                    return_url: '{{ url('premium-shop/complete') }}',
                },
            });

            if (error) {
                $('#payment-message').removeClass('hide').text(error.message);
                $('#button-text').removeClass('hide');
                $('#spinner').addClass('hide');
                $('#submit-payment').prop('disabled', false);
            }
        });
    </script>
@endsection