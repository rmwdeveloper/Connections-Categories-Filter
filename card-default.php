<?php
/**
 * @package    Connections Card Default
 * @subpackage Template : Card
 * @author     Robert Westenberger
 * @since      0.7.9
 * @license    GPL-2.0+
 * @link       http://rmwdeveloper@gmail.com
 * 
 */


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
require 'getCategoryBlock.php';
if ( ! class_exists( 'CN_Card_Template' ) ) {

	class CN_Card_Template {

		public static function register() {

			$atts = array(
				'class'       => 'CN_Card_Template',
				'name'        => 'Default Entry Card',
				'slug'        => 'card',
				'type'        => 'all',
				'version'     => '2.0.1',
				'author'      => 'Steven A. Zahm',
				'authorURL'   => 'connections-pro.com',
				'description' => 'This is the default template.',
				'custom'      => FALSE,
				'path'        => plugin_dir_path( __FILE__ ),
				'url'         => plugin_dir_url( __FILE__ ),
				'thumbnail'   => 'thumbnail.png',
				'parts'       => array(),
				);

			cnTemplateFactory::register( $atts );
		}

		public function __construct( $template ) {

			$this->template = $template;

			$template->part( array( 'tag' => 'card', 'type' => 'action', 'callback' => array( __CLASS__, 'card' ) ) );
			$template->part( array( 'tag' => 'card-single', 'type' => 'action', 'callback' => array( __CLASS__, 'card' ) ) );
		}

		public static function card( $entry, $template, $atts ) {

			?>

			<div class="cn-entry" style="-moz-border-radius:4px; border-top-right-radius:20px; border-top-left-radius: 20px;background-color:#FFFFFF; border:1px solid #E3E3E3; color: #000000; margin:8px 0px;  position: relative;">
				<div style="width:100%; float:left; background-color: rgb(100,200,211); height: 150px;">
					<?php $entry->getImage(); ?>
					<!-- <div style="clear:both;"></div> -->
					<div style="margin-bottom: 10px;position: relative; width: 55&#37;;float: right; top: 15px; right: 5px; color:white;">
						<span style="font-size:larger;font-variant: small-caps"><strong><?php echo $entry->getNameBlock(); ?></strong></span>
						<?php //$entry->getTitleBlock(); ?>
						<?php //$entry->getOrgUnitBlock(); ?>
						<?php //$entry->getContactNameBlock(); ?>
						<?php //$entry->getCategoryBlock();?>
						<?php getCategoryBlock($atts = $atts,$entry=$entry); ?>
					</div>

						<?php $entry->getAddressBlock(); ?>
				</div>

				<div align="right">

					<?php $entry->getFamilyMemberBlock(); ?>
					<?php $entry->getPhoneNumberBlock(); ?>
					<?php $entry->getEmailAddressBlock(); ?>
					<?php $entry->getImBlock(); ?>
					<?php $entry->getSocialMediaBlock(); ?>
					<?php $entry->getLinkBlock(); ?>
					<?php $entry->getDateBlock(); ?>

				</div>

				<div style="clear:both"></div>
				<div class="cn-meta" align="left" style="margin-top: 6px">

					<?php $entry->getContentBlock( $atts['content'], $atts, $template ); ?>

					<div style="display: block; margin-bottom: 8px;"><?php $entry->getBioBlock( array( /*'separator' => ', ', 'before' => '<span>', 'after' => '</span>'*/ ) ); ?><?php //$entry->getCategoryBlock( array( /*'separator' => ', ', 'before' => '<span>', 'after' => '</span>'*/ ) ); ?></div>

					<?php if ( cnSettingsAPI::get( 'connections', 'connections_display_entry_actions', 'vcard' ) ) $entry->vcard( array( 'before' => '<span>', 'after' => '</span>' ) ); ?>

					<?php

					cnTemplatePart::updated(
						array(
							'timestamp' => $entry->getUnixTimeStamp(),
							'style' => array(
								'font-size'    => 'x-small',
								'font-variant' => 'small-caps',
								'position'     => 'absolute',
								'right'        => '36px',
								'bottom'       => '8px',
							)
						)
					);

					cnTemplatePart::returnToTop( array( 'style' => array( 'position' => 'absolute', 'right' => '8px', 'bottom' => '5px' ) ) );

					?>

				</div>

			</div>

			<?php
		}

	}

	// Register the template.
	add_action( 'cn_register_template', array( 'CN_Card_Template', 'register' ) );
}
