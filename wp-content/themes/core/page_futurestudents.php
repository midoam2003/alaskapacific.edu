<?php

// Template Name: Future Students

//Load necessary scripts
add_action('genesis_before', 'template_load_scripts');
function template_load_scripts(){
?><style>
		#menu-item-409 a{
			background: url("<?php echo get_bloginfo('stylesheet_directory'); ?>/images/nav-bg.png") repeat-x 0 11px transparent !important;
		}
	</style>

	<script src="<?php echo get_bloginfo('stylesheet_directory'); ?>/js/future-students.js"></script>
	<?php
}





//Mobile Menu
add_action('genesis_before', 'template_load_mobile');
function template_load_mobile(){
	load_main_menu();
	load_page_menu('admissions-menu');
	load_quick_links();
}

 get_header(); 

// content here
 ?>

<div class="future-splash"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/future-students/future-students-header.jpg"></div>

<div class="future-boxes">
	<div class="box-wrap">
	<div class="box discover">
		<h2><a href="http://www.alaskapacific.edu/apply/visit-campus/"><span>Discover Campus</span></a></h2>
		<ul>
			<li><a href="http://www.alaskapacific.edu/apply/visit-campus/">Schedule a Tour</a></li>
			<li>
			<a href="http://www.youvisit.com" class="virtualtour_embed"
	alt = "Virtual Tour"
	data-inst="60370"
	data-loc="80519"
	data-platform="v"
>Take a Virtual Tour</a>
<script src="http://www.youvisit.com/tour/Embed/js2"></script></li>
			<li><a href="http://www.alaskapacific.edu/apply/visit-campus/apu-experience/">Attend an Open House</a></li>
			<li><a href="http://www.alaskapacific.edu/explore-apu/student-life/housing/housing-options/">Living on Campus</a></li>
		</ul>
	</div>
	<div class="box degree-browser">
		<h2><a href="http://www.alaskapacific.edu/degrees"><span>Find Your Degree</span></a></h2>
		<ul>
			<li><a href="http://www.alaskapacific.edu/degrees">Browse Degree Programs</a></li>
			<li><a href="https://ssl.alaskapacific.edu/CourseOffering/Offering.aspx">Search Course Offerings</a></li>
			<li><a href="http://catalog.alaskapacific.edu/content.php?catoid=6&navoid=120">View 2013-2014 Course Catalog</a></li>
			
		</ul>
	</div>
	<div class="box costs-options">
		<h2><a href="http://www.alaskapacific.edu/apply/financial-aid/cost-of-attendance/"><span>Costs &amp; Options</span></a></h2>
		<ul>
			<li><a href="http://www.alaskapacific.edu/apply/financial-aid/cost-of-attendance/">Cost of Attendance</a></li>
			<li><a href="https://ssl.alaskapacific.edu/NetCalculator/index.htm">Tuition Net Price Calculator</a></li>
			<li><a href="http://www.alaskapacific.edu/apply/financial-aid/financial-aid-information">Financial Aid</a></li>
			<li><a href="http://www.alaskapacific.edu/apply/financial-aid/financial-aid-information/scholarship-and-resources/">Scholarships</a></li>
		</ul>
	</div>
	<div class="box apply">
		<h2><a href="http://www.alaskapacific.edu/apply/"><span>Apply Today</span></a></h2>
		<ul>
			<li><a href="http://www.alaskapacific.edu/apply/">Start Your Application Now</a></li>
			<li><a href="http://catalog.alaskapacific.edu/content.php?catoid=6&navoid=145">Admission Requirements</a></li>
			<!-- <li><a href="">Dates &amp; Deadlines</a></li> -->
			<!-- <li><a href="">Online Application</a></li> -->
			<!-- <li><a href="">Next Steps &amp; Importan Documents</a></li> -->
		</ul>
	</div>
	</div>
</div>

<div class="video-splash">
<div class="video-splash-wrap">
<div class="copy">
	
	<h2>There’s a place <em>for you</em> at APU</h2>
	<p><strong>The people</strong>, places and stories of Alaska are foundations of your sequenced cirriculum. Expect to be challenged academically as you develop in-demand skills including project management, collaborative teamwork in the sciences and liberal arts, and effective communication in a variety of media.</p>
</div>	
<div class="video"><iframe src="//player.vimeo.com/video/60010026?title=0&amp;byline=0&amp;portrait=0" width="100%" height="242" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>
</div>
</div>

<div class="testimonials">
<h2>Student Successes</h2>

<ul><li><p class="quote">"Since coming to APU, I’ve had many incredible experiences that have allowed me to grow into the person I am today, and the person I want to be tomorrow. Through educational experiences and active learning, I was able to create my own focus based on my personal goals and interests. I couldn’t have asked for a better education."</p><p class="source">— Devin Littlefield, Outdoor Studies</p></li>

<li><p class="quote">"APU provides some of the most unique class experiences. For example, my second semester of my freshman year, I took a dog mushing course. Yup, I was able to learn how to mush a six dog team for college credit. It was one of the most incredible things I have experienced. My advice is to just take a chance on APU, you never know what hidden passion you will discover here at APU."</p><p class="source">— Amber Peterson, Environmental Sciences</p></li>

<li><p class="quote">"Alaska Pacific University is an opportunity that few people get to experience. Fortunately, I have had the great fortune to be exposed to a rigorous program and benefiting from in as an adult and member of the scientific community. Marine biology has always been my dream and APU has given me the tools and map to build myself a firm future.
"</p><p class="source">— Nicholas Tucker, Marine Biology</p></li>


</ul>

</div>

<div class="news">
	<h2>News &amp; Announcements</h2>
	<?php query_posts('category_name=Admissions&showposts=5'); ?>
<ol>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<li><?php the_title(); ?></li>
<?php endwhile; ?>
</ol>
<?php endif; ?>

</div>

<div class="meet">
	<h2>Meet Your Admissions Counselors</h2>
	<h3 class="subtitle">Need more guidance? Don’t hesitate to get in touch:</h3>

	<div class="post-10872 people type-people status-publish hentry entry">
				<a href="http://www.alaskapacific.edu/blog/people/anthony-sallows/" title="Anthony Sallows">
				<img width="100" height="100" src="http://www.alaskapacific.edu/wp-content/uploads/photo.JPG-100x100.jpeg" class="alignleft post-image" alt="photo.JPG">				</a>
				<h2 class="entry-title"><a href="http://www.alaskapacific.edu/blog/people/anthony-sallows/" title="Anthony Sallows">Anthony Sallows</a></h2>
				<p class="people-details">
				Admissions Counselor<br>				907-564-8300<br>												</p>
				</div>

				<div class="post-21332 people type-people status-publish hentry entry">
				<a href="http://www.alaskapacific.edu/blog/people/brian-mcdermott/" title="Brian McDermott">
				<img width="100" height="100" src="http://www.alaskapacific.edu/wp-content/uploads/BrianMcDermott-100x100.jpg" class="alignleft post-image" alt="BrianMcDermott">				</a>
				<h2 class="entry-title"><a href="http://www.alaskapacific.edu/blog/people/brian-mcdermott/" title="Brian McDermott">Brian McDermott</a></h2>
				<p class="people-details">
				Admissions Counselor<br>				907-564-8248<br>				<a href="http://www.alaskapacific.edu/contact/index.php?person=21332" title="Contact Brian McDermott">Contact</a><br>								</p>
				</div>


</div>


<?php
get_footer();
