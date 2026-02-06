<?php
// You may comment this out IF you're sure the function exists.
require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
remove_all_filters('plugins_api');
$plugins_allowedtags = array(
			'a'       => array(
				'href'   => array(),
				'title'  => array(),
				'target' => array(),
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


// Chatway Plugins
$args = [
    'slug'   => 'chatway-live-chat',
    'fields' => [
        'short_description' => true,
        'icons'             => true,
        'reviews'           => false,
// excludes all reviews
    ],
];
$data = plugins_api('plugin_information', $args);

$chatway_plugin = array();
if ($data && ! is_wp_error($data)) {
    $chatway_plugin['chatway']       = $data;
    $chatway_plugin['chatway']->name = 'Free Live Chat: Chatway';
    $chatway_plugin['chatway']->short_description = 'Live chat with your website’s visitors through your WordPress website. Chatway includes unlimited chats, iOS & Android mobile apps, team collaboration, saved replies, integrations, and more.';
}
?>
<style>
	.recommended-chatway-plugin-content {
		display: flex;
		gap: 32px;
	}
	.plugin-card.plugin-card-chatway-live-chat {
		width: 100% !important;
	}
 
	.recommended-chatway-plugin-container {
		max-width: 1200px;
		margin: 0 auto; 
		background-color: #FFFFFF;
		border-radius: 12px;
		margin-top: 32px;
	}
	.recommended-chatway-plugin-content > div {
		width: 50% !important;
	}
	.recommended-chatway-plugin-header h2 {
		padding: 32px 28px;
		border-bottom: 1px solid #ddd;
		color: #49687E;  
		font-size: 24px; 
		font-weight: 600;
		line-height: 100%;
        margin: 0 !important;
	}
	.recommended-chatway-plugin-content {
		padding: 28px;
	}
		
	.recommended-chatway-plugin-content-inner h3 {
		color: var(--Main-text, #092030);  
		font-size: 20px; 
		font-weight: 700;
		line-height: 100%;
		margin-top: 0;
	}
	.recommended-chatway-plugin-content-inner p {
		color: var(--Grey-2, #49687E);  
		font-size: 16px; 
		font-weight: 400;
		line-height: 137%;
	}
	.recommended-chatway-plugin-content-inner ul li {
		display: flex;
		color: var(--Grey-2, #49687E);
		gap: 8px;
		align-items: start;
		margin: 0;
		font-size: 14px;
		font-weight: 400;
		line-height: normal;
		justify-content: start;
		flex-direction: row;
		flex-wrap: wrap;
		margin-bottom: 14px;
	}
	.recommended-chatway-plugin-content-inner ul li span {
		width: calc(100% - 60px);
	}
    @media (max-width: 782px) {
        .recommended-chatway-plugin-content{
            flex-direction: column;
        }
        .recommended-chatway-plugin-content > div {
            width: 100% !important;
        }
    }
    @media (max-width: 380px) {
        .recommended-chatway-plugin-content {
            padding: 8px;
        }
    }
</style>
<div class="wrap mystickyelement-wrap recommended-plugins-wrapper">
	<div class="recommended-chatway-plugin-container">
		<div class="recommended-chatway-plugin-header">
			<h2>
				<?php _e('Install Chatway Live Chat', 'mystickyelements'); ?>				
			</h2>
		</div>
		<div class="recommended-chatway-plugin-content">  
			<div class="wp-list-table widefat plugin-install">
				<div class="the-list">
					<?php
					foreach ( (array) $chatway_plugin as $plugin ) {
						if ( is_object( $plugin ) ) {
							$plugin = (array) $plugin;
						}

						// Display the group heading if there is one.
						if ( isset( $plugin['group'] ) && $plugin['group'] != $group ) {
							if ( isset( $this->groups[ $plugin['group'] ] ) ) {
								$group_name = $this->groups[ $plugin['group'] ];
								if ( isset( $plugins_group_titles[ $group_name ] ) ) {
									$group_name = $plugins_group_titles[ $group_name ];
								}
							} else {
								$group_name = $plugin['group'];
							}

							// Starting a new group, close off the divs of the last one.
							if ( ! empty( $group ) ) {
								echo '</div></div>';
							}

							echo '<div class="plugin-group"><h3>' . esc_html( $group_name ) . '</h3>';
							// Needs an extra wrapping div for nth-child selectors to work.
							echo '<div class="plugin-items">';

							$group = $plugin['group'];
						}
						$title = wp_kses( $plugin['name'], $plugins_allowedtags );

						// Remove any HTML from the description.
						$description = strip_tags( $plugin['short_description'] );
						$version     = wp_kses( $plugin['version'], $plugins_allowedtags );

						$name = strip_tags( $title . ' ' . $version );

						$author = wp_kses( $plugin['author'], $plugins_allowedtags );
						if ( ! empty( $author ) ) {
							/* translators: %s: Plugin author. */
							$author = ' <cite>' . sprintf( __( 'By %s', 'mystickyelements' ), $author ) . '</cite>';
						}

						$requires_php = isset( $plugin['requires_php'] ) ? $plugin['requires_php'] : null;
						$requires_wp  = isset( $plugin['requires'] ) ? $plugin['requires'] : null;

						$compatible_php = is_php_version_compatible( $requires_php );
						$compatible_wp  = is_wp_version_compatible( $requires_wp );
						$tested_wp      = ( empty( $plugin['tested'] ) || version_compare( get_bloginfo( 'version' ), $plugin['tested'], '<=' ) );

						$action_links = array();

						if ( current_user_can( 'install_plugins' ) || current_user_can( 'update_plugins' ) ) {
							$status = install_plugin_install_status( $plugin );

							switch ( $status['status'] ) {
								case 'install':
									if ( $status['url'] ) {
										if ( $compatible_php && $compatible_wp ) {
											$action_links[] = sprintf(
												'<a class="install-now button" data-slug="%s" href="%s" aria-label="%s" data-name="%s">%s</a>',
												esc_attr( $plugin['slug'] ),
												esc_url( $status['url'] ),
												/* translators: %s: Plugin name and version. */
												esc_attr( sprintf( _x( 'Install %s now', 'plugin' , 'mystickyelements'), $name ) ),
												esc_attr( $name ),
												__( 'Install Now' , 'mystickyelements')
											);
										} else {
											$action_links[] = sprintf(
												'<button type="button" class="button button-disabled" disabled="disabled">%s</button>',
												_x( 'Cannot Install', 'plugin', 'mystickyelements' )
											);
										}
									}
									break;

								case 'update_available':
									if ( $status['url'] ) {
										if ( $compatible_php && $compatible_wp ) {
											$action_links[] = sprintf(
												'<a class="update-now button aria-button-if-js" data-plugin="%s" data-slug="%s" href="%s" aria-label="%s" data-name="%s">%s</a>',
												esc_attr( $status['file'] ),
												esc_attr( $plugin['slug'] ),
												esc_url( $status['url'] ),
												/* translators: %s: Plugin name and version. */
												esc_attr( sprintf( _x( 'Update %s now', 'plugin', 'mystickyelements' ), $name ) ),
												esc_attr( $name ),
												__( 'Update Now', 'mystickyelements' )
											);
										} else {
											$action_links[] = sprintf(
												'<button type="button" class="button button-disabled" disabled="disabled">%s</button>',
												_x( 'Cannot Update', 'plugin', 'mystickyelements' )
											);
										}
									}
									break;

								case 'latest_installed':
								case 'newer_installed':
									if ( is_plugin_active( $status['file'] ) ) {
										$action_links[] = sprintf(
											'<button type="button" class="button button-disabled" disabled="disabled">%s</button>',
											_x( 'Active', 'plugin', 'mystickyelements' )
										);
									} elseif ( current_user_can( 'activate_plugin', $status['file'] ) ) {
										$button_text = __( 'Activate', 'mystickyelements' );
										/* translators: %s: Plugin name. */
										$button_label = _x( 'Activate %s', 'plugin', 'mystickyelements' );
										$activate_url = add_query_arg(
											array(
												'_wpnonce' => wp_create_nonce( 'activate-plugin_' . $status['file'] ),
												'action'   => 'activate',
												'plugin'   => $status['file'],
											),
											network_admin_url( 'plugins.php' )
										);

										if ( is_network_admin() ) {
											$button_text = __( 'Network Activate', 'mystickyelements' );
											/* translators: %s: Plugin name. */
											$button_label = _x( 'Network Activate %s', 'plugin', 'mystickyelements' );
											$activate_url = add_query_arg( array( 'networkwide' => 1 ), $activate_url );
										}

										$action_links[] = sprintf(
											'<a href="%1$s" class="button activate-now" aria-label="%2$s">%3$s</a>',
											esc_url( $activate_url ),
											esc_attr( sprintf( $button_label, $plugin['name'] ) ),
											$button_text
										);
									} else {
										$action_links[] = sprintf(
											'<button type="button" class="button button-disabled" disabled="disabled">%s</button>',
											_x( 'Installed', 'plugin', 'mystickyelements' )
										);
									}
									break;
							}
						}

						$details_link = self_admin_url(
							'plugin-install.php?tab=plugin-information&amp;plugin=' . $plugin['slug'] .
							'&amp;TB_iframe=true&amp;width=600&amp;height=550'
						);

						$action_links[] = sprintf(
							'<a href="%s" class="thickbox open-plugin-details-modal" aria-label="%s" data-title="%s">%s</a>',
							esc_url( $details_link ),
							/* translators: %s: Plugin name and version. */
							esc_attr( sprintf( __( 'More information about %s', 'mystickyelements' ), $name ) ),
							esc_attr( $name ),
							__( 'More Details', 'mystickyelements' )
						);

						if ( ! empty( $plugin['icons']['svg'] ) ) {
							$plugin_icon_url = $plugin['icons']['svg'];
						} elseif ( ! empty( $plugin['icons']['2x'] ) ) {
							$plugin_icon_url = $plugin['icons']['2x'];
						} elseif ( ! empty( $plugin['icons']['1x'] ) ) {
							$plugin_icon_url = $plugin['icons']['1x'];
						} else {
							$plugin_icon_url = $plugin['icons']['default'];
						}

						/**
						 * Filters the install action links for a plugin.
						 *
						 * @since 2.7.0
						 *
						 * @param string[] $action_links An array of plugin action links. Defaults are links to Details and Install Now.
						 * @param array    $plugin       The plugin currently being listed.
						 */
						$action_links = apply_filters( 'plugin_install_action_links', $action_links, $plugin );

						$last_updated_timestamp = strtotime( $plugin['last_updated'] );
						?>
					<div class="plugin-card plugin-card-<?php echo sanitize_html_class( $plugin['slug'] ); ?>">
						<?php
						if ( ! $compatible_php || ! $compatible_wp ) {
							echo '<div class="notice inline notice-error notice-alt"><p>';
							if ( ! $compatible_php && ! $compatible_wp ) {
								_e( 'This plugin doesn&#8217;t work with your versions of WordPress and PHP.', 'mystickyelements' );
								if ( current_user_can( 'update_core' ) && current_user_can( 'update_php' ) ) {
									printf(
										/* translators: 1: URL to WordPress Updates screen, 2: URL to Update PHP page. */
										' ' . __( '<a href="%1$s">Please update WordPress</a>, and then <a href="%2$s">learn more about updating PHP</a>.', 'mystickyelements' ),
										self_admin_url( 'update-core.php' ),
										esc_url( wp_get_update_php_url() )
									);
									wp_update_php_annotation( '</p><p><em>', '</em>' );
								} elseif ( current_user_can( 'update_core' ) ) {
									printf(
										/* translators: %s: URL to WordPress Updates screen. */
										' ' . __( '<a href="%s">Please update WordPress</a>.', 'mystickyelements' ),
										self_admin_url( 'update-core.php' )
									);
								} elseif ( current_user_can( 'update_php' ) ) {
									printf(
										/* translators: %s: URL to Update PHP page. */
										' ' . __( '<a href="%s">Learn more about updating PHP</a>.', 'mystickyelements' ),
										esc_url( wp_get_update_php_url() )
									);
									wp_update_php_annotation( '</p><p><em>', '</em>' );
								}
							} elseif ( ! $compatible_wp ) {
								_e( 'This plugin doesn&#8217;t work with your version of WordPress.', 'mystickyelements' );
								if ( current_user_can( 'update_core' ) ) {
									printf(
										/* translators: %s: URL to WordPress Updates screen. */
										' ' . __( '<a href="%s">Please update WordPress</a>.', 'mystickyelements' ),
										self_admin_url( 'update-core.php' )
									);
								}
							} elseif ( ! $compatible_php ) {
								_e( 'This plugin doesn&#8217;t work with your version of PHP.', 'mystickyelements' );
								if ( current_user_can( 'update_php' ) ) {
									printf(
										/* translators: %s: URL to Update PHP page. */
										' ' . __( '<a href="%s">Learn more about updating PHP</a>.', 'mystickyelements' ),
										esc_url( wp_get_update_php_url() )
									);
									wp_update_php_annotation( '</p><p><em>', '</em>' );
								}
							}
							echo '</p></div>';
						}
						?>
						<div class="plugin-card-top">
							<div class="name column-name">
								<h3>
									<a href="<?php echo esc_url( $details_link ); ?>" class="thickbox open-plugin-details-modal">
									<?php echo wp_kses($title, $plugins_allowedtags); ?>
									<img src="<?php echo esc_attr( $plugin_icon_url ); ?>" class="plugin-icon" alt="" />
									</a>
								</h3>
							</div>
							<div class="action-links">
								<?php
								if ( $action_links ) {
									echo '<ul class="plugin-action-buttons"><li>' . implode( '</li><li>', $action_links ) . '</li></ul>';
								}
								?>
							</div>
							<div class="desc column-description">
								<p><?php echo wp_kses($description, $plugins_allowedtags); ?></p>
								<p class="authors"><?php echo wp_kses($author, $plugins_allowedtags); ?></p>
							</div>
						</div>
						<div class="plugin-card-bottom">
							<div class="vers column-rating">
								<?php
								wp_star_rating(
									array(
										'rating' => $plugin['rating'],
										'type'   => 'percent',
										'number' => $plugin['num_ratings'],
									)
								);
								?>
								<span class="num-ratings" aria-hidden="true">(<?php echo number_format_i18n( $plugin['num_ratings'] ); ?>)</span>
							</div>
							<div class="column-updated">
								<strong><?php _e( 'Last Updated:', 'mystickyelements' ); ?></strong>
								<?php
									/* translators: %s: Human-readable time difference. */
									printf( __( '%s ago', 'mystickyelements' ), human_time_diff( $last_updated_timestamp ) );
								?>
							</div>
							<div class="column-downloaded">
								<?php
								if ( $plugin['active_installs'] >= 1000000 ) {
									$active_installs_millions = floor( $plugin['active_installs'] / 1000000 );
									$active_installs_text     = sprintf(
										/* translators: %s: Number of millions. */
										_nx( '%s+ Million', '%s+ Million', $active_installs_millions, 'Active plugin installations', 'mystickyelements' ),
										number_format_i18n( $active_installs_millions )
									);
								} elseif ( 0 == $plugin['active_installs'] ) {
									$active_installs_text = _x( 'Less Than 10', 'Active plugin installations', 'mystickyelements' );
								} else {
									$active_installs_text = number_format_i18n( $plugin['active_installs'] ) . '+';
								}
								/* translators: %s: Number of installations. */
								printf( __( '%s Active Installations', 'mystickyelements' ), $active_installs_text );
								?>
							</div>
							<div class="column-compatibility">
								<?php
								if ( ! $tested_wp ) {
									echo '<span class="compatibility-untested">' . __( 'Untested with your version of WordPress', 'mystickyelements' ) . '</span>';
								} elseif ( ! $compatible_wp ) {
									echo '<span class="compatibility-incompatible">' . __( '<strong>Incompatible</strong> with your version of WordPress', 'mystickyelements' ) . '</span>';
								} else {
									echo '<span class="compatibility-compatible">' . __( '<strong>Compatible</strong> with your version of WordPress', 'mystickyelements' ) . '</span>';
								}
								?>
							</div>
						</div>
					</div>
					<?php
				} ?>
				</div>
			</div>	
			<div class="recommended-chatway-plugin-content-inner">
				<h3><?php esc_html_e('Connect effortlessly with customers through Live Chat!','mystickyelements'); ?></h3>
				<p><?php esc_html_e('Add the Chatway Live Chat widget to your website and effectively communicate with visitors with features such as:','mystickyelements'); ?></p>
				<?php
				 $chatway_feature = [
					esc_html__("Handle chats from your website, email, Facebook Messenger & Instagram in one place.", "mystickyelements"),
					esc_html__("Integrate with WooCommerce and create separate widgets and inboxes for multiple websites.", "mystickyelements"),
					esc_html__("Customize your widget, add FAQs, set up automated messages and canned responses to reply faster, and collaborate effortlessly with your team with notes and reminders.", "mystickyelements"),
					esc_html__("Access live visitor details, multilingual support, and unlimited conversations.", "mystickyelements"),
					esc_html__("Stay connected anywhere with Chatway’s iOS and Android apps.", "mystickyelements"),
				 ]
				?>
				<ul>
					<?php foreach($chatway_feature as $feature) { ?>
						<li> 
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect width="24" height="24" rx="12" fill="#27B836" fill-opacity="0.16"/>
								<path d="M17.3346 8L10.0013 15.3333L6.66797 12" stroke="#27B836" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
							<span><?php echo esc_html($feature); ?></span>
						</li> 
					<?php } ?>
				</ul>
			</div>  
		</div> 
	</div> 
</div>
