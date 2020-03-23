<?php

/**
 * @param $attachment_id
 * @param string $size
 * @return bool|string
 * Get img path
 */
function scaled_image_path($attachment_id, $size = 'thumbnail') {
    $file = get_attached_file($attachment_id, true);
    if (empty($size) || $size === 'full') {
        // for the original size get_attached_file is fine
        return realpath($file);
    }
    if (! wp_attachment_is_image($attachment_id) ) {
        return false; // the id is not referring to a media
    }
    $info = image_get_intermediate_size($attachment_id, $size);
    if (!is_array($info) || ! isset($info['file'])) {
        return false; // probably a bad size argument
    }
    return realpath(str_replace(wp_basename($file), $info['file'], $file));
}

/**
 * @param $path
 * @return float|int
 * Get img quality (FOR JPG)
 */
function get_image_quality($path){
    list($width, $height) = getimagesize($path);
    $filesize = filesize( $path );
    return (101-(($width*$height)*3)/$filesize);
}

/**
 * @param $id
 * Add Attachment
 */
function attachment_added($id)
{
    $filename = wp_get_attachment_url($id);
    $file_type = pathinfo($filename, PATHINFO_EXTENSION);
    if($file_type == 'jpg'|| $file_type == 'jpe' || $file_type == 'jpeg'){
        add_post_meta($id,'not_compressed',true);
    }
}
add_action('add_attachment', 'attachment_added');

/**
 * Compress JPG
 * @param $filename
 * @param $quality
 */
function jpg_compress($filename,$quality)
{
    $get_quality = null;
    $get_quality = get_image_quality($filename);
    if($get_quality > $quality){
        $image = imagecreatefromjpeg($filename);
        imagejpeg($image, $filename, $quality);
        imagedestroy($image);
    }
}

/**
 * Image compress
 * @param $filename
 * @param $quality
 * @return bool
 */
function img_compress($filename,$quality){
    $file_type = pathinfo($filename, PATHINFO_EXTENSION);
    if($file_type == 'jpg'|| $file_type == 'jpe' || $file_type == 'jpeg'){
        jpg_compress($filename,$quality);
        return true;
    } else {return false; }
}


/**
 * Get images sizes
 * @param $id
 * @return array|bool
 */
function get_attachment_files_list($id)
{
    $images_list = array();

    if(!wp_attachment_is_image($id)) return false;

    $images_list[] = get_attached_file($id);

    $sizes_list = get_intermediate_image_sizes($id);
    if(!$sizes_list) return $images_list;

    foreach ($sizes_list as $size) {
        $path = scaled_image_path($id,$size);
        if($path) $images_list[] = $path;
    }
    return $images_list;
}

/**
 * @param $id
 * @param $quality
 * @return bool
 */
function attachment_compress($id,$quality)
{
    $images_list = get_attachment_files_list($id);
    if(is_array($images_list)){
        foreach ($images_list as $image) {
            img_compress($image,$quality);
        }
        return true;
    }
    else return false;
}

/**
 * Add notices to admin panel
 */

// add notices
add_action( 'admin_notices', 'generate_admin_notice_compress_count' );

function generate_admin_notice_compress_count()
{
    global $user_ID;
    $compress_attachments_ids = array();
    $button = null;
    $error = null;
    $all_images_sum = null;

    if( is_super_admin( $user_ID ) ){
        $is_jpg = false;
        $range = false;
        $attachments = get_posts( array(
            'post_type' => 'attachment',
            'posts_per_page' => -1,
            'post_mime_type' => 'image',
            'meta_key'=>'not_compressed',
            'meta_value'=> true,
        ) );
        foreach ( $attachments as $attachment ) {
            $filename = wp_get_attachment_url($attachment->ID);
            $file_type = pathinfo($filename, PATHINFO_EXTENSION);
            if($is_jpg == false){
                if($file_type == 'jpg'|| $file_type == 'jpe' || $file_type == 'jpeg') $is_jpg = true;
            }
            if($file_type == 'jpg'|| $file_type == 'jpe' || $file_type == 'jpeg'){
                $compress_attachments_ids[] = $attachment->ID;
            }
        }
        if(count($compress_attachments_ids) > 0){
            $range = '<p>
                  <span>Compress Quality</span>
                  <input class="compress_quality" type="range" min="0" max="100" step="1" value="90">
                  <label>90</label><span> (for jpg)</span></p>';
            $button = '<button data-count="'.count($compress_attachments_ids).'" data-images="'.json_encode($compress_attachments_ids).'" id="compressImagesBtn" style="display: inline-block; vertical-align: middle" class="button button-primary button-small">Compress Images</button>
<div class="progress_bar_img"><div class="inner_progress_img"><span id="loading_inner__text_img"></span></div></div><div class="progress_text_img"><span>0</span> of '.count($compress_attachments_ids).'</div><span class="spinner" style="display: inline-block; vertical-align: middle; margin-left: 15px; float: none!important; margin-top: 0!important;"></span>';
            echo '<div class="notice notice-success" id="compressCount">
                 <p style="display: inline-block; margin-right: 10px; vertical-align: middle">Waiting for Compress (jpg, jpe, jpeg): 
                  <strong>'.count($compress_attachments_ids).'</strong>
                  </p>
                  '.$button.'
                  '.$range.'
             </div>';
        }
    }
}

//AJAX (JS)
add_action( 'admin_print_footer_scripts', 'compress_images_javascript' );
function compress_images_javascript(){
    ?>
    <script>
        $ = jQuery;
        var attachment_iterator,
            btn = $('#compressImagesBtn');
        if(btn[0]){
            var attachment_ids = JSON.parse(btn.attr('data-images'));
        }
        function compress_attachment() {
            var data = {
                'action': 'compress_images',
                'compress_images_id': attachment_ids[attachment_iterator],
                'quality' : $('.compress_quality').attr('value'),
            };
            var count = btn.attr('data-count'),
                progress_width = null;
            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                data:data,
                type:'POST',
                success:function(){
                    attachment_iterator++;
                    if(attachment_ids[attachment_iterator] !== undefined) {
                        progress_width = ((attachment_iterator) * 100) / count;
                        $('.progress_text_img span').text(attachment_iterator);
                        $('.progress_bar_img .inner_progress_img').width(progress_width + '%');
                        compress_attachment();
                    }
                    else {
                        progress_width = ((attachment_iterator) * 100) / count;
                        $('.progress_text_img span').text(attachment_iterator);
                        $('.progress_bar_img .inner_progress_img').width(progress_width + '%');
                        location.reload();
                    }
                }
            });
        }
        btn.on('click',function () {
            attachment_iterator = 0;
            $(this).next().addClass('is-active');
            $('.progress_text_img').next().addClass('is-active');
            compress_attachment();
            $(this).remove();
        });

        // range
        for( input of document.querySelectorAll("input.compress_quality")){
            actualizarInput(input)
        }

        document.addEventListener("input", function(evt) {
            var input = evt.target;
            actualizarInput(input)
        });

        function actualizarInput(input){
            var label = input.parentElement.querySelector("label");
            if(label !== null){
                label.innerHTML = input.value;
                var inputMin = input.getAttribute("min");
                var inputMax = input.getAttribute("max");
                var unidad = (inputMax - inputMin) / 100;
                input.style.setProperty("--value", (input.value - inputMin)/unidad);
            }
        }

    </script>
    <style>

        .progress_bar_img {
            width: 200px;
            height: 20px;
            background: #fff;
            border: 2px solid #333;
            vertical-align: middle;
            transition: all 0.4s ease-in-out;
            opacity: 0;
            display: none;
        }
        .progress_bar_img.is-active {
            opacity: 1;
            display: inline-block;
        }
        .progress_bar_img.is-active + .progress_text_img {
            opacity: 1;
            display: inline-block;
        }
        .progress_text_img {
            font-size: 14px;
            margin-left: 15px;
            vertical-align: middle;
            opacity: 0;
            display: none;
            transition: all 0.4s ease-in-out;
        }
        .inner_progress_img {
            width: 0;
            height: 20px;
            background-color: #4CAF50!important;
            transition: all 0.4s ease-in-out;
            text-align: center;
        }
        .inner_progress_img span {
            position: absolute;
            text-align: center;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            display: inline-block;
            color: #ffffff;
            font-size: 20px
        }

        .compress_quality {
            -webkit-appearance: none;
            display: inline-block;
            vertical-align: middle;
            height: 15px;
            background: #d3d3d3;
            outline: none;
            opacity: 0.7;
            -webkit-transition: .2s;
            transition: opacity .2s;
            padding: 0;
            margin: 0 5px;
        }
        .compress_quality + label {
            display: inline-block;
            vertical-align: middle;
            font-weight: 700;
        }
        .compress_quality:hover {
            opacity: 1;
        }

        .compress_quality::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 25px;
            height: 15px;
            background: #4CAF50;
            cursor: pointer;
        }

        .compress_quality::-moz-range-thumb {
            width: 25px;
            height: 15px;
            background: #4CAF50;
            cursor: pointer;
        }
    </style>
    <?php
}

//AJAX (PHP)
function compress_images() {
    $compress_images_id = $_POST['compress_images_id'];
    $quality = $_POST['quality'];
    if($compress_images_id){
        update_post_meta($compress_images_id,'not_compressed',false);
        attachment_compress($compress_images_id,$quality);
    }
    die();
}
add_action('wp_ajax_compress_images','compress_images');
add_action('wp_ajax_nopriv_compress_images', 'compress_images');
