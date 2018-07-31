<?php
/*
Template Name: 全部文章时间排序
*/
$args = array(
'post_type'=> 'post'
);$archives_query = new WP_Query();$archives_query->query($args);?><?php get_header() ?><?php
$max_page = $archives_query->max_num_pages;if (($max_page > 1 | ($max_page == 1 & get_option('hide_pagi_only_1') != "checked") ) & get_option('pagi_float') == "checked") {$pagi_float_class = "pagi_float";}if ($max_page > 1 | ($max_page == 1 & get_option('hide_pagi_only_1') != "checked") ) {$has_pagi_class = "has_pagi";}?><?php include("assets/template/carousel.php"); ?><div class="cats_display <?php echo $pagi_float_class." ".$has_pagi_class; ?>" :class="main.carousel.type"><?php include('assets/template/nav_category.php'); ?><?php
echo "<div class='cat_group category content-container'><h2>".get_the_title()."</h2>";if (get_option('allow_user_change_show_type')) {?><div class="change_show_type col-xs-12" style="margin-top: -70px;"><el-dropdown @command="change_show_type"><span class="label_text"><i class="fa fa-th-large" aria-hidden="true"></i></span><el-dropdown-menu slot="dropdown" class="change_show_type_lists"><el-dropdown-item command="">恢复默认</el-dropdown-item><el-dropdown-item divided command="list">列表</el-dropdown-item><el-dropdown-item command="card">卡片</el-dropdown-item><el-dropdown-item command="blog">博客</el-dropdown-item></el-dropdown-menu></el-dropdown></div><?php
}wp_reset_query();if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); }elseif ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); }else { $paged = 1; }$args = array(
'post_type'=> 'post','paged'=> $paged
);query_posts( $args );while( have_posts() ){the_post();$all_posts_display_type = get_option('all_posts_display_type');if ($_COOKIE['display_type'] != '' & $_COOKIE['display_type'] != 'cover' & get_option('allow_user_change_show_type')=='checked') {$all_posts_display_type = $_COOKIE['display_type'];}switch ($all_posts_display_type) {case 'list':include("assets/template/post_list.php");break;case 'card':include("assets/template/post_card.php");break;case 'cover':include("assets/template/post_newest.php");break;default:include("assets/template/post_blog.php");break;}}echo "</div>";?><?php echo wp_nav( $p = 2 ,$showSummary = false, $showPrevNext = true, $style = 'panda_pagination', $container = 'full-container' ); ?></div><?php get_footer() ?>