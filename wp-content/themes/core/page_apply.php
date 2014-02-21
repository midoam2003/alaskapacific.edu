<?php

// Template Name: Apply

add_action('genesis_meta', 'template_load_css');

function template_load_css() { 
	?>

	<link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/fonts/soho.css">

	<?


}
//Load necessary scripts
add_action('genesis_before', 'template_load_scripts');
function template_load_scripts(){
?>

<style>
		#menu-item-409 a{
			background: url("<?php echo get_bloginfo('stylesheet_directory'); ?>/images/nav-bg.png") repeat-x 0 11px transparent !important;
		}
	</style>
	<?php
}

add_action('genesis_after', 'template_load_js');
function template_load_js() { 

    ?>




<script src="<?php echo get_bloginfo('stylesheet_directory'); ?>/js/jquery.isotope.min.js"></script>
<script src="<?php echo get_bloginfo('stylesheet_directory'); ?>/js/apply.js"></script>


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




<div id="apply-page">

	<div class="splash">
	        <div class="overlay"></div>
	        <header>

	        <h1>Apply to APU</h1>
	        <h2>Launching your future? Developing professional skills?<br />
	Follow these easy steps and you’ll be on your way!</h2>
	        
	        </header>
	        </div>

	        <div class="main">

	        <div id="step-1" class="step">
	            <h1><small>Step 1.</small>Select a degree program<span class="options legend"><span class="option"><i class="fa fa-moon-o fa-lg"></i>&nbsp;&nbsp;=&nbsp;&nbsp;Evening Courses</span><span class="option"><i class="fa fa-laptop fa-lg"></i>&nbsp;&nbsp;=&nbsp;&nbsp;Online Courses</span></span></h1>

	            <div class="degrees">

	            <h2>Bachelor's Degrees</h2>

	            <ul id="mix" data-portal="undergrad">

	            	<?php $loop = new WP_Query( array( 'post_type' => 'degrees', 'levels' => 'ba,bs' ) ); ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

<li><span class="icon"><i class="fa fa-chevron-right"></i></span><?php the_title() ?><span>Bachelor of Arts Degree</span><a href="<?php echo $url[0];  ?>" class="more">Read More&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a></li>


<?php endwhile; ?>

	            </ul>

	            <h2>Graduate Degrees</h2>

	            <ul id="mix2" data-portal="graduate">

	            <?php $loop = new WP_Query( array( 'post_type' => 'degrees', 'levels' => 'ma,mba-2,ms' ) ); ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

<li><span class="icon"><i class="fa fa-chevron-right"></i></span><?php the_title() ?><span>Bachelor of Arts Degree</span><a href="<?php echo $url[0];  ?>" class="more">Read More&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a></li>


<?php endwhile; ?>

	            </ul>

	            <h2>Doctoral Degrees</h2>

	            <ul data-portal="graduate">
	               <?php $loop = new WP_Query( array( 'post_type' => 'degrees', 'levels' => 'psyd' ) ); ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

<li><span class="icon"><i class="fa fa-chevron-right"></i></span><?php the_title() ?><span>Bachelor of Arts Degree</span><a href="<?php echo $url[0];  ?>" class="more">Read More&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a></li>


<?php endwhile; ?>
	            </ul>

	            <h2>Associate's Degrees</h2>

	            <ul data-portal="undergrad">
	                <?php $loop = new WP_Query( array( 'post_type' => 'degrees', 'levels' => 'aa' ) ); ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

<li><span class="icon"><i class="fa fa-chevron-right"></i></span><?php the_title() ?><span>Bachelor of Arts Degree</span><a href="<?php echo $url[0];  ?>" class="more">Read More&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a></li>


<?php endwhile; ?>
	            </ul>

	            <h2>Certificates</h2>

	            <ul data-portal="undergrad">
	                <?php $loop = new WP_Query( array( 'post_type' => 'degrees', 'levels' => 'certificate' ) ); ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

<li><span class="icon"><i class="fa fa-chevron-right"></i></span><?php the_title() ?><span>Bachelor of Arts Degree</span><a href="<?php echo $url[0];  ?>" class="more">Read More&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a></li>


<?php endwhile; ?>
	            </ul>

	            <h2>High School Student Programs</h2>

	            <ul data-portal="high-school">
	                <?php $loop = new WP_Query( array( 'post_type' => 'degrees', 'levels' => 'high-school' ) ); ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

<li><span class="icon"><i class="fa fa-chevron-right"></i></span><?php the_title() ?><span>Bachelor of Arts Degree</span><a href="<?php echo $url[0];  ?>" class="more">Read More&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a></li>


<?php endwhile; ?>
	            </ul>

	            <h2>Non-Degree Seeking</h2>

	            <ul>
	                <li class="single"><span class="icon"><i class="fa fa-chevron-right"></i></span>Non-Degree Seeking<a href="" class="more">Read More&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a></li>
	            </ul>

	            <!-- <h2>Non-degree Seeking</h2>

	            <ul>
	                <li>C</li>
	                <li>Credit-by-Choice<span>Bachelor of Arts Degree</span></li>
	            </ul> -->



	            </div>
	            </div>

	            <div id="step-2" class="step">

	                <h1><small>Step 2.</small>Review important dates <span class="amp">&amp;</span> deadlines</h1>

	                <div class="fafsa">

	                June 30th, 2014 federal deadline for FAFSA

	                </div>

	                <div class="undergrad">

	                Priority deadline 1 month prior to start of classes. Spring and Fall Start terms.

	                </div>

	                <div class="mba">

	                August 1st deadline for fall
	                December 1st deadline for spring
	                April 1st deadline for summer


	                </div>

	                <div class="map">

	                August 1st deadline for fall
	December 1st deadline for spring
	April 1st deadline for summer

	                </div>

	                 <div class="mses">

	                 Priority deadline for fall: Feb 15th (must complete application for graduate assistantship consideration)
	June 1st deadline for fall
	Nov 1st deadline for spring

	                </div>

	                <div class="msoee">

	                July 1st deadline for fall 
	                Nov 1st deadline for spring

	                </div>

	                <div class="early-honors">
	                June 1st deadline for fall
	                </div>

	                <div class="mscp">
	                March 1st deadline for fall
	                </div>

	                <div class="psyd">
	                Feb 1st deadline for summer
	                </div>     

	                <div class="international">

	                All International students regardless of program. Must also meet deadline requirements for their program of choice: 

	                June 1st deadline for fall
	Sept 1st deadline for spring


	                </div>          

	            </div>

	            <div id="step-3" class="step">
	            <h1><small>Step 3.</small>Complete the online application</h1>

	            <p>Please note you will need to create a new account to begin your online application. This new username and password is only for the application and will cease to be valid once you submit the completed application. An Admissions Counselor will contact you within a week after receiving your application to discuss any other documents necessary to complete your application.</p>

	            <br />

	            <a class="sign-up newbutton" href=""><i class="fa fa-user"></i>&nbsp;&nbsp;Create your account</a><a href="" class="login newbutton"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;Resume an application</a>

	            </div>

	            <div id="step-4" class="step">

	                <h1><small>Step 4.</small>Submit additional supporting documents</h1>

	                <div class="undergrad">

	                    <h2>Official Transcripts</h2>

	                    <p>Send us your official transcripts you have earned from schools you have attended.</p>

	                    <p>To be fully-admitted, we will need to receive official transcripts from all universities and postsecondary schools that you have attended. If you have less than 30 transferable college credits, we will also need an official high school or GED transcript. Credits are considered transferable if they are from 100 level or higher courses with a "C" or better average from an accredited university. A transcript is "official" only when we receive it in a sealed envelope from the awarding institution. You may have them sent directly to us or deliver it yourself as long as it is still sealed. Please use admissions@alaskapacific.edu if the institution delivers transcripts electronically.</p>

	                    <h2>ACT or SAT Scores</h2>

	                    <p>Applicants are required to submit test scores from either the ACT or SAT.</p>

	                    <p>APU requires the following minimum <em>combined</em> test scores to qualify for admission:</p>

	                    <table>
	                        <tr><th>ACT</th><th>SAT</th></tr>
	                        <tr><td>20</td><td>970</td></tr>
	                    </table>


	                    <p>Students whose test scores do not meet our minimums may be considered for admission if they have submitted an otherwise strong application.</p>

	                    <p>ACT scores may be requested online
	                    (ACT Reporting Code: 0062)</p>

	                    <p>SAT scores may be requested online
	                    (SAT Reporting Code: 4201) </p>

	                    <p>Standardized test scores are not required if you have graduated from high school more than 3 years ago or you have a GED.</p>

	                </div>

	                <div 








	                <div class="early-honors">

	                    <h2>Official Transcripts</h2>

	                    <p>To be fully-admitted, we will need to receive an official transcript from your high school. A transcript is "official" only when we receive it in a sealed envelope from the high school. You may have them sent directly to us or deliver it yourself as long as it is still sealed.</p>

	                    <h2>Test Scores &amp; Placement Testing</h2>
	<p>Early Honors applicants may be required to submit standardized test scores (Pre-SAT, SAT, ACT) or take APU math and writing placement tests to be considered for admission into the program and/or to determine best placement into APU course sequences.</p>

	<p>ACT scores may be requested online (ACT Reporting Code: 0062)</p>

	<p>SAT scores may be requested online (SAT Reporting Code: 4201)</p>

	                    <h2>Essay</h2>

	                    <p>We would like to know who you are, why you would like to attend Alaska Pacific University, and how you express yourself. Please choose one of the following essay options below and submit a double-spaced, typed essay of at least 500 words. Regardless of the option you choose, please include a brief explanation of why you would like to attend APU.</p>

	                    <ul>
	                        <li>Discuss a significant event or achievement that has shaped your values and goals.</li>
	                        <li>Describe a book, author, or individual who has had an impact on your development as a person.</li>
	                        <li>Tell us about your passions and interests and how they contribute to your personality.</li>
	                        <li>Send us a graded, written piece of work of which you are especially proud. Be sure that the work is significant enough to reflect the true level of your thinking and writing abilities. Be sure to include your teacher's comments, and let us know the assignment's requirements.</li>
	                    </ul>

	                    <h2>Letters of Recommendation</h2>

	                    Submit two Letters of Recommendation. Letter of recommendation form

	                    http://2p3hfwqbf6o3bs9g5tpqw3k05.wpengine.netdna-cdn.com/wp-content/uploads/2012/01/Undergraduate_LetterOfRec.pdf

	Students who attend Alaska Pacific University excel both in and out of the classroom. We want to hear about your success! Please submit two letters of recommendations from your, teachers, counselors, or employers. You may request a written letter or use our teacher recommendation form. Letters may be emailed to admissions@alaskapacific.edu or mailed to:

	                </div>


	                <div class="credit-by-choice">

	                    <h2>Application Fee</h2>

	                    <p>$25.00 non-refundable application fee. Please make checks or money orders payable to Alaska Pacific University.</p>

	                    <h2>Official Transcripts</h2>

	                    <p>Official high school transcripts. Transcripts are considered official only if they are delivered in a sealed envelope from the issuing institution.</p>

	                    <h2>High School Official Approval Letter</h2>

	                    <p>One letter from appropriate high school official approving Credit-By-Choice admission.</p>

	                    <h2>Parental Guardian Consent</h2>

	                    <p>Written consent from parent or guardian.</p>

	                </div>






	                <div class="box address">Office of Admissions<br />
	Alaska Pacific University<br />
	4101 University Drive<br />
	Anchorage, AK 99508</div>

	                <div class="box email">admissions@alaskapacific.edu</div>

	            </div>


	<!--             <h1><small>Step 5.</small>Interview with the Early Honors program director</h1> -->

	            <div id="step-5" class="step">
	            <h1><small>Step 5.</small>Wait for your acceptance decision</h1>

	                <div class="undergrad">
	                    <p>Once all admission requirements are fulfilled your file will be reviewed and you will be contacted within a week.</p>
	                </div>

	                <div class="graduate">
	                    <p>Each Graduate program requires admission to the University as well as to the program the student wishes to enter. Application documents are collected by the Admissions Office and then sent to the appropriate department for evaluation by the Program Director. When a decision is made regarding admission, the applicant will be notified by the Graduate Program Director and the Graduate Admissions Counselor.</p>
	                </div>
	            </div>
	            <div id="step-6" class="step">
	            <h1><small>Step 6.</small>Get in touch with our admissions counselors</h1>

	            </div>

	        </div>
	</div>

<?php
get_footer();