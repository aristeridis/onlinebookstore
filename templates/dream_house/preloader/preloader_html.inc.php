<?php 

echo '<div id="preloader">';

switch ($this->params->get('preloader')) {
case "rotating-plane":
    echo '
		<div class="os-spinner">
		  <div class="rect1"></div>
		  <div class="rect2"></div>
		  <div class="rect3"></div>
		  <div class="rect4"></div>
		  <div class="rect5"></div>
		</div>
	';
    break;
case "double-bounce":
    echo '
		<div class="os-spinner">
			<div class="double-bounce1"></div>
			<div class="double-bounce2"></div>
		</div>
	';
    break;
case "rectangle-bounce":
		echo '
			<div class="os-spinner">
				<div class="rect1"></div>
				<div class="rect2"></div>
				<div class="rect3"></div>
				<div class="rect4"></div>
				<div class="rect5"></div>
			</div>
		';
    break;
case "wandering-cubes":
    echo '
		<div class="os-spinner">
			<div class="cube1"></div>
			<div class="cube2"></div>
		</div>
	';
    break;
case "pulse":
    echo '
	    <div class="os-spinner"></div>
    ';
    break;
case "chasing-dots":
	echo '
		<div class="os-spinner">
			<div class="dot1"></div>
			<div class="dot2"></div>
		</div>
	';
    break;
case "three-bounce":
	echo '
		<div class="os-spinner">
			<div class="bounce1"></div>
			<div class="bounce2"></div>
			<div class="bounce3"></div>
		</div>
	';
    break;
case "sk-circle":
	echo '
		<div class="sk-circle os-spinner">
			<div class="sk-circle1 sk-child"></div>
			<div class="sk-circle2 sk-child"></div>
			<div class="sk-circle3 sk-child"></div>
			<div class="sk-circle4 sk-child"></div>
			<div class="sk-circle5 sk-child"></div>
			<div class="sk-circle6 sk-child"></div>
			<div class="sk-circle7 sk-child"></div>
			<div class="sk-circle8 sk-child"></div>
			<div class="sk-circle9 sk-child"></div>
			<div class="sk-circle10 sk-child"></div>
			<div class="sk-circle11 sk-child"></div>
			<div class="sk-circle12 sk-child"></div>
		</div>
	';
    break;
case "sk-cube-grid":
    echo '
		<div class="sk-cube-grid os-spinner">
			<div class="sk-cube sk-cube1"></div>
			<div class="sk-cube sk-cube2"></div>
			<div class="sk-cube sk-cube3"></div>
			<div class="sk-cube sk-cube4"></div>
			<div class="sk-cube sk-cube5"></div>
			<div class="sk-cube sk-cube6"></div>
			<div class="sk-cube sk-cube7"></div>
			<div class="sk-cube sk-cube8"></div>
			<div class="sk-cube sk-cube9"></div>
		</div>
	';
    break;
case "sk-fading-circle":
    echo '
		<div class="sk-fading-circle os-spinner">
			<div class="sk-circle1 sk-circle"></div>
			<div class="sk-circle2 sk-circle"></div>
			<div class="sk-circle3 sk-circle"></div>
			<div class="sk-circle4 sk-circle"></div>
			<div class="sk-circle5 sk-circle"></div>
			<div class="sk-circle6 sk-circle"></div>
			<div class="sk-circle7 sk-circle"></div>
			<div class="sk-circle8 sk-circle"></div>
			<div class="sk-circle9 sk-circle"></div>
			<div class="sk-circle10 sk-circle"></div>
			<div class="sk-circle11 sk-circle"></div>
			<div class="sk-circle12 sk-circle"></div>
		</div>
';
    break;

}

echo '</div>';


?>