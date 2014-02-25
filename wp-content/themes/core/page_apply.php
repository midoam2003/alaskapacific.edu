<?php

// Template Name: Apply

add_action('genesis_meta', 'template_load_css');

function template_load_css() { 
?>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
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

<script src="<?php echo get_bloginfo('stylesheet_directory'); ?>/js/jquery.mixitup.min.js"></script>
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
			<ul id="bachelors-degrees" data-portal="undergrad">
				<?php $loop = new WP_Query( array( 'post_type' => 'degrees', 'levels' => 'ba,bs', 'posts_per_page'=>-1, 'order'=>'ASC', 'orderby'=>'menu_order' ) ); ?>
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<li data-program="<? echo $post->post_name ?>" data-portal="<?php $portals = get_the_terms($post->ID, 'portal'); $portal = array_pop($portals); echo $portal->slug; ?>"><span class="cancel"><i class="fa fa-times"></i></span><span class="icon"><i class="fa fa-chevron-right"></i></span><?php the_title() ?><a href="<?php the_permalink()  ?>" class="more">Read More&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a></li>
				<?php endwhile; ?>
	        </ul>

	        <h2>Graduate Degrees</h2>
			<ul id="graduate-degrees" data-portal="graduate">
			<?php $loop = new WP_Query( array( 'post_type' => 'degrees', 'levels' => 'ma,mba-2,ms', 'posts_per_page'=>-1, 'order'=>'ASC', 'orderby'=>'menu_order') ); ?>
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<li data-program="<? echo $post->post_name ?>" data-portal="<?php $portals = get_the_terms($post->ID, 'portal'); $portal = array_pop($portals); echo $portal->slug; ?>"><span class="cancel"><i class="fa fa-times"></i></span><span class="icon"><i class="fa fa-chevron-right"></i></span><?php the_title() ?><a href="<?php the_permalink() ?>" class="more">Read More&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a></li>
			<?php endwhile; ?>
			</ul>

			<h2>Doctoral Degrees</h2>
	        <ul id="doctoral-degrees" data-portal="graduate">
	        <?php $loop = new WP_Query( array( 'post_type' => 'degrees', 'levels' => 'psyd', 'posts_per_page'=>-1, 'order'=>'ASC', 'orderby'=>'menu_order') ); ?>
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<li data-program="<? echo $post->post_name ?>" data-portal="<?php $portals = get_the_terms($post->ID, 'portal'); $portal = array_pop($portals); echo $portal->slug; ?>"><span class="cancel"><i class="fa fa-times"></i></span><span class="icon"><i class="fa fa-chevron-right"></i></span><?php the_title() ?><a href="<?php the_permalink()  ?>" class="more">Read More&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a></li>
			<?php endwhile; ?>
	        </ul>

	            <h2>Associate's Degrees</h2>

	            <ul id="associates-degrees" data-portal="undergrad">
	                <?php $loop = new WP_Query( array( 'post_type' => 'degrees', 'levels' => 'aa', 'posts_per_page'=>-1, 'order'=>'ASC', 'orderby'=>'menu_order' ) ); ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
<li data-program="<? echo $post->post_name ?>" data-portal="<?php $portals = get_the_terms($post->ID, 'portal'); $portal = array_pop($portals); echo $portal->slug; ?>"><span class="cancel"><i class="fa fa-times"></i></span><span class="icon"><i class="fa fa-chevron-right"></i></span><?php the_title() ?><a href="<?php the_permalink()  ?>" class="more">Read More&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a></li>


<?php endwhile; ?>
	            </ul>

	            <h2>Certificates</h2>

	            <ul id="certificates" data-portal="undergrad">
	                <?php $loop = new WP_Query( array( 'post_type' => 'degrees', 'levels' => 'ctf', 'posts_per_page'=>-1, 'order'=>'ASC', 'orderby'=>'menu_order' ) ); ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
<li data-program="<? echo $post->post_name ?>" data-portal="<?php $portals = get_the_terms($post->ID, 'portal'); $portal = array_pop($portals); echo $portal->slug; ?>"><span class="cancel"><i class="fa fa-times"></i></span><span class="icon"><i class="fa fa-chevron-right"></i></span><?php the_title() ?><a href="<?php the_permalink()  ?>" class="more">Read More&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a></li>


<?php endwhile; ?>
	            </ul>

	            <h2>High School Student Programs</h2>

	            <ul id="high-school-programs" data-portal="high-school">
	                <?php $loop = new WP_Query( array( 'post_type' => 'degrees', 'levels' => 'high-school', 'posts_per_page'=>-1, 'order'=>'ASC', 'orderby'=>'menu_order' ) ); ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

<li data-program="<? echo $post->post_name ?>" data-portal="<?php $portals = get_the_terms($post->ID, 'portal'); $portal = array_pop($portals); echo $portal->slug; ?>"><span class="cancel"><i class="fa fa-times"></i></span><span class="icon"><i class="fa fa-chevron-right"></i></span><?php the_title() ?><a href="<?php the_permalink()  ?>" class="more">Read More&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a></li>


<?php endwhile; ?>
	            </ul>

	            <h3>Still undecided? You can still apply with the following option:</h3>

	            <ul id="non-degree-seeking">
	                <li class="single" data-portal="non"><span class="cancel"><i class="fa fa-times"></i></span><span class="icon"><i class="fa fa-chevron-right"></i></span>Non-Degree Seeking<a href="" class="more">Read More&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></a></li>
	            </ul>

	            <!-- <h2>Non-degree Seeking</h2>

	            <ul>
	                <li>C</li>
	                <li>Credit-by-Choice</li>
	            </ul> -->



	            </div>
	            </div>

	            <div id="step-2" class="step">

	                <h1><small>Step 2.</small>Review important dates <span class="amp">&amp;</span> deadlines</h1>

	                <div class="default deadline">

	                	<h2>Registration Deadlines</h2>
	                	<p>Priority deadline 1 month prior to start of classes. Spring and Fall Start terms.</p>

	                </div>

	                <div class="cup deadline">
		                <h2>Registration Deadlines</h2>
		                <p>1 month prior to the start of block or session class.</p>
	                </div>

	                <div class="ps deadline">

		                <h2>Registration Deadlines</h2>
		                <p>1 month prior to the start of block, session, or module class.</p>

	                </div>

	                <div class="other deadline">

	                	<h2>Registration Deadlines</h2>
		                <p>August 1st for Fall, December 1st for Spring, April 1st for Summers (unless otherwise noted).</p>

	                </div>

	                <div class="ms-environmental-science deadline">

	                	<h2>Registration Deadlines</h2>
		                <p>June 1st for Fall, November 1st for Spring.</p>

	                </div>

	                <div class="ms-outdoor-environmental-education deadline">

	                	<h2>Registration Deadlines</h2>
		                <p>July 1st for Fall, November 1st for Spring.</p>

	                </div>

	                <div class="ms-counseling-psychology deadline">

	                	<h2>Registration Deadlines</h2>
		                <p>March 1st for Fall.</p>
		                

	                </div>

	                <div class="psyd-counseling-psychology deadline">

	                	<h2>Registration Deadlines</h2>
		                <p>February 1st for Summer.</p>
		                

	                </div>

	                <div class="ehp deadline">
	                	<h2>Registration Deadlines</h2>
		                <p>June 1st deadline for fall.</p> 
	                </div>

	                <p><a class="newbutton calendar" href="http://www.alaskapacific.edu/university-calendar/"><i class="fa fa-calendar"></i>&nbsp;&nbsp;View the University Calendar for upcoming dates</a></p>

<!-- 
	                <div class="international">

	                All International students regardless of program. Must also meet deadline requirements for their program of choice: 

	                June 1st deadline for fall
	Sept 1st deadline for spring


	                </div>           -->

	            </div>

	            <div id="step-3" class="step">
		            <h1><small>Step 3.</small>Complete the online application</h1>

		            <p>Please note you will need to create a new account to begin your online application. This new username and password is only for the application and will cease to be valid once you submit the completed application. An Admissions Counselor will contact you within a week after receiving your application to discuss any other documents necessary to complete your application.</p>

		            <br />

		            <a class="sign-up newbutton" href=""><i class="fa fa-user"></i>&nbsp;&nbsp;Create your account</a><a href="" class="login newbutton"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;Resume an application</a>

	            </div>

	            <div id="step-4" class="step">

	                <h1><small>Step 4.</small>Submit additional supporting documents</h1>

	                <div class="cup docs">

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

	                    <p>Request your ACT scores online (ACT Reporting Code: 0062)</p>

	                    <p>SAT scores may be requested online (SAT Reporting Code: 4201) </p>

	                    <p>Standardized test scores are not required if you have graduated from high school more than 3 years ago or you have a GED.</p>

	                </div>

	                <div class="ps docs">

	                    <h2>Official Transcripts</h2>

	                    <p>Send us your official transcripts you have earned from schools you have attended.</p>

	                    <p>To be fully-admitted, we will need to receive official transcripts from all universities and postsecondary schools that you have attended. If you have less than 30 transferable college credits, we will also need an official high school or GED transcript. Credits are considered transferable if they are from 100 level or higher courses with a "C" or better average from an accredited university. A transcript is "official" only when we receive it in a sealed envelope from the awarding institution. You may have them sent directly to us or deliver it yourself as long as it is still sealed.</p>

	                    <h2>Statement of Goals</h2>

	                    <p>You will need to compose a 1-2 page essay about your goals. We ask you to describe your goals, how you feel your degree will help you accomplish these goals, and the impact it may have on your family, community, or self. Please note this also serves as your writing sample.</p>

	                    <h2>Current Résumé</h2>

	                    <p>The classrooms at Alaska Pacific University are filled with students who come from many different professional backgrounds. Your résumé will help your academic adviser better understand your professional background.</p>

	                </div>

	                <div class="doct docs">

	                    <h2>Résumé</h2>

	                    <p>Send us your current professional Cirriculum Vitae or Résumé.</p>

	                    <h2>Letters of Reference</h2>

	                    <p>Three letters of reference (note recommendation letters should include an appraisal of your ability to work in a significantly self-directed program at the doctoral level as well as your critical thinking, analytical, and communications skills. Referrals should include the writer’s address, telephone number and/or email, and their relationship to you.</p>

	                    <h2>Autobiography</h2>

	                    <p>A one or two page autobiography (personal as opposed to professional) that highlights your strengths. We want to get to know you and have a sense of what strengths you will bring to the cohort.</p>

	                    <h2>Essay</h2>

	                    <p>An essay that addresses the following questions:</p>

	                    <ul>
	                        <li>What are your reasons for wanting a Psy.D. from APU at this time?</li>
	                        <li>What are your short and long term personal and professional goals? How do you see yourself contributing to the improvement of the community or larger society with the Psy. D.?</li>
	                        <li>Describe your abilities and desires regarding rigorous independent work within a cohort setting or model along with your plans to enter into Track 1 or 2.</li>
	                        <li>Describe your plan to balance graduate school, work, and personal life should you be admitted to the program.</li>
	                    </ul>

	                    <h2>Writing Sample</h2>

	                    <p>Academic writing sample. APA format preferred.</p>

	                </div>

	                <div class="ehp docs">

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

	                    <p>Submit two Letters of Recommendation.</p>

	                    <p><a class="newbutton recommendation" href="http://2p3hfwqbf6o3bs9g5tpqw3k05.wpengine.netdna-cdn.com/wp-content/uploads/2012/01/Undergraduate_LetterOfRec.pdf"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;Download the Letter of Recommendation template form</a></p>
	                    
	                    <p>Students who attend Alaska Pacific University excel both in and out of the classroom. We want to hear about your success! Please submit two letters of recommendations from your, teachers, counselors, or employers. You may request a written letter or use our teacher recommendation form.</p>

	                </div>


	                <div class="credit-by-choice docs">

	                    <h2>Application Fee</h2>

	                    <p><b>$25.00</b> non-refundable application fee. Please make checks or money orders payable to Alaska Pacific University.</p>

	                    <h2>Official Transcripts</h2>

	                    <p>Official high school transcripts. Transcripts are considered official only if they are delivered in a sealed envelope from the issuing institution.</p>

	                    <h2>High School Official Approval Letter</h2>

	                    <p>One letter from appropriate high school official approving Credit-By-Choice admission.</p>

	                    <h2>Parental Guardian Consent</h2>

	                    <p>Written consent from parent or guardian.</p>

	                </div>

	                <div class="non docs">

	                	<h2>Application Fee</h2>

	                    <p><b>$25.00</b> non-refundable application fee. Please make checks or money orders payable to Alaska Pacific University.</p>

	                </div>

	                <div class="master-of-arts-program docs">

		                <h2>Personal Statement and Study Plan</h2>

						<p>As the central feature of the application, these essays are reviewed by the admissions committee as a demonstration of your writing competence, your ability to fully articulate your goals, the appropriateness of a non-traditional program for attaining your goals, as well as a measurement of your critical thinking skills. The committee will give considerable weight to the thoroughness and genuineness with which you complete your Personal Statement as well as to the specificity and relevance of your curriculum as defined by your Study Plan.</p>

						<h2>Samples of Work</h2>

						<p>If applicable, applicants are required to submit examples of work completed with the portfolio. Depending on the field of study these may include research project narratives, manuscripts, creative writing samples, articles, short stories, photographs or transparencies of artwork, major papers, or other materials and documentation.</p>

					</div>

					<div class="master-of-business-administration docs">

						<h2>Essay</h2>

						<p>Submit a 500-800 word essay addressing your personal and professional goals as they relate to your motivation to obtain an MBA degree or a Certificate (not required for MBAICT program).</p>

					</div>

					<div class="ms-environmental-science docs">

						<h2>Essay</h2>

						<p>Write and submit a 500-word essay outlining your motivation for seeking the Master of Science in Environmental Science Degree. Include your professional interests, career goals, potential research topics, and the faculty advisor(s) that you would like to work with.</p>

					</div>

					<div class="ms-outdoor-environmental-education docs">

						<h2>Essay</h2>

						<p>Write and submit a 700-1000 word essay outlining your motivations for seeking the Master of Science in Outdoor and Environmental Education degree. Include your professional interests and career goals.</p>

					</div>

					<div class="psyd-counseling-psychology docs">

						<h2>Essay</h2>

						<p>Please address as completely as possible the following areas:</p>

						<ul>
							<li>What are your reasons for wanting to obtain an advanced degree in Counseling Psychology?</li>
							<li>What are your short-term and long-term goals, or how do you see yourself as contributing towards the improvement of a social or community problem in your area?</li>
							<li>The MSCP Program is designed to be an academically intense and experientially demanding program. If admitted, we (the faculty) plan to create and maintain an intellectually and personally challenging experience for you. Therefore, please describe how you plan to balance graduate school, work and personal life (i.e. relationships, family, etc.)</li>
							<li>Please provide one-page biography. The purpose of this application is to help us learn more about you. Please share any other personal information, which you would like the Admissions Committee to take into consideration during the interview process.</li>
						</ul>

					</div>

					<div class="grad docs">

						<h2>Letters of Recommendation</h2>
						<p>Applicants to our graduate programs must submit three letters of recommendation. Feel free to email your letters of recommendation to admissions@alaskapacific.edu or directly to your admissions counselor. You may also use our graduate recommendation form as a substitute for the letters of rec.</p>

					</div>

					<div class="master-of-business-administration docs">

						<h2>Test Scores</h2>

						<p>Standardized Test. Submit scores from the Graduate Record Exam (GRE) or the Graduate Management Admission Test (GMAT). Alaska Pacific’s GRE and GMAT reporting code is 4201 (not required for MBAICT program).</p>

						<h2>Résumé</h2>

	                    <p>Send us your current professional Cirriculum Vitae or Résumé.</p>

					</div>

<!-- 
						Teaching Certification

						Alaska Department of Education and Early Development initial certification test (Praxis I, CBEST or WEST-B). Scores must meet or exceed Alaska State requirements. Alaska Pacific’s Praxis I reporting code is RA-4201. Scores must also be reported to the AK State DOEED at R-7027.
 -->

 					<div class="master-of-arts-program docs">

						<h2>Test Scores</h2>

						<p>Official Graduate Entrance Examination Scores. MAP cannot accept scores older than five years beyond the official test date. Please contact the MAP Director for assistance in determining which test (the GRE, GMAT, or Miller Analogies Test (MAT)) would be best suited for your application. Alaska Pacific's reporting code is 4201 for GRE and GMAT, and 1841 for MAT. In certain circumstances, the testing requirement may be waived.</p>

					</div>

					<div class="ms-counseling-psychology docs">

						<h2>Test Scores</h2>

						<p>Standardized Test. Submit scores from the Miller Analogy Test (MAT). Alaska Pacific’s MAT reporting code is 1841.</p>

					</div>

					<div class="ms-environmental-science docs">

						<h2>Test Scores</h2>

						<p>Submit scores from the Graduate Records Exam (GRE) general test, which are no more than four years old.</p>

						<p>The Master of Science in Environmental Science program will waive test scores in some cases. Applicants who have had exceptional academic achievements and applicable professional experience are good candidates for test waivers.</p>

						<h2>Résumé</h2>

	                    <p>Send us your current professional Cirriculum Vitae or Résumé.</p>

					</div>


					<div class="ms-outdoor-environmental-education docs">

						<h2>Test Scores</h2>

						<p>Submit scores from the Miller Analogy Test (MAT) or the Graduate Records Exam (GRE) general test. Alaska Pacific’s GRE reporting code is 4201, MAT reporting code is 1841.</p>

						<h2>Résumé</h2>

	                    <p>Send us your current professional Cirriculum Vitae or Résumé.</p>

					</div>
		
					<div class="grad docs">

						<p>Test scores are waived for applicants who already have one master’s degree.</p>

						<p>The TOEFL score is not always required of international applicants. Their essays are used to make a preliminary determination of their command of the English language.</p>

						<h2>GPA scores</h2>

						<p>Graduate candidates who have GPA scores below a 3.0 may be admitted on a provisional basis. Full admission is contingent upon successful completion of the first semester of classes in which they are required to maintain a 3.0 GPA or above.</p>

						<p>Applicants with a GPA between 2.75 and 2.99 may be considered appropriate by the Program Director of the graduate program. If an applicant’s GPA is below a 2.75, the Program Director will make a decision based on the recommendation of the department in which the program is offered. The Program Director has the option of seeking input from the Graduate Studies Committee in uncertain cases. The Program Director will report the admission of students with a GPA below a 2.75 to the Graduate Studies Committee.</p>

					</div>

					<div class="certification-option-for-teachers-k-8 docs">

						<h2>Background Check</h2>

						<p>All CO-OP Participants must provide a copy of an Alaska State Troopers Background Check to the Education Department prior to starting the program. Background checks can be done on a walk-in basis at the locations listed online.</p>

					</div>


					<br /><br />

					<p><b>Please submit all documents via one of the following methods:</b></p>

					<div class="floats">
	                <div class="box address"><span class="icon"><i class="fa fa-building-o fa-lg"></i></span>Office of Admissions<br />
	Alaska Pacific University<br />
	4101 University Drive<br />
	Anchorage, AK 99508</div>

	                <div class="box email"><span class="icon"><i class="fa fa-envelope-o fa-lg"></i></span>admissions@alaskapacific.edu</div>

	                </div>

	                

	            </div>


	<!--             <h1><small>Step 5.</small>Interview with the Early Honors program director</h1> -->

	            <div id="step-5" class="step">
	            <h1><small>Step 5.</small>Wait for your acceptance decision</h1>

	                <div class="undergrad">
	                    <p>Once all admission requirements are fulfilled your file will be reviewed and you will be contacted within a week.</p>
	                </div>

	                <div class="grad">
	                    <p>Each Graduate program requires admission to the University as well as to the program the student wishes to enter. Application documents are collected by the Admissions Office and then sent to the appropriate department for evaluation by the Program Director. When a decision is made regarding admission, the applicant will be notified by the Graduate Program Director and the Graduate Admissions Counselor.</p>
	                </div>
	            </div>
	            <div id="step-6" class="step">
	            <h1><small>Step 6.</small>Get in touch with our admissions counselors</h1>

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

	            </div>

	        </div>
	</div>

<?php
get_footer();