<?php
/* Template Name: Contact Page */
get_header(); ?>
<section class="content-page">
    <div class="wrapper">
        <h2 class="title">Контакти</h2>
        <div class="content-page__contact">
            <div class="content-page__form">
                <?php require('templates/elements/form.php'); ?>
            </div>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d82352.48246568393!2d23.94219597765685!3d49.83277867724807!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473add7c09109a57%3A0x4223c517012378e2!2z0JvRjNCy0L7Qsiwg0JvRjNCy0L7QstGB0LrQsNGPINC-0LHQu9Cw0YHRgtGMLCA3OTAwMA!5e0!3m2!1sru!2sua!4v1582875829856!5m2!1sru!2sua" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>