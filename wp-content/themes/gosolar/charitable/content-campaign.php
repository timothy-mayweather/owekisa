<?php 
/**
 * Displays the campaign content.
 *
 * Override this template by copying it to yourtheme/charitable/content-campaign.php
 *
 * @author  Studio 164a
 * @package Charitable/Templates/Campaign
 * @since   1.0.0
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$campaign = $view_args[ 'campaign' ];
$content = $view_args[ 'content' ];

/**
 * @hook charitable_campaign_content_before
 */
//do_action( 'charitable_campaign_content_before', $campaign ); 
?>
<div class="row campaign-single-summary">
	<div class="col-md-4">
		<div class="campaign-figures campaign-summary-item">
			<?php 
				$currency_helper = charitable_get_currency_helper();
		
					if ( $campaign->has_goal() ) {
						$ret = sprintf( _x( 'Donation: %s / %s', 'amount donated of goal', 'gosolar' ),
							'<span class="amount">' . $currency_helper->get_monetary_amount( $campaign->get_donated_amount() ) . '</span>',
							'<span class="goal-amount">' . $currency_helper->get_monetary_amount( $campaign->get( 'goal' ) ) . '</span>'
						);
					} else {
						$ret = sprintf( _x( '%s donated', 'amount donated', 'gosolar' ),
							'<span class="amount">' . $currency_helper->get_monetary_amount( $campaign->get_donated_amount() ) . '</span>'
						);
					}
		
					echo ( ''. $ret );
				?>	
		</div>
		
		<div class="campaign-progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="<?php echo esc_attr( $campaign->get_percent_donated_raw() ); ?>">
			<span class="bar" style="width: <?php echo esc_attr( $campaign->get_percent_donated_raw() ); ?>%;"></span>
		</div>
	</div>
	<div class="col-md-8 campaign-donate-button-item">
		<div class="campaign-donation pull-right">
			<a class="donate-button button" href="<?php echo charitable_get_permalink( 'campaign_donation_page', array( 'campaign_id' => $campaign->ID ) ) ?>" aria-label="<?php echo esc_attr( sprintf( _x( 'Make a donation to %s', 'make a donation to campaign', 'gosolar' ), get_the_title( $campaign->ID ) ) ) ?>">
				<?php _e( 'Donate', 'gosolar' ) ?>
			</a>
		</div>
	</div>
</div>	
<?php
	echo ( ''. $content );
/**
 * @hook charitable_campaign_content_after
 */
do_action( 'charitable_campaign_content_after', $campaign );