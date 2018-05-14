<?php
/**
 * @package The Taste of Ink
 * @version 1.0
 */
/*
Plugin Name: The Taste of Ink
Plugin URI: https://wordpress.org/plugins/the-taste-of-ink/
Description: You will randomly see a lyric from The taste of ink in the upper right of your admin screen on every page.
Author: Courd Headman
Version: 1.0
Author URI: http://courd.ga
Text Domain: taste-of-ink
*/

function taste_of_ink_get_lyric() {
	/** These are the lyrics to Hello Dolly */
	$lyrics = "is it worth it can you even hear me?
	standing with your spotlight on me
	not enough to feed the hungry
	i'm tired and i've felt it for a while now
	in this sea of lonely
	The taste of ink is getting old
	It's four o' clock in the ******* morning
	Each day gets more and more like the last day
	Still I can see it coming
	While I'm standing in the river drowning
	This could be my chance to break out
	This could be my chance to say goodbye
	At last it's finally over
	Couldn't take this town much longer
	Being half dead wasn't what I planned to be
	Now I'm ready to be free
	So here I am it's in my hands
	And I'll savor every moment of this
	So here I am alive at last
	And I'll savor every moment of this
	Won't you think I'm pretty
	When I'm standing top the bright lit city
	And I'll take your hand and pick you up
	And keep you there so you can see it
	As long as you're alive and care
	I promise I will take you there
	We'll drink and dance the night away
	As long as you're alive
	Here I am
	So long as you're alive and care
	I promise I will take you there";

	// Here we split it into lines
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function taste_that_ink() {
	$chosen = taste_of_ink_get_lyric();
	echo "<p id='dolly'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'taste_that_ink' );

// We need some CSS to position the paragraph
function ink_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#dolly {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_action( 'admin_head', 'ink_css' );
