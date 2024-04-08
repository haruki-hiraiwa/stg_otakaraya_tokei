<?php
if(!empty(get_field('n_tel1_text'))){
    $tel = get_field('n_tel1_text');
}else{
    $tel = '';
}
?>
<section class="tabContents_open">
    <div class="titleMain titleMain--wrapper">
        <h2 class="titleMain--main">
        <?php 
        //   echo get_field('faq_headline', 31737); 
            echo 'お客様からよく頂く質問を<br class="is-sp">ご紹介';
        ?>
        </h2>
        <div class="titleMain--lead">
            
        </div>
    </div>

    <?php

    $args = array(
        'post_type' => 'faq',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'menu_order',
        'tax_query' => array(
            array(
                'taxonomy' => 'faq_cat',
                'terms' => 'faq_intro',
                'field' => 'slug'
            ),
        ),
    );
    $query = new WP_Query($args);

    if($query->have_posts()):
        while($query->have_posts()): $query->the_post();
        $question = get_the_title();
        $answer = the_field_without_wpautop('faq_answer');
        $slug = $post->post_name;
    ?>
    <div>
        <div class="question_Box">
            <div class="arrow_question qa__list__q"><?php echo $question;?></div>
        </div>
        <div class="question_Box">
            <div class="arrow_answer qa__list__a">
                <?php 
                echo $answer;
                if($slug === 'tel'):
                ?>
                <p><a href="tel:" . <?php echo $tel ?> class="phone-number is-sp"><?php echo $tel ?></a></p>
                <p class="is-pc"><?php echo $tel ?></p>
                <?php
                endif;
                ?>
            </div>
        </div>
    </div>
    <?php endwhile; endif;?>

</section>

<style>
     
.arrow_question,
.arrow_answer {
    position: relative;
    background: #f2f2f2;
    border: 1px solid #c8c8c8;
    border-radius: 10px;
    width:95%;
    font-size: 14px;
    padding:15px 10px 15px 50px;
}
.arrow_question{
    background:#fff;
}
 
.arrow_answer {
    float: right;
    border: none;
}
 
/* .arrow_question:after,
.arrow_question:before,
.arrow_answer:after,
.arrow_answer:before {
    top: 30%;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
} */
 
.arrow_answer:after,
.arrow_answer:before {
    right: 100%;
}
 
/* .arrow_question:after,
.arrow_question:before{
     left: 100%;
} */
 
.arrow_question:after,
.arrow_answer:after {
    border-color: rgba(255, 255, 255, 0);
    border-width: 8px;
    margin-top: -8px;
}
 
.arrow_question:after{
    border-left-color: #fff;
}
 
.arrow_answer:after{
    border-right-color: #fff;
     
}
 
/* .arrow_question:before,
.arrow_answer:before {
    border-color: rgba(200, 200, 200, 0);
    border-width: 9px;
    margin-top: -9px;
} */
 
.arrow_question:before{
    border-left-color: #c8c8c8;
}
 
.arrow_answer:before {
    border-right-color: #c8c8c8;    
}
 
.question_image{
     float: left;
     width:15%;
}
 
.answer_image{
     float: right;
     width:15%;
}
 
.answer_image img,
.question_image img{
    border-radius: 50px;
    display: block;
    margin: 0 auto;
    max-width: 60px;
    width: 100%;
}
 
.question_Box .name {
    text-align: center;
    font-size: 12px;
}
.question_Box{
     width: 100%;
     overflow: hidden;
     /* margin-bottom: 8px; */
}
/* .question_Box:nth-child(even){
     margin-bottom: 25px;
} */
.qa__list__q::before,
.qa__list__a::before{
    margin: 0px 15px;
}


.qa__list__q{
    margin:1rem 0;
}

</style>