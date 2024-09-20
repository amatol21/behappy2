<?php
/*
Template Name: Документи
*/

get_header(); ?>

        
    
    <section class="page-banner page-banner-small">
        <div class="bottom-rotten-curve"></div>

        <div class="auto-container">
            <h1><?= the_field('acf_documents_header'); ?></h1>
        </div>
    </section>

    <section class="faq-section">
        <div class="auto-container">
            <div class="tabs-box">
                <div class="row clearfix">
                    <div class="offset-lg-2 col-lg-9 col-md-12 col-sm-12">
                        <div class="inner">

<p>&nbsp;</p>

<?= the_content(); ?>


</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php get_footer(); ?>