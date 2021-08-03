@if (count($portfolio) > 0)
    <div class="section" id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto">
                    <div class="h4 text-center mb-4 title">Portfolio</div>
                </div>
            </div>
            <div class="tab-content gallery mt-5">
                <div class="tab-pane active" id="web-development">
                    <div class="ml-auto mr-auto">
                        <div class="row">
                            @foreach ($portfolio as $item)
                                @php
                                    if (!isset($count)) {
                                        $count = 1;
                                        echo '<div class="col-md-6">';
                                    }
                                @endphp

                                <div class="cc-porfolio-image img-raised" data-aos="fade-up"
                                    data-aos-anchor-placement="top-bottom">
                                    <a href="{{ $item->link }}">
                                        <figure class="cc-effect">
                                            <img src="{{ $item->thumb }}" alt="Image" />
                                            <figcaption>
                                                <div class="h4">{{ $item->titulo }}</div>
                                                <p>{{ $item->descricao }}</p>
                                            </figcaption>
                                        </figure>
                                    </a>
                                </div>

                                @php
                                    if ($count == 2) {
                                        echo '</div>';
                                        unset($count);
                                    } else {
                                        $count++;
                                    }
                                @endphp
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
