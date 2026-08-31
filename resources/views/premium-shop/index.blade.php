@extends('premium-shop.layout')

@section('title')
    Premium Shop
@endsection

@section('content')
    {!! breadcrumbs(['Premium Shop' => 'premium-shop']) !!}

    <h1>Premium Shop</h1>
    <p>Purchase items and currency using real money. Payments are processed securely by Stripe.</p>

    @if (!$products->count())
        <p class="text-center">No products are currently available.</p>
    @else
        @php
            $currencies = $products->where('rewardable_type', 'Currency');
            $items = $products->where('rewardable_type', 'Item');

            // Group items by category name, falling back to 'Uncategorized'
            $itemsByCategory = $items->groupBy(function ($product) {
                return $product->rewardable?->category?->name ?? 'Uncategorized';
            });
        @endphp

        {{-- Currency Section --}}
        @if ($currencies->count())
            <div class="card mb-4 inventory-category">
                <h5 class="card-header inventory-header">Currency</h5>
                <div class="card-body inventory-body">
                    <div class="row">
                        @foreach ($currencies as $product)
                            <div class="col-sm-3 col-6 text-center inventory-item d-flex flex-column justify-content-end mb-3" data-id="{{ $product->id }}">
                                <div class="mb-1">
                                    @if ($product->imageUrl)
                                        <img src="{{ $product->imageUrl }}" alt="{{ $product->name }}" style="max-height: 200px;">
                                    @endif
                                </div>
                                <div>
                                    <strong>{{ $product->name }}</strong>
                                    <div>{{ $product->quantity }}x {{ optional($product->rewardable)->name ?? 'Unknown' }}</div>
                                    <div><strong>Price:</strong> {{ $product->price_display }}</div>
                                    <div class="mt-2">
                                        @auth
                                            <button class="btn btn-primary btn-sm buy-btn" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price_display }}">
                                                Buy Now
                                            </button>
                                        @else
                                            <a href="{{ url('login') }}" class="btn btn-secondary btn-sm">Login to Purchase</a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{-- Items grouped by category --}}
        @foreach ($itemsByCategory as $categoryName => $categoryProducts)
            <div class="card mb-4 inventory-category">
                <h5 class="card-header inventory-header">{{ $categoryName }}</h5>
                <div class="card-body inventory-body">
                    <div class="row">
                        @foreach ($categoryProducts as $product)
                            <div class="col-sm-3 col-6 text-center inventory-item d-flex flex-column justify-content-end mb-3" data-id="{{ $product->id }}">
                                <div class="mb-1">
                                    @if ($product->imageUrl)
                                        <img src="{{ $product->imageUrl }}" alt="{{ $product->name }}" style="max-height: 200px;">
                                    @elseif (optional($product->rewardable)->imageUrl)
                                        <img src="{{ $product->rewardable->imageUrl }}" alt="{{ $product->name }}" style="max-height: 200px;">
                                    @endif
                                </div>
                                <div>
                                    <strong>{{ $product->name }}</strong>
                                    <div>{{ $product->quantity }}x {{ optional($product->rewardable)->name ?? 'Unknown' }}</div>
                                    <div><strong>Price:</strong> {{ $product->price_display }}</div>
                                    <div class="mt-2">
                                        @auth
                                            <button class="btn btn-primary btn-sm buy-btn" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price_display }}">
                                                Buy Now
                                            </button>
                                        @else
                                            <a href="{{ url('login') }}" class="btn btn-secondary btn-sm">Login to Purchase</a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
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
        document.body.appendChild(document.getElementById('paymentModal'));
        const stripe = Stripe('{{ $stripeKey }}');
        let elements;
        let currentProductId;

        $('.buy-btn').on('click', async function() {
            currentProductId = $(this).data('id');
            const name = $(this).data('name');
            const price = $(this).data('price');

            $('#purchase-summary').text('You are purchasing: ' + name + ' for ' + price);
            $('#payment-message').addClass('hide').text('');
            $('#paymentModal').modal('show');

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

            elements = stripe.elements({
                clientSecret: data.clientSecret
            });
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

            const {
                error
            } = await stripe.confirmPayment({
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
