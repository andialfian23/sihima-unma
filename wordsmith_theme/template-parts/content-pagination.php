<div class="row pagination-wrap">
    <div class="col-full data-aos=fade-up">

    <?php
    the_posts_pagination( array(
        'mid_size' => '2',
        'prev_text' => __('prev', 'wordsmith'),
        'next_text' => __('next', 'wordsmith'),
    ) );
    ?>


        <!-- <nav class="pgn" data-aos="fade-up">
            <ul>
                <li><a class="pgn__prev" href="#0">Prev</a></li>
                <li><a class="pgn__num" href="#0">1</a></li>
                <li><span class="pgn__num current">2</span></li>
                <li><a class="pgn__num" href="#0">3</a></li>
                <li><a class="pgn__num" href="#0">4</a></li>
                <li><a class="pgn__num" href="#0">5</a></li>
                <li><span class="pgn__num dots">…</span></li>
                <li><a class="pgn__num" href="#0">8</a></li>
                <li><a class="pgn__next" href="#0">Next</a></li>
            </ul>
        </nav>-->
    </div>
</div>