@extends('layouts.app')

@section('content')

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section ftco-animate text-center">
                    <h2 class="mb-4">Our Menu</h2>
                    <p>Explore our delicious selection of handcrafted pizzas. Choose from our signature classics or create your own masterpiece with up to 4 toppings. Every pizza is made fresh to order with premium ingredients.</p>
                </div>
            </div>
        </div>
        <div class="container-wrap">
            <div class="row no-gutters d-flex" style="padding: 0 15px;">

                @foreach ($pizza as $i)
                    <div class="col-lg-6 col-md-6 col-sm-12 d-flex ftco-animate mb-4 mb-md-4 mb-lg-5" style="padding: 0 15px;">
                        <div class="services-wrap d-flex" style="width: 100%;">
                            <a href="#" class="img"
                                style="background-image: url({{ url('images/' . $i->image) }});"></a>
                            <div class="text p-4">
                                <h3>{{ $i->pizza_name }}</h3>
                                <p>{{ $i->pizza_description }}</p>
                                <p class="price">
                                    <span>£{{ $i->price }}</span> 
                                    @if($i->type === 'custom')
                                        <button type="button" class="ml-2 btn btn-white btn-outline-white" 
                                                data-toggle="modal" 
                                                data-target="#customPizzaModal"
                                                data-pizza-id="{{ $i->id }}"
                                                data-pizza-name="{{ $i->pizza_name }}"
                                                data-pizza-price="{{ $i->price }}">
                                            Build Your Own
                                        </button>
                                    @else
                                        <a href="{{ route('add.to.cart', $i->id) }}"
                                           class="ml-2 btn btn-white btn-outline-white">Add to cart</a>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- Custom Pizza Builder Modal -->
    <div class="modal fade" id="customPizzaModal" tabindex="-1" role="dialog" aria-labelledby="customPizzaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="background-color: #1a1d1f; color: #fff;">
                <div class="modal-header" style="border-bottom: 1px solid #333;">
                    <h5 class="modal-title" id="customPizzaModalLabel">🍕 Build Your Custom Pizza</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff; opacity: 0.8;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="customPizzaForm">
                        @csrf
                        <input type="hidden" id="pizza_id" name="pizza_id">
                        
                        <div class="alert alert-info" style="background-color: #2c3e50; border: none; color: #ecf0f1;">
                            <strong>Base Price: £<span id="basePrice">10.00</span></strong>
                            <br>
                            <small>Select up to 4 toppings (£1.00 each)</small>
                        </div>

                        <h6 class="mb-3">Select Your Toppings:</h6>
                        
                        <div class="row" id="toppingsContainer">
                            @php
                                $toppings = \App\Models\Topping::available()->get();
                            @endphp
                            
                            @foreach($toppings as $topping)
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <div class="custom-control custom-checkbox" style="padding-left: 2rem;">
                                        <input type="checkbox" 
                                               class="custom-control-input topping-checkbox" 
                                               id="topping_{{ $topping->id }}" 
                                               name="toppings[]" 
                                               value="{{ $topping->id }}"
                                               data-price="{{ $topping->price }}">
                                        <label class="custom-control-label" for="topping_{{ $topping->id }}" style="cursor: pointer; user-select: none;">
                                            <strong>{{ ucfirst($topping->name) }}</strong> 
                                            <span class="badge badge-warning ml-2">+£{{ $topping->price }}</span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div id="toppingLimitWarning" class="alert alert-warning mt-3" style="display: none; background-color: #f39c12; border: none; color: #fff;">
                            <strong>Maximum 4 toppings allowed!</strong> Please unselect a topping before adding more.
                        </div>

                        <hr style="border-color: #444;">

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5>Total Price:</h5>
                            <h4 class="text-warning">£<span id="totalPrice">10.00</span></h4>
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" max="10" 
                                   style="background-color: #2c3e50; border: 1px solid #444; color: #fff; max-width: 100px;">
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #333;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="addCustomPizzaBtn" style="background-color: #ff6b35; border-color: #ff6b35;">
                        Add to Cart
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #ff6b35;
            border-color: #ff6b35;
        }
        
        .modal-content {
            border-radius: 10px;
        }
        
        .topping-checkbox:disabled ~ .custom-control-label {
            opacity: 0.5;
            cursor: not-allowed !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('customPizzaModal');
            const form = document.getElementById('customPizzaForm');
            const checkboxes = document.querySelectorAll('.topping-checkbox');
            const totalPriceSpan = document.getElementById('totalPrice');
            const basePriceSpan = document.getElementById('basePrice');
            const warning = document.getElementById('toppingLimitWarning');
            const addBtn = document.getElementById('addCustomPizzaBtn');
            
            let basePrice = 10.00;
            const maxToppings = 4;

            // When modal opens, populate pizza data
            $('#customPizzaModal').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget);
                const pizzaId = button.data('pizza-id');
                const pizzaName = button.data('pizza-name');
                basePrice = parseFloat(button.data('pizza-price'));
                
                document.getElementById('pizza_id').value = pizzaId;
                basePriceSpan.textContent = basePrice.toFixed(2);
                totalPriceSpan.textContent = basePrice.toFixed(2);
                
                // Reset form
                form.reset();
                checkboxes.forEach(cb => {
                    cb.checked = false;
                    cb.disabled = false;
                });
                warning.style.display = 'none';
            });

            // Handle topping selection
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const checkedCount = document.querySelectorAll('.topping-checkbox:checked').length;
                    
                    // Show/hide warning
                    if (checkedCount >= maxToppings) {
                        warning.style.display = 'block';
                        // Disable unchecked boxes
                        checkboxes.forEach(cb => {
                            if (!cb.checked) {
                                cb.disabled = true;
                            }
                        });
                    } else {
                        warning.style.display = 'none';
                        // Enable all boxes
                        checkboxes.forEach(cb => {
                            cb.disabled = false;
                        });
                    }
                    
                    // Calculate total
                    let toppingsCost = 0;
                    document.querySelectorAll('.topping-checkbox:checked').forEach(cb => {
                        toppingsCost += parseFloat(cb.dataset.price);
                    });
                    
                    const total = basePrice + toppingsCost;
                    totalPriceSpan.textContent = total.toFixed(2);
                });
            });

            // Handle add to cart
            addBtn.addEventListener('click', function() {
                const pizzaId = document.getElementById('pizza_id').value;
                const selectedToppings = Array.from(document.querySelectorAll('.topping-checkbox:checked'))
                    .map(cb => cb.value);
                const quantity = document.getElementById('quantity').value;
                
                // Create URL with toppings
                let url = `/add-to-cart/${pizzaId}?quantity=${quantity}`;
                if (selectedToppings.length > 0) {
                    selectedToppings.forEach(toppingId => {
                        url += `&toppings[]=${toppingId}`;
                    });
                }
                
                // Redirect to add to cart route
                window.location.href = url;
            });
        });
    </script>

@endsection
