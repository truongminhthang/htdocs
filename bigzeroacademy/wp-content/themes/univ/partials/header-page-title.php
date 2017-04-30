<?php
/**
 * This partial is used for displaying the Site Header when in archive pages
 *
 * @package Layers
 * @since Layers 1.0.0
 */

$show_page  = get_post_meta( get_the_ID(),'_univ_breadcrumbs', true );  
?>

<!-- breadcrumb-area start -->
<?php if(!is_front_page() && is_page())  :  ?>
  <?php if( $show_page == 0 ) { ?>
    <div class="breadcrumb-banner-area pages-area">
        <div class="container">
            <div class="grid">
				<div class="column span-12">
					<div class="breadcrumb-padding pages-p">

						<div class="bread-crumbs">
							<?php univ_breadcrumbs();?>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
<?php } ?>

<?php elseif( is_archive() ) : ?>
	<div class="breadcrumb-banner-area archive-page">
        <div class="container">
            <div class="grid">
				<div class="column span-12">
					<div class="breadcrumb-padding pages-p">
						<div class="bread-crumbs">
							<?php univ_breadcrumbs();?>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
	
<?php elseif(is_single()) : ?>
	<?php if( $show_page == 0 ) { ?>
		<div class="breadcrumb-banner-area single-page">
			<div class="container">
				<div class="grid">
					<div class="column span-12">
						<div class="breadcrumb-padding pages-p">
							<div class="bread-crumbs">
								<?php univ_breadcrumbs();?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
	
<?php elseif(is_404()) : ?>

	<div class="breadcrumb-banner-area notfound-page">
		<div class="container">
			<div class="grid">
				<div class="column span-12">
					<div class="breadcrumb-padding pages-p">
						<div class="bread-crumbs">
							<?php univ_breadcrumbs();?>							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php elseif(is_search()) : ?>
    <div class="breadcrumb-banner-area search-page">
        <div class="container">
            <div class="grid">
				<div class="column span-12">
					<div class="breadcrumb-padding pages-p">
						<div class="bread-crumbs">
							<?php univ_breadcrumbs();?>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>

<?php else : ?>

<?php endif; ?>
<!-- breadcrumb-area end -->