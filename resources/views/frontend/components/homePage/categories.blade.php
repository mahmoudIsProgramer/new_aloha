@if ($categoryHome->count() > 0)
    <!--title start-->
    <div class="title8 section-big-pt-space">
        <h4>our category</h4>
    </div>
    <!--title end-->

    <!--rounded category start-->
    <section class="rounded-category">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="slide-6 no-arrow">
                        @foreach ($categoryHome as $category)

                            <div>
                                <div class="category-contain">
                                    <div class="img-wrapper">
                                        <a href="{{ route('products', ['category_id' => $category->id]) }}">
                                            <img src="{{ $category->image_path }}" alt="category  " class="img-fluid">
                                        </a>
                                    </div>
                                    <a href="{{ route('products', ['category_id' => $category->id]) }}"
                                        class="btn-rounded">
                                        {{ $category->name }}
                                    </a>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--rounded category end-->
@endif
