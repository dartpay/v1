<?php
header("Content-Type:text/css");
$color = "#f0f"; // Change your Color Here


function checkhexcolor($color)
{
    return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if (isset($_GET['color']) and $_GET['color'] != '') {
    $color = "#" . $_GET['color'];
}

if (!$color or !checkhexcolor($color)) {
    $color = "#336699";
}
?>
.scrollToTop,
input[type="submit"], .custom-pagination li a.active, .common-pagination span, ::selection , .header-top, .header-bottom .header-bottom-area .menu-area .menu li .sub-menu li:hover > a, .header-bar span, .exchange-form .form-group input[type="submit"], .exchange-form .form-group button, .exchange-form .form-group .rates, .section-bg.get-service .exchange-form .form-group input[type="submit"],.blog-sidebar .widget.widget-search form .form-group button, .feature-item::after, .how-item.active .serial, .how-item:hover .serial, .newslater-form button, .get-service .exchange-form .form-group input[type="submit"], .account-form .form-group input[type="submit"], .privacy-content .item .bullet-list li::before, .terms-of-service-wrapper .item .left .title::before, .contact-form .form-group input[type="submit"], .contact--item::before, .contact--item::after, .process-tab .tab-menu li.active , .exchange-from-to-form .form-group input[type="submit"], .affiliate-item .affiliate-thumb, .theme-button, .post-item .post-content::before, .post-item .post-content::after, .post-item.post-details .post-content .thumb-area ul li::before, .post-item blockquote::before, .blog-pagination li a.active, .blog-pagination li a:hover, .comment-wrapper li .comment-item:hover .reply-button , .comment-form-group button, .custom-button, .custom-button.white:hover, .swiper-slide-next .custom-button:hover, .swiper-slide-next .custom-button.white , .transaction-table .t-header, .widget.widget-search .search--form button, .widget.widget-tags ul li a:hover, .widget .title , .bg_theme, .reserve_item .reserve_header, .faq-item.open .faq-title, .list::-webkit-scrollbar-track {
background:<?php echo $color; ?>;
}
.custom-pagination li a, .custom-pagination li a.active, .exchange-form .form-group input:focus, .blog-sidebar .widget.widget-search form .form-group button, .blog-sidebar .widget.widget-tags ul li a:hover, .client-item .client-content blockquote, .account-form .form-group input:focus, .contact-form .form-group input:focus, .contact-form .form-group textarea:focus, .exchange-from-to-form .form-group input[type="submit"], .custom-button:hover, .widget.widget-tags ul li a:hover {
border-color:<?php echo $color; ?> !important;
}

.feature-thumb i, .section-header .cate, .section-header .title span, .custom-pagination li a:hover, .footer-bottom p a, .footer-area .footer-widget.widget-link ul li a:before, .footer-area .footer-widget.widget-link ul li a:hover, .blog-sidebar .widget.widget-archive ul li a:hover, .blog-sidebar .widget.widget-category ul li a:hover, .blog-sidebar .widget.widget-post ul li a:hover .subtitle, .blog-sidebar .widget.widget-tags ul li a:hover, .feature-item.active .feature-content .title, .feature-item:hover .feature-content .title, .how-item.active .title, .how-item:hover .title.faq-wrapper-3 .faq-item:nth-of-type(4n + 4) .faq-number .thumb, .faq-wrapper-2 .faq-item:nth-of-type(4n + 4) .faq-number .thumb, .currency-converter p a, .account-form .form-group label a, .process-tab .tab-menu li .thumb i, .currency-rate span, .confirmation-group .confirmation-content .con-header p .currency-cl, .confirmation-group .confirmation-content .transaction-id li .trans-id, .confirmation-group .confirmation-content .content a:hover, .responsive-table strong, .dashboard-item .dashboard-content .amount, .post-item .post-content .meta-post a i, .post-item .post-content .meta-post a:hover, .post-item.post-details .post-content .tag-options .tags a:hover, .post-item.post-details .post-content .tag-options .share a:hover, .post-item:hover .post-content .blog-header .title a, .comment-wrapper li .comment-item:hover .sub-title a, .custom-button.white, .swiper-slide-next .custom-button, .widget.widget-archive ul li a::before, .widget.widget-category ul li a::before, .widget.widget-archive ul li a:hover, .widget.widget-category ul li a:hover, .widget.widget-banner a:hover , .widget.widget-post ul li .content .sub-title a:hover, .widget.widget-post ul li .content .meta a, .cl-theme {
color:<?php echo $color; ?> !important;
}
.how-item .how-thumb,
.preloader .wellcome span {
    color: <?php echo $color; ?>;
}

.service-item .service-thumb {
    color: <?php echo $color ?>22;
}
.how-item::before {
    color: <?php echo $color ?>80;
}