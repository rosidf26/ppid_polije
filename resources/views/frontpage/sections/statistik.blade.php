<section class="section section-primary border-top-0 mb-0">
    <div class="container">
        <div class="row counters counters-sm counters-text-light">
            @foreach($statistik as $index => $value)
            <div class="col-sm-6 col-lg-4 mb-5 mb-lg-0">
                <div class="counter">
                    <strong data-to="{{ (isset($value->extras['count_1'])) ? $value->extras['count_1'] : '' }}">0</strong>
                    <label class="opacity-5 text-4 mt-1">{{ (isset($value->extras['count_1'])) ? $value->extras['lb_1'] : '' }}</label>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 mb-5 mb-lg-0">
                <div class="counter">
                    <strong data-to="{{ (isset($value->extras['count_1'])) ? $value->extras['count_2'] : '' }}">0</strong>
                    <label class="opacity-5 text-4 mt-1">{{ (isset($value->extras['count_1'])) ? $value->extras['lb_2'] : '' }}</label>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 mb-5 mb-sm-0">
                <div class="counter">
                    <strong data-to="{{ (isset($value->extras['count_1'])) ? $value->extras['count_3'] : '' }}">0</strong>
                    <label class="opacity-5 text-4 mt-1">{{ (isset($value->extras['count_1'])) ? $value->extras['lb_3'] : '' }}</label>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>