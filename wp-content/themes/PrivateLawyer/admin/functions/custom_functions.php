<?php
/////////PRODUCT DETAIL PAGE FUNCTIONS START///////////////
function templ_is_show_listing_author()
{
	if(strtolower(get_option('ptthemes_listing_author'))=='yes' || get_option('ptthemes_listing_author')=='')
	{
		return true;	
	}
	return false;
}
function templ_is_show_listing_date()
{
	if(strtolower(get_option('ptthemes_listing_date'))=='yes' || get_option('ptthemes_listing_date')=='')
	{
		return true;	
	}
	return false;
}
function templ_is_show_listing_comment()
{
	if(strtolower(get_option('ptthemes_listing_comment'))=='yes' || get_option('ptthemes_listing_comment')=='')
	{
		return true;	
	}
	return false;
}
function templ_is_show_listing_category()
{
	if(strtolower(get_option('ptthemes_listing_category'))=='yes' || get_option('ptthemes_listing_category')=='')
	{
		return true;	
	}
	return false;
}
function templ_is_show_listing_tags()
{
	if(strtolower(get_option('ptthemes_listing_tags'))=='yes' || get_option('ptthemes_listing_tags')=='')
	{
		return true;	
	}
	return false;
}
/////////PRODUCT DETAIL PAGE FUNCTIONS END///////////////

/////////PRODUCT DETAIL PAGE FUNCTIONS START///////////////
function templ_is_show_post_author()
{
	if(strtolower(get_option('ptthemes_details_author'))=='yes' || get_option('ptthemes_details_author')=='')
	{
		return true;	
	}
	return false;
}

function templ_is_show_post_date()
{
	if(strtolower(get_option('ptthemes_details_date'))=='yes' || get_option('ptthemes_details_date')=='')
	{
		return true;	
	}
	return false;
}

function templ_is_show_post_comment()
{
	if(strtolower(get_option('ptthemes_details_comment'))=='yes' || get_option('ptthemes_details_comment')=='')
	{
		return true;	
	}
	return false;
}

function templ_is_show_post_category()
{
	if(strtolower(get_option('ptthemes_details_category'))=='yes' || get_option('ptthemes_details_category')=='')
	{
		return true;	
	}
	return false;
}

function templ_is_show_post_tags()
{
	if(strtolower(get_option('ptthemes_details_tags'))=='yes' || get_option('ptthemes_details_tags')=='')
	{
		return true;	
	}
	return false;
}
/////////PRODUCT DETAIL PAGE FUNCTIONS END///////////////

/////////FOOTER FUNCTIONS START///////////////
function templ_is_footer_widgets_2colright()
{
	if(get_option('ptthemes_bottom_options')=='Two Column - Right(one third)')
	{
		return true;	
	}
	return false;
}
function templ_is_footer_widgets_2colleft()
{
	if(get_option('ptthemes_bottom_options')=='Two Column - Left(one third)')
	{
		return true;	
	}
	return false;
}
function templ_is_footer_widgets_eqlcol()
{
	if(get_option('ptthemes_bottom_options')=='Equal Column')
	{
		return true;	
	}
	return false;
}
function templ_is_footer_widgets_3col()
{
	if(get_option('ptthemes_bottom_options')=='Three Column')
	{
		return true;	
	}
	return false;
}
function templ_is_footer_widgets_4col()
{
	if(get_option('ptthemes_bottom_options')=='Fourth Column')
	{
		return true;	
	}
	return false;
}
function templ_is_footer_widgets_fullwidth()
{
	if(get_option('ptthemes_bottom_options')=='Full Width')
	{
		return true;	
	}
	return false;
}

///////////////OTHER FLAG SETTINGS START////////////////////
function templ_is_ajax_pagination()
{
	if (get_option('ptthemes_pagination') == 'AJAX-fetching posts')
	{
		return true;	
	}
	return false;
}
function templ_is_third_party_seo()
{
	if(strtolower(get_option('ptthemes_use_third_party_data'))=='yes')
	{
		return true;	
	}
	return false;		
}
function templ_is_top_home_link()
{
	if(strtolower(get_option('ptthemes_top_home_links'))=='yes' || get_option('ptthemes_top_home_links')=='' )
	{
		return true;
	}
	return false;
}
function templ_is_top_pages_nav()
{
	if(get_option('ptthemes_top_pages_nav')!="" && !strstr(get_option('ptthemes_top_pages_nav'),'none'))
	{
		return true;
	}
	return false;
}
function templ_is_top_category_nav()
{
	if(get_option('ptthemes_category_top_nav')!="" && !strstr(get_option('ptthemes_category_top_nav'),'none'))
	{
		return true;
	}
	return false;
}
function templ_is_facebook_button()
{
	if(strtolower(get_option('ptthemes_facebook_button'))=='yes')
	{
		return true;	
	}
	return false;
}
function templ_is_tweet_button()
{
	if(strtolower(get_option('ptthemes_tweet_button'))=='yes')
	{
		return true;	
	}
	return false;
}
function templ_is_show_blog_title()
{
	if(strtolower(get_option('ptthemes_show_blog_title'))=='yes')
	{
		return true;	
	}
	return false;
}
function templ_is_php_mail()
{
	if(get_option('ptthemes_notification_type')=='PHP Mail')
	{
		return true;	
	}
	return false;
}
///////////////OTHER FLAG SETTINGS END////////////////////


/************************************
//FUNCTION NAME : templ_sendEmail
//ARGUMENTS : from email ID,From email Name, To email ID, To email name, Mail Subject, Mail Content, Mail Header.
//RETURNS : Send Mail to the email address.
***************************************/
function templ_sendEmail($fromEmail,$fromEmailName,$toEmail,$toEmailName,$subject,$message,$extra='')
{
	$fromEmail = apply_filters('templ_send_from_emailid', $fromEmail);
	$fromEmailName = apply_filters('templ_send_from_emailname', $fromEmailName);
	$toEmail = apply_filters('templ_send_to_emailid', $toEmail);
	$toEmailName = apply_filters('templ_send_to_emailname', $toEmailName);
	
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	
	// Additional headers
	$headers .= 'To: '.$toEmailName.' <'.$toEmail.'>' . "\r\n";
	$headers .= 'From: '.$fromEmailName.' <'.$fromEmail.'>' . "\r\n";
	$subject = apply_filters('templ_send_email_subject', $subject);
	$message = apply_filters('templ_send_email_content', $message);
	$headers = apply_filters('templ_send_email_headers', $headers);
	
	// Mail it
	if(templ_is_php_mail())
	{
		@mail($toEmail, $subject, $message, $headers);	
	}else
	{
		wp_mail($toEmail, $subject, $message, $headers);	
	}	
}
/************************************
//FUNCTION NAME : templ_getTinyUrl
//ARGUMENTS :source url
//RETURNS : Tiny URL created
***************************************/
function templ_getTinyUrl($url) {
    //$tinyurl = file_get_contents("http://tinyurl.com/api-create.php?url=".$url);
	$tinyurl = $url;
    return $tinyurl;
}



/************************************
//FUNCTION NAME : commentslist
//ARGUMENTS :comment data, arguments,depth level for comments reply
//RETURNS : Comment listing format
***************************************/
function commentslist($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li>
        <div id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>            
        <div class="comment_left">
            <?php echo get_avatar($comment, 45, get_bloginfo('template_url').'/images/no-avatar.png'); ?>
       
            <div class="comment-meta">
                <?php printf(__('<p class="comment-author"><span>%s</span></p>','templatic'), get_comment_author_link()) ?>
                <?php printf(__('<p class="comment-date">%s</p>','templatic'), get_comment_date(templ_get_date_format())) ?>
              
              <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            </div>
            <span class="comment_arrow"></span>
        </div>
            <div class="comment-text">
                <?php if ($comment->comment_approved == '0') : ?>
                    <p><?php _e('Your comment is awaiting moderation.','templatic') ?></p>
                    <br/>
                <?php endif; ?>
                <?php comment_text() ?>
            </div>
         </div>
<?php
}


/************************************
//FUNCTION NAME : templ_get_date_format
//ARGUMENTS :None
//RETURNS : date format as per set from design settings
***************************************/
function templ_get_date_format()
{
	$date_format = get_option('ptthemes_date_format');
	if(!$date_format){$date_format = get_option('date_format');}
	if($date_format==''){$date_format = 'M j, Y';}
	return apply_filters('templ_date_formate_filter',$date_format);
}

/************************************
//FUNCTION NAME : templ_get_time_format
//ARGUMENTS :None
//RETURNS : time format as per set from design settings
***************************************/
function templ_get_time_format()
{
	$time_format = get_option('ptthemes_time_format');
	if(!$time_format){ $time_format = get_option('time_format');}
	if($time_format==''){$time_format = 'g:s a';}
	return apply_filters('templ_time_formate_filter',$time_format);
}


/************************************
//FUNCTION NAME : templ_get_formated_date
//ARGUMENTS :Input date in 'Y-m-d' format (eg:- 2011-01-31)
//RETURNS : formated date as per set from design settings
***************************************/
function templ_get_formated_date($date)
{
	$date_format = templ_get_date_format();
	if($date)
	{
		return apply_filters('templ_get_formated_date_filter',date($date_format,strtotime($date)));	
	}
}

/************************************
//FUNCTION NAME : templ_get_site_contact_email
//ARGUMENTS :NONE
//RETURNS : site email set from design settings or admin email
***************************************/
function templ_get_site_contact_email()
{
	$site_email = get_option('pttheme_contact_email');
	if($site_email=='')
	{
		$site_email = get_option('admin_email');	
	}
	return apply_filters('templ_get_site_contact_email_filter',$site_email);
}


/************************************
//FUNCTION NAME : templ_set_breadcrumbs_navigation
//ARGUMENTS :arg1=custom seperator, arg2=cutom breadcrumbs content
//RETURNS : breadcrums for each pages
***************************************/
function templ_set_breadcrumbs_navigation($arg1='',$arg2='')
{
	do_action('templ_set_breadcrumbs_navigation');
	if (strtolower(get_option( 'ptthemes_breadcrumbs'))=='yes') {  ?>
    <div class="breadcrumb clearfix">
        <div class="breadcrumb_in">
		<?php 
		ob_start();
		yoast_breadcrumb(''.$arg1,''.$arg2);
		$breadcrumb = ob_get_contents();
		ob_end_clean();
		echo apply_filters('templ_breadcrumbs_navigation_filter',$breadcrumb);
		?></div>
    </div>
    <?php }
}

/************************************
//FUNCTION NAME : templ_get_excerpt
//ARGUMENTS :string content, number of characters limit
//RETURNS : string with limit of number of characters
***************************************/
function templ_get_excerpt($string, $limit='',$post_id='') {
	global $post;
	if(!$post_id)
	{
		$post_id=$post->ID;
	}
	$read_more = get_option('ptthemes_content_excerpt_readmore');
	if($read_more)
	{
		$read_more = ' <a href="'.get_permalink($post_id).'" title="" class="read_more">'.$read_more.'</a>';
	}else
	{
		$read_more = ' <a href="'.get_permalink($post_id).'" title="" class="read_more">'.__('read more','templatic').'</a>';
	}
	$read_more = apply_filters('templ_get_excerpt_readmore_filter',$read_more);
	if($limit)
	{
		$words = explode(" ",$string);
		if ( count($words) >= $limit)
		return apply_filters('templ_get_excerpt_filter',implode(" ",array_splice($words,0,$limit)).$read_more);
		else
		return apply_filters('templ_get_excerpt_filter',$string.$read_more);
		
	}else
	{
		return apply_filters('templ_get_excerpt_filter',$string.$read_more);
	}
	
}

/************************************
//FUNCTION NAME : templ_listing_content
//ARGUMENTS :NONE
//RETURNS : display content or excerpt or sub part of it.
***************************************/
function templ_listing_content()
{
	if (apply_filters('templ_get_listing_content_filter', true))
	{
		if(get_option('ptthemes_postcontent_full')=='Full Content')
		{
			the_content();		
		}else
		{
			$limit = get_option('ptthemes_content_excerpt_count');
			echo templ_get_excerpt(get_the_excerpt(), $limit);
		}
	}
}
add_action('templ_get_listing_content','templ_listing_content');


/************************************
//FUNCTION NAME : templ_seo_meta_content
//ARGUMENTS : None
//RETURNS : Meta Content, Description and Noindex settings for SEO
***************************************/
function templ_seo_meta_content()
{
	if (is_home() || is_front_page()) 
	{
		$description = get_option('ptthemes_home_desc_seo');
		$keywords = get_option('ptthemes_home_keyword_seo');
	}elseif (is_single() || is_page())
	{
		global $post;
		$description = get_post_meta($post->ID,'templ_seo_page_desc',true);
		$keywords = get_post_meta($post->ID,'templ_seo_page_kw',true);
	}
	
	if(is_category() && strtolower(get_option( 'ptthemes_tag_archives_noindex' ))=='yes')
	{
		echo '<META NAME="ROBOTS" CONTENT="NOINDEX">';
	}elseif(is_tag() && strtolower(get_option( 'ptthemes_tag_archives_noindex' ))=='yes')
	{
		echo '<META NAME="ROBOTS" CONTENT="NOINDEX">';
	}elseif(is_archive() && strtolower(get_option('ptthemes_category_noindex'))=='yes')
	{
		echo '<META NAME="ROBOTS" CONTENT="NOINDEX">';
	}
	if($description){ echo '<meta content="'.$description.'" name="description" />';}
	if($keywords){ echo '<meta content="'.$keywords.'" name="keywords" />';}
	
}
add_action('templ_seo_meta','templ_seo_meta_content');

/************************************
//FUNCTION NAME : templ_seo_title
//ARGUMENTS : None
//RETURNS : SEO page title
***************************************/
function templ_seo_title() {
	if(templ_is_third_party_seo()){
	}else
	{
		global $page, $paged;
		$sep = " | "; # delimiter
		$newtitle = get_bloginfo('name'); # default title
	
		# Single & Page ##################################
		if (is_single() || is_page())
		{
			global $post;
			$newtitle = get_post_meta($post->ID,'templ_seo_page_title',true);
			if($newtitle=='')
			{
				$newtitle = single_post_title("", false);
			}
		}
	
		# Category ######################################
		if (is_category())
			$newtitle = single_cat_title("", false);
	
		# Tag ###########################################
		if (is_tag())
		 $newtitle = single_tag_title("", false);
	
		# Search result ################################
		if (is_search())
		 $newtitle = __("Search Result ",'templatic') . $s;
	
		# Taxonomy #######################################
		if (is_tax()) {
			$curr_tax = get_taxonomy(get_query_var('taxonomy'));
			$curr_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); # current term data
			# if it's term
			if (!empty($curr_term)) {
				$newtitle = $curr_tax->label . $sep . $curr_term->name;
			} else {
				$newtitle = $curr_tax->label;
			}
		}
	
		# Page number
		if ($paged >= 2 || $page >= 2)
				$newtitle .= $sep . sprintf('Page %s', max($paged, $page));
	
		# Home & Front Page ########################################
		if (is_home() || is_front_page()) {
			if(get_option('ptthemes_home_title_seo')){
				$newtitle = get_option('ptthemes_home_title_seo');
			}else
			{
				$newtitle = get_bloginfo('name') . $sep . get_bloginfo('description');
			}
		} else {
			$newtitle .=  $sep . get_bloginfo('name');
		}
		return $newtitle;
	}
}
add_filter('wp_title', 'templ_seo_title');

/************************************
//FUNCTION NAME : templ_main_header_navigation_content
//ARGUMENTS : None
//RETURNS : Get Header Main Menu Action Hook
***************************************/
function templ_main_header_navigation_content()
{
	 if(strtolower(get_option('ptthemes_main_pages_nav_enable'))!='deactivate'){?>
    
    <div class="main_nav">
    	<div class="main_nav_in">
     
        <?php apply_filters('templ_main_header_nav_above_filter','');?>
        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Main Navigation') ){}else{  ?>
        <ul>
        
           <?php if(strtolower(get_option('ptthemes_main_nav_home_links'))=='yes' || get_option('ptthemes_main_nav_home_links')=='' ){?> <li class="<?php if ( is_home() ) { ?>current_page_item<?php } ?> home" ><a href="<?php echo get_option('home'); ?>/"><?php _e('Home');?></a></li><?php }?>
		
        
         <?php if(get_option('ptthemes_include_main_nav')!="" && !strstr(get_option('ptthemes_include_main_nav'),'none')){ wp_list_pages('title_li=&depth=0&include=' . get_option('ptthemes_include_main_nav') .'&sort_column=menu_order'); }  ?>
         
          <?php
	 if(get_option('ptthemes_category_main_nav')!="" && !strstr(get_option('ptthemes_category_main_nav'),'none')){ 
		$catlist_blog =  wp_list_categories('title_li=&include=' . get_option('ptthemes_category_main_nav') .'&echo=0');
    if(!strstr($catlist_blog,'No categories'))
	 {
		 echo $catlist_blog;
	 }
	 }
     ?>
         </ul>
          <?php }?>
         <?php apply_filters('templ_main_header_nav_below_filter','');?>	 
         	 </div>
         </div>
    <?php }
}
add_action('templ_get_main_header_navigation','templ_main_header_navigation_content');


/************************************
//FUNCTION NAME : templ_top_header_navigation_content
//ARGUMENTS : None
//RETURNS : Get Header Top Menu Action Hook
***************************************/
function templ_top_header_navigation_content()
{
	 if(strtolower(get_option('ptthemes_top_pages_nav_enable'))!='deactivate'){?>
    <div class="top_navigation">
        	 <div class="top_navigation_in">
             	
        <?php apply_filters('templ_top_header_nav_above_filter','');?>
        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('top_navigation') ){}else{  ?>
         <ul>
          <?php if(templ_is_top_home_link()){?> <li class="<?php if ( is_home() ) { ?>current_page_item<?php } ?> home" ><a href="<?php echo get_option('home'); ?>/"><?php _e('Home');?></a></li><?php }?>
         
		 <?php if(templ_is_top_pages_nav()){ 
		 wp_list_pages('title_li=&depth=0&include=' . get_option('ptthemes_top_pages_nav') .'&sort_column=menu_order');
		 }?>
         
         <?php
	 if(templ_is_top_category_nav()){
		$catlist_blog =  wp_list_categories('title_li=&include=' . get_option('ptthemes_category_top_nav') .'&echo=0');
		if(!strstr($catlist_blog,'No categories'))
		 {
			 echo $catlist_blog;
		 }
	 }
     ?>
         </ul>
          <?php }?>
          <?php apply_filters('templ_top_header_nav_below_filter','');?>
         	</div>
         </div>
    <?php }
}
add_action('templ_get_top_header_navigation','templ_top_header_navigation_content');


/************************************
//FUNCTION NAME : templ_show_facebook_button_action
//ARGUMENTS : None
//RETURNS : Facebook Button Detail page - Action Hook
***************************************/
function templ_show_facebook_button_action()
{
	if(templ_is_facebook_button())
	{
		if (apply_filters('templ_facebook_button_script', true))
		{
			global $post;
		?>
       <iframe class="facebook" src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;layout=standard&amp;show_faces=false&amp;width=290&amp;action=like&amp;colorscheme=light" scrolling="no" frameborder="0"  style="border:none; overflow:hidden; width:290px; height:24px;"></iframe>  
        <?php	
		}
	}
}
add_action('templ_show_facebook_button','templ_show_facebook_button_action');


/************************************
//FUNCTION NAME : templ_show_twitter_button_action
//ARGUMENTS : None
//RETURNS : Twitter Button Detail page - Action Hook
***************************************/
function templ_show_twitter_button_action()
{
	if(templ_is_tweet_button())
	{
		if (apply_filters('templ_tweet_button_script', true))
		{
		?>
        <a href="http://twitter.com/share" class="twitter-share-button"><?php _e('Tweet');?></a>
		<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script> 
        <?php	
		}
	}
}
add_action('templ_show_twitter_button','templ_show_twitter_button_action');


/************************************
//FUNCTION NAME : templ_add_site_logo
//ARGUMENTS : None
//RETURNS : Text as site logo with description
***************************************/
function templ_add_site_logo()
{
	if (templ_is_show_blog_title()) 
	{ 
		echo apply_filters('templ_blog_title_text','<div class="blog-title"><a href="'.get_option('home').'/">'.get_bloginfo( 'name', 'display' ).'</a> 
		<p class="blog-description">'. get_bloginfo('description', 'display').'</p></div>');
	}else
	{
		echo templ_get_site_logo();
	}	
}
add_action('templ_site_logo','templ_add_site_logo'); //site logo action + filters

///site logo filter
/************************************
//FUNCTION NAME : templ_get_site_logo
//ARGUMENTS : None
//RETURNS : Site Header logo with Hyper link
***************************************/
function templ_get_site_logo() {
	if(get_option('ptthemes_logo_url'))
	{
		$logo_url = get_option('ptthemes_logo_url');	
	}else
	{
		$logo_url = get_bloginfo('template_directory').'/images/logo.png';
	}
    if($logo_url)
	{		
		$return_str = '<a href="'.get_option('home').'/">';
		$return_str .= '<img src="'.apply_filters('templ_logo',$logo_url).'" alt="" />';
		$return_str .= '</a>';
	}
    return apply_filters( 'templ_get_site_logo', $return_str );
}


/************************************
//FUNCTION NAME : templ_home_page_slider
//ARGUMENTS : None
//RETURNS : Widgets of Slider Above,Home Slider and Slider Below for home page
***************************************/
function templ_home_page_slider()
{
	if (apply_filters('templ_home_page_slider_filter', true))
	{
		if (is_home() || is_front_page())
		{
			if (function_exists('dynamic_sidebar') && dynamic_sidebar('slider_above')){ }
		   	if (function_exists('dynamic_sidebar') && dynamic_sidebar('home_slider')){ }
			if (function_exists('dynamic_sidebar') && dynamic_sidebar('slider_below')){ }
		}	
	}
	do_action('templ_home_page_slider');
}

/************************************
//FUNCTION NAME : get_currency_sym
//ARGUMENTS : None
//RETURNS : Currency symbol for the system
***************************************/
if(!function_exists('get_currency_sym'))
{
	function get_currency_sym()
	{
		if(get_option('ptthemes_default_currency_symbol'))
		{
			return get_option('ptthemes_default_currency_symbol');	
		}
		return '$';
	}
}

/************************************
//FUNCTION NAME : get_currency_code
//ARGUMENTS : None
//RETURNS : Currency code for the system
***************************************/
if(!function_exists('get_currency_code'))
{
	function get_currency_code()
	{
		if(get_option('ptthemes_default_currency'))
		{
			return get_option('ptthemes_default_currency');	
		}
		return 'USD';
	}
}


/************************************
//FUNCTION NAME : templ_get_top_header_navigation_above_code
//ARGUMENTS : None
//RETURNS : Widgets of Top Navigation Above for Above Top header navigation
***************************************/
add_action('templ_get_top_header_navigation_above','templ_get_top_header_navigation_above_code');
function templ_get_top_header_navigation_above_code()
{
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('top_navigation_above')){ 
     }
}



/* realated posts*/


function get_related_posts($postdata)
{
	$postCatArr = wp_get_post_categories($postdata->ID);
	$post_array = array();
	for($c=0;$c<count($postCatArr);$c++)
	{
		$category_posts=get_posts('category='.$postCatArr[$c]);
		foreach($category_posts as $post) 
		{
			if($post->ID !=  $postdata->ID)
			{
				$post_array[$post->ID] = $post;
			}
		}
	}
	if($post_array)
	{
	?>
	<div class="related_post clearfix">
	<h3><?php _e('Related Article','templatic');?></h3><ul>
	<?php
		$relatedprd_count = 0;
		foreach($post_array as $postval)
		{
			$product_id = $postval->ID;
			$post_title = $postval->post_title;
			$productlink = get_permalink($product_id);
			$post_date = $postval->post_date;
			$comment_count = $postval->comment_count;
			if($postval->post_status == 'publish')
			{
				$relatedprd_count++;
				?>
				<li><a href="<?php echo $productlink; ?>" rel="bookmark" title="Permanent Link to <?php echo $post_title; ?>"><?php echo $post_title; ?></a></li>
				<?php
				if($relatedprd_count==5){ break;}
			}
		}
	?>
	</ul>
	</div>
	<?php
	}
}


function bdw_get_images_with_info($iPostID,$img_size='thumb') 
{
    $arrImages =& get_children('order=ASC&orderby=menu_order ID&post_type=attachment&post_mime_type=image&post_parent=' . $iPostID );
	$return_arr = array();
	if($arrImages) 
	{		
       foreach($arrImages as $key=>$val)
	   {
	   		$id = $val->ID;
			if($img_size == 'large')
			{
				$img_arr = wp_get_attachment_image_src($id,'full');	// THE FULL SIZE IMAGE INSTEAD
				$imgarr['id'] = $id;
				$imgarr['file'] = $img_arr[0];
				$return_arr[] = $imgarr;
			}
			elseif($img_size == 'medium')
			{
				$img_arr = wp_get_attachment_image_src($id, 'medium'); //THE medium SIZE IMAGE INSTEAD
				$imgarr['id'] = $id;
				$imgarr['file'] = $img_arr[0];
				$return_arr[] = $imgarr;
			}
			elseif($img_size == 'thumb')
			{
				$img_arr = wp_get_attachment_image_src($id, 'thumbnail'); // Get the thumbnail url for the attachment
				$imgarr['id'] = $id;
				$imgarr['file'] = $img_arr[0];
				$return_arr[] = $imgarr;
				
			}
	   }
	  return $return_arr;
	}
}
?>