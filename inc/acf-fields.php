<?php
/**
 * Local ACF field definitions.
 *
 * Keeping this definition in the theme makes the page builder portable and
 * reviewable in version control. ACF JSON is enabled for administrator edits.
 *
 * @package PlayTVX
 */

defined( 'ABSPATH' ) || exit;

/**
 * Return a reusable ACF link field definition.
 *
 * @param string $key Field key.
 * @param string $label Field label.
 * @return array<string, mixed>
 */
function ptvx_acf_link_field( $key, $label ) {
	return array(
		'key'          => $key,
		'label'        => $label,
		'name'         => str_replace( '-', '_', sanitize_title( $label ) ),
		'type'         => 'link',
		'return_format' => 'array',
	);
}

/**
 * Register the child theme's local ACF groups.
 *
 * The named function also enables non-persistent WP-CLI validation before the
 * child theme is activated.
 *
 * @return void
 */
function ptvx_register_acf_fields() {
		if ( ! function_exists( 'acf_add_local_field_group' ) ) {
			return;
		}

		acf_add_options_page(
			array(
				'page_title' => __( 'PlayTVX Settings', 'playtvx' ),
				'menu_title' => __( 'PlayTVX Settings', 'playtvx' ),
				'menu_slug'  => 'playtvx-settings',
				'capability' => 'manage_options',
				'redirect'   => false,
			)
		);

		acf_add_local_field_group(
			array(
				'key'                   => 'group_ptvx_site_settings',
				'title'                 => __( 'PlayTVX Settings', 'playtvx' ),
				'fields'                => array(
					array(
						'key'   => 'field_ptvx_settings_brand_tab',
						'label' => __( 'Brand', 'playtvx' ),
						'type'  => 'tab',
					),
					array(
						'key'           => 'field_ptvx_logo',
						'label'         => __( 'Logo', 'playtvx' ),
						'name'          => 'logo',
						'type'          => 'image',
						'return_format' => 'id',
						'preview_size'  => 'medium',
					),
					array(
						'key'           => 'field_ptvx_site_tagline',
						'label'         => __( 'Tagline', 'playtvx' ),
						'name'          => 'site_tagline',
						'type'          => 'text',
					),
					array(
						'key'           => 'field_ptvx_legal_hero_background',
						'label'         => __( 'Legal page hero background', 'playtvx' ),
						'name'          => 'legal_hero_background',
						'type'          => 'image',
						'return_format' => 'id',
						'preview_size'  => 'medium',
					),
					array(
						'key'   => 'field_ptvx_settings_header_tab',
						'label' => __( 'Header and announcement', 'playtvx' ),
						'type'  => 'tab',
					),
					array( 'key' => 'field_ptvx_announcement_messages', 'label' => __( 'Announcement messages', 'playtvx' ), 'name' => 'announcement_messages', 'type' => 'textarea', 'rows' => 4, 'instructions' => __( 'One message per line. The ticker repeats these messages automatically.', 'playtvx' ) ),
					array( 'key' => 'field_ptvx_header_cta_label', 'label' => __( 'Header CTA label', 'playtvx' ), 'name' => 'header_cta_label', 'type' => 'text', 'default_value' => __( 'Subscribe Now', 'playtvx' ) ),
					array( 'key' => 'field_ptvx_header_cta_offer', 'label' => __( 'Header central offer', 'playtvx' ), 'name' => 'header_cta_offer', 'type' => 'select', 'choices' => array( 'trial' => __( 'Trial', 'playtvx' ), 'monthly' => __( 'Monthly', 'playtvx' ), 'six_month' => __( '6 months', 'playtvx' ), 'yearly' => __( 'Yearly', 'playtvx' ), 'twenty_four_month' => __( '24 months', 'playtvx' ) ), 'default_value' => 'yearly' ),
					array(
						'key'   => 'field_ptvx_settings_sales_tab',
						'label' => __( 'Sales links', 'playtvx' ),
						'type'  => 'tab',
					),
					array( 'key' => 'field_ptvx_trial_link', 'label' => __( 'Trial link', 'playtvx' ), 'name' => 'trial_link', 'type' => 'url' ),
					array( 'key' => 'field_ptvx_monthly_link', 'label' => __( 'Monthly plan link', 'playtvx' ), 'name' => 'monthly_link', 'type' => 'url' ),
					array( 'key' => 'field_ptvx_six_month_link', 'label' => __( '6-month plan link', 'playtvx' ), 'name' => 'six_month_link', 'type' => 'url' ),
					array( 'key' => 'field_ptvx_yearly_link', 'label' => __( 'Yearly plan link', 'playtvx' ), 'name' => 'yearly_link', 'type' => 'url' ),
					array( 'key' => 'field_ptvx_twenty_four_month_link', 'label' => __( '24-month plan link', 'playtvx' ), 'name' => 'twenty_four_month_link', 'type' => 'url' ),
					array(
						'key'   => 'field_ptvx_settings_contact_tab',
						'label' => __( 'Contact and social', 'playtvx' ),
						'type'  => 'tab',
					),
					array( 'key' => 'field_ptvx_support_email', 'label' => __( 'Support email', 'playtvx' ), 'name' => 'support_email', 'type' => 'email' ),
					array( 'key' => 'field_ptvx_whatsapp_link', 'label' => __( 'WhatsApp link', 'playtvx' ), 'name' => 'whatsapp_link', 'type' => 'url' ),
					array( 'key' => 'field_ptvx_facebook_link', 'label' => __( 'Facebook link', 'playtvx' ), 'name' => 'facebook_link', 'type' => 'url' ),
					array( 'key' => 'field_ptvx_instagram_link', 'label' => __( 'Instagram link', 'playtvx' ), 'name' => 'instagram_link', 'type' => 'url' ),
					array(
						'key'   => 'field_ptvx_settings_footer_tab',
						'label' => __( 'Footer', 'playtvx' ),
						'type'  => 'tab',
					),
					array( 'key' => 'field_ptvx_footer_summary', 'label' => __( 'Footer summary', 'playtvx' ), 'name' => 'footer_summary', 'type' => 'textarea', 'rows' => 4 ),
				),
				'location'              => array(
					array(
						array(
							'param'    => 'options_page',
							'operator' => '==',
							'value'    => 'playtvx-settings',
						),
					),
				),
				'position'              => 'normal',
				'style'                 => 'seamless',
				'active'                => true,
				'show_in_rest'          => 0,
			)
		);

		acf_add_local_field_group(
			array(
				'key'                   => 'group_ptvx_page_sections',
				'title'                 => __( 'Page sections', 'playtvx' ),
				'fields'                => array(
					array(
						'key'          => 'field_ptvx_page_sections',
						'label'        => __( 'Page sections', 'playtvx' ),
						'name'         => 'page_sections',
						'type'         => 'flexible_content',
						'button_label' => __( 'Add section', 'playtvx' ),
						'layouts'      => array(
							'layout_ptvx_hero' => array(
								'key'        => 'layout_ptvx_hero',
								'name'       => 'hero',
								'label'      => __( 'Hero', 'playtvx' ),
								'sub_fields' => array(
									array( 'key' => 'field_ptvx_hero_eyebrow', 'label' => __( 'Eyebrow', 'playtvx' ), 'name' => 'eyebrow', 'type' => 'text' ),
									array( 'key' => 'field_ptvx_hero_heading', 'label' => __( 'Heading', 'playtvx' ), 'name' => 'heading', 'type' => 'text', 'required' => 1 ),
									array( 'key' => 'field_ptvx_hero_text', 'label' => __( 'Text', 'playtvx' ), 'name' => 'text', 'type' => 'textarea', 'rows' => 4 ),
									array( 'key' => 'field_ptvx_hero_background_image', 'label' => __( 'Background image', 'playtvx' ), 'name' => 'background_image', 'type' => 'image', 'return_format' => 'id', 'preview_size' => 'medium' ),
									array( 'key' => 'field_ptvx_hero_payment_badges', 'label' => __( 'Payment badges', 'playtvx' ), 'name' => 'payment_badges', 'type' => 'gallery', 'return_format' => 'id', 'preview_size' => 'thumbnail' ),
									array( 'key' => 'field_ptvx_hero_trust_points', 'label' => __( 'Trust points', 'playtvx' ), 'name' => 'trust_points', 'type' => 'textarea', 'rows' => 4, 'instructions' => __( 'One point per line.', 'playtvx' ) ),
									array(
										'key'        => 'field_ptvx_hero_stats',
										'label'      => __( 'Stats', 'playtvx' ),
										'name'       => 'stats',
										'type'       => 'repeater',
										'layout'     => 'table',
										'sub_fields' => array(
											array( 'key' => 'field_ptvx_hero_stat_value', 'label' => __( 'Value', 'playtvx' ), 'name' => 'value', 'type' => 'text' ),
											array( 'key' => 'field_ptvx_hero_stat_label', 'label' => __( 'Label', 'playtvx' ), 'name' => 'label', 'type' => 'text' ),
										),
									),
									array( 'key' => 'field_ptvx_hero_primary_offer', 'label' => __( 'Primary offer', 'playtvx' ), 'name' => 'primary_offer', 'type' => 'select', 'choices' => array( 'trial' => __( 'Trial', 'playtvx' ), 'monthly' => __( 'Monthly', 'playtvx' ), 'six_month' => __( '6 months', 'playtvx' ), 'yearly' => __( 'Yearly', 'playtvx' ), 'twenty_four_month' => __( '24 months', 'playtvx' ) ), 'default_value' => 'yearly', 'allow_null' => 1 ),
									array( 'key' => 'field_ptvx_hero_primary_label', 'label' => __( 'Primary CTA label', 'playtvx' ), 'name' => 'primary_label', 'type' => 'text' ),
									ptvx_acf_link_field( 'field_ptvx_hero_primary_link', __( 'Primary CTA', 'playtvx' ) ),
									array( 'key' => 'field_ptvx_hero_secondary_offer', 'label' => __( 'Secondary offer', 'playtvx' ), 'name' => 'secondary_offer', 'type' => 'select', 'choices' => array( 'trial' => __( 'Trial', 'playtvx' ), 'monthly' => __( 'Monthly', 'playtvx' ), 'six_month' => __( '6 months', 'playtvx' ), 'yearly' => __( 'Yearly', 'playtvx' ), 'twenty_four_month' => __( '24 months', 'playtvx' ) ), 'allow_null' => 1 ),
									array( 'key' => 'field_ptvx_hero_secondary_label', 'label' => __( 'Secondary CTA label', 'playtvx' ), 'name' => 'secondary_label', 'type' => 'text' ),
									ptvx_acf_link_field( 'field_ptvx_hero_secondary_link', __( 'Secondary CTA', 'playtvx' ) ),
									array( 'key' => 'field_ptvx_hero_image', 'label' => __( 'Image', 'playtvx' ), 'name' => 'image', 'type' => 'image', 'return_format' => 'id', 'preview_size' => 'medium' ),
								),
							),
							'layout_ptvx_rich_text' => array(
								'key'        => 'layout_ptvx_rich_text',
								'name'       => 'rich_text',
								'label'      => __( 'Rich text', 'playtvx' ),
								'sub_fields' => array(
									array( 'key' => 'field_ptvx_rich_text_heading', 'label' => __( 'Heading', 'playtvx' ), 'name' => 'heading', 'type' => 'text' ),
									array( 'key' => 'field_ptvx_rich_text_content', 'label' => __( 'Content', 'playtvx' ), 'name' => 'content', 'type' => 'wysiwyg', 'tabs' => 'visual', 'media_upload' => 0 ),
									ptvx_acf_link_field( 'field_ptvx_rich_text_link', __( 'CTA', 'playtvx' ) ),
								),
							),
							'layout_ptvx_feature_grid' => array(
								'key'        => 'layout_ptvx_feature_grid',
								'name'       => 'feature_grid',
								'label'      => __( 'Feature grid', 'playtvx' ),
								'sub_fields' => array(
									array( 'key' => 'field_ptvx_feature_grid_heading', 'label' => __( 'Heading', 'playtvx' ), 'name' => 'heading', 'type' => 'text' ),
									array( 'key' => 'field_ptvx_feature_grid_intro', 'label' => __( 'Introduction', 'playtvx' ), 'name' => 'intro', 'type' => 'textarea', 'rows' => 3 ),
									array(
										'key'        => 'field_ptvx_feature_grid_items',
										'label'      => __( 'Features', 'playtvx' ),
										'name'       => 'items',
										'type'       => 'repeater',
										'layout'     => 'block',
										'sub_fields' => array(
											array( 'key' => 'field_ptvx_feature_grid_item_title', 'label' => __( 'Title', 'playtvx' ), 'name' => 'title', 'type' => 'text', 'required' => 1 ),
											array( 'key' => 'field_ptvx_feature_grid_item_text', 'label' => __( 'Text', 'playtvx' ), 'name' => 'text', 'type' => 'textarea', 'rows' => 3 ),
											array( 'key' => 'field_ptvx_feature_grid_item_icon', 'label' => __( 'Icon/image', 'playtvx' ), 'name' => 'icon', 'type' => 'image', 'return_format' => 'id', 'preview_size' => 'thumbnail' ),
										),
									),
								),
							),
							'layout_ptvx_plans' => array(
								'key'        => 'layout_ptvx_plans',
								'name'       => 'plans',
								'label'      => __( 'Plans', 'playtvx' ),
								'sub_fields' => array(
									array( 'key' => 'field_ptvx_plans_heading', 'label' => __( 'Heading', 'playtvx' ), 'name' => 'heading', 'type' => 'text' ),
									array( 'key' => 'field_ptvx_plans_intro', 'label' => __( 'Introduction', 'playtvx' ), 'name' => 'intro', 'type' => 'textarea', 'rows' => 3 ),
									array(
										'key'        => 'field_ptvx_plans_items',
										'label'      => __( 'Plans', 'playtvx' ),
										'name'       => 'items',
										'type'       => 'repeater',
										'layout'     => 'block',
										'sub_fields' => array(
											array( 'key' => 'field_ptvx_plan_name', 'label' => __( 'Name', 'playtvx' ), 'name' => 'name', 'type' => 'text', 'required' => 1 ),
											array( 'key' => 'field_ptvx_plan_duration', 'label' => __( 'Duration', 'playtvx' ), 'name' => 'duration', 'type' => 'text' ),
											array( 'key' => 'field_ptvx_plan_price', 'label' => __( 'Price', 'playtvx' ), 'name' => 'price', 'type' => 'text' ),
											array( 'key' => 'field_ptvx_plan_highlighted', 'label' => __( 'Highlight this plan', 'playtvx' ), 'name' => 'highlighted', 'type' => 'true_false', 'ui' => 1 ),
											array( 'key' => 'field_ptvx_plan_features', 'label' => __( 'Features', 'playtvx' ), 'name' => 'features', 'type' => 'textarea', 'rows' => 6, 'instructions' => __( 'One feature per line.', 'playtvx' ) ),
											array( 'key' => 'field_ptvx_plan_offer', 'label' => __( 'Central offer', 'playtvx' ), 'name' => 'offer', 'type' => 'select', 'choices' => array( 'trial' => __( 'Trial', 'playtvx' ), 'monthly' => __( 'Monthly', 'playtvx' ), 'six_month' => __( '6 months', 'playtvx' ), 'yearly' => __( 'Yearly', 'playtvx' ), 'twenty_four_month' => __( '24 months', 'playtvx' ) ), 'allow_null' => 1 ),
											array( 'key' => 'field_ptvx_plan_cta_label', 'label' => __( 'CTA label', 'playtvx' ), 'name' => 'cta_label', 'type' => 'text' ),
											ptvx_acf_link_field( 'field_ptvx_plan_link', __( 'Plan CTA', 'playtvx' ) ),
										),
									),
								),
							),
							'layout_ptvx_comparison' => array(
								'key'        => 'layout_ptvx_comparison',
								'name'       => 'comparison',
								'label'      => __( 'Comparison table', 'playtvx' ),
								'sub_fields' => array(
									array( 'key' => 'field_ptvx_comparison_heading', 'label' => __( 'Heading', 'playtvx' ), 'name' => 'heading', 'type' => 'text' ),
									array( 'key' => 'field_ptvx_comparison_intro', 'label' => __( 'Introduction', 'playtvx' ), 'name' => 'intro', 'type' => 'textarea', 'rows' => 3 ),
									array( 'key' => 'field_ptvx_comparison_columns', 'label' => __( 'Column headings', 'playtvx' ), 'name' => 'columns', 'type' => 'text', 'instructions' => __( 'Separate headings with a pipe: Feature | Cable | Streaming | PlayTVX', 'playtvx' ) ),
									array( 'key' => 'field_ptvx_comparison_rows', 'label' => __( 'Rows', 'playtvx' ), 'name' => 'rows', 'type' => 'textarea', 'rows' => 8, 'instructions' => __( 'One row per line; separate cells with a pipe.', 'playtvx' ) ),
									array( 'key' => 'field_ptvx_comparison_offer', 'label' => __( 'Central offer', 'playtvx' ), 'name' => 'offer', 'type' => 'select', 'choices' => array( 'trial' => __( 'Trial', 'playtvx' ), 'monthly' => __( 'Monthly', 'playtvx' ), 'six_month' => __( '6 months', 'playtvx' ), 'yearly' => __( 'Yearly', 'playtvx' ), 'twenty_four_month' => __( '24 months', 'playtvx' ) ), 'default_value' => 'yearly', 'allow_null' => 1 ),
									array( 'key' => 'field_ptvx_comparison_cta_label', 'label' => __( 'CTA label', 'playtvx' ), 'name' => 'cta_label', 'type' => 'text', 'default_value' => __( '12 Months Subscription', 'playtvx' ) ),
								),
							),
							'layout_ptvx_steps' => array(
								'key'        => 'layout_ptvx_steps',
								'name'       => 'steps',
								'label'      => __( 'Steps', 'playtvx' ),
								'sub_fields' => array(
									array( 'key' => 'field_ptvx_steps_heading', 'label' => __( 'Heading', 'playtvx' ), 'name' => 'heading', 'type' => 'text' ),
									array( 'key' => 'field_ptvx_steps_intro', 'label' => __( 'Introduction', 'playtvx' ), 'name' => 'intro', 'type' => 'textarea', 'rows' => 3 ),
									array(
										'key'        => 'field_ptvx_steps_items',
										'label'      => __( 'Steps', 'playtvx' ),
										'name'       => 'items',
										'type'       => 'repeater',
										'layout'     => 'block',
										'sub_fields' => array(
											array( 'key' => 'field_ptvx_step_title', 'label' => __( 'Title', 'playtvx' ), 'name' => 'title', 'type' => 'text', 'required' => 1 ),
											array( 'key' => 'field_ptvx_step_text', 'label' => __( 'Text', 'playtvx' ), 'name' => 'text', 'type' => 'textarea', 'rows' => 3 ),
										),
									),
									array( 'key' => 'field_ptvx_steps_offer', 'label' => __( 'Central offer', 'playtvx' ), 'name' => 'offer', 'type' => 'select', 'choices' => array( 'trial' => __( 'Trial', 'playtvx' ), 'monthly' => __( 'Monthly', 'playtvx' ), 'six_month' => __( '6 months', 'playtvx' ), 'yearly' => __( 'Yearly', 'playtvx' ), 'twenty_four_month' => __( '24 months', 'playtvx' ) ), 'allow_null' => 1 ),
									array( 'key' => 'field_ptvx_steps_cta_label', 'label' => __( 'CTA label', 'playtvx' ), 'name' => 'cta_label', 'type' => 'text' ),
									ptvx_acf_link_field( 'field_ptvx_steps_link', __( 'CTA', 'playtvx' ) ),
								),
							),
							'layout_ptvx_devices' => array(
								'key'        => 'layout_ptvx_devices',
								'name'       => 'devices',
								'label'      => __( 'Device grid', 'playtvx' ),
								'sub_fields' => array(
									array( 'key' => 'field_ptvx_devices_heading', 'label' => __( 'Heading', 'playtvx' ), 'name' => 'heading', 'type' => 'text' ),
									array( 'key' => 'field_ptvx_devices_intro', 'label' => __( 'Introduction', 'playtvx' ), 'name' => 'intro', 'type' => 'textarea', 'rows' => 3 ),
									array( 'key' => 'field_ptvx_devices_background_image', 'label' => __( 'Background image', 'playtvx' ), 'name' => 'background_image', 'type' => 'image', 'return_format' => 'id', 'preview_size' => 'medium' ),
									array( 'key' => 'field_ptvx_devices_showcase_image', 'label' => __( 'Device showcase image', 'playtvx' ), 'name' => 'showcase_image', 'type' => 'image', 'return_format' => 'id', 'preview_size' => 'medium' ),
									array( 'key' => 'field_ptvx_devices_platform_logos', 'label' => __( 'Platform logos', 'playtvx' ), 'name' => 'platform_logos', 'type' => 'gallery', 'return_format' => 'id', 'preview_size' => 'medium', 'instructions' => __( 'Choose and order the white platform logos displayed beneath the device showcase.', 'playtvx' ) ),
									array( 'key' => 'field_ptvx_devices_items', 'label' => __( 'Devices', 'playtvx' ), 'name' => 'items', 'type' => 'textarea', 'rows' => 5, 'instructions' => __( 'One device per line.', 'playtvx' ) ),
									array( 'key' => 'field_ptvx_devices_offer', 'label' => __( 'Central offer', 'playtvx' ), 'name' => 'offer', 'type' => 'select', 'choices' => array( 'trial' => __( 'Trial', 'playtvx' ), 'monthly' => __( 'Monthly', 'playtvx' ), 'six_month' => __( '6 months', 'playtvx' ), 'yearly' => __( 'Yearly', 'playtvx' ), 'twenty_four_month' => __( '24 months', 'playtvx' ) ), 'allow_null' => 1 ),
									array( 'key' => 'field_ptvx_devices_cta_label', 'label' => __( 'CTA label', 'playtvx' ), 'name' => 'cta_label', 'type' => 'text' ),
									ptvx_acf_link_field( 'field_ptvx_devices_link', __( 'CTA', 'playtvx' ) ),
								),
							),
							'layout_ptvx_faq' => array(
								'key'        => 'layout_ptvx_faq',
								'name'       => 'faq',
								'label'      => __( 'FAQ', 'playtvx' ),
								'sub_fields' => array(
									array( 'key' => 'field_ptvx_faq_heading', 'label' => __( 'Heading', 'playtvx' ), 'name' => 'heading', 'type' => 'text' ),
									array( 'key' => 'field_ptvx_faq_eyebrow', 'label' => __( 'Eyebrow', 'playtvx' ), 'name' => 'eyebrow', 'type' => 'text' ),
									array(
										'key'        => 'field_ptvx_faq_items',
										'label'      => __( 'Questions', 'playtvx' ),
										'name'       => 'items',
										'type'       => 'repeater',
										'layout'     => 'block',
										'sub_fields' => array(
											array( 'key' => 'field_ptvx_faq_question', 'label' => __( 'Question', 'playtvx' ), 'name' => 'question', 'type' => 'text', 'required' => 1 ),
											array( 'key' => 'field_ptvx_faq_answer', 'label' => __( 'Answer', 'playtvx' ), 'name' => 'answer', 'type' => 'wysiwyg', 'tabs' => 'visual', 'media_upload' => 0 ),
										),
									),
								),
							),
							'layout_ptvx_social_proof' => array(
								'key'        => 'layout_ptvx_social_proof',
								'name'       => 'social_proof',
								'label'      => __( 'Social proof screenshots', 'playtvx' ),
								'sub_fields' => array(
									array( 'key' => 'field_ptvx_social_proof_heading', 'label' => __( 'Heading', 'playtvx' ), 'name' => 'heading', 'type' => 'text' ),
									array( 'key' => 'field_ptvx_social_proof_intro', 'label' => __( 'Introduction', 'playtvx' ), 'name' => 'intro', 'type' => 'textarea', 'rows' => 3 ),
									array(
										'key'        => 'field_ptvx_social_proof_stats',
										'label'      => __( 'Stats', 'playtvx' ),
										'name'       => 'stats',
										'type'       => 'repeater',
										'layout'     => 'table',
										'sub_fields' => array(
											array( 'key' => 'field_ptvx_social_proof_stat_value', 'label' => __( 'Value', 'playtvx' ), 'name' => 'value', 'type' => 'text' ),
											array( 'key' => 'field_ptvx_social_proof_stat_label', 'label' => __( 'Label', 'playtvx' ), 'name' => 'label', 'type' => 'text' ),
										),
									),
									array( 'key' => 'field_ptvx_social_proof_reviews', 'label' => __( 'Review screenshots', 'playtvx' ), 'name' => 'reviews', 'type' => 'gallery', 'return_format' => 'id', 'preview_size' => 'medium' ),
									array( 'key' => 'field_ptvx_social_proof_offer', 'label' => __( 'Central offer', 'playtvx' ), 'name' => 'offer', 'type' => 'select', 'choices' => array( 'trial' => __( 'Trial', 'playtvx' ), 'monthly' => __( 'Monthly', 'playtvx' ), 'six_month' => __( '6 months', 'playtvx' ), 'yearly' => __( 'Yearly', 'playtvx' ), 'twenty_four_month' => __( '24 months', 'playtvx' ) ), 'allow_null' => 1 ),
									array( 'key' => 'field_ptvx_social_proof_cta_label', 'label' => __( 'CTA label', 'playtvx' ), 'name' => 'cta_label', 'type' => 'text' ),
									ptvx_acf_link_field( 'field_ptvx_social_proof_link', __( 'CTA', 'playtvx' ) ),
								),
							),
							'layout_ptvx_split_features' => array(
								'key'        => 'layout_ptvx_split_features',
								'name'       => 'split_features',
								'label'      => __( 'Split feature list', 'playtvx' ),
								'sub_fields' => array(
									array( 'key' => 'field_ptvx_split_features_eyebrow', 'label' => __( 'Eyebrow', 'playtvx' ), 'name' => 'eyebrow', 'type' => 'text' ),
									array( 'key' => 'field_ptvx_split_features_heading', 'label' => __( 'Heading', 'playtvx' ), 'name' => 'heading', 'type' => 'text' ),
									array( 'key' => 'field_ptvx_split_features_intro', 'label' => __( 'Introduction', 'playtvx' ), 'name' => 'intro', 'type' => 'textarea', 'rows' => 4 ),
									array( 'key' => 'field_ptvx_split_features_image', 'label' => __( 'Image', 'playtvx' ), 'name' => 'image', 'type' => 'image', 'return_format' => 'id', 'preview_size' => 'medium' ),
									array(
										'key'        => 'field_ptvx_split_features_items',
										'label'      => __( 'Features', 'playtvx' ),
										'name'       => 'items',
										'type'       => 'repeater',
										'layout'     => 'block',
										'sub_fields' => array(
											array( 'key' => 'field_ptvx_split_feature_title', 'label' => __( 'Title', 'playtvx' ), 'name' => 'title', 'type' => 'text' ),
											array( 'key' => 'field_ptvx_split_feature_text', 'label' => __( 'Text', 'playtvx' ), 'name' => 'text', 'type' => 'textarea', 'rows' => 3 ),
										),
									),
								),
							),
							'layout_ptvx_media_pair' => array(
								'key'        => 'layout_ptvx_media_pair',
								'name'       => 'media_pair',
								'label'      => __( 'Two media feature panels', 'playtvx' ),
								'sub_fields' => array(
									array( 'key' => 'field_ptvx_media_pair_heading', 'label' => __( 'Heading', 'playtvx' ), 'name' => 'heading', 'type' => 'text' ),
									array( 'key' => 'field_ptvx_media_pair_intro', 'label' => __( 'Introduction', 'playtvx' ), 'name' => 'intro', 'type' => 'textarea', 'rows' => 3 ),
									array(
										'key'        => 'field_ptvx_media_pair_items',
										'label'      => __( 'Panels', 'playtvx' ),
										'name'       => 'items',
										'type'       => 'repeater',
										'min'        => 2,
										'max'        => 2,
										'layout'     => 'block',
										'sub_fields' => array(
											array( 'key' => 'field_ptvx_media_pair_item_title', 'label' => __( 'Title', 'playtvx' ), 'name' => 'title', 'type' => 'text' ),
											array( 'key' => 'field_ptvx_media_pair_item_text', 'label' => __( 'Text', 'playtvx' ), 'name' => 'text', 'type' => 'textarea', 'rows' => 3 ),
											array( 'key' => 'field_ptvx_media_pair_item_image', 'label' => __( 'Image', 'playtvx' ), 'name' => 'image', 'type' => 'image', 'return_format' => 'id', 'preview_size' => 'medium' ),
										),
									),
								),
							),
							'layout_ptvx_image_cta' => array(
								'key'        => 'layout_ptvx_image_cta',
								'name'       => 'image_cta',
								'label'      => __( 'Image background CTA', 'playtvx' ),
								'sub_fields' => array(
									array( 'key' => 'field_ptvx_image_cta_heading', 'label' => __( 'Heading', 'playtvx' ), 'name' => 'heading', 'type' => 'text' ),
									array( 'key' => 'field_ptvx_image_cta_text', 'label' => __( 'Text', 'playtvx' ), 'name' => 'text', 'type' => 'textarea', 'rows' => 3 ),
									array( 'key' => 'field_ptvx_image_cta_background_image', 'label' => __( 'Background image', 'playtvx' ), 'name' => 'background_image', 'type' => 'image', 'return_format' => 'id', 'preview_size' => 'medium' ),
									array( 'key' => 'field_ptvx_image_cta_offer', 'label' => __( 'Central offer', 'playtvx' ), 'name' => 'offer', 'type' => 'select', 'choices' => array( 'trial' => __( 'Trial', 'playtvx' ), 'monthly' => __( 'Monthly', 'playtvx' ), 'six_month' => __( '6 months', 'playtvx' ), 'yearly' => __( 'Yearly', 'playtvx' ), 'twenty_four_month' => __( '24 months', 'playtvx' ) ), 'allow_null' => 1 ),
									array( 'key' => 'field_ptvx_image_cta_label', 'label' => __( 'CTA label', 'playtvx' ), 'name' => 'cta_label', 'type' => 'text' ),
									ptvx_acf_link_field( 'field_ptvx_image_cta_link', __( 'CTA', 'playtvx' ) ),
								),
							),
							'layout_ptvx_latest_posts' => array(
								'key'        => 'layout_ptvx_latest_posts',
								'name'       => 'latest_posts',
								'label'      => __( 'Latest posts', 'playtvx' ),
								'sub_fields' => array(
									array( 'key' => 'field_ptvx_latest_posts_heading', 'label' => __( 'Heading', 'playtvx' ), 'name' => 'heading', 'type' => 'text' ),
									array( 'key' => 'field_ptvx_latest_posts_intro', 'label' => __( 'Introduction', 'playtvx' ), 'name' => 'intro', 'type' => 'textarea', 'rows' => 3 ),
									array( 'key' => 'field_ptvx_latest_posts_cta_label', 'label' => __( 'View all label', 'playtvx' ), 'name' => 'cta_label', 'type' => 'text' ),
								),
							),
							'layout_ptvx_cta' => array(
								'key'        => 'layout_ptvx_cta',
								'name'       => 'cta',
								'label'      => __( 'CTA band', 'playtvx' ),
								'sub_fields' => array(
									array( 'key' => 'field_ptvx_cta_theme', 'label' => __( 'Theme', 'playtvx' ), 'name' => 'theme', 'type' => 'button_group', 'choices' => array( 'navy' => __( 'Navy', 'playtvx' ), 'gold' => __( 'Gold', 'playtvx' ), 'light' => __( 'Light', 'playtvx' ) ), 'default_value' => 'navy' ),
									array( 'key' => 'field_ptvx_cta_heading', 'label' => __( 'Heading', 'playtvx' ), 'name' => 'heading', 'type' => 'text', 'required' => 1 ),
									array( 'key' => 'field_ptvx_cta_text', 'label' => __( 'Text', 'playtvx' ), 'name' => 'text', 'type' => 'textarea', 'rows' => 3 ),
									array( 'key' => 'field_ptvx_cta_offer', 'label' => __( 'Central offer', 'playtvx' ), 'name' => 'offer', 'type' => 'select', 'choices' => array( 'trial' => __( 'Trial', 'playtvx' ), 'monthly' => __( 'Monthly', 'playtvx' ), 'six_month' => __( '6 months', 'playtvx' ), 'yearly' => __( 'Yearly', 'playtvx' ), 'twenty_four_month' => __( '24 months', 'playtvx' ) ), 'default_value' => 'yearly', 'allow_null' => 1 ),
									array( 'key' => 'field_ptvx_cta_label', 'label' => __( 'CTA label', 'playtvx' ), 'name' => 'cta_label', 'type' => 'text' ),
									ptvx_acf_link_field( 'field_ptvx_cta_link', __( 'CTA link', 'playtvx' ) ),
								),
							),
						),
					),
				),
				'location'              => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'page',
						),
					),
				),
				'position'              => 'normal',
				'style'                 => 'seamless',
				'active'                => true,
				'show_in_rest'          => 0,
			)
		);
}

add_action( 'acf/init', 'ptvx_register_acf_fields' );
