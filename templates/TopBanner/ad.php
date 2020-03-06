<?php
$linkStart = '<a href="' . $linkURL . '" target="_blank">';
$linkEnd   = '</a>';
$message   = sprintf($message, $linkStart, $linkEnd);
?>
<div class="pp-pro-ads-top-banner">
    <span class="pp-pro-ads-top-banner-message"><?php echo $message; ?></span>
    <button type="button" class="dismiss" title="<?php __('Dismiss this message.', 'publishpress-pro-ads'); ?>"
            data-page="overview"></button>
</div>