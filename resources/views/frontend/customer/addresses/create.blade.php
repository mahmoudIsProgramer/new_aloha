<?php
$page = 'addresses';
?>
@section('title_page')
    {{ __('site.' . $page) }}
@endsection

@extends('layouts.app')

@section('content')
    @include('partials.breadCrumb',['page'=>$page])

    <!-- section start -->
    <section class="section-big-py-space b-g-light">
        <div class="custom-container">
            <div class="checkout-page contact-page">
                <div class="checkout-form">
                    <form action="{{ route('customer.addresses.store') }}" method="POST">
                        @csrf
                        @method('post')
                        @include('partials._errors')
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <div class="checkout-title">
                                    <h3>Contact Details</h3>
                                </div>
                                <div class="theme-form">
                                    <div class="row check-out ">
                                        <h3 class="pb-3">Add Address</h3>
                                        <hr>

                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label>Full Name</label>
                                            <input name='full_name' required value="{{ old('full_name') }}" type="text"
                                                placeholder="First Name">
                                        </div>

                                        <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                            <label class="field-label">City *</label>
                                            <select id="input-city"
                                                class="select2 form-control select2-hidden-accessible city_id"
                                                name="city_id" autocomplete="new-password" required tabindex="-1"
                                                aria-hidden="true" data-select2-id="select2-data-input-city">
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                            <label class="field-label">District *</label>
                                            <div class="states"></div>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                            <label class="field-label">Zone *</label>
                                            <input type="text" name="zone" value="{{ old('zone') }}" placeholder="zone">

                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label class="field-label">Street Name *</label>
                                            <input type="text" name="street_name" value="{{ old('street_name') }}"
                                                placeholder="Street Name *">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label class="field-label">Building No *</label>
                                            <input type="text" name="building_number" value="{{ old('building_number') }}"
                                                placeholder="">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label class="field-label">Floor No *</label>
                                            <input type="text" name="floor_number" value="{{ old('floor_number') }}"
                                                value="" placeholder="">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label class="field-label">Apartment No *</label>
                                            <input type="text" name="apartment_number"
                                                value="{{ old('apartment_number') }}" value="" placeholder="">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label class="field-label">Nearest Landmark</label>
                                            <input type="text" name="landmark" value="{{ old('landmark') }}" value=""
                                                placeholder="">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label class="field-label">Location Type *</label>
                                            <select class="form-control" name="location_type" value="" required=""
                                                id="input-location_type">
                                                <option value=""> Select Location Type </option>
                                                <option value="home">Home/House</option>
                                                <option value="bussines">Business</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label class="field-label">Phone Number</label>
                                            <input type="text" name="phone" value="{{ old('phone') }}" value=""
                                                placeholder="">
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label class="field-label">Address</label>
                                            <input type="text" name="address" value="{{ old('address') }}" value=""
                                                placeholder="Street address">
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn-normal btn">Add Address</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <div class="checkout-details theme-form  section-big-mt-space">
                                    <div class="order-box">
                                        <div class="title-box">
                                            <div>Product <span>Total</span></div>
                                        </div>
                                        <ul class="qty">
                                            <li>Pink Slim Shirt × 1 <span>$25.10</span></li>
                                            <li>SLim Fit Jeans × 1 <span>$555.00</span></li>
                                        </ul>
                                        <ul class="sub-total">
                                            <li>Subtotal <span class="count">$380.10</span></li>
                                        </ul>
                                        <ul class="total">
                                            <li>Total <span class="count">$620.00</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- section end -->
@endsection


@push('scripts')


    <!-- start get states and regoins and streests  -->
    <script type="text/javascript">
        $(document).ready(function() {


            // change city
            $(document).on('change', '.city_id', function() {


                var city_id = $('.city_id option:selected').val();
                var token = $("input[name='_token']").val();
                $('.states').html('');
                $('.regoins').html('');
                if (city_id > 0) {
                    $.ajax({

                        url: "{!! route('dashboard.getStates') !!}",
                        type: 'get',
                        dataType: '',
                        data: {
                            city_id: city_id,
                            getData: 'states',
                            select: ''
                        },
                        success: function(data) {
                            $('.states').html(data);
                        }
                    });
                }
            }); // end city change

            // states
            @if (old('city_id'))

                @php
                    $city_id = old('city_id');
                    $state_id = old('state_id');
                @endphp
                $.ajax({
                url:'{!! route('dashboard.getStates') !!}',
                type:'get',
                dataType:'html',
                data:{ city_id:{{ $city_id }},getData:'states' , select:{{ $state_id }} },
                success: function (data) {
                $('.states').html(data)
                }
                });

            @endif


        });
    </script>


@endpush
