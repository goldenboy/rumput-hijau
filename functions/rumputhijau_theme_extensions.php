<?php

################################################################################
// Breadcrumbs - http://dimox.net/wordpress-breadcrumbs-without-a-plugin/
################################################################################

function rumputhijau_breadcrumbs() {
 
  $delimiter = '&raquo;';
  $home = 'Home'; // text for the 'Home' link
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
 
    echo '<div id="breadcrumbs">';
 
    global $post;
    $homeLink = home_url();
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo 'Page' . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }
} // end rumputhijau_breadcrumbs()

################################################################################
// Stop more link from jumping to middle of page
################################################################################

function remove_more_jump_link($link) { 
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}
add_filter('the_content_more_link', 'remove_more_jump_link');

##########################################################################################
// Twitter Widget by Jeffrey Way - https://github.com/JeffreyWay/WordPress-Twitter-Widget
##########################################################################################
class rumputhijau_Twitter_Widget extends WP_Widget {
    function __construct() {
        $params = array(
	    'description' => __('Display your recent tweets to your readers.', 'rumputhijau'),
	    'name' => __('&raquo; Rumputhijau Twitter Widget', 'rumputhijau')
		);
        
        // id, name, params
        parent::__construct('rumputhijau_Twitter_Widget', '', $params);
    }
    
    public function form($instance) {
        extract($instance);
        ?>
        
        <p>
	    <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', 'rumputhijau'); ?> </label>
	    <input type="text"
		class="widefat"
		id="<?php echo $this->get_field_id('title'); ?>"
		name="<?php echo $this->get_field_name('title'); ?>"
		value="<?php if ( isset($title) ) echo esc_attr($title); ?>" />
        </p>
        
        <p>
	    <label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Twitter Username:', 'rumputhijau'); ?></label>
	    
	    <input class="widefat"
		type="text"
		id="<?php echo $this->get_field_id('username'); ?>"
		name="<?php echo $this->get_field_name('username'); ?>"
		value="<?php if ( isset($username) ) echo esc_attr($username); ?>" />
        </p>
        
        <p>
	    <label for="<?php echo $this->get_field_id('tweet_count'); ?>">
		<?php _e('Number of Tweets to Retrieve:', 'rumputhijau'); ?>
	    </label>
	     
	    <input
		type="number"
		class="widefat"
		style="width: 40px;"
		id="<?php echo $this->get_field_id('tweet_count');?>"
		name="<?php echo $this->get_field_name('tweet_count');?>"
		min="1"
		max="10"
		value="<?php echo !empty($tweet_count) ? $tweet_count : 5; ?>" />
        </p>
        <?php
    }
    
    // What the visitor sees...
    public function widget($args, $instance) {
	extract($instance);
        extract( $args );
        
        if ( empty($title) ) $title = 'Recent Tweets';
        
        $data = $this->twitter($tweet_count, $username);
        if ( false !== $data && isset($data->tweets) ) {
            echo $before_widget;
		echo $before_title;
		    echo $title;
		echo $after_title;
		
		echo '<ul><li>' . implode('</li><li>', $data->tweets) . '</li></ul>'; ?>
		<span class="follow-me">
			<a href="https://twitter.com/<?php echo $username; ?>" class="twitter-follow-button" data-show-count="false">Follow @<?php echo $username; ?></a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</span>
        <?php   echo $after_widget;
        }
    }
    
    private function twitter($tweet_count, $username)
    {
        if ( empty($username) ) return;
        
        $tweets = get_transient('recent_tweets_widget');
        if ( !$tweets ||
	    $tweets->username !== $username ||
	    $tweets->tweet_count !== $tweet_count )
	{
	    return $this->fetch_tweets($tweet_count, $username);
	}
        return $tweets;
    }
    
    private function fetch_tweets($tweet_count, $username)
    {
	$tweets = wp_remote_get("http://twitter.com/statuses/user_timeline/$username.json");
	$tweets = json_decode($tweets['body']);
	
	// An error retrieving from the Twitter API?
	if ( isset($tweets->error) ) return false;
	
	$data = new StdClass();
	$data->username = $username;
	$data->tweet_count = $tweet_count;
	
	foreach($tweets as $tweet) {
	    if ( $tweet_count-- === 0 ) break;
	    $data->tweets[] = $this->filter_tweet( $tweet->text );
	}
	
	set_transient('recent_tweets_widget', $data, 60 * 5); // five minutes
	return $data;
    }

    private function filter_tweet($tweet)
    {
        // Username links
        $tweet = preg_replace('/(http[^\s]+)/im', '<a href="$1">$1</a>', $tweet);
        $tweet = preg_replace('/@([^\s]+)/i', '<a href="http://twitter.com/$1">@$1</a>', $tweet);
        // URL links
        return $tweet;
    }
    
}

add_action('widgets_init', 'register_rumputhijau_twitter_widget');
function register_rumputhijau_twitter_widget()
{
    register_widget('rumputhijau_Twitter_Widget');
}
?>