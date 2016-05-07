<?php
/*
Template Name: 12 VC Custom Page
*/

get_header(); global $tuscany_opt; ?>


<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <!-- Single Wrapper -->
    <div class="single-wrapper">
        <div class="post-content-section">
            <?php the_content(); ?>
        </div>
    </div>
    <!-- End Single Wrapper -->
<?php endwhile; endif; ?>


<?php get_footer(); ?>