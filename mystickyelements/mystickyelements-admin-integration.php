<?php
global $wp_version ;
$plugins_allowedtags = array(
    'a'       => array(
        'href'   => array(),
        'title'  => array(),
        'target' => array(),
        'class' => array(),
    ),
    'abbr'    => array( 'title' => array() ),
    'acronym' => array( 'title' => array() ),
    'code'    => array(),
    'pre'     => array(),
    'em'      => array(),
    'strong'  => array(),
    'ul'      => array(),
    'ol'      => array(),
    'li'      => array(),
    'p'       => array(),
    'br'      => array(),
);
?>
<div class="mystickyelement-new-widget-wrap">
    <div class="p-5 w-full">
        <h2 class="text-center mystickyelement-integrate-title-main text-2xl!">
            <?php esc_html_e('Upgrade to Pro and connect your My Sticky Elements form to the following platforms to automatically receive leads', 'mystickyelements'); ?>
        </h2>
        <div class="mystickyelement-new-widget-row">
            <div class="mystickyelement-features">
                <div class="flex flex-col md:flex-row gap-5 w-full">
                    <div class="flex-1 relative mse-pro-rules">
                        <div class="elements-int-container mystickyelement-feature">
                            <div class="mystickyelement-feature-top">
                                <img src="<?php echo MYSTICKYELEMENTS_URL ?>/images/mailchimp.png" />
                            </div>
                            <div class="feature-title">Connect your forms to Mailchimp</div>
                            <div class="feature-description">
                                <p class="text-center">
                                    <a href="#" class="mse-secondary-button small-button main-button whitespace-nowrap">
                                        <?php esc_html_e('Connect', 'mystickyelements'); ?>
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="mse-pro-modal">
                            <?php do_action('mse_pro_button') ?>
                        </div>
                    </div>
                    <div class="flex-1 relative mse-pro-rules">
                        <div class="elements-int-container mystickyelement-feature">
                            <div class="mystickyelement-feature-top">
                                <img src="<?php echo MYSTICKYELEMENTS_URL ?>/images/mailpoet.png" />
                            </div>
                            <div class="feature-title">Connect your forms to MailPoet</div>
                            <div class="feature-description">
                                <p class="text-center">
                                    <a href="#" class="mse-secondary-button small-button main-button whitespace-nowrap">
                                        <?php esc_html_e('Connect', 'mystickyelements'); ?>
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="mse-pro-modal">
                            <?php do_action('mse_pro_button') ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mystickyelement-integration-upgrade-button mt-10">
                <?php do_action('mse_pro_button') ?>
            </div>
        </div>
    </div>
</div>

<style>
*, ::after, ::before {
    box-sizing: border-box;
}
/*New Widget Page css*/
.mystickyelement-new-widget-wrap {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: calc(100vh - 95px);
}
.mystickyelement-features {
	padding-top: 40px;
	max-width: 776px;
	margin: 0 auto;
}
.mystickyelement-new-widget-wrap h2 {
	font-style: normal;
	font-weight: 600;
	font-size: 20px;
	font-size: 20px;
	line-height: 30px;
	color: #1e1e1e;
	margin: 0;
	text-align: center;
}
.mystickyelement-new-widget-wrap h2.mystickyelement-integrate-title-main {
	font-style: normal;
	font-weight: 500;
	font-size: 18px;
	line-height: 1.5;
	color: #1E1E1E;
	margin: 0 auto;
	max-width: 620px;
	position: relative;
	padding-bottom: 30px;
}
.mystickyelement-new-widget-wrap h2.mystickyelement-integrate-title-main:after {
    display: none;
}
.mystickyelement-features ul {
    margin: 0;
    padding: 0;
}
.mystickyelement-features ul li {
    margin: 0;
    width: 50%;
    float: left;
    padding: 10px;
	position: relative;
}
.mystickyelement-feature {
	background: #fff;
	border-radius: 10px;
	padding: 60px 20px 10px 20px;
	height: 100%;
	position: relative;
    border: 1px solid #E3EAEE;
}
.mystickyelement-feature-top {
	width: 73px;
	height: 73px;
	border-radius: 50%;
	position: absolute;
	left: 0;
	right: 0;
	margin: 0 auto;
	top: -25px;
	background: #fff;
	z-index: 2;
	padding: 10px;
	box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.06), 0px 1px 3px rgba(0, 0, 0, 0.1);
}
.feature-title {
	font-style: normal;
	font-weight: 400;
	font-size: 16px;
	line-height: 18px;
	color: #64748B;
	margin-bottom: 15px;
	text-align: center;
}
.mystickyelement-feature.second {
    min-height: 155px;
}
.feature-description {
    font-family: Poppins;
    font-style: normal;
    font-weight: normal;
    font-size: 13px;
    line-height: 18px;
    color: #1E1E1E;
}
a.new-upgrade-button {
    height: 40px;
    background: #605DEC;
    border-radius: 100px;
    border: solid 1px #605DEC;
    display: inline-block;
    text-align: center;
    color: #fff;
    line-height: 40px;
    margin: 10px 0 10px 10px;
    padding: 0 25px;
    text-decoration: none;
    text-transform: uppercase;
}
a.new-demo-button {
    height: 40px;
    color: #605DEC;
    border: solid 1px #605DEC;
    border-radius: 100px;
    display: inline-block;
    text-align: center;
    background: #fff;
    line-height: 40px;
    margin: 10px 0 10px 10px;
    padding: 0 25px;
    text-decoration: none;
    width: 165px;
}
.mystickyelement-feature.analytics {
    min-height: 115px;
}
.mystickyelement-feature-top img {
    width: 100%;
    height: auto;
}

.mystickyelement-features ul li:hover .mystickyelement-integration-button{
	display: block;
}
.mystickyelement-integration-button {
	display: none;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    z-index: 9;
}
.mystickyelement-feature input[type="text"] {
	border: 1px solid #E2E8F0;
	color: #9CA3AF;
	font-size: 12px;
}
.mystickyelement-integration-upgrade-button {
	text-align: center;
}

</style>
